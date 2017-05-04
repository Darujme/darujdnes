/**
 * Addclass to nav menu when scroll
 * ======================================
 * - jquery needed :)
 * - active on some pages only
 * @start - when stick-up element
 */

var win = $(window)
var enableOn = !$('body').hasClass('is-page')
var enableOnRes = win.width() > 767

var stickyScroll = function() {
	var top = win.scrollTop()
	var $menu = $('.menu-item.anchor')

	// active items
	$menu.each(function () {
			var $el = $(this)
			var $child = $el.children('a')

			var href = $child.attr("href")
			var href = href.replace(homeUrl+'/', '')

			if (href.match("#")) {
				if(href == "#"){
					return false;
				}
				var $target = $(href);

				var startFrom = 0;
				var offset = 100;

				if(!$target.length){
					return false
				}

				if(win.scrollTop() + win.height() == $(document).height()) {
					 $menu.removeClass("is-active");
					 $menu.last().addClass("is-active");
			 }
			 else if(win.scrollTop() < offset) {
					 $menu.removeClass("is-active");
					 // $menu.first().addClass("is-active");
			 }
				else if ( ($target.position().top -(offset) <= top) && top > startFrom) {
						$menu.removeClass("is-active");
						$el.addClass("is-active");
				}
				else{
						$el.removeClass("is-active");
				}
			}
	});
}

if(enableOnRes && enableOn){
	win.scroll(function() {
		window.requestAnimationFrame(stickyScroll)
	})
	// initial call
	stickyScroll()
}
