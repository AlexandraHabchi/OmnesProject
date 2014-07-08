/*
 * Main Javascript
 */

$("#connexion a").click(function(e){
	e.preventDefault();

	var page = 'home';
	var datas = {
		'ajax'  : 'oubliPwd',
		'email' : $("#login").val()
	};
	$.ajax({
		  url      : "/" + page + "?context=html",
		  type     : "POST",
		  dataType : "json",
		  data     : datas,
		  success  : function(result) {
			  $("#errors").remove();
			  $("#connexion").append('<ul class="list-group" id="erreurs"></ul>');
			  if(result['errors']) {
				  var err = result['errors'];
				  for(var i in result['errors']) {
					  $("#erreurs").append('<li class="list-group-item list-group-item-danger">' + err[i] + '</li>');
				  }
			  }
			  if(result['success']) {
				  var ok = result['success'];
				  for(var i in ok) {
					  $("#erreurs").append('<li class="list-group-item list-group-item-success">' + ok[i] + '</li>');
				  }
			  }
		  }// end success
	});// end ajax
	
});

$("#changePwdBtn").click(function(e){
	e.preventDefault();
	if(check_form()) {
		$(e.target).unbind('click');
		$(e.target).click();
	}
});