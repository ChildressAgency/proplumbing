jQuery(document).ready(function($){
  // animation check
  var $animationElements = $('.animation-trigger');
  var $window = $(window);

  // disable on small devices
  var isMobile = window.matchMedia('(max-width:768px)');
  if(isMobile.matches){
    $animationElements.removeClass('animation-trigger');
  }

  function checkIfInView(){
    var windowHeight = $window.height();
    var windowTopPosition = $window.scrollTop();
    var windowBottomPosition = (windowTopPosition + windowHeight);

    $.each($animationElements, function () {
      var $element = $(this);
      var elementHeight = $element.outerHeight();
      var elementTopPosition = $element.offset().top;
      var elementHeightOffset = elementHeight * (75 / 100);
      var elementBottomPosition = (elementTopPosition + elementHeight);

      if ((elementBottomPosition >= windowTopPosition) &&
        (elementTopPosition <= windowBottomPosition - elementHeightOffset)) {
        $element.addClass('animation-go');
      }
    });
  }

  $window.on('scroll', checkIfInView);

  function normalizeSlideHeights() {
    $('.carousel').each(function () {
      var items = $('.carousel-item', this);
      // reset the height
      items.css('min-height', 0);
      // set the height
      var maxHeight = Math.max.apply(null,
        items.map(function () {
          return $(this).outerHeight()
        }).get());
      items.css('min-height', maxHeight + 'px');
    })
  }

  $(window).on('load resize orientationchange', normalizeSlideHeights);
});