$('#nav-login').click(() => {
    $('.l-wrapper').toggleClass('active');
    $('.r-wrapper').removeClass('active');
})

$('#nav-register').click(() => {
    $('.r-wrapper').toggleClass('active');
    $('.l-wrapper').removeClass('active');
})

$('.close-r-form').click(() => {
    $('.r-wrapper').removeClass('active');
})

$('.close-l-form').click(() => {
    $('.l-wrapper').removeClass('active');
})
