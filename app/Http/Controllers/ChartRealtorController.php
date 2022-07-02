<?php

namespace App\Http\Controllers;

use App\Charts\ChartReports;
use App\Repositories\CommissionRepository;
use Illuminate\Support\Facades\Auth;

class ChartRealtorController extends Controller
{
    private $commissionRepository;

    public function __construct(CommissionRepository $commissionRepository)
    {
        $this->commissionRepository = $commissionRepository;
    }

    public function index()
    {
        die('aqui');
        return view('charts.realtor', [
            'commissionChart' => $this->chart('realtor_commission', 'Comissões', 'line', '#dc3545c2'),
            'catcherChart' => $this->chart('catcher_commission', 'Captações', 'line', '#075f1cc2'),
            'exclusiveChart' => $this->chart('exclusive_commission', 'Exclusividades', 'line', '#5e5f07c2')
        ]);
    }

    /**
     * Função que renderiza o gráfico
     *
     * @param $field
     * @param $title
     * @param $type
     * @param $background
     * @return ChartReports
     */
    public function chart($field, $title, $type, $background): ChartReports
    {
        $dataset = $this->commissionRepository->getIndividualCommission(Auth::id(), $field);

        $chart = new ChartReports();
        $chart->labels(months('short'));
        $chart->dataset($title, $type, $dataset)->options([
            'backgroundColor' => $background,
        ]);

        return $chart;
    }
}
