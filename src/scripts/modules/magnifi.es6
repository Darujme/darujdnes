/**
  Magnific popup init
*/
var $galleries = $('.js-gallery')

$galleries.each(function(){
	$(this).magnificPopup({
	  delegate: 'a',
	  removalDelay: 300,
	  mainClass: 'mfp-fade',
	  type: 'image',
	  gallery: {
	      enabled: true
	    }
	});
})

$('.js-iframe').magnificPopup({
  type: 'iframe'
});


/**
  translate magnifi
*/
$.extend(true, $.magnificPopup.defaults, {
  tClose: 'Zavřít (Esc)', // Alt text on close button
  tLoading: 'Načítám...', // Text that is displayed during loading. Can contain %curr% and %total% keys
  gallery: {
    tPrev: 'Předchozí (Šipka doleva)', // Alt text on left arrow
    tNext: 'Další (Šipka doprava)', // Alt text on right arrow
    tCounter: '%curr% z %total%' // Markup for "1 of 7" counter
  },
  image: {
    tError: '<a href="%url%">Fotku</a> se nepovedlo načíst.' // Error message when image could not be loaded
  },
  ajax: {
    tError: '<a href="%url%">Obsah</a> se nepovedlo načíst.' // Error message when ajax request failed
  }
});
