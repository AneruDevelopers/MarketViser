// TODO O JQUERY SERÁ DEPURADO DENTRO DESTA FUNÇÃO

$(document).ready(function() {
        
        $('.owl-one').owlCarousel({
            loop:false,
            margin:5,
            responsiveClass:true,
            responsive:{
                0:{
                    items:6,
                    loop:false,
                    dots: false
                },
                600:{
                    items:8,
                    loop:false,
                    dots: false
                },
                1000:{
                    items:12,
                    loop:false,
                    dots: false
                }
            }
        });

        $('.owl-mobile').owlCarousel({
            loop:false,
            margin:5,
            responsiveClass:true,
            responsive:{
                0:{
                    items:6,
                    loop:false,
                    dots: false
                },
                600:{
                    items:8,
                    loop:false,
                    dots: false
                },
                850:{
                    items:12,
                    loop:false,
                    dots: false
                }
            }
        });

        $("#owl-demo").owlCarousel({
 
            items:1,
            loop:true,
            margin:5,
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            lazyLoad: true,
            nav:false,
            pagination:false,
            dots:false,
            singleItem:true
        });

        // LOGIN BUTTON MODAL

        
});

(function() {
  'use strict';
  $('.hamburger-menu').click(function (e) {
      e.preventDefault();
      if ($(this).hasClass('active')){
          $(this).removeClass('active');
          $('.menu-overlay').fadeToggle( 'fast', 'linear' );
          $('.menu .menu-list').slideToggle( 'slow', 'swing' );
          $('.hamburger-menu-wrapper').toggleClass('bounce-effect');
      } else {
          $(this).addClass('active');
          $('.menu-overlay').fadeToggle( 'fast', 'linear' );
          $('.menu .menu-list').slideToggle( 'slow', 'swing' );
          $('.hamburger-menu-wrapper').toggleClass('bounce-effect');
      }
  })
})();


// window.onscroll = function() {myFunction()};

// var header = document.getElementById("headerSticky");
// var sticky = header.offsetTop;

// function myFunction() {
//   if (window.pageYOffset > sticky) {
//     header.classList.add("sticky");
//   } else {
//     header.classList.remove("sticky");
//   }
// }


// Storage Menu Header

// function mostra() {
// document.getElementById('modalMenuHeader').style.display = 'block';
// }
      
// function esconde() {
// document.getElementById('modalMenuHeader').style.display = 'none';
// }


function loadingRes(message="") {
    return "<p><i class='fa fa-circle-notch fa-spin'></i> &nbsp;"+message+"</p>";
}

function clearErrors() {
    $(".has-error").removeClass("has-error");
    $(".help-block").html("");
}

function showErrors(error_list) {
    clearErrors();
    $.each(error_list, function(id, message) {
        $(id).parent().siblings(".help-block").html(message);
    })
}

function messages() {
    $.ajax({
        dataType: 'json',
        url: 'functions/messages.php',
        success: function(json) {
            if(json["message"]) {
                Swal.fire({title: json["title"],
                    text: json["text"],
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonColor: "#d9534f",
                    confirmButtonText: "Ok",
                });
            }
        }
    });
}

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

$("#myBtn2").click(function() {
    $("#usu_email_login").val("");
    $("#usu_senha_login").val("");
    $(".help-block-login").html("");
});
$("#myBtn").click(function() {
    $("#usu_email_login").val("");
    $("#usu_senha_login").val("");
    $(".help-block-login").html("");
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
} 