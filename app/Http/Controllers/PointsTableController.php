<?php

namespace App\Http\Controllers;

use App\PointsTable;
use App\PointsTableInfo;
use App\Production;
use App\Repositories\CommissionRepository;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;

class PointsTableController extends Controller
{

    private $user;
    private $quarter;
    private $year;
    private $productions;
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

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getProductions()
    {
        return $this->productions;
    }

    /**
     * @param mixed $productions
     */
    public function setProductions($productions): void
    {
        $this->productions = $productions;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }

    public function index()
    {
        switch (Auth::user()->profile) {
            case 'realtor' :
                $this->setUser(Auth::user());
            case 'supervisor' :
                $user = $this->getUser() ? $this->getUser() : Auth::user();
                $this->setUser($user);
                $teams = $this->getUser()->team()->get();
                break;
            case 'admin' :
                $teams = Team::orderBy('name', 'asc')->get();
                break;
            default:
                exit();
        }

        $year = ($this->getYear() == null) ? date('Y') : $this->getYear();
        $this->setYear($year);

        // Pega os valores dos pontos de cada item da tabela de pontos
        $pointsTable = PointsTable::where('year', date('Y'))->first();

        // Set quarter
        if (!$this->getQuarter()) {
            $this->setQuarter(currentQuarter());
        }

        $monthsOfQuarter = monthsOfQuarter($this->getQuarter());

        // Set productions
        if ($this->getUser()) {
            $productions = PointsTable::getValuesQuarter($this->getUser(), $this->getQuarter(), $this->getYear());
        }

        $this->setProductions($productions ?? null);

        if (isset($this->user->id)) {
            $qtdFields['plaques'] = Production::sumFieldProduction($this->user->id, 'plaques', monthsOfQuarter($this->getQuarter()), 2020);
            $qtdFields['published_ads'] = Production::sumFieldProduction($this->user->id, 'published_ads', monthsOfQuarter($this->getQuarter()), 2020);
            $qtdFields['exclusivities'] = Production::sumFieldProduction($this->user->id, 'captured_exclusivities', monthsOfQuarter($this->getQuarter()), 2020);

            $infos = PointsTableInfo::infos($this->getUser(), $this->getQuarter(), $this->getYear());
        }

        $salesRealtor = $this->commissionRepository->getQtdSalesRealtor($user)->only($monthsOfQuarter);
        foreach ($salesRealtor as $sale) {
            $qtdSalesRealtor[] = $sale;
        }

        return view('points-table.index', [
            'productions' => $this->getProductions(),
            'qtdSalesRealtor' => $qtdSalesRealtor,
            'quarter' => $this->getQuarter(),
            'year' => $this->getYear(),
            'monthsOfQuarter' => $monthsOfQuarter,
            'teams' => $teams ?? null,
            'pointsTable' => $pointsTable ?? null,
            'realtorSelected' => $this->getUser()->id ?? null,
            'qtdFields' => $qtdFields ?? null,
            'infos' => $infos ?? null
        ]);
    }

    /**
     * Retorna os dados da consulta realizada
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $user_profile = Auth::user()->profile;

        if ($user_profile != 'realtor') {
            $request->validate([
                'realtor' => 'required|integer',
            ]);
            $user = User::find($request->realtor);
            $this->setUser($user);
        }

        $this->setQuarter($request->quarter);
        $this->setYear($request->year);

        return $this->index();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePointsTargets(Request $request)
    {
        PointsTable::updateOrCreate(
            [
                'year' => date('Y')
            ],
            $request->except('_token')
        );

        Toastr::success('Pontuações e metas trimestrais atualizadas com sucesso.');

        return redirect()->back();
    }


    public function storeInfos(Request $request)
    {
        $inputInfos = $request->except('_token', 'quarter', 'year');
        $quarter = $request->quarter;
        $year = $request->year;

        foreach ($inputInfos as $type => $infos) {
            foreach ($infos as $info) {
                if ($info['value']) {
                    PointsTableInfo::updateOrCreate(
                        [
                            'id' => $info['id'],
                            'user_id' => Auth::id(),
                        ],
                        [
                            'quarter' => $quarter,
                            'year' => $year,
                            'type' => $type,
                            'value' => $info['value']
                        ]
                    );
                }
            }
        }

        Toastr::success('Informações salva com sucesso', 'Tabela de pontos');

        return redirect()->route('points-table.index');
    }
}
