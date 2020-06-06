//smooth scroll
$(document).ready(function(){
  $(".js-scroll-trigger").on('click', function(event) {

    if (this.hash !== "") {
      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top - 130
      }, 1000, function(){

        // window.location.hash = hash;
      });
    }
  });
});

//Back to top
$(document).ready(function(){ 
  $(window).scroll(function(){ 
      if ($(this).scrollTop() > 400) { 
          $('#scroll').fadeIn(); 
      } else { 
          $('#scroll').fadeOut(); 
      } 
  }); 
  $('#scroll').click(function(){ 
      $("html, body").animate({ scrollTop: 0 }, 600); 
      return false; 
  }); 
});

$(window).scroll(function(){
  var wScroll = $(this).scrollTop();

  if (wScroll > $('.about').offset().top - 300)
  {
    $('.about').addClass('showAbout');
    $('.about').addClass('aboutLeft');
    $('.about').addClass('aboutRight');
  }

  if (wScroll > $('.contact').offset().top - 300)
  {
    $('.contact').addClass('showContact1');
    $('.contact').addClass('showContact2');
  }
});