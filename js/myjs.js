// reloading CAPTCHA image
function reloadCaptcha() {
	var d = new Date(); var image='image.png?'+d.getMilliseconds(); 
	document.getElementById("imgcap").src = document.getElementById("imgcap").src+"?"+d.getMilliseconds();
}
/* ----------- END LOGIN --------------- */
