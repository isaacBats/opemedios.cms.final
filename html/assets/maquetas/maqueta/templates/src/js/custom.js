jQuery(document).ready(function($){
           

  try{
    var gallery = $('#gallery').galleriffic('#navigation', {
      delay: 300,
      numThumbs: 13,
      preloadAhead: 0,
      imageContainerSel: '#slideshow',
      controlsContainerSel: '#controls',
      fixedNavigation: true,
      galleryKeyboardNav: true,
      autoPlay: false,
      enableHistory: false,
      enableTopPager: false,
      enableBottomPager: true,
      renderSSControls: false,
      nextLinkText: '>',
      prevLinkText: '<'
    });
    gallery.onFadeOut = function () {
      $('#details').fadeOut('fast');
    };
    gallery.onFadeIn = function () {
      $('#details').fadeIn('fast');
    };

  }catch(e){
    console.log(e);
  }
  try{
    var imgHeight = $('#imgHome > img').height();
    var imgWidth = $('#imgHome > img').width();

    $('#imgHome').css('height', imgHeight);
    $('#imgHome').css('width', imgWidth);
    $(window).resize(function(){
      var imgHeight = $('#imgHome > img').height();
      var imgWidth = $('#imgHome > img').width();

      $('#imgHome').css('height', imgHeight);
      $('#imgHome').css('width', imgWidth);
    });
    $(".slidetabs").tabs(".images > div", {
      // enable "cross-fading" effect
      effect: 'fade',
      fadeOutSpeed: "slow",
      // start from the beginning after the last tab
      rotate: true
   
      // use the slideshow plugin. It accepts its own configuration
    }).slideshow({
      autoplay: true,
      clickable: false
    });
  }catch(e){
    console.log('Slideshow home error: '+e);
  }
  

  var anchoNav;
  var anchoTotal = 0;

  $("#main-nav li:has(ul)").addClass("submenu");

  try {
    $(".fancybox").fancybox({
        openEffect: 'elastic',
        closeEffect: 'elastic'
    });
  } catch(e) {
    console.log(e);
  }

  $('input[type="text"]').each(function(){

    this.value = $(this).attr('placeholder');
    $(this).addClass('text-label');
     
    $(this).focus(function(){
      if(this.value == $(this).attr('placeholder')) {
        this.value = '';
        $(this).removeClass('text-label');
      }
    });
     
    $(this).blur(function(){
      if(this.value == '') {
        this.value = $(this).attr('placeholder');
        $(this).addClass('text-label');
      }
    });
  });
  
  $('input[type="email"]').each(function(){

    this.value = $(this).attr('placeholder');
    $(this).addClass('text-label');
     
    $(this).focus(function(){
      if(this.value == $(this).attr('placeholder')) {
        this.value = '';
        $(this).removeClass('text-label');
      }
    });
     
    $(this).blur(function(){
      if(this.value == '') {
        this.value = $(this).attr('placeholder');
        $(this).addClass('text-label');
      }
    });
  });
  $('#main-aside > ul > li > a').on('click', function(){
    $(this).next('ul').slideToggle();
  });
  try{
    $("#gallery").on("focusin", function(){
      $("a.fancybox").fancybox({
            openEffect: 'elastic',
            closeEffect: 'elastic',
            titleShow: false,
            showNavArrows: true
      });
    });
    $('#fancybox-content').after('<div class="share-product gallery" style="text-align:center; margin-top:10px; position:absolute; left:0; right: 0;"><a href="javascript:void(0);" style="font-size:18px;"><img src="images/share-it.png"></a><a href="javascript:void(0);" style="font-size:18px;"><img src="images/tweet-it.png"></a><a href="javascript:void(0);" style="font-size:18px;"><img src="images/pin-it.png"></a></div>');
  }catch(e){
    console.log(e);
  }
});	

	