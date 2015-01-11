$(document).ready(function() {
/*Sticky header*/
  var stickyNavTop = $('.header').offset().top;
  var stickyNav = function(){
    var scrollTop = $(window).scrollTop();
    if (scrollTop > stickyNavTop) {
      $('.header').addClass('header-sticky');
    } else {
        $('.header').removeClass('header-sticky');
      }
  };
  stickyNav();
  $(window).scroll(function() {
    stickyNav();
  });

/*Smooth scrolling with first click bug covered*/
  var $header_height = $(".header");
  $('a[href^="#"]').on('click', function(event) {
    $(this).parent().addClass("active_menu");
    $(this).parent().siblings().removeClass("active_menu");
    var target = $( $(this).attr('href') );
    var headerHeight = $(".header").height();
    if( target.length ) {
      event.preventDefault();
      //this is the fix part
      if (!$(".header").hasClass("header-sticky")) {
        $('html, body').animate({
            scrollTop: target.offset().top-headerHeight*2-19
        }, 1000);
      //here it ends
      } else {  
        $('html, body').animate({
            scrollTop: target.offset().top-headerHeight-9
        }, 1000);
      }
    }
  });

/*Sidebar menu action*/
  $(".menu li").each(function(){
    $(this).click(function(e){
      $(this).find("i").toggleClass("fa_active");
      $(this)./*has("ul.sub_menu").*/toggleClass("menu_active");
      $(this).siblings().find("ul.sub_menu").slideUp();
      $(this).siblings().find("ul li").removeClass("menu_active");
      $(this).siblings().not(this).removeClass("menu_active");
      $(this).siblings().find("i").not(this).removeClass("fa-rotate-180 fa_active");
      $(this).find("ul.sub_menu").slideToggle();
      e.stopPropagation();
    });
  });

/*Load on click*/
  $(".side-bar-right li").click(function(e){
    if($(this).attr("href") != '') {
      $('.content-left').load($(this).attr("href"));
      e.stopPropagation();
    } else {
      $('.content-left').html("<p class='error_info'>Informatia inca nu e disponibila la moment</p>");
    }
  });
    $(".side-bar-left li").click(function(e){
    if($(this).attr("href") != '') {
      $('.content-right').load($(this).attr("href"));
      e.stopPropagation();
    } else {
      $('.content-right').html("<p class='error_info'>Informatia inca nu e disponibila la moment</p>");
    }
  });
  
/*Form*/
  $(".trigger").on("click",function(){
    $(this).next().slideToggle(1500);
  })
  
  if ( ($(".error-name").text() == "") || ($(".error-mail").text == "") ) {
    $(".errors").addClass("dont-display");
  }
  $(".errors .close").click(function(){
    $(".errors").addClass("dont-display");
  })
  
  $('.name input').bind('input', function(){
      $(".submit").addClass("di");
  });
  $('.email input').bind('input', function(){
      $(".submit").addClass("spl");
  });
  $('.textarea textarea').bind('input', function(){
    $(".submit").addClass("ay");
  }); 
/*Gooogle Map*/
  var locations = [
      ['<div>Spitalul Municipal Nr1    </div><div>Etajul 2, cab 205</div>', 47.006555, 28.843627],
      ['<div>Centrul Mamei si Copilului</div><div>Etajul 6, cab 624</div>', 46.980494, 28.870559]
    ];
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: new google.maps.LatLng(47.006555, 28.843627),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var infowindow = new google.maps.InfoWindow();
  var marker, i;
  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map
    });
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
  }

});
$(document).on("click",".sup_content_display",function(){
  $(this).siblings().find("ul").slideUp();    
  $(this).find("ul").slideToggle();
  e.stopPropagation();
});





$(document).ready(function() {
  $(".slider").children(".slides").children("img").addClass("image-active");
  $(".slider").children(".slides").children("img").siblings().addClass("inactive");
  $(".slider").children(".controlers").find("li").addClass("controler-active");
  $(".slider").children(".controlers").find("li:first-child").addClass("active-slide"); 
  $(".slider").children(".slides").children("img:first-child").addClass("active-slide");
  var a = setInterval(slider, 5000);
  function slider() {                                 /*.hide()*/
    var nextItemImage = $('.image-active.active-slide').fadeOut().removeClass('active-slide').next('.image-active');
    var nextItemTitle = $('.controler-active.active-slide').removeClass('active-slide').next('.controler-active');
    if (nextItemImage.length === 0) {
      nextItemImage = $('.image-active').first();
      nextItemTitle = $('.controler-active').first();
    }
    nextItemImage.fadeIn().addClass('active-slide');
    nextItemTitle.show().addClass('active-slide');
  };
/*Hover and Click*/
  $(".image-active").hover(
    function(stopandgo){
      a = clearInterval(a)},
    function(stopandgo){
      a = setInterval(slider, 5000);}
  );
  $(".controler-active").hover(
    function(stopandgo){
      a = clearInterval(a)},
    function(stopandgo){
      a = setInterval(slider, 5000);}
  );
  $(".controler-active").hover(
    function() {	$(this).addClass("hover");      },
    function() {	$(this).removeClass("hover")	}
  );
  $(".controler-active").click(function() {
    var index = $(this).parent().children().index(this);
    $(".controler-active").removeClass("active-slide");
    $(this).addClass("active-slide");
    $(".image-active").removeClass("active-slide");
    $(".image-active").eq(index).addClass("active-slide");
  });  
});
