/*
  @ Javascript toggle menu binding
*/
var toggler = document.getElementById("js-menu-toggle")

if(toggler){
  toggler.onclick = function(){
    document.body.classList.toggle('menu-is-open')
  }
}
