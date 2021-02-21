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
});
