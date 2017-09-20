
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
      //TODO::создать всплывающее окно по центру экрана после отправки сообщения
        $.ajax({
            type: 'post',
            url: '/application',
            data: date,
            success: function(response) {
                $('.my-form').addClass('hide');

                var blockHeight = $('.pop-up_Callback').outerHeight(),
                    blockWidth = $('.pop-up_Callback').outerWidth();
                var w = ($(window).width() - blockWidth) / 2,
                    h = ($(window).height() - blockHeight) / 2;
                var margins = h + 'px' + ' 0 ' + '0 ' + w + 'px';

                $('.pop-up_Callback').css('margin', margins);
                $('.pop-up_Callback').removeClass('hide')
                $('.pop-up_Callback').show()
                    .delay(2000)
                $('.pop-up_Callback').hide(2000)

                $('.applications').show();
            },
            error: function(){
                alert('error');
            }
        });
        return false;
    });
});

