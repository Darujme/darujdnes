/*
	@ Javascript toggle menu binding
*/
var toggler = document.getElementById("js-menu-lang-toggle")

if(toggler){
	toggler.onclick = function(){
		document.body.classList.toggle('menu-lang-is-open')
	}
}
