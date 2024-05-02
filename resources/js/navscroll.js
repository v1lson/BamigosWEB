 $(window).scroll(function() {
    if ($(this).scrollTop() === 0) {
    $('navbar').css('top', '70px');
    $('navbar').css('height', '');
} else {
    $('navbar').css('top', '0px');
    $('navbar').css('height', '100vh');
}
});

