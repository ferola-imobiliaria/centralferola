<?php

namespace App\Http\Controllers;

use App\PointsTable;
use App\PointsTableInfo;
use App\Production;
use App\Repositories\CommissionRepository;
use App\Repositories\ProductionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;

class PointsTableController extends Controller
{
    private $quarter;
    private $year;
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


    public function __construct(CommissionRepository $commissionRepository, ProductionRepository $productionRepository)
    {
        $this->commissionRepository = $commissionRepository;
        $this->productionRepository = $productionRepository;
    }

    public function index()
    {
        $user = Auth::user();

        $year = ($this->getYear() == null) ? date('Y') : $this->getYear();
        $this->setYear($year);

        // Pega os valores dos pontos de cada item da tabela de pontos
        $pointsTable = PointsTable::where('year', date('Y'))->first();

        // Set quarter
        if (!$this->getQuarter()) {
            $this->setQuarter(currentQuarter());
        }

        $monthsOfQuarter = monthsOfQuarter($this->getQuarter());

        $qtdFields['plaques'] = Production::sumFieldProduction($user, 'plaques', monthsOfQuarter($this->getQuarter()), $year);
        $qtdFields['published_ads'] = Production::sumFieldProduction($user, 'published_ads', monthsOfQuarter($this->getQuarter()), $year);
        $qtdFields['exclusivities'] = Production::sumFieldProduction($user, 'captured_exclusivities', monthsOfQuarter($this->getQuarter()), $year);

        $infos = PointsTableInfo::infos($user, $this->getQuarter(), $this->getYear());

        $salesRealtor = $this->commissionRepository->getQtdSalesRealtor($user)->only($monthsOfQuarter);
        foreach ($salesRealtor as $sale) {
            $qtdSalesRealtor[] = $sale;
        }

        return view('points-table.index', [
            'productions' => $this->productionRepository->getIndividualYearProduction($user)->only($monthsOfQuarter),
            'qtdSalesRealtor' => $qtdSalesRealtor,
            'quarter' => $this->getQuarter(),
            'year' => $this->getYear(),
            'monthsOfQuarter' => $monthsOfQuarter,
            'teams' => $teams ?? null,
            'pointsTable' => $pointsTable ?? null,
            'realtorSelected' => $user->id ?? null,
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
        if (Auth::user()->profile != 'admin') {
            abort(404);
        }

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
