/*
	@ Add body class if user scrolled
*/
var tablet = window.innerWidth > 767
if(tablet){
	var start =  window.innerHeight / 2
}else{
	var start =  window.innerHeight
}

var scrollStarted = function() {
	var top = window.scrollY

	if(top >= start){
		document.body.classList.add('is-scrolled')
	}else{
		document.body.classList.remove('is-scrolled')
	}
}

window.addEventListener('scroll', function() {
	window.requestAnimationFrame(scrollStarted)
});
// initial call
scrollStarted()
