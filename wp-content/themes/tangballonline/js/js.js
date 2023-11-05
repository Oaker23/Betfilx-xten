
var swiper = new Swiper(".promotionsl", {
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween:20,
    observer: true,
  observeParents: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
  },
  autoplay: {
      delay: 5000,
      disableOnInteraction: false,
  },
});   



 $('.headercommentbox').on('click', function () {
        $('.commentbox').toggleClass('d-block');
        
    });



var swiper = new Swiper(".postslide", {
   slidesPerView: "auto",
   centeredSlides: true,
   effect: "coverflow",
   grabCursor: true,
   observer: true,
  observeParents: true,
   coverflowEffect: {
      rotate: 20,
      stretch: 0,
      depth: 200,
      modifier: 1,
      slideShadows: true,
  },
  pagination: {
    el: ".swiper-pagination2",
      clickable: true,
  },
  autoplay: {
      delay: 5500,
      disableOnInteraction: false,
  },
});




$('.containpro').show();
$('.btnpromotion').on('click', function () {
    $('.containpro').show();
    $('.containpost').hide();
    $('.btnpromotion').addClass('active');
    $('.btnpost').removeClass('active');
});
$('.btnpost').on('click', function () {
    $('.containpost').show();
    $('.containpro').hide();
    $('.btnpost').addClass('active');
    $('.btnpromotion').removeClass('active');
});


    $('.sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('.overlay').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
         $('.wrapper-menu').toggleClass('open'); 
         $('.wrapper-menu').toggleClass('hamopen');
         $('.overlay').show();
    });
    $('.overlay,#xsidebar').on('click', function () {
        $('.overlay').hide();
        $('#sidebar').toggleClass('active');
        $('.overlay').toggleClass('active');
        $('.collapse.in').toggleClass('in');
        $('.wrapper-menu').toggleClass('open'); 
         $('.wrapper-menu').toggleClass('hamopen');
    });



       var bgSection01 = $('.bgSection01').find('img').attr('src');
   $(".x-index-top-container").css('background', 'linear-gradient(45deg, transparent, #00000073),url('+ bgSection01 + ')right center');

   var bgSection02 = $('.bgSection02').find('img').attr('src');
   $(".bgsec02").css('background', 'linear-gradient(268deg, #00000000, #2f582000),url(' + bgSection02 + ')center center');

   var bgSection03 = $('.bgSection03').find('img').attr('src');
   $(".section04").css('background', 'linear-gradient(6deg, #00000000, #000000a1),url(' + bgSection03 + ')center');

   var bgSection04 = $('.bgSection04').find('img').attr('src');
   $(".section05").css('background', 'linear-gradient(198deg, #00000030, transparent),url(' + bgSection04 + ')center bottom');

   var bgSection05 = $('.bgSection05').find('img').attr('src');
   $(".section06").css('background', 'url(' + bgSection05 + ')center center');

   var bgSection06 = $('.bgSection06').find('img').attr('src');
   $(".-mobile-application-container").css('background', 'url(' + bgSection06 + ')center center');

   var bgBody = $('.bgBody').find('img').attr('src');
   $(".fixedbgback").css('background', 'url(' + bgBody + ')center center');

   // var bgBody = $('.bgBody').find('img').attr('src');
   // $(".fixedbgback").css('background', 'radial-gradient(#9203035e, #000000ba),url(' + bgBody + ') right center');

   // var bgSection04 = $('.bgSection04').find('img').attr('src');
   // $(".section05").css('background', 'radial-gradient(#000000ab, #8e2d2db5),url(' + bgSection04 + ')');