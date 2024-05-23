 $(window).scroll(function() {
    if ($(this).scrollTop() === 0) {
    $('navbar').css('top', '70px');
    $('navbar').css('height', '');
        $('navbar ul').css('margin-top', 'auto');
} else {
    $('navbar').css('top', '0px');
    $('navbar').css('height', '100vh');
    $('navbar ul').css('margin-top', '20vh');
    $('main').css('padding-bottom', '70px');
}
});

function test(){
    console.log('Bro funciona')
}

