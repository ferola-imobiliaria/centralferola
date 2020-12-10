<?php

namespace App\Http\Controllers;

use App\Charts\ChartReports;
use App\Repositories\CommissionRepository;

class FinancialController extends Controller
{
    private $stores = ['sede', 'noroeste', 'aguas_claras'];
    private $commissionRepository;

    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }

    public function index()
    {
        return view('financial.index', [
            'vgvMonthsChart' => $this->vgvMonthsChart(),
            'vgvYearChart' => $this->vgvYearChart(),
            'vgvQuarterChart' => $this->vgvQuarterChart(),
            'commissionMonthsChart' => $this->commissionMonthsChart(),
            'commissionQuarterChart' => $this->commissionQuarterChart(),
            'commissionYearChart' => $this->commissionYearChart()
        ]);
    }

    public function storeCharts($field)
    {
        switch ($field) {
            case 'vgv' :
                $data['sede'] = $this->commissionRepository->getVgvStore('sede');
                $data['noroeste'] = $this->commissionRepository->getVgvStore('noroeste');
                $data['aguas_claras'] = $this->commissionRepository->getVgvStore('aguas_claras');
                return $data;
            case 'commission' :
                $data['sede'] = $this->commissionRepository->getCommissionStore('sede');
                $data['noroeste'] = $this->commissionRepository->getCommissionStore('noroeste');
                $data['aguas_claras'] = $this->commissionRepository->getCommissionStore('aguas_claras');
                return $data;
            default:
                exit();
        }

    }

    public function vgvMonthsChart(): ChartReports
    {
        $vgvMonthsChart = new ChartReports();
        $vgvMonthsChart->labels(months('short'));
        foreach ($this->stores as $store) {
            $vgvMonthsChart->dataset(ucfirst(trans($store)), 'bar', $this->storeCharts("vgv")[$store]->values())
                ->options([
                    'backgroundColor' => storeColors($store)
                ]);
        }

        return $vgvMonthsChart;
    }

    public function vgvQuarterChart(): ChartReports
    {
        $quartersYear = [];
        for ($i = 1; $i <= 4; $i++) {
            array_push($quartersYear,
                $this->commissionRepository->getVgvStore('noroeste')->only(monthsOfQuarter($i))->sum());
        }

        $vgvQuarterChart = new ChartReports();
        $vgvQuarterChart->labels(['1º TRI', '2º TRI', '3º TRI', '4º TRI']);
        foreach ($this->storeCharts("vgv") as $store => $vgv) {
            $dataset = [];
            for ($i = 1; $i <= 4; $i++) {
                array_push($dataset,
                    $this->commissionRepository->getVgvStore($store)->only(monthsOfQuarter($i))->sum());
            }

            $vgvQuarterChart->dataset(ucfirst(trans($store)), 'bar', $dataset)->options([
                'backgroundColor' => storeColors($store)
            ]);
        }

        return $vgvQuarterChart;
    }

    public function vgvYearChart(): ChartReports
    {
        $vgvYearChart = new ChartReports();
        $vgvYearChart->labels([date('Y')]);
        foreach ($this->storeCharts("vgv") as $store => $vgv) {
            $vgvYearChart->dataset(ucfirst(trans($store)), 'bar', [$vgv->sum()])->options([
                'backgroundColor' => storeColors($store)
            ]);
        }

        return $vgvYearChart;
    }


    public function commissionMonthsChart(): ChartReports
    {
        $commissionMonthsChart = new ChartReports();

        $commissionMonthsChart->labels(months('short'));
        foreach ($this->storeCharts("commission") as $store => $commission) {
            $commissionMonthsChart->dataset(ucfirst(trans($store)), 'bar', $this->storeCharts("commission")[$store]->values())
                ->options([
                    'backgroundColor' => storeColors($store)
                ]);
        }

        return $commissionMonthsChart;
    }

    public function commissionQuarterChart(): ChartReports
    {
        $quartersYear = [];
        for ($i = 1; $i <= 4; $i++) {
            array_push($quartersYear,
                $this->commissionRepository->getCommissionStore('noroeste')->only(monthsOfQuarter($i))->sum());
        }

        $commissionQuarterChart = new ChartReports();
        $commissionQuarterChart->labels(['1º TRI', '2º TRI', '3º TRI', '4º TRI']);
        foreach ($this->storeCharts("commission") as $store => $vgv) {
            $dataset = [];
            for ($i = 1; $i <= 4; $i++) {
                array_push($dataset,
                    $this->commissionRepository->getCommissionStore($store)->only(monthsOfQuarter($i))->sum());
            }

            $commissionQuarterChart->dataset(ucfirst(trans($store)), 'bar', $dataset)->options([
                'backgroundColor' => storeColors($store)
            ]);
        }

        return $commissionQuarterChart;
    }

    public function commissionYearChart(): ChartReports
    {
        $commissionYearChart = new ChartReports();
        $commissionYearChart->labels([date('Y')]);
        foreach ($this->storeCharts("commission") as $store => $commission) {
            $commissionYearChart->dataset(ucfirst(trans($store)), 'bar', [$commission->sum()])->options([
                'backgroundColor' => storeColors($store)
            ]);
        }

        return $commissionYearChart;
    }

}
