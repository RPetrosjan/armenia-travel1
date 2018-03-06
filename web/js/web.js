$( document ).ready(function() {
    $('.selectlangue,.selectlangue>i').click(function () {
        $('.uldropdown').toggleClass('active');
        $('.selectlangue>i').toggleClass('fa-angle-up');
        return false;
    });

    $("html, body").click(function(e) {
        console.log($(e.target).attr('class'));
        if ($(e.target).hasClass('selectlangue') || $(e.target).hasClass('fa-angle-down')  || $(e.target).hasClass('fa-angle-up')) {
            return false;
        }
        $('.uldropdown').removeClass('active');
    });
});
