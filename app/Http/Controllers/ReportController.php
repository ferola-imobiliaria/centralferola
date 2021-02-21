<?php

namespace App\Http\Controllers;

use App\CommissionsControl;
use App\PointsTable;
use App\Production;
use App\Report;
use App\Repositories\CommissionRepository;
use App\Repositories\ProductionRepository;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    private $quarter;
    private $commissionRepository;
    private $productionRepository;

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

    public function __construct(CommissionRepository $commissionRepository, ProductionRepository $productionRepository)
    {
        $this->middleware('can:is-admin-or-supervisor');

        $this->commissionRepository = $commissionRepository;
        $this->productionRepository = $productionRepository;

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

    public function showTeamProduction(Request $request)
    {
        $teamId = $request->team ?? Auth::user()->team->id;

        $teamProduction = $this->productionRepository->getTeamProduction($teamId, $request->month, $request->year);

        $team = Team::find($teamId);

        foreach ($team->users as $user) {
            Arr::add($teamProduction[$user->name_short], 'sales',
                $this->commissionRepository->getQtdSalesRealtor($user, $request->year)->pull($request->month)
            );

            Arr::add($teamProduction[$user->name_short], 'vgv',
                $this->commissionRepository->getVgvRealtor($user, $request->month, $request->year)
            );

            Arr::add($teamProduction[$user->name_short], 'exclusivities_sold',
                $this->commissionRepository->getQtdItem($user->id, 'exclusivities_sold', $request->year)->pull($request->month)
            );

            Arr::add($teamProduction[$user->name_short], 'captures_sold',
                $this->commissionRepository->getQtdItem($user->id, 'captures_sold', $request->year)->pull($request->month)
            );
        }

        return view('reports.production', [
            'teamProduction' => $teamProduction,
            'teams' => Report::getTeam(),
            'teamSelected' => $team,
            'monthSelected' => $request->month,
            'yearSelected' => $request->year
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

        $pointsTable = PointsTable::where('year', $request->year)->first();
        $monthsOfQuarter = monthsOfQuarter($request->quarter);

        $salesRealtor = $this->commissionRepository->getQtdSalesRealtor($user)->only($monthsOfQuarter);

        foreach ($salesRealtor as $sale) {
            $qtdSalesRealtor[] = $sale;
        }

        return view('reports.points-table', [
            'teams' => Report::getTeam(),
            'quarter' => $request->quarter,
            'productions' => $this->productionRepository->getIndividualYearProduction($user, $request->year)->only($monthsOfQuarter),
            'realtorSelected' => $request->realtor,
            'yearSelected' => $request->year,
            'pointsTable' => $pointsTable,
            'monthsOfQuarter' => $monthsOfQuarter,
            'qtdSalesRealtor' => $qtdSalesRealtor
        ]);
    }
}
