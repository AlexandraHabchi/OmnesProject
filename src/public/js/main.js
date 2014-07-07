/*
 * Main Javascript
 */

$("#connexion a").click(function(e){
	e.preventDefault();
	console.log($("#login").val());
	envoiAjax('home', {
		'ajax'  : 'oubliPwd',
		'email' : $("#login").val()
	});
});

function envoiAjax(page, datas)
{
	$.ajax({
		  url      : "/" + page + "?context=html",
		  type     : "POST",
		  dataType : "json",
		  data     : datas
	});
}

function recupAjax(page)
{
	$.ajax({
		  url      : "/" + page + "?context=html",
		  type     : "POST",
		  dataType : "json",
		  success  : function(result) {
			  return result;
		  }
	});
}

function fullAjax(page, datas)
{
	$.ajax({
		  url      : "/" + page + "?context=html",
		  type     : "POST",
		  dataType : "json",
		  data     : datas,
		  success  : function(result) {
			  return result;
		  }
	});
}