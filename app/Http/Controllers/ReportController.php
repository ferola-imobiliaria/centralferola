<?php

namespace App\Http\Controllers;

use App\CommissionsControl;
use App\PointsTable;
use App\Production;
use App\Report;
use App\Repositories\CommissionRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    private $quarter;
    private $commissionRepository;

    /**
     * @return mixed
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * @param mixed $quarter
     */
    public function setQuarter($quarter): void
    {
        $this->quarter = $quarter;
    }

    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->middleware('can:is-admin-or-supervisor');

        $this->commissionRepository = $commissionRepository;

        if (!$this->getQuarter()) {
            $this->setQuarter(currentQuarter());
        }
    }

    public function indexProduction()
    {
        return view('reports.production', [
            'teams' => Report::getTeam()
        ]);
    }

    public function showProduction(Request $request)
    {
        $request->validate([
            'realtor' => 'required|integer',
        ]);

        $userProduction = Production::userMonthProduction($request->realtor, $request->month, $request->year)
            ->toArray();

        if (Auth::user()->profile === 'supervisor') {
            $dayUserProduction = Production::whereMonth('date', $request->month)
                ->whereYear('date', $request->year)
                ->where('user_id', $request->realtor)
                ->get();
        }

        return view('reports.production', [
            'teams' => Report::getTeam(),
            'userProduction' => $userProduction,
            'dayUserProduction' => $dayUserProduction ?? null,
            'realtorSelected' => $request->realtor,
            'monthSelected' => $request->month,
            'yearSelected' => $request->year
        ]);
    }

    public function indexComissionsControl()
    {
        $user = Auth::user();

        switch ($user->profile) {
            case 'admin' :
                $commissionsControls = CommissionsControl::all();
                break;
            case 'supervisor' :
                $commissionsControls = array();

                $user_team = $user->team;
                $team_members = $user_team->users;

                foreach ($team_members as $member) {
                    foreach ($member->commissions as $commission) {
                        array_push($commissionsControls, $commission);
                    }
                }
                break;
            default:
                exit();
        }

        return view('reports.commissions-control', [
            'commissionsControls' => $commissionsControls
        ]);
    }

    public function indexPointsTable()
    {
        $quarter = currentQuarter();

        $pointsTable = PointsTable::where('year', date('Y'))->first();

        return view('reports.points-table', [
            'teams' => Report::getTeam(),
            'quarter' => $quarter,
            'pointsTable' => $pointsTable ?? null,
        ]);
    }

    public function showPointsTable(Request $request)
    {
        $user = User::find($request->realtor);

        $productions = PointsTable::getValuesQuarter($user, $request->quarter, $request->year);
        $pointsTable = PointsTable::where('year', date('Y'))->first();
        $monthsOfQuarter = monthsOfQuarter($request->quarter);

        $salesRealtor = $this->commissionRepository->getQtdSalesRealtor($user)->only($monthsOfQuarter);
        foreach ($salesRealtor as $sale) {
            $qtdSalesRealtor[] = $sale;
        }

        return view('reports.points-table', [
            'teams' => Report::getTeam(),
            'quarter' => $request->quarter,
            'productions' => $productions,
            'realtorSelected' => $request->realtor,
            'pointsTable' => $pointsTable,
            'monthsOfQuarter' => $monthsOfQuarter,
            'qtdSalesRealtor' => $qtdSalesRealtor
        ]);
    }
}
