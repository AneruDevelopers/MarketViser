// TODO O JQUERY SERÁ DEPURADO DENTRO DESTA FUNÇÃO

$(document).ready(function() {

        
        $("#topNav").load("functions/includes/topNav.html"); 
        $("#header").load("functions/includes/header.html"); 
        $("#footer").load("functions/includes/footer.html");
        $("#nav").load("functions/includes/nav.html");

        var owl = $('.owl-carousel');
        owl.owlCarousel({
                items:1,
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:3500,
                autoplayHoverPause:true
        });

});

window.onscroll = function() {myFunction()};

var header = document.getElementById("headerSticky");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}

// Storage Menu Header

function mostra() {
document.getElementById('modalMenuHeader').style.display = 'block';
}
      
function esconde() {
document.getElementById('modalMenuHeader').style.display = 'none';
}