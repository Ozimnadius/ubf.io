$(function (e) {
    $('.header__menu').on('click', function (e) {
        $('.menu').toggleClass('active');
    });

    $('.menu__close').on('click', function (e) {
        $('.menu').removeClass('active');
    });

    $('input[type=tel]').mask('+7 (999) 999-99-99');

    $('.call').on('click', function (e) {
        $('.popup').addClass('active');
    });

    $('body').on('click', '.form__close', function (e) {
        $('.popup').removeClass('active');
    });

    $('.form').validate(
        {
            rules: {
                name: "required",
                tel: "required",
                email: "required"
            },
            messages: {
                name: "Введите ваше Имя",
                tel: "Введите ваш Телефон",
                email: "Введите ваш Email"
            },

            submitHandler: function (form) {

                let wrap = $(form).find('.form__wrap'),
                    data = $(form).serialize();

                $.ajax({
                    dataType: "json",
                    type: "POST",
                    url: 'php/ajax.php',
                    data: data,
                    success: function (result) {
                        if (result.status) {
                            wrap.html(result.html);
                        } else {
                            alert('Что-то пошло не так, попробуйте еще раз!!!');
                        }
                    },
                    error: function (result) {
                        alert('Что-то пошло не так, попробуйте еще раз!!!');
                    }
                });
            }
        }
    );
});