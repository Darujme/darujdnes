/**
 * Tabs pagination - listing in tabs
 * ======================================
 * - jquery needed
 * - css styles needed
 * - autoplay option, enable it with html attr 'data-auto'
 * - autoplay-delay option, set it with html attr 'data-delay'
 * - endless autoplay enabled
 * - toggle class 'is-active' on target list item & clicked nav item
 */
var timer;
var $tabs = $('.jstabs')
var $nav = $tabs.find('.jstabs-nav').children()

// init every jstabs group, bind, run autoplay
var init = function() {
	bind()

	$tabs.each(function(){
		var $el = $(this);

		if($el.attr('data-auto')){
			var delay = $el.attr('data-delay') || 3000
			autoPlay($el, delay)
		}
	})
}

// bind jstabs-nav clicks
var bind = function() {
	$nav.click(function(e){
		e.preventDefault();
		var $el = $(this);

		clearInterval(timer); // stop autoplay
		goTo($el);
	})
}

// core tabs switcher function
var goTo = function($el){
	var index = $el.index()
	var $parent = $el.closest('.jstabs')
	var $navs = $parent.find('.jstabs-nav').children()
	var $lists = $parent.find('.jstabs-list').children()

	$navs.removeClass('is-active')
	$el.addClass('is-active')

	$lists.removeClass('is-active').eq(index).addClass('is-active')

	$('.js-gallery-slider').slick('setPosition', 0);

}

// switch to next slide, on last switch to first
var goTonext = function(parent){
	var $parent = parent

	var $current = $parent.find('.jstabs-nav').children('.is-active')
	var $next = $current.next()

	if(!$next.length){
		var $next =  $parent.find('.jstabs-nav').children().first()
	}

	goTo($next);
}

// automatically switch slides
var autoPlay = function (parent, delay){
	timer = setInterval(function(){
		goTonext(parent)
	}, delay);
}

init()
