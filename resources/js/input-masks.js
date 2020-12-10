jQuery(document).ready(function () {
    jQuery('.maskMoney').mask('000.000.000', {reverse: true});
    jQuery('.maskMoney2').mask("#.##0,00", {reverse: true, placeholder: "0,00"});
    jQuery('.maskCpf').mask('000.000.000-00', {placeholder: "000.000.000-00"});
    jQuery('.maskCpfNoPlaceHolder').mask('000.000.000-00');
    jQuery('.maskCellPhone').mask('(00) 0 0000-0000');
});
