<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Comissão #{{ $commission->id }} | PDF </title>
    <style type="text/css">
        ol {
            margin: 0;
            padding: 0
        }

        table td, table th {
            padding: 0
        }

        .c8 {
            border-right-style: solid;
            padding: 0pt 5.8pt 0pt 5.8pt;
            border-bottom-color: #000000;
            border-top-width: 1pt;
            border-right-width: 1pt;
            border-left-color: #000000;
            vertical-align: top;
            border-right-color: #000000;
            border-left-width: 1pt;
            border-top-style: solid;
            border-left-style: solid;
            border-bottom-width: 1pt;
            /*width: 549.4pt;*/
            border-top-color: #000000;
            border-bottom-style: solid
        }

        .c1 {
            color: #000000;
            font-weight: 400;
            text-decoration: none;
            vertical-align: baseline;
            font-size: 12pt;
            font-family: "Arial";
            font-style: normal
        }

        .c11 {
            -webkit-text-decoration-skip: none;
            color: #000000;
            text-decoration: underline;
            vertical-align: baseline;
            text-decoration-skip-ink: none;
            font-size: 14pt;
            font-style: normal
        }

        .c2 {
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 2.3;
            text-align: left
        }

        .c0 {
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 1.5;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        .c12 {
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 2.0;
            text-align: center
        }

        .c3 {
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 1.0;
            orphans: 2;
            widows: 2;
            text-align: center
        }

        .c9 {
            color: #000000;
            text-decoration: none;
            vertical-align: baseline;
            font-size: 10pt;
            font-style: normal
        }

        .c13 {
            color: #000000;
            text-decoration: none;
            vertical-align: baseline;
            font-size: 12pt;
            font-style: normal
        }

        .c10 {
            color: #000000;
            text-decoration: none;
            vertical-align: baseline;
            font-size: 9pt;
            font-style: normal
        }

        .c7 {
            margin-left: -5.8pt;
            border-spacing: 0;
            border-collapse: collapse;
            /*margin-right: auto*/
        }

        /*.c15 {*/
        /*    background-color: #ffffff;*/
        /*    max-width: 538.6pt;*/
        /*    padding: 28.4pt 28.4pt 7.1pt 28.4pt*/
        /*}*/

        .c4 {
            font-weight: 400;
            font-family: "Arial"
        }

        .c6 {
            font-weight: 700;
            font-family: "Arial"
        }

        .c16 {
            background-color: #a6a6a6
        }

        .c14 {
            height: 0pt
        }

        .c5 {
            height: 12pt
        }

        .title {
            padding-top: 24pt;
            color: #000000;
            font-weight: 700;
            font-size: 36pt;
            padding-bottom: 6pt;
            font-family: "Times New Roman";
            line-height: 1.0;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        .subtitle {
            padding-top: 18pt;
            color: #666666;
            font-size: 24pt;
            padding-bottom: 4pt;
            font-family: "Georgia";
            line-height: 1.0;
            page-break-after: avoid;
            font-style: italic;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        li {
            color: #000000;
            font-size: 12pt;
            font-family: "Times New Roman"
        }

        p {
            margin: 0;
            color: #000000;
            font-size: 12pt;
            font-family: "Times New Roman"
        }

        h1 {
            padding-top: 24pt;
            color: #000000;
            font-weight: 700;
            font-size: 24pt;
            padding-bottom: 6pt;
            font-family: "Times New Roman";
            line-height: 1.0;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h2 {
            padding-top: 18pt;
            color: #000000;
            font-weight: 700;
            font-size: 18pt;
            padding-bottom: 4pt;
            font-family: "Times New Roman";
            line-height: 1.0;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h3 {
            padding-top: 14pt;
            color: #000000;
            font-weight: 700;
            font-size: 14pt;
            padding-bottom: 4pt;
            font-family: "Times New Roman";
            line-height: 1.0;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h4 {
            padding-top: 12pt;
            color: #000000;
            font-weight: 700;
            font-size: 12pt;
            padding-bottom: 2pt;
            font-family: "Times New Roman";
            line-height: 1.0;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h5 {
            padding-top: 11pt;
            color: #000000;
            font-weight: 700;
            font-size: 11pt;
            padding-bottom: 2pt;
            font-family: "Times New Roman";
            line-height: 1.0;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h6 {
            padding-top: 10pt;
            color: #000000;
            font-weight: 700;
            font-size: 10pt;
            padding-bottom: 2pt;
            font-family: "Times New Roman";
            line-height: 1.0;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }</style>
</head>

<body>

<p class="c2">
    <span class="c6 c11">CONTROLE DE COMISS&Otilde;ES &ndash; LOJA: {{ strtoupper(__($commission->store)) }}</span>
    <span
        style="float: right; overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 169.67px; height: 92.67px;">
            <img alt="" src="images/pv-resp-control-commission.png""
                 style="width: 169.67px; height: 92.67px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);"></span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1"><b>IM&Oacute;VEL:</b> {{ $commission->property }}</span>
</p>
<p class="c2">
    <span class="c1"><b>EDIF&Iacute;CIO:</b> {{ $commission->edifice }}</span>
</p>
<p class="c2">
    <span
        class="c1"><b>PROPRIETÁRIO:</b> {{ $commission->owner }} {{ ($commission->owner2 ? '/ ' . $commission->owner2 : '') }}</span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1" style="float: left; width: 70%;"><b>CPF:</b> {{ $commission->owner_cpf }}</span>
</p>
<p class="c2" style="text-align: right;">
    <span class="c1"><b>Telefone:</b> {{ $commission->owner_phone }}</span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1" style="float: left; width: 65%;"><b>DATA DA VENDA:</b> {{ $commission->sale_date }}</span>
</p>
<p class="c2" style="text-align: right;">
    <span class="c1"><b>VLR VENDA:</b> R$ {{ number_format($commission->sale_value, 2, ',', '.') }}</span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1" style="float: left; width: 66%;"><b>COMISS&Atilde;O:</b> R$ {{ number_format($commission->commission_value, 2, ',', '.') }}</span>
</p>
<p class="c2" style="text-align: right;">
    <span class="c1"><b>Recebeu em:</b>......../........./.............</span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1" style="float:left; width: 390px;"><b>CORRETOR:</b> {{ $commission->user->name }}</span>
    <span class="c1" style="float:left; width: 50px;">&nbsp;{{ $commission->realtor_percentage }}% </span>
    <span class="c1"
          style="float:left; width: 120px;">R$ {{ number_format($commission->realtor_commission, 2, ',', '.') }}</span>
    <span class="c1" style="float:left;"><b>Data:</b>......../......./.........</span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1" style="float:left; width: 390px;"><b>CAPTADOR:</b> {{ getUserName($commission->catcher) }}</span>
    <span class="c1" style="float:left; width: 50px;">&nbsp;10%</span>
    <span class="c1"
          style="float:left; width: 120px;">R$ {{ number_format($commission->catcher_commission, 2, ',', '.') }}</span>
    <span class="c1" style="float:left;"><b>Data:</b>......../......./.........</span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1"
          style="float:left; width: 390px;"><b>EXCLUSIVO:</b> {{ getUserName($commission->exclusive) }}</span>
    <span class="c1" style="float:left; width: 50px;">&nbsp;10%</span>
    <span class="c1"
          style="float:left; width: 120px;">R$ {{ number_format($commission->exclusive_commission, 2, ',', '.') }}</span>
    <span class="c1" style="float:left;"><b>Data:</b>......../......./.........</span>
</p>

<div style="clear: both;"></div>

<p class="c2">
    <span class="c1"
          style="float:left; width: 390px;"><b>SUPERVISOR:</b> {{ getUserName($commission->supervisor) }}</span>
    <span class="c1" style="float:left; width: 50px;">5%</span>
    <span class="c1"
          style="float:left; width: 120px;">R$ {{ number_format($commission->supervisor_commission, 2, ',', '.') }}</span>
    <span class="c1" style="float:left;"><b>Data:</b>......../......./.........</span>
</p>

<p class="c2">
    <span class="c1"><b>IMOBILIÁRIA:</b> (&nbsp;<span id="perc_real_estate">{{ $realEstatePerc }}</span>% )
            R$ {{ number_format($commission->real_estate_commission, 2, ',', '.') }}</span>
</p>
<p class="c2">
        <span class="c1"><b style="float: left">Obs:</b>
            _________________________________________________________________________________________<br>
            _________________________________________________________________________________________<br>
            _________________________________________________________________________________________<br>
            _________________________________________________________________________________________
        </span>
</p>

<br><br>

<table class="c7">
    <tbody>
    <tr class="c14">
        <td class="c8 c16" colspan="1" rowspan="1">
            <p class="c12">
                <span class="c6 c13">PARA USO EXCLUSIVO DO FINANCEIRO:</span></p></td>
    </tr>
    <tr class="c14">
        <td class="c8" colspan="1" rowspan="1">
            <p class="c2">
                <span class="c1"><b>META SUPERVISOR: &nbsp; &nbsp; &nbsp;SIM ( &nbsp; ) N&Atilde;O ( &nbsp; ) R$____________________ DATA:</b></span>
            </p>
            <p class="c2">
                    <span class="c1"><b style="float: left;">Obs:</b>
                        _________________________________________________________________________________________<br>
                        _________________________________________________________________________________________<br>
                        _________________________________________________________________________________________<br>
                        _________________________________________________________________________________________<br><br>
                    </span>
            </p>
        </td>
    </tr>
    </tbody>
</table>


<p class="c3" style="margin-top: 5px;">
    <span class="c10 c4">SHS QD 06 Bloco &ldquo;C&rdquo; &nbsp;Salas 1701/2 Complexo Brasil 21 Asa Sul - Bras&iacute;lia /DF &nbsp;PABX: (61) 3323-2100</span>
</p>

</body>

</html>
