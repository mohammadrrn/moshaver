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
$('.price').css('display', 'none');
$('#transfer').on('change', function () {
    $('.price').css('display', 'none');
    var change_input = parseInt(this.value);
    $('.price > div > input').val(0);
    if (change_input == 1) {
        $('#buy_price').css('display', 'block');
    } else if (change_input == 2) {
        $('#mortgage_price').css('display', 'block');
        $('#rent_price').css('display', 'block');
    } else if (change_input == 3) {
        $('#mortgage_price').css('display', 'block');
    } else if (change_input == 4) {
        $("#participation_price").css("display", "block");
    }
});

$('#estate').on('change', function () {
    var change_input = parseInt(this.value);
    if (change_input == 5) {
        $('#year_of_construction').css('display', 'none');
        $('#floor').css('display', 'none');
        $('#plaque').css('display', 'none');
        $('#number_of_floor').css('display', 'none');
        $('#apartment_unit').css('display', 'none');
        $('#number_of_room').css('display', 'none');
    } else {
        $('#year_of_construction').css('display', 'block');
        $('#plaque').css('display', 'block');
        $('#floor').css('display', 'block');
        $('#number_of_floor').css('display', 'block');
        $('#apartment_unit').css('display', 'block');
        $('#number_of_room').css('display', 'block');
    }
});

var transfer_id = $('.transfer_id').val();
if (transfer_id == 1) {
    $('#buy_price').css('display', 'block');
} else if (transfer_id == 2) {
    $('#mortgage_price').css('display', 'block');
    $('#rent_price').css('display', 'block');
} else if (transfer_id == 3) {
    $('#mortgage_price').css('display', 'block');
} else if (transfer_id == 4) {
    $("#participation_price").css("display", "block");
}


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

$(document).ready(function () {

// Currency Separator
    var commaCounter = 10;

    function numberSeparator(Number) {
        Number += '';

        for (var i = 0; i < commaCounter; i++) {
            Number = Number.replace(',', '');
        }

        x = Number.split('.');
        y = x[0];
        z = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(y)) {
            y = y.replace(rgx, '$1' + ',' + '$2');
        }
        commaCounter++;
        return y + z;
    }

// Set Currency Separator to input fields
    $(document).on('keypress , paste', '.number-separator', function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $('.number-separator').on('input', function () {
                e.target.value = numberSeparator(e.target.value);
            });
        } else {
            e.preventDefault();
            return false;
        }
    });
})

$(".panel-nav-ul-li-sub").click(function () {
    $(this).find('.panel-nav-ul-li-sub-ul').slideToggle();
});



