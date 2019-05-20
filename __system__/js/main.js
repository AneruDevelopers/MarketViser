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

  $('.loop').owlCarousel({
      center: false,
      items:4,
      loop:false,
      margin:8,
      responsive:{
          600:{
              items:7
          }
      }
  });
  
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

// MODAL DE LOGIN

var modal1 = document.getElementById('myModal');

var btn1 = document.getElementById("myBtn2");

var span1 = document.getElementsByClassName("close")[0];

btn1.onclick = function() {
    modal1.style.display = "block";
}

span1.onclick = function() {
    modal1.style.display = "none";
}

// window.onclick = function(event) {
//   if (event.target == modal1) {
//     modal1.style.display = "none";
//   }
// }

// modal1.onclick = function() {
//     modal1.style.display = "none";
// }

// MODAL DE ARMAZÉNS

var modal2 = document.getElementById('myModalArmazem');

var btn2 = document.getElementById("myBtnArmazem");

var span2 = document.getElementsByClassName("closeModalArmazem")[0];

btn2.onclick = function() {
    modal2.style.display = "block";
}

span2.onclick = function() {
    modal2.style.display = "none";
}

// window.onclick = function(event) {
//   if (event.target == modal2) {
//     modal2.style.display = "none";
//   }
// }

modal2.onclick = function() {
    modal2.style.display = "none";
}

// MODAL DE ARMAZÉNS MOBILE

var modal3 = document.getElementById('myModalArmazem');

var btn3 = document.getElementById("myBtnArmazemMobile");

var span3 = document.getElementsByClassName("closeModalArmazem")[0];

btn3.onclick = function() {
    modal3.style.display = "block";
}

span3.onclick = function() {
    modal3.style.display = "none";
}

// window.onclick = function(event) {
//   if (event.target == modal2) {
//     modal2.style.display = "none";
//   }
// }

modal3.onclick = function() {
    modal3.style.display = "none";
}

// EFEITO INPUT CADASTRO

+function($){
  if ($('html').hasClass('lte9')) {
      /* LTE IE9 */
      /*
       * Shim for :placeholder-shown
       * Add .placeholder-shown class to the text field elements then value is set
       */
      var placeholderShown = function(e, self) {
          var self = $(self || this),
              shown = 'placeholder-shown',
              hasValue = !!self.val();
          self.toggleClass(shown, !hasValue);
      }, d = $(document), ns = 'input[type=text],input[type=url],input[type=tel],input[type=number],input[type=file],input[type=email],textarea';
      $(ns).each(function(key, elem) {
          placeholderShown(null, elem);
          d.on('keyup', ns, placeholderShown);
      });
  }
}(jQuery);