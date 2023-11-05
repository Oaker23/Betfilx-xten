// tabs Home---------------------------------------------------------
$('#backtohome').click(function(){
  document.getElementById("defaultOpen").click();
});

function opentab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";

  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");

  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";



  $("#backtohistory").hide();
  if ($("#slip").css('display')=='block') {
    $("#backtohistory").show();
  } else{
    $("#backtohistory").hide();
  }




  if ($("#section01").css('display')=='block') {
    $("#containbacktohome").hide();
  }else{
    $("#containbacktohome").show();
  }



}
document.getElementById("defaultOpen").click();
// End tabs Home---------------------------------------------------------





// tabs friend---------------------------------------------------------
function openfriendtab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("friendcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";

  }
  tablinks = document.getElementsByClassName("ininwrapgrid001");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");

  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";




  if ($("#allfriend").css('display')=='none') {
    $(".countearnmoney").hide();
    $(".pcfriendback").hide();
  }else{
    $(".countearnmoney").show();
    $(".pcfriendback").show();
  }


  if ($("#withdrawfriendtabs").css('display')=='block') {
    $("#withdrawfriend").show();
  }else{
    $("#withdrawfriend").hide();
  }



}
document.getElementById("tabfriendopen").click();
// Endtabs friend---------------------------------------------------------





// gamingtab---------------------------------------------------------
function opengame(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabgame");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinkgame");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
// document.getElementById("dfgameOpen").click();
// gamingtab---------------------------------------------------------












// Copy---------------------------------------------------------
$(document).ready(function(){
  $(".copybtn").click(function(event){
    var $tempElement = $("<input>");
    $("body").append($tempElement);
    $tempElement.val($(this).closest(".copybtn").find("span").text()).select();
    document.execCommand("Copy");
    $tempElement.remove();

  });
});
function myAlertTop(){
  $(".myAlert-top").show();
  setTimeout(function(){
    $(".myAlert-top").hide(); 
  }, 2000);
}
// Copy---------------------------------------------------------


var flkty = new Flickity('.carousel',{
 cellAlign: 'center',
 contain: true,
 prevNextButtons: true,
 pageDots: true,
 autoPlay: 3500,
 lazyLoad: 1,
 imagesLoaded: true,
});

flkty.on( 'staticClick', function( event, pointer, cellElement, cellIndex ) {
 flkty.next()
 if ( typeof cellIndex == 'number' ) {

   flkty.selectCell( cellIndex );

 }

});

var $carousel2 = $('.carousel').flickity();
$('.button-resize-1').on( 'click', function() {
  // expand gallery by toggling class
  $carousel2.toggleClass('is-expanded')
  .flickity('resize'); });
















// Promotion-----------------------------------
var swiper = new Swiper('.swiper-container', {
  effect: 'coverflow',
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: 'auto',
  observer: true,
  observeParents: true,
  initialSlide: 1,
  coverflowEffect: {
   rotate: 10,
   stretch:120,
   depth:500,
   modifier: 1,
   slideShadows: true,
 },
 pagination: {
  el: '.swiper-pagination',
},
navigation: {
  nextEl: '.btnnext',
  prevEl: '.btnprev',
},
});

// Promotion--------------------------------------







//Withdraw-------------------------------------------
var el = document.querySelector('input.number');
el.addEventListener('keyup', function (event) {
  if (event.which >= 37 && event.which <= 40) return;

  this.value = this.value.replace(/\D/g, '')
  .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
});
//Withdraw-------------------------------------------






//history-------------------------------------------
$(document).ready(function(){
  $("#withdrawwhis").hide();
});

$('#btnwithdrawwhis').click(function(){
  $('.headdeposit').removeClass("active");
  $('.headwithdraw').addClass("active");
  $("#withdrawwhis").show();
  $("#deposithis").hide();
});

$('#btndeposithis').click(function(){
  $('.headwithdraw').removeClass("active");
  $('.headdeposit').addClass("active");
  $("#deposithis").show();
  $("#withdrawwhis").hide();
});


//history-------------------------------------------































// Deposit -----------------------------------------------------



// W3C's JS Code
var acc = document.getElementsByClassName("accordion");
var i;


  // Add onclick listener to every accordion element
  for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function() {
      // For toggling purposes detect if the clicked section is already "active"
      var isActive = this.classList.contains("active");

      // Close all accordions
      var allAccordions = document.getElementsByClassName("accordion");
      for (j = 0; j < allAccordions.length; j++) {
        // Remove active class from section header
        allAccordions[j].classList.remove("active");

        // Remove the max-height class from the panel to close it
        var panel = allAccordions[j].nextElementSibling;
        var maxHeightValue = getStyle(panel, "maxHeight");

        if (maxHeightValue !== "0px") {
          panel.style.maxHeight = null;
        }
      }

      // Toggle the clicked section using a ternary operator
      isActive ? this.classList.remove("active") : this.classList.add("active");

      // Toggle the panel element
      var panel = this.nextElementSibling;
      var maxHeightValue = getStyle(panel, "maxHeight");
      
      if (maxHeightValue !== "0px") {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    };
  }
  
  // Cross-browser way to get the computed height of a certain element. Credit to @CMS on StackOverflow (http://stackoverflow.com/a/2531934/7926565)
  function getStyle(el, styleProp) {
    var value, defaultView = (el.ownerDocument || document).defaultView;
  // W3C standard way:
  if (defaultView && defaultView.getComputedStyle) {
    // sanitize property name to css notation
    // (hypen separated words eg. font-Size)
    styleProp = styleProp.replace(/([A-Z])/g, "-$1").toLowerCase();
    return defaultView.getComputedStyle(el, null).getPropertyValue(styleProp);
  } else if (el.currentStyle) { // IE
    // sanitize property name to camelCase
    styleProp = styleProp.replace(/\-(\w)/g, function(str, letter) {
      return letter.toUpperCase();
    });
    value = el.currentStyle[styleProp];
    // convert other units to pixels on IE
    if (/^\d+(em|pt|%|ex)?$/i.test(value)) { 
      return (function(value) {
        var oldLeft = el.style.left, oldRsLeft = el.runtimeStyle.left;
        el.runtimeStyle.left = el.currentStyle.left;
        el.style.left = value || 0;
        value = el.style.pixelLeft + "px";
        el.style.left = oldLeft;
        el.runtimeStyle.left = oldRsLeft;
        return value;
      })(value);
    }
    return value;
  }
}





// End Deposit -----------------------------------------------------



























//  เรียกใช้ Sidebar----------------------------------------------------
// var wrapperMenu = document.querySelector('.wrapper-menu');

// wrapperMenu.addEventListener('click', function(){
//   wrapperMenu.classList.toggle('open'); 
//   wrapperMenu.classList.toggle('hamopen');
  
// });


// $(document).ready(function () {
  
//   $("#sidebar").mCustomScrollbar({
//     theme: "minimal"
//   });

//   $('#dismiss, .overlay').on('click', function () {
//     $('#sidebar').removeClass('active');
//     $('.overlay').removeClass('active');
//     wrapperMenu.classList.toggle('open'); 
//     wrapperMenu.classList.toggle('hamopen');
    
    
//   });

//   $('.sidebarCollapse').on('click', function () {
//     $('#sidebar').toggleClass('active');
//     $('.overlay').toggleClass('active');
//     $('.collapse.in').toggleClass('in');
//     $('a[aria-expanded=true]').attr('aria-expanded', 'false');
//   });
// });
//  End เรียกใช้ Sidebar----------------------------------------------------