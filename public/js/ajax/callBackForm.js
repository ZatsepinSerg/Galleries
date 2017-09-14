
$(document).ready(function() {
    $('#show-form').click(function () {
        $('.my-form').removeClass('hide');
        $('.applications').hide();
        $( "#name" ).focus();
    });
    $('#cancel').click(function () {
        $('.my-form').addClass('hide');
        $('.applications').show();
    });
});


$(document).ready(function(){
    $("#callMasters").submit(function() { //устанавливаем событие отправки для формы с id=form

        var  date = $(this).serialize();

        $.ajax({
            type: 'post',
            url: '/application',
            data: date,
            success: function(response) {
                //alert(response);

                $('.my-form').addClass('hide');
                $('.applications').show();
            },
            error: function(){
                alert('error');
            }
        });
        return false;
    });
});

