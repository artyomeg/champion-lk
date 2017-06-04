/*
 Jquery Validation using jqBootstrapValidation
 example is taken from jqBootstrapValidation docs 
 */

jQuery(document).ready(function($) {
    // отправка формы
    $("form.form_ajax").submit(function() {
        // запишем форму, чтобы потом не было проблем с this
        var form = $(this);

        // подготавливаем данные
        var data = form.serialize(); 
        // инициализируем ajax запрос
        $.ajax({ 
            // отправляем в POST формате, можно GET
           type: 'POST', 
           // путь до обработчика, у нас он лежит в той же папке
           url: '/', 
           // ответ ждем в json формате
           dataType: 'json', 
           // данные для отправки
           data: data, 
           // событие до отправки
           beforeSend: function(data) { 
               // например, отключим кнопку, чтобы не жали по 100 раз
                form.find('input[type="submit"]').attr('disabled', 'disabled'); 
            },
            // событие после удачного обращения к серверу и получения ответа
            success: function () {
                var form = $('.modal.fade:visible');
                // Success message
                form.find('.status-text').html("<div class='alert alert-success'>");
                form.find('.status-text > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                
                if (form.attr('id') == '_freeze')
                    form.find('.status-text > .alert-success')
                            .append("<strong>Спасибо за обращение, ваша заявка будет рассмотрена и менеджер свяжется с вами в ближайшее время.</strong>");
                else if (form.attr('id') == '_sendletter')
                    form.find('.status-text > .alert-success')
                            .append("<strong>Спасибо за обращение, нам очень важно Ваше мнение.</strong>");
                
                form.find('.status-text > .alert-success')
                        .append('</div>');

                //clear all fields
                form.trigger("reset");

//                setTimeout(function () {
//                    $("#myModal").modal('hide');
//                }, 4000);
            },
            error: function () {
                var form = $('.modal.fade:visible');
                // Fail message
                form.find('.status-text').html("<div class='alert alert-danger'>");
                form.find('.status-text > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                form.find('.status-text > .alert-danger').append("<strong>Извините, кажется проблемы на сервере отправки писем...</strong> Вы не могли бы написать напрямую на адрес <a href='youremail@mail.com?Subject=Перезвоните мне'>youremail@mail.com</a> ? Приносим извинения за это неудобство!");
                form.find('.status-text > .alert-danger').append('</div>');
                //clear all fields
                form.trigger("reset");
            },
            // событие после любого исхода
            complete: function(data) { 
                // в любом случае включим кнопку обратно
                form.find('input[type="submit"]').prop('disabled', false); 
            }

        });

        return false;
        // вырубаем стандартную отправку формы
//        return false; 
    });
});




/*
$(function () {
        // подготавливаем данные
        var data = form.serialize(); 

    
        $.ajax({
            url: "recall_me.php",
            type: "POST",
            data: {data},
            cache: false,
            success: function () {
                // Success message
                $('#success').html("<div class='alert alert-success'>");
                $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success > .alert-success')
                        .append("<strong>Спасибо! Ваше сообщение отправлено.</strong>");
                $('#success > .alert-success')
                        .append('</div>');


                //clear all fields
                $('#contactForm').trigger("reset");

                setTimeout(function () {
                    $("#myModal").modal('hide');
                }, 4000);

            },
            error: function () {
                // Fail message
                $('#success').html("<div class='alert alert-danger'>");
                $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success > .alert-danger').append("<strong>Извините, кажется проблемы на сервере отправки писем...</strong> Вы не могли бы написать напрямую на адрес <a href='youremail@mail.com?Subject=Перезвоните мне'>youremail@mail.com</a> ? Приносим извинения за это неудобство!");
                $('#success > .alert-danger').append('</div>');
                //clear all fields
                $('#contactForm').trigger("reset");
            },
        })

});


/*When clicking on Full hide fail/success boxes */
$('#name').focus(function () {
    $('#success').html('');
});