/**
 * Atibuindo o valor de venda a uma variável global
 */
let saleValue;

$('#sale_value').on('change', function () {
    saleValue = parseFloat($(this).val().replace(/\./g, '').replace(',', ''));

    if (!isNaN(saleValue)) {
        $('#commission_percentage, #commission_value, #realtor_percentage').attr("readonly", false);
    } else {
        $('#commission_percentage, #commission_value, #realtor_percentage').attr("readonly", true);
    }
});


/**
 * Função para calcular os valores da comissão
 * @param value
 * @param per
 */
function calcCommission(value, per) {
    let commission = parseFloat(value * per) / 100;
    return commission;
}


/**
 * Função para inserir o valor, com a máscara, das comissões no input indicado
 * @param field
 * @param value
 */
function insertComissions(field, value) {
    $(field).unmask();
    $(field).val(value).mask("#.##0,00", {reverse: true});
}


/**
 * Calcula o valor da comissão da venda.
 * O cálculo e realizado pelo valor da venda e a porcentagem informada no formulário
 */
$('input#commission_percentage').on('focusout change', function () {
    let commissionValue = calcCommission(saleValue, $(this).val());
    insertComissions('#commission_value', commissionValue);

    $('input#commission_value').trigger("change");
});

/**
 * Calcula a porcentagem da venda, se o valor monetário da comissão for informado primeiro,
 * calcula a cmissão do captador e do supervisor
 */
$('input#commission_value').on('focusout change', function () {
    /* Calcula a porcentagem da venda baseado no valor da comissão */
    let commissionPerc = ($(this).cleanVal() * 100) / saleValue;
    $('input#commission_percentage').val(commissionPerc.toFixed(2));

    /* Valor da comissão do captador */
    let commissionCatcher = calcCommission($(this).cleanVal(), 10);
    insertComissions('input#catcher_commission', commissionCatcher);

    /* Valor da comissão do supervisor */
    let commissionVal = $(this).val().replace('.', '').replace(',', '.');
    let commissionSupervisor = calcCommission(commissionVal, 2.5).toFixed(2);
    insertComissions('input#supervisor_commission', commissionSupervisor);

    $('#isExclusive').attr("disabled", false);

    $("#realtor_percentage").trigger("change");
});


/**
 * Calcula o valor monetário da comissão do corretor, após informar a porcentagem da comissão
 */
$('input#realtor_percentage').on('focusout change', function () {
    let commissionValue = $('input#commission_value').val().replace('.', '').replace(',', '.');
    let commissionRealtor = calcCommission(commissionValue, $(this).val()).toFixed(2);
    insertComissions('input#realtor_commission', commissionRealtor)
});


/**
 * Valor comissão da imobiliária
 */
$('input#realtor_percentage').on('focusout change', function () {

    let saleCommission = $('input#commission_value').cleanVal();
    let realtorCommission = $('input#realtor_commission').cleanVal();
    let catcherCommission = $('input#catcher_commission').cleanVal();

    if ($('input#supervisor_commission').length) {
        var supervisorCommission = $('input#supervisor_commission').cleanVal();
    } else {
        var supervisorCommission = 0;
    }

    let realEstateCommission = (saleCommission - realtorCommission - catcherCommission - supervisorCommission);

    insertComissions('input#real_estate_commission', realEstateCommission)
});


/**
 * Exibe/esconde o campo de 'exclusivo'
 * Calcula o valor monetário da camissão de 'exclusivo'
 * Se o checkbox do exclusivo for maracado, a comissão da imobiliária será somada com o valor monetário do exclusivo
 */
$('input:checkbox[id="isExclusive"]').on('change', function () {
    let commissionValue = $('input#commission_value').cleanVal();
    let commissionExclusive = calcCommission(commissionValue, 5);

    let realEstateCommission = parseFloat($('input#real_estate_commission').cleanVal())

    insertComissions('input#exclusive_commission', commissionExclusive);

    $('#divExclusive').toggle('fadeIn', function () {
        if ($('#divExclusive').is(':hidden')) {
            insertComissions('input#real_estate_commission', realEstateCommission + commissionExclusive);
            $('input#exclusive').attr('required', 'true');
        } else {
            insertComissions('input#real_estate_commission', realEstateCommission - commissionExclusive);
            $('input#exclusive').removeAttr('required');
        }
    });

});
