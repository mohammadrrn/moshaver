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



// _______Trust-offices_________
$(".cover-comment-row-right-top-like-defult").click(function(){
    $(".cover-comment-row-right-top-like-blue").css("display" , "block");
    $(this).css("display" , "none");
    $(".cover-comment-row-right-top-dislike-red").css("display" , "none");
    $(".cover-comment-row-right-top-dislike-defult").css("display" , "block");
});
$(".cover-comment-row-right-top-like-blue").click(function(){
    $(".cover-comment-row-right-top-like-defult").css("display" , "block");
    $(this).css("display" , "none");
});
$(".cover-comment-row-right-top-dislike-defult").click(function(){
    $(".cover-comment-row-right-top-dislike-red").css("display" , "block");
    $(this).css("display" , "none");
    $(".cover-comment-row-right-top-like-blue").css("display" , "none");
    $(".cover-comment-row-right-top-like-defult").css("display" , "block");
});
$(".cover-comment-row-right-top-dislike-red").click(function(){
    $(".cover-comment-row-right-top-dislike-defult").css("display" , "block");
    $(this).css("display" , "none");
    
});

$(".trusted-offices-box-box-left-first-box-img-dislike-1").click(function(){
    $(".trusted-offices-box-box-left-first-box-img-dislike-2").css("display" , "block");
    $(".trusted-offices-box-box-left-first-box-img-dislike-1").css("display" , "none");
    $(".trusted-offices-box-box-left-first-box-img-like-2").css("display" , "none");
    $(".trusted-offices-box-box-left-first-box-img-like-1").css("display" , "block");
});
$(".trusted-offices-box-box-left-first-box-img-dislike-2").click(function(){
    $(".trusted-offices-box-box-left-first-box-img-dislike-1").css("display" , "block");
    $(".trusted-offices-box-box-left-first-box-img-dislike-2").css("display" , "none");
    $(".trusted-offices-box-box-left-first-box-img-like-1").css("display" , "block");
    $(".trusted-offices-box-box-left-first-box-img-like-2").css("display" , "none");
});
$(".trusted-offices-box-box-left-first-box-img-like-1").click(function(){
    $(".trusted-offices-box-box-left-first-box-img-like-2").css("display" , "block");
    $(".trusted-offices-box-box-left-first-box-img-like-1").css("display" , "none");
    $(".trusted-offices-box-box-left-first-box-img-dislike-1").css("display" , "block");
    $(".trusted-offices-box-box-left-first-box-img-dislike-2").css("display" , "none");
});
$(".trusted-offices-box-box-left-first-box-img-like-2").click(function(){
    $(".trusted-offices-box-box-left-first-box-img-like-1").css("display" , "block");
    $(".trusted-offices-box-box-left-first-box-img-like-2").css("display" , "none");
    $(".trusted-offices-box-box-left-first-box-img-dislike-1").css("display" , "block");
    $(".trusted-offices-box-box-left-first-box-img-dislike-2").css("display" , "none");
});

