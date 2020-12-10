$(function () {
    $("select[name='profile']").on('change', function () {
        let selectedProfile = $(this).children("option:selected").val();

        if (selectedProfile === "supervisor") {
            $('#team').removeClass('d-none');
            $('#team_add').removeClass('d-none');
        } else {
            $('#team').addClass('d-none');
            $('#team_add').addClass('d-none');
        }

        if (selectedProfile === "realtor") {
            $('select[name="realtor_team"]').removeClass('d-none');
        } else {
            $('select[name="realtor_team"]').addClass('d-none');
        }

    });

    $('#team').addInputArea({
        maximum: 3
    });
});
