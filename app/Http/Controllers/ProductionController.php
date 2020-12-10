<?php

namespace App\Http\Controllers;

use App\Helpers\Date;
use App\Production;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;

class ProductionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param null $month
     * @param null $year
     */
    public function index($month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        $userProduction = Production::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('user_id', Auth::id())
            ->get();

        $monthProductions = [
            'dates' => $monthCalendar = Date::monthCalendar($month, $year),
            'productions' => $userProduction
        ];


        return view('productions.index', [
            'monthProductions' => $monthProductions,
            'monthSelected' => $month,
            'yearSelected' => $year
        ]);
    }

    public function store(Request $request)
    {
        $producoesRequest = $request->input("prod.*");

        foreach ($producoesRequest as $producao) {
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
