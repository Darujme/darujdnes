/*
  @ Parallax effect on header
*/
var $target = $('.header')
var enableOn = window.innerWidth > 999

var onScroll = function() {
  var top = window.pageYOffset

  var move = top / 3

  $target.css({
    'background-position' : 'left '+move+'px'
  })

}

// Bind on scroll
if(enableOn){
  window.addEventListener('scroll', function() {
    window.requestAnimationFrame(onScroll)
  })
  onScroll()
}
