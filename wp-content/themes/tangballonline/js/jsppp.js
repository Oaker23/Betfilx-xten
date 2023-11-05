  $("body").addClass("Postbg");
$(window).scroll(function(){
    if($(window).scrollTop() == $(window).height() > $(document).height() - 150) {
        $('.x-header').removeClass('-sticky');

    }else{
     $('.x-header').addClass('-sticky');
 }
});