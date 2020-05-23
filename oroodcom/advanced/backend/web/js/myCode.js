$(document).ready(function ()
{
    $('.pass-in').hide();
    $('.password-click').click(function () {
        $('.pass-in').toggle(500);
    });

    $('.logout').click(function () {
    $.post('/oroodcom/advanced/backend/web/site/logout');
    });
    $('.forgot-pass').click(function(event) {
        $(".pr-wrap").toggleClass("show-pass-reset");
    });

    $('.pass-reset-submit').click(function(event) {
        $(".pr-wrap").removeClass("show-pass-reset");
    });

    $(".addNameBtn").click(function () {
        $("#myModal").modal('show')
            .find("#myModalContent")
            .load($(this).attr('value'));
    });

});