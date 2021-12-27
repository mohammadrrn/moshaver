$(".box-lang").click(function () {
    $(".box-lang-select").slideToggle();
});
$(".box-job").click(function () {
    $(".box-job-select").slideToggle();
});
$(".panel-nav-icon-menu").click(function () {
    $(".panel-nav-ul").slideToggle();
});
$(".header-right-icon-moshaver").click(function () {
    $(".menu-responsive").slideToggle();
});

$(".btn-choose-gold").click(function () {
    $(".subscription-center-gold").slideToggle();
    $(".subscription-center-silver").css("display", "none");
});
$(".btn-choose-silver").click(function () {
    $(".subscription-center-silver").slideToggle();
    $(".subscription-center-gold").css("display", "none");

});

//send-request
$(document).ready(function () {
    $(".type-of-option-items-button").click(function () {
        $("button").removeClass("gray");
        $(".type-of-option-items-button").removeClass("type-of-option-items-1");
        $(this).addClass("gray");
    });
    $(".type-of-option-items-button-2").click(function () {
        $("button").removeClass("gray-2");
        $(this).addClass("gray-2");
    });
});

$("#colorWell").on("change", function () {
    var change_color = document.querySelector("#colorWell");
    $(".inside").css("background", change_color.value);
});


//zoonkan
// function sortable(section, onUpdate){
//     var dragEl, nextEl, newPos, dragGhost;

//     let oldPos = [...section.children].map(item => {
//       item.draggable = true
//       let pos = document.getElementById(item.id).getBoundingClientRect();
//       return pos;
//     });

//     function _onDragOver(e){
//         e.preventDefault();
//         e.dataTransfer.dropEffect = 'move';

//         var target = e.target;
//         if( target && target !== dragEl && target.nodeName == 'DIV' ){
//           if(target.classList.contains('inside')) {
//             e.stopPropagation();
//           } else {
//           var targetPos = target.getBoundingClientRect();
//           var next = (e.clientY - targetPos.top) / (targetPos.bottom - targetPos.top) > .5 || (e.clientX - targetPos.left) / (targetPos.right - targetPos.left) > .5;
//             section.insertBefore(dragEl, next && target.nextSibling || target);
//            console.log(oldPos);
//             }
//         }
//     }
//     function _onDragEnd(evt){
//         evt.preventDefault();
//         newPos = [...section.children].map(child => {
//              let pos = document.getElementById(child.id).getBoundingClientRect();
//              return pos;
//            });
//         console.log(newPos);
//         dragEl.classList.remove('ghost');
//         section.removeEventListener('dragover', _onDragOver, false);
//         section.removeEventListener('dragend', _onDragEnd, false);

//         nextEl !== dragEl.nextSibling ? onUpdate(dragEl) : false;
//     }
//       section.addEventListener('dragstart', function(e){
//         dragEl = e.target;
//         nextEl = dragEl.nextSibling;
//         e.dataTransfer.effectAllowed = 'move';
//         e.dataTransfer.setData('Text', dragEl.textContent);
//         section.addEventListener('dragover', _onDragOver, false);
//         section.addEventListener('dragend', _onDragEnd, false);
//         setTimeout(function (){
//             dragEl.classList.add('ghost');
//         }, 0)
//     });
// }

// sortable( document.getElementById('list'), function (item){

// });

//zoonkan-color
// var colorWell;
// var defaultColor = "#0000ff";


// window.addEventListener("load", startup, false);


// function startup() {
//   colorWell = document.querySelector("#colorWell");
//   colorWell.value = defaultColor;

//   colorWell.addEventListener("input", updateFirst, false);
//   colorWell.addEventListener("change", updateAll, false);
//   colorWell.select();
// }


// function updateFirst(event) {
//   var inside = document.getElementsByClassName("inside");

//   if (inside) {
//     inside.style.background = event.target.value;
//   };
// }

// function updateAll(event) {
//   document.querySelectorAll(".inside").forEach(function(inside) {
//     inside.style.background = event.target.value;
//   });
// };

//group select option
$('#mortgage_price').val(0);
$('#buy_price').val(0);
$('#rent_price').val(0);
$('.ddlViewBy').on('change', function () {
    var change_input = parseInt(this.value);
    if (change_input === 1 || change_input === 3) {
        $("#box-by").css("display", "block");
        $("#box-mortgage").css("display", "none");
        $("#box-rent").css("display", "none");
        $('#rent_price').val(0);
        $('#mortgage_price').val(0);
    } else {
        $("#box-by").css("display", "none");
        $("#box-mortgage").css("display", "block");
        $("#box-rent").css("display", "block");
        $('#buy_price').val(0);
    }
    // console.log(change_input);
});


$('img.marked').click(function (e) {
    const marked_id = $(this).attr('aria-valuetext');
    const id = $(this).attr('id');
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: "/bookmarked",
        type: "POST",
        data: {
            marked_id: marked_id,
            _token: _token
        },
        success: function (response) {
            if (response) {
                $("#" + id).attr('src', response.img)
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
});

$('.alert-message').animate({
    right: "30px",
    opacity: '1',
}, 500, function () {
    $('.alert-message').delay(3000).animate({
        right: "0",
        opacity: '0',
    }, 500)
})

