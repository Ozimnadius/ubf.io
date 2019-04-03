$(function (e) {
    $('.header__menu').on('click', function (e) {
        $('.menu').toggleClass('active');
    });

    $('.menu__close').on('click', function (e) {
        $('.menu').removeClass('active');
    });
});