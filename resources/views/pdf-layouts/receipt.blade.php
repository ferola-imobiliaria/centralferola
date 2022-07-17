<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style type="text/css">
        body {
            font-family: "dejavu sans", serif;
        }

    </style>

    <title>Recibo - {{ ucfirst($type) }}</title>
</head>

<body>

    @if ($type === 'ferola')
        <div style="padding: 30px 50px; font-size:14pt;">
            <img src="images/logo-ferola-recibo.png" />
            <br /><br />
            <div style="text-align:center; background: #ccc;">
                <h2>RECIBO</h2>
            </div>
            <p style="margin-top: 50px; line-height: 30px; text-align: justify;">
                Recebi integralmente de {{ $commissionControl->owner }},
                CPF nº {{ $commissionControl->owner_cpf }} a quantia de
                <b>R$ {{ number_format(($commissionControl->real_estate_commission + $commissionControl->supervisor_commission), 2, ',', '.') }}
                    ({{ $valueFull }})</b>,
                referente a comissão de venda do imóvel <b> {{ $commissionControl->property }}
                    - {{ $commissionControl->edifice }}</b>.
            </p>
            <p style="margin-top: 50px;">Brasília, {{ $commissionControl->sale_date }}.</p>
            <p style="margin-top: 100px;text-align: center;">_______________________________________________
                <br />Ferola Empreendimentos Imobiliários
                <br />CNPJ: 03.903.776.0001/00
            </p>
        </div>
    @endif


    @if ($type === 'corretor')
        <div style="padding: 30px 50px; font-size:14pt;">
            <img src="images/logo-ferola-recibo.png" />
            <br /><br />
            <div style="text-align:center; background: #ccc;">
                <h2>RECIBO</h2>
            </div>
            <p style="margin-top: 50px; line-height: 30px; text-align: justify;">
                Recebi integralmente de {{ $commissionControl->owner }},
                CPF nº {{ $commissionControl->owner_cpf }} a quantia de
                <b>R$ {{ number_format($commissionControl->realtor_commission, 2, ',', '.') }}
                    ({{ $valueFull }})</b>,
                referente à comissão de venda do imóvel <b> {{ $commissionControl->property }}
                    - {{ $commissionControl->edifice }}</b>.
            </p>
            <p style="margin-top: 50px;">Brasília, {{ $commissionControl->sale_date }}.</p>
            <p style="margin-top: 100px;text-align: center;">_______________________________________
                <br />{{ mb_strtoupper(getUserName($commissionControl->user_id)) }}
                <br />CPF: {{ $commissionControl->user->cpf }}
            </p>
        </div>
    @endif

    @if ($type === 'supervisor')
        <div style="padding: 30px 50px; font-size:14pt;">
            <img src="images/logo-ferola-recibo.png" />
            <br /><br />
            <div style="text-align:center; background: #ccc;">
                <h2>RECIBO</h2>
            </div>
            <p style="margin-top: 50px; line-height: 30px; text-align: justify;">
                Recebi integralmente de {{ env('COMPANY_NAME') }},
                CNPJ nº {{ env('COMPANY_CNPJ') }} a quantia de
                R$ {{ number_format($commissionControl->supervisor_commission, 2, ',', '.') }}
                ({{ $valueFull }}), referente
                a comissão de supervisão de venda do imóvel
                <b> {{ $commissionControl->property }} - {{ $commissionControl->edifice }}</b>.
            </p>
            <p style="margin-top: 50px;">Brasília, {{ $commissionControl->sale_date }}.</p>
            <p style="margin-top: 100px;text-align: center;">_______________________________________
                <br />{{ mb_strtoupper(getUserName($commissionControl->supervisor)) }}
                <br />CPF: {{ getUserCpf($commissionControl->supervisor) }}
            </p>
        </div>
    @endif

    @if ($type === 'exclusivo')
        <div style="padding: 30px 50px; font-size:14pt;">
            <img src="images/logo-ferola-recibo.png" />
            <br /><br />
            <div style="text-align:center; background: #ccc;">
                <h2>RECIBO</h2>
            </div>
            <p style="margin-top: 50px; line-height: 30px; text-align: justify;">
                Recebi integralmente de {{ $commissionControl->owner }},
                CPF nº {{ $commissionControl->owner_cpf }} a quantia de
                <b>R$ {{ number_format($commissionControl->exclusive_commission, 2, ',', '.') }}
                    ({{ $valueFull }})</b>,
                referente a exclusividade de venda do imóvel <b> {{ $commissionControl->property }}
                    - {{ $commissionControl->edifice }}</b>.
            </p>
            <p style="margin-top: 50px;">Brasília, {{ $commissionControl->sale_date }}.</p>
            <p style="margin-top: 100px;text-align: center;">_______________________________________
                <br />{{ mb_strtoupper(getUserName($commissionControl->exclusive)) }}
                <br />CPF: {{ getUserCpf($commissionControl->exclusive) }}
            </p>
        </div>
    @endif

    @if ($type === 'captador')
        <div style="padding: 30px 50px; font-size:14pt;">
            <img src="images/logo-ferola-recibo.png" />
            <br /><br />
            <div style="text-align:center; background: #ccc;">
                <h2>RECIBO</h2>
            </div>
            <p style="margin-top: 50px; line-height: 30px; text-align: justify;">
                Recebi integralmente de {{ $commissionControl->owner }},
                CPF nº {{ $commissionControl->owner_cpf }} a quantia de
                <b>R$ {{ number_format($commissionControl->catcher_commission, 2, ',', '.') }}
                    ({{ $valueFull }})</b>,
                referente a captação da venda do imóvel <b> {{ $commissionControl->property }}
                    - {{ $commissionControl->edifice }}</b>.
            </p>
            <p style="margin-top: 50px;">Brasília, {{ $commissionControl->sale_date }}.</p>
            <p style="margin-top: 100px;text-align: center;">_______________________________________
                <br />{{ mb_strtoupper(getUserName($commissionControl->catcher)) }}
                <br />CPF: {{ getUserCpf($commissionControl->catcher) }}
            </p>
        </div>
    @endif

</body>

</html>
