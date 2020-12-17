<?php

namespace App\Http\Controllers;

use App\Helpers\Date;
use App\Production;
use App\Repositories\ProductionRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;

class ProductionController extends Controller
{

    private $productionRepository;

    public function __construct(ProductionRepository $productionRepository)
    {
        $this->middleware('auth');
        $this->productionRepository = $productionRepository;
    }

    /**
     * @param null $month
     * @param null $year
     */
    public function index($month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return view('productions.index', [
            'monthProductions' => $this->productionRepository->getProductionMonth(Auth::user(), $month, $year),
            'monthSelected' => $month,
            'yearSelected' => $year
        ]);
    }

    public function store(Request $request)
    {
        $producoesRequest = $request->input("prod.*");

        foreach ($producoesRequest as $key => $producao) {

            // Checa se a linha do array possui informações de produção
            $hasProduction = array_sum(Arr::except($producoesRequest[$key], 'date'));

            if ($hasProduction) {
                Production::updateOrCreate(
                    [
                        'date' => $producao['date'],
                        'user_id' => Auth::id()
                    ],
                    [
                        'captured_properties' => $producao['imv_cap'],
                        'captured_exclusivities' => $producao['exc_cap'],
                        'published_ads' => $producao['anuncios_publicados'],
                        'plaques' => $producao['placas'],
                        'proposals' => $producao['propostas'],
                    ]
                );
            }
        }

        Toastr::success('<b>Sua produção foi salva com sucesso!!!</b>');

        return redirect()->route('production.index');
    }

    public function consult(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        return $this->index($month, $year);
    }
}
