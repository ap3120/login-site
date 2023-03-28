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

$('#r-f').on('submit', (e) => {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: 'php/register.php',
        data: {
            username: $('#r-username').val(),
            password: $('#r-pw').val(),
            password2: $('#r-pw-2').val(),
        },
        dataType: 'json',
        success: res => {
            
            console.log(res);
            if (res.msg === 'The two passwords do not match.' || res.msg === 'User already exists.') {
                alert(res.msg);
            } else {
                $('.r-wrapper').removeClass('active');
                $('.l-wrapper').addClass('active');
            }
        },
        error: errorThrown => {console.log(errorThrown);}
    })
});
