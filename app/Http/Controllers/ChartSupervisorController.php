<?php

namespace App\Http\Controllers;

use App\Charts\ChartReports;
use App\Repositories\CommissionRepository;
use App\Repositories\ProductionRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChartSupervisorController extends Controller
{

    private $teamRepository;
    private $productionRepository;
    private $commissionRepository;

    public function __construct(TeamRepository $teamRepository, ProductionRepository $productionRepository, UserRepository $userRepository, CommissionRepository $commissionRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->productionRepository = $productionRepository;
        $this->commissionRepository = $commissionRepository;
        $this->userRepository = $userRepository;


    }

    public function index($type)
    {

         $users = Auth::user();
         $team = $this->userRepository->getUserTeamById($users->id);

         $teams = ($users->profile == 'admin') ? $this->userRepository->getUsersNotAdmin() : $this->userRepository->getUsersTeamByTeam($team);;

        return view('charts.supervisor', [
            'team' => $teams,
            'type' => $type
        ]);
    }

    /**
     * Função que retorna a visualização do gráfico renderizado
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $type)
    {
        $team = $this->userRepository->getUserTeamById($request->realtor);

        return view('charts.supervisor', [
            'team' => $this->userRepository->getUsersTeamByTeam($team),
            'chart' => $this->chartData($request->realtor, $request->field, $request->year, $type),
            'realtorSelected' => $request->realtor,
            'fieldSelected' => $request->field,
            'yearSelected' => $request->year,
            'type' => $type
        ]);
    }

    /**
     * Função que obtém as informações e renderiza o gráfico
     *
     * @param int $user_id
     * @param string $field
     * @param null $year
     * @return ChartReports
     */
    public function chartData(int $user_id, string $field, $year = null, $type): ChartReports
    {

        switch ($type) {
            case 'producao' :
                if ($field == 'sales') {
                    $user = User::find($user_id);
                    $data = $this->commissionRepository->getQtdSalesRealtor($user, $year);
                } elseif ($field === "captures_sold" || $field === "exclusivities_sold") {
                    $data = $this->commissionRepository->getQtdItem($user_id, $field, $year);
                } elseif ($field === "vgv") {
                    $user = User::find($user_id);
                    $data = $this->commissionRepository->getMonthsVgv($user, $year);
                } else {
                    $data = $this->productionRepository->getIndividualProduction($user_id, $field, $year);
                }
                break;
            case 'comissao' :
                $data = $this->commissionRepository->getIndividualCommission($user_id, $field, $year);
                break;
            default :
                exit();
        }

        $chart = new ChartReports();
        $chart->labels(months('short'));
        $chart->dataset(trans($field), 'line', $data->values())->options([
            'backgroundColor' => '#b81a1ab3'
        ]);

        return $chart;
    }
}
