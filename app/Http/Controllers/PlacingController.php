<?php

namespace App\Http\Controllers;

use App\Repositories\ProductionRepository;
use Illuminate\Http\Request;

class PlacingController extends Controller
{
    private $productionRepository;

    public function __construct(ProductionRepository $productionRepository)
    {
        $this->middleware('can:is-admin');

        $this->productionRepository = $productionRepository;
    }

    public function index()
    {
        return view('placings.index', [
            'placingSede' => $this->productionRepository->getRankingProduction('sale_value', 'sede'),
            'placingNoroeste' => $this->productionRepository->getRankingProduction('sale_value', 'noroeste'),
            'placingAguasClaras' => $this->productionRepository->getRankingProduction('sale_value', 'aguas_claras'),
            'placingGeral' => $this->productionRepository->getRankingProduction('sale_value')
        ]);
    }
}
