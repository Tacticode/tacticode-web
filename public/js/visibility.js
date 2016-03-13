var visibility = null;
var character_id = null;
var team_id = null;

$(document).ready(function() {

    visibility = $('#visibility').val();
    character_id = $('#character_id').val();
    team_id = $('#team_id').val();
    $('#visibility, #character_id', '#team_id').remove();

    $('a.visibility').click(function() {

        var new_visibility = 0;
        if (visibility == 0)
            new_visibility = 1;

        $('a.visibility i').removeClass('fa-eye fa-eye-slash');
        $('a.visibility i').addClass('fa-spin fa-spinner');

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

                    $('a.visibility i').removeClass('fa-spin fa-spinner');

                    $('a.visibility').toggleClass('btn-success');
                    $('a.visibility').toggleClass('btn-warning');
                    visibility = new_visibility;
                    if (visibility) {

                        $('a.visibility span').text(lang.characters.visible);
                        $('a.visibility i').toggleClass('fa-eye');
                    }
                    else {

                        $('a.visibility span').text(lang.characters.invisible);
                        $('a.visibility i').toggleClass('fa-eye-slash');
                    }
                }
            }
        }, 'json');
    });
});