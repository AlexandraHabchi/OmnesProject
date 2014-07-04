/*
 * Main Javascript
 */

$(".supp").click(function(e){
	$("#alert_supp").modal('show');
	var target = e.target.parentNode.children['supp'];
	$("#confirm_supp").click(function(){
		target.removeAttribute('disabled');
		target.click();
	});
});