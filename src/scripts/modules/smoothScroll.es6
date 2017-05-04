/*
	@ Smooth scroll on anchor links
*/

var body = $(document.body)
var enableOffset = window.innerWidth > 767

$('a[href^="#"]:not([href="#"]):not(.js-popup), a[href^="'+homeUrl+'/#"]').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		var target = $(this.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		if (target.length) {

			if(enableOffset){
				var offset = 0
			}else{
				var offset = 0
			}

			var scroll = target.offset().top

			if($(this).data('scroll-offset') && enableOffset){
				var scroll = scroll + $(this).data('scroll-offset')
			}

			var scroll = scroll + offset

			body.removeClass('menu-is-open')

			$('html,body').animate({
				scrollTop: scroll
			}, 800);

			ChangeUrl(document.title, homeUrl+this.hash);

			return false;

		}
	}
});

function ChangeUrl(page, url) {
	if (typeof (history.pushState) != "undefined") {
		var obj = { Page: page, Url: url };
		history.pushState(obj, obj.Page, obj.Url);
	}
}
