$(function () {

    /**
     * Cálculo da pontuação por mês em cada quesito
     */
    let totalMonth = 0;

    $('table#pointsTable tbody tr').each(function () {

        $(this).find('td:not(td:last-child)').each(function (index) {
            let qtd = parseInt($(this).text());
            let score = parseInt($('table#pointsTable thead th:not(:first-child)').eq(index).data('score'));
            totalMonth += qtd * score;
        });

        $(this).find('td:last-child').text(totalMonth);

        totalMonth = 0;
    });


    /**
     *Cálculo total dos pontos no trimestre
     */
    let totalQuarter = 0;

    $(this).find('table#pointsTable tbody tr td:last-child').each(function () {
        totalQuarter += parseInt($(this).text());
    });
    $('.totalQuarterPoints').text(totalQuarter);

    /**
     * Quantidade de pontos que faltam para atingir a meta
     */
    let missingPoints = parseInt($('#targetPoints').text()) - totalQuarter;
    $('#missingPoints').text(missingPoints);

    /**
     * Meta de pontos do trimestre
     */
    let targetPoints = $('#targetPoints').text();
    $('.targetPoints').text(targetPoints);

    /**
     * Barra de progresso da meta de pontos
     */
    let percentTarget = totalQuarter / targetPoints * 100;
    console.log(totalQuarter);
    $('#progress-bar').css('width', percentTarget + '%');

});
