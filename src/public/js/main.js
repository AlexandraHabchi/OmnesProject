/*
 * Main Javascript
 */
$("table.test").dataTable();

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

if($("form").get(0)) {
	ini_check();
	$( "select" ).combobox();
}

$("#create").click(function(e){
	e.preventDefault();
	if(check_form()) {
		$(e.target).unbind('click');
		$(e.target).click();
	}
});

if($("#corps_pagine").get(0)) {
	var id = ucfirst(getId());
	$.ajax({
	  url      : "/gestion" + id + "?context=html",
	  type     : "GET",
	  dataType : "json",
	  success  : function(result) {
		  pagine(result);
	  }// end success
	});
}

$("input.command").click(function(e) {
	var elmt = $(e.target.parentNode.parentNode).context;
	var id = elmt.children['id'].innerHTML;
	var quantite = elmt.children['input'];
	if(OnNumber(quantite.firstChild.id)) {
		var produit = {
				'id_prd' : elmt.children['id'].innerHTML,
				'qte'    : elmt.children['input'].firstChild.value
		};
		$.ajax({
		  url      : "/panier?context=html",
		  type     : "POST",
		  dataType : "json",
		  data     : produit,
		  success  : function(result) {
			  alert(result['message']);
			  if(document.title == 'Panier') {
				  location.reload();
			  } else {
				  quantite.firstChild.value = '';
				  elmt.children['tot_prx'].innerHTML = '';
				  elmt.children['tot_prd'].innerHTML = '';
			  }
		  }// end success
		});
	}
});

function ucfirst(string) 
{
	var min = string.charAt(0); maj = string.charAt(0).toUpperCase();
	string = string.replace(min, maj);
	return string;
}

function getId() 
{
	return document.getElementsByTagName('form')[0].attributes['id'].nodeValue;
}

