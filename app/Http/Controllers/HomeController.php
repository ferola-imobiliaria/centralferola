<?php

namespace App\Http\Controllers;

use App\CommissionsControl;
use App\Production;
use App\Repositories\CommissionRepository;
use App\Repositories\ProductionRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    private $productionRepository;
    private $teamRepository;
    private $userRepository;
    private $commissionRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProductionRepository $productionRepository
     * @param TeamRepository $teamRepository
     */
    public function __construct(ProductionRepository $productionRepository, TeamRepository $teamRepository, UserRepository $userRepository, CommissionRepository $commissionRepository)
    {
        $this->middleware('auth');

        $this->productionRepository = $productionRepository;
        $this->teamRepository = $teamRepository;
        $this->userRepository = $userRepository;
        $this->commissionRepository = $commissionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        switch (Auth::user()->profile) {
            case 'realtor' :
                return $this->indexRealtor(Auth::user());
            case 'supervisor' :
                return $this->indexSupervisor(Auth::user());
            case 'admin' :
                return $this->indexAdmin();
        }
    }

    public function indexRealtor($user)
    {
        // Dados do time do usuário
        $user_team = $user->team;

        //Ganhos no mês corrente com comissão de venda, captação, exclusividade e supervisão
        $monthErnings = CommissionsControl::sumErnings($user->id, date('Y'), [date('m')]);

        //Ganhos no ano corrente com comissão de venda, captação, exclusividade e supervisão
        $yearErnings = CommissionsControl::sumErnings($user->id, date('Y'));

        // Dados da produção do mês do usuário
        $userMonthProduction = Production::userMonthProduction($user->id, date('m'), date('Y'));
        $userMonthProduction->put('vgv', $this->commissionRepository->getVgvRealtor($user, date('m')));
        $userMonthProduction->put('sales', $user->commissions()->whereMonth('sale_date', date('m'))->count());


        // Dados da produção do ano do usuário
        $userYearProduction = Production::userYearProduction($user->id, date('Y'));
        $userYearProduction->put('vgv', $this->commissionRepository->getVgvRealtor($user));
        $userYearProduction->put('sales', $user->commissions()->whereYear('sale_date', date('Y'))->count());

        if ($user_team) {
            $team_members = $user_team->users()->orderBy('profile', 'asc')->orderBy('name', 'asc')->get();
        }

        return view('home', [
            'userMonthProduction' => $userMonthProduction,
            'userYearProduction' => $userYearProduction,
            'team_members' => $team_members ?? null,
            'monthErnings' => $monthErnings,
            'yearErnings' => $yearErnings
        ]);
    }

    public function indexSupervisor($user)
    {
        // Dados do time do usuário
        $user_team = $user->team;

        //Ganhos no mês corrente com comissão de venda, captação, exclusividade e supervisão
        $monthErnings = CommissionsControl::sumErnings($user->id, date('Y'), [date('m')]);

        //Ganhos no ano corrente com comissão de venda, captação, exclusividade e supervisão
        $yearErnings = CommissionsControl::sumErnings($user->id, date('Y'));

        // Dados da produção do mês do usuário
        $userMonthProduction = Production::userMonthProduction($user->id, date('m'), date('Y'));
        $userMonthProduction->put('vgv', $this->commissionRepository->getVgvRealtor($user, date('m')));
        $userMonthProduction->put('sales', $user->commissions()->whereMonth('sale_date', date('m'))->count());


        // Dados da produção do ano do usuário
        $userYearProduction = Production::userYearProduction($user->id, date('Y'));
        $userYearProduction->put('vgv', $this->commissionRepository->getVgvRealtor($user));
        $userYearProduction->put('sales', $user->commissions()->whereYear('sale_date', date('Y'))->count());

        if ($user_team) {
            $team_members = $user_team->users()->orderBy('profile', 'asc')->orderBy('name', 'asc')->get();
        }

        return view('home', [
            'team_members' => $team_members ?? null,
            'monthErnings' => $monthErnings,
            'yearErnings' => $yearErnings,
            'userMonthProduction' => $userMonthProduction,
            'userYearProduction' => $userYearProduction
        ]);
    }

    public function indexAdmin()
    {
        $realtors = $this->userRepository->getRealtors();

        $colors = [
            'sede' => 'success',
            'noroeste' => 'danger',
            'aguas_claras' => 'info'
        ];

        // Usuários por Loja
        $realtor_store = [];
        foreach ($realtors as $realtor) {
            array_push($realtor_store, $realtor->team->store);
        }

        $totalStoreVgv = [
            'sede' => $this->commissionRepository->getVgvStore('sede'),
            'noroeste' => $this->commissionRepository->getVgvStore('noroeste'),
            'aguas_claras' => $this->commissionRepository->getVgvStore('aguas_claras')
        ];

        $totalStoreCommission = [
            'sede' => $this->commissionRepository->getCommissionStore('sede'),
            'noroeste' => $this->commissionRepository->getCommissionStore('noroeste'),
            'aguas_claras' => $this->commissionRepository->getCommissionStore('aguas_claras')
        ];

        return view('home', [
            'colors' => $colors,
            'teams' => $this->teamRepository->getTeam(),
            'rankingVgvSede' => $this->productionRepository->getRankingProduction('sale_value', 'sede'),
            'rankingVgvNoroeste' => $this->productionRepository->getRankingProduction('sale_value', 'noroeste'),
            'rankingVgvAguasClaras' => $this->productionRepository->getRankingProduction('sale_value', 'aguas_claras'),
            'realtors' => $realtors,
            'realtors_store' => array_count_values($realtor_store),
            'stores_vgv' => $totalStoreVgv,
            'totalVgv' => $this->commissionRepository->getVgvStore(),
            'stores_commission' => $totalStoreCommission,
            'totalCommission' => $this->commissionRepository->getCommissionStore()
        ]);
    }
}
