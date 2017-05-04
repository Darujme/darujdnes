/**
 * Add active class to visible elements
 * ======================================
 * - jquery needed :)
 * - active on some resolution only
 * @offset - offset element from top + define in css to!
 * @removeClass - allow run animation again
 */
var enableOn = window.innerWidth > 767
var $items = $('.animate')

var offset = 120
var removeClass = false

var visibleSectionsInit = function(){
	visibleSection()
}

var visibleSection = function() {
	var top = window.pageYOffset + window.innerHeight - offset

	// active items
	$items.each(function () {
			var $el = $(this);
			var animationStart = $el.offset().top
			var elOffsetTop = $el.data('offset-top')
			var elOffsetBottom = $el.data('offset-bottom')
			var bodyClass = $el.data('body-class')
			var runGraph = $el.data('rungraph')

			if(elOffsetTop || elOffsetTop == 0){
				var animationStart = animationStart - offset + elOffsetTop
			}

			if(elOffsetBottom || elOffsetBottom == 0){
				var elHeight = $el.outerHeight()

				var animationStart = animationStart - offset + elHeight - elOffsetBottom
			}

			if( top > animationStart){
				if(!$el.hasClass('is-visible')){
					$el.addClass('is-visible')
					if(runGraph){
						initSlidePath()
					}
					if(bodyClass){
						$('body').addClass(bodyClass)
					}
				}
			}else{
				if(removeClass){
					$el.removeClass('is-visible')
				}
			}

	});
}

if(enableOn){

	window.addEventListener('scroll', function() {
    window.requestAnimationFrame(visibleSection)
	});
	// initial call
	visibleSectionsInit()
}
