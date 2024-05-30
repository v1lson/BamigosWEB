 $(window).scroll(function() {
    if ($(this).scrollTop() === 0) {
    $('navbar').css('top', '70px');
    $('navbar').css('height', '');
    $('navbar ul').css('margin-top', 'auto');
    $('navbar #menu').css('margin-bottom', ''); 
} else {
    $('navbar').css('top', '0px');
    $('navbar').css('height', '100vh');
    $('navbar #menu').css('margin-top', '30vh');
    $('navbar #menu').css('margin-bottom', 'auto');
    $('main').css('padding-bottom', '70px');
}
});


