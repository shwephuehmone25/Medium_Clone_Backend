$(function () {
    $(document).scroll(function () {
        var $nav = $(".navbar");
        var $btn = $(".get-btn");
        $btn.toggleClass("scrolled", $(this).scrollTop() > $btn.height());
        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
    });
});
