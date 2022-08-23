<?php

namespace App\Http\Controllers;

use App\CommissionsControl;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phputil\extenso\Extenso;

class ReceiptController extends Controller
{

    private $types = ['ferola', 'corretor', 'supervisor', 'exclusivo', 'captador', 'parceiro'];

    public function index()
    {
        return view('receipts.index', [
            'commissionsControls' => CommissionsControl::getCommissionsControlUser()
        ]);
    }

    public function show(Request $request)
    {

        $commission = CommissionsControl::where('uuid', $request->commission)->first();

        return view('receipts.index', [
            'commissionsControls' => CommissionsControl::getCommissionsControlUser(),
            'commission' => $commission,
            'saleSelect' => $request->commission
        ]);

    }

    public function generate(string $type, string $uuid)
    {
        // faz verificação para ver se o type do recibo é válido
        if (!in_array($type, $this->types)) {
            exit();
        }

        $e = new Extenso();

        if (Auth::user()->profile === 'admin') {
            $commissionControl = CommissionsControl::where('uuid', $uuid)
                ->first();
        } else {
            $commissionControl = CommissionsControl::where('uuid', $uuid)
                ->where('user_id', Auth::user()->id)
                ->first();
        }

        switch ($type) {
            case 'ferola':
                $commissionValue = $commissionControl->real_estate_commission + $commissionControl->supervisor_commission;
                break;
            case 'corretor':
                $usuario = $commissionControl->user_id;
                $exclusivo = $commissionControl->exclusive;
                $captador = $commissionControl->catcher;

                if($usuario === $exclusivo){
                    $valor1 = $commissionControl->exclusive_commission;
                }else {
                    $valor1 = 0;
                }

                if($usuario === $captador) {
                    $valor2 = $commissionControl->catcher_commission;
                }else {
                    $valor2 = 0;
                }
                $commissionValue = $commissionControl->realtor_commission + $valor1 + $valor2;

                break;
            case 'supervisor':
                $commissionValue = $commissionControl->supervisor_commission;
                break;
            case 'exclusivo':
                $commissionValue = $commissionControl->exclusive_commission;
                break;
            case 'captador':
                $commissionValue = $commissionControl->catcher_commission;
                break;
            case 'parceiro':
                $commissionValue = $commissionControl->sale_value_parceiro;
                break;
            default:
                exit();
        }

        $pdf = PDF::loadView('pdf-layouts.receipt', [
            'type' => $type,
            'valorTotal' => $commissionValue,
            'commissionControl' => $commissionControl,
            'valueFull' => $e->extenso($commissionValue)
        ]);

        return $pdf->stream();
    }
}
