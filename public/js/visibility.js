$(document).ready(function() {

    $('#visibility, #character_id', '#team_id').remove();

    $('a.visibility').click(function() {

        var div = $(this).parent().parent();

        var visibility = $(div).find('.visibility').val();
        var character_id = $(div).find('.character_id').val();
        var team_id = $(div).find('.team_id').val();

        var new_visibility = 0;
        if (visibility == 0)
            new_visibility = 1;

        $(div).find('a.visibility i').removeClass('fa-eye fa-eye-slash');
        $(div).find('a.visibility i').addClass('fa-spin fa-spinner');

        var url, data;

        if (team_id && !character_id) {

            url = '/teams/setvisibility';
            data = {
                'visibility': new_visibility,
                'team_id': team_id,
            };
        } else if (!team_id && character_id) {

            url = '/characters/setvisibility';
            data = {
                'visibility': new_visibility,
                'character_id': character_id,
            };
        } else
            return;

        $.ajax({
            type: 'post',
            url: url,
            headers: {'X-XSRF-TOKEN' : token},
            data: data,
            success: function(data) {

                if (data.result == 'success') {

                    $(div).find('a.visibility i').removeClass('fa-spin fa-spinner');

                    $(div).find('a.visibility').toggleClass('btn-success');
                    $(div).find('a.visibility').toggleClass('btn-warning');
                    visibility = new_visibility;
                    if (visibility) {

                        $(div).find('a.visibility span').text(lang.characters.visible);
                        $(div).find('a.visibility i').toggleClass('fa-eye');
                    }
                    else {

                        $(div).find('a.visibility span').text(lang.characters.invisible);
                        $(div).find('a.visibility i').toggleClass('fa-eye-slash');
                    }
                }
            }
        }, 'json');
    });
});