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
                let $toast = $('<div>').text(res.msg);
                $toast.attr({'class': 'toast'});
                $('#r-f').append($toast);
                setTimeout(function() {
                    $toast.remove();
                }, 3000);
            } else {
                $('.r-wrapper').removeClass('active');
                $('.l-wrapper').addClass('active');
            }
        },
        error: errorThrown => {console.log(errorThrown);}
    })
});

$('#l-f').on('submit', e => {
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: 'php/login.php',
        data: {
            username: $('#l-username').val(),
            password: $('#l-pw').val()
        },
        dataType: 'json',
        success: res => {
            console.log(res);
            if (res.error) {
                let $toast = $('<div>').text(res.error);
                $toast.attr({'class': 'toast'});
                $('#l-f').append($toast);
                setTimeout(function() {
                    $toast.remove();
                }, 3000);
            } else {
                window.location.href = 'http://localhost/login-site/php/dashboard.php'
            }
        },
        error: errorThrown => {console.log(errorThrown);}
    });
});
