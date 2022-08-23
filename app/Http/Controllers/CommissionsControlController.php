<?php

namespace App\Http\Controllers;

use App\CommissionsControl;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;

class CommissionsControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $commissionsControls = $user->commissions;

        return view('commissions-control.index', [
            'commissionsControls' => $commissionsControls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $user_team = $user->team;

        $realtors = User::orderBy('name', 'asc')
            ->get(['id', 'name', 'name_short']);

        $supervisor = $user_team->users()->where('profile', 'supervisor')->first();

        return view('commissions-control.create', [
            'user_store' => $user->team->store,
            'supervisor' => $supervisor,
            'realtors' => $realtors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valorParceiro = str_replace(',', '.',
                            str_replace('.', '', $request->sale_value_parceiro));

        $venda = str_replace(',', '.',
            str_replace('.', '', $request->sale_value));


        if($request['isParceiro'] != "on")
        {
            $request['isParceiro'] = null;
            $request['nome_parceiro'] = null;
            $request['nome_parceiro'] = null;
            $request['cpf_cnpj_parceiro'] = null;
            $request['telefone_parceiro'] = null;
            $request['sale_value_parceiro'] = null;
        }else {
            $request['sale_value'] = ($venda + $valorParceiro);
            $request['sale_value_parceiro'] = $valorParceiro;
        }

        CommissionsControl::create($request->all());

        Toastr::success('Controle de Comissões salva com sucesso!');

        return redirect()->route('commissions-control.index');
    }

    /**
     * Display the specified resource.
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $commission = CommissionsControl::where('uuid', $uuid)->first();

//        echo "<pre>";
//        print_r($commission);
//        die;

        /**
         * Calcula a porcentagem de comissão da imobiliária
         */
        $realtorPerc = $commission->realtor_percentage;
        $catcherPerc = $commission->catcher_percentage;
        $exclusivePerc = ($commission->exclusive_commission ? $commission->exclusive_percentage : 0);
        $supervisorPerc = ($commission->supervisor_commission ? $commission->supervisor_percentage : 0);
        $realEstatePerc = 100 - (
                $realtorPerc +
                $catcherPerc +
                $exclusivePerc +
                $supervisorPerc
            );

        $pdf = PDF::loadView('pdf-layouts.commission-control', [
            'commission' => $commission,
            'realEstatePerc' => $realEstatePerc
        ]);

        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $commission_control = CommissionsControl::where('uuid', $uuid)->first();

        return view('commissions-control.edit', [
            'commission_control' => $commission_control
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $update = CommissionsControl::where('uuid', $uuid)
            ->update($request->except('_token', '_method'));

        if ($update) {
            Toastr::success('Controle de comissão editado com sucesso.');
            return redirect()->back();
        } else {
            Toastr::error('Erro ao atualizar o Controle de comissão', 'Tente novamente.');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $commissionControl = CommissionsControl::where('uuid', $uuid)->first();
        $id = $commissionControl->id;

        if ($commissionControl->delete()) {
            Toastr::success("Controle de comissões {$id} excluído com sucesso.");
        } else {
            Toastr::error("O Controle de comissões {$id} não pode ser removido. Tente novamente.", "Erro");
        }

        return redirect()->back();

    }
}
