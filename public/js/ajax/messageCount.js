
$(document).ready(function(){
    $.ajax({
        type: 'get',
        url: '/admin/count-new-message',

        success: function(response) {
            $('#countMessage').append('(' + response +')')
        },
        error: function(){
            alert('error');
        }
    });
    return false;
});
