$(function() {

    $('.drop-box').click (function() {
        $('#ul')
            .fadeToggle();
    });

    $('.drop-box').on('click', function() {
        $(this).toggleClass('marked');
        $('.drop-text').toggleClass('marked1');
    });

    $(".drop-box").click(function(){
        $('.rotate').toggleClass("down");
    });

});

// _____login____
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

$('#signUp-responsiv').click(function () {
    $('.container').addClass("right-panel-active");
    // $('.sign-up-container').css('animation', 'show 0.4s');
    $('.sign-up-container').css('transform', 'translateX(0)');
    // $('.sign-in-container').css('animation', 'show 0.4s');
    $('.sign-in-container').css('transform', 'translateX(-100%)');
});
$('#signIn-responsiv').click(function () {
    $('.container').removeClass("right-panel-active");
    // $('.sign-in-container').css('animation', 'show 0.4s');
    $('.sign-in-container').css('transform', 'translateX(0)');
    // $('.sign-up-container').css('animation', 'show 0.4s');
    $('.sign-up-container').css('transform', 'translateX(100%)');
});


$(".login-send-code").click(function(){
    $(this).css("display", "none");
    $(".js-counter ").css("display", "block");
    var seconds = 60,
        pause = 3500,
        counter = '.js-counter',
        zeroStateClass = 'zero-state';



    function timer() {
        $(counter).html((secs < 10 ? "0" : "") + String(secs));
        if (secs > 0) {
            setTimeout(timer, 1000);
        } else {
            $(counter).addClass(zeroStateClass);
            setTimeout(countdown, pause);
        }
        secs--;
    }

    secs = seconds;
    $(counter).removeClass(zeroStateClass);
    timer();

    setTimeout(() => {
        $(this).css("display", "block");
        $(".js-counter").css("display", "none");
    }, seconds * 1000);

});




