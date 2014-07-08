// #####################################################################################
// Auteur              : Issam HABCHI  
// Date de creation    : 17-05-2014
// Version             : 1.0
// Module / Fichier    : fct_pagination.js
// Description         : fonction qui permets la pagination d'un ensemble de données.
// ######################################################################################

/*
  Fonctionalité  Minimale.
  1- pagine(data) :  fonction principal (data est un tableau de données)
                     la ligne 0 est l'entete du tableau
  
  2- La ligne est clickable dans sa totalité est renvoie à une fonction "CLIC_Data_Page(Clé)" pour
     la recherche de l'enregistrement, la clé est la colonne 0 de la ligne.

  3- Le Nombre de ligne est selectionnable par un Select
     Les Valeurs sont dans la variable PAGE_TAB_SEL [a,b,c, ....]

  4- Le nom de la div principale est   <div id="corps_pagine"> </div>
  
  5- Definition des attributs d'affichage par le tableau T_PAGINE
     T_PAGINE[colonne]=[A1, A2, A3, ... ]
        -> A1 prend les valeurs 0 ou 1  0= Non affichable, 1=Affichable
        -> A2 prend les valeurs 0 = Affichage Normale
                                1 = C'est un URL
                                2 = Image
                                3 = Combine URL + Image
        -> A3 Si A2=URL elle contient l'index du contenu d'affichage 
              Si A2=2 on indique l'URL de limage.
        -> A4 Hauteur de l'Image. 
        -> A5 Largeur de l'image.

  Exemple :
     T_PAGINE[4]=[1,2,'../imgs/logo.png',30,40]    
     La Colonne Numero 5 du tableau d'affichage est une image dont le fichier est logo.png,
     la hauteur de l'image est 30 pixel avec une largeur de 40 pixel.

     T_PAGINE[1]=[0]  La colonne 1 du tableau est masqué. 
  
*/

// ###########################################################################################
// Varibles et fonctions utilisables dans les programmes Externe
var T_PAGINE= new Array;                  // Tableau d'attribut d'affichage ......
var HEADER_PAGINE='';             // Variable Contenant une description du tableau

function CLIC_Data_Page(Cle) {}
function CLIC_Sort_Col(Col) {}
// #############     Fin des variables et fonction Externe        ############################


var NUM_page=1;
var MAX_page=0;
var PAGE_TAB_SEL=[10,20,30,50,100];
var NBL_page = PAGE_TAB_SEL[1];
var Clic_Sort_Col=false;


var data=[];
var dat_ini=[];



// ###########################################################################################
// ********************* Ajout au select une option avec sa valeur *****************
function Select_Option(val,opt)
{
  var option = "<option value="+val+">"+opt+"</option>";
  return option;
}


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Elimine les lignes qui ne correspond pas à la recherche
function filtre_data(T, O)  		// T=tableau de Data; O=Objet du Filtre
{
	if(O == undefined) return T;
  var a, j;   var tab=[];
  var reg=new RegExp(O,"i");      // Expression Reguliere ignore la difference entre miniscule, Majuscule  
  tab[0]=T[0]; j=1;                 // Il s'agit de Sauvegarder la 1er Ligne ( Entete)     
  for (var i=1; i<T.length; i++) 
    { 
      a=T[i].join("");              // On Concatene l'ensemble des elements de la ligne
      if (a.match(reg)) 
         { tab[j]=T[i]; j++;}       // On ajoute la ligne au cas ou l'objet est trouvé
    }
  return tab;                       // On renvoie le tableau de données du filtre
}

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Permet de trier un tableau par Ordre Croissant par colonne  ... A Ameliorer pour les numerique et les dates ...
function sort_data_col(T, C)      // T=Tableau  C=Colonne
{
  L0=T[0];  T.shift();            // sauvegarde + supression de la 1er Ligne 
  NL=T.length;  
  for (var i=0; i<NL-1; i++)
    for (var j=i+1; j<NL; j++)
     {                                      // On tri le Tableau suivant la colonne  
       X=T[i][C];  X=X.toUpperCase();       // Transforme le mot en majuscule
       Y=T[j][C];  Y=Y.toUpperCase();       
       if ( X > Y ) 
        {   
            X=T[i];  T[i]=T[j];  T[j]=X;    // Echange 
        }
     }
  T.unshift(L0);                            // On rajoute la 1er Ligne
  return(T);
}



// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Fonction principal .............. 
function pagine(Input)
{
	data = [];
	for(var j in Input) {
		var ligne = [];
		for(var i = 0; i<Input[0].length; i++) {
			 ligne.push(Input[j][i]);
		}
		data.push(ligne);
	}
	
  dat_ini=data; 
  var rech = $("#search").val();
  data=filtre_data(dat_ini, rech);
  $("#section_pagine").remove();
  $("#corps_pagine").append('<div class="col-lg-12" id="section_pagine"></div>');   		// Definition de la section de pagination
  $("#section_pagine").append('<div class="row" id="section_haut"></div>');   // section contenant le Select des Page + Recherche
 
  $("#section_pagine").append('<div class="row table-responsive"><table class="table table-bordered table-condensed no-margin" id="cor_tab"></table></div>'); 		// Affichage du Tableau 
  
  $("#section_pagine").append('<div class="row" id="section_bas"></div>'); 			// section d'affichage des boutons de pagination
  construct_header();   $("#search").val(rech);
  entete_tableau(data[0]);  
  data_page(NUM_page);
  construct_footer(data);
}

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function pagine_recherche()
{
  data=filtre_data(dat_ini, $("#search").val() );
  data_page(NUM_page); 
  construct_footer(data); 
}

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// La foction de tri du tableau par colonne
function CLIC_Sort_Col(Col)
{
  if (Clic_Sort_Col==False) return;
  
  data=sort_data_col(dat_ini, Col );
  data_page(NUM_page); 
  construct_footer(data); 
}


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Constreuction de la section "ENTETE"
function construct_header()
{
  $("#section_haut").append('<div class="col-lg-4 form-group no-margin" id="select_nbl"></div>');
  $("#section_haut").append('<div class="col-lg-5" id="title"></div>');
  $("#section_haut").append('<div class="col-lg-3" id="search_barre"></div>');

  $("#select_nbl").append('<label for="nbl" class="control-label inline">Affiche</label>');
  $("#select_nbl").append('<select class="form-control inline" id="nbl" onChange="change_pagination()">');
  $("#select_nbl").append('<label for="nbl" class="control-label inline">lignes par page</label>');

  for (i=0; i<PAGE_TAB_SEL.length; i++)    // Remplissage du Select
     $("#nbl").append(Select_Option(PAGE_TAB_SEL[i], PAGE_TAB_SEL[i]));
  $("#nbl").val(NBL_page); 
  
  $("#title").append('<h1 class="text-center no-margin">'+HEADER_PAGINE+'</h1> ');
    
  $("#search_barre").append('<input type="text" id="search" class="form-control" placeholder="Rechercher" onkeyup="pagine_recherche()">');
}
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// --------------------------------------------------------------------------------------
// Changement de Pagination ....... Repond au onchange du Select Nombre de Page 
function change_pagination()
{
  NBL_page=$("#nbl").val(); 
  $("#btn_bas").remove();
  construct_footer();  NUM_page=1; data_page(1);
}

// ---------------------------------------------------------------------------------------
// Construction du bas de pages avec les boutons de paginations
function construct_footer()
{
 MAX_page=parseInt((data.length-1)/NBL_page);       // On calcul le Nombre Maximum de Page
 X=MAX_page*NBL_page;                               //
 if (X<data.length-1) MAX_page++;                   // On ajoute une page dans le cas du reste
 
  $("#pagine").remove();
  if (MAX_page<=1) return;                          // dans le cas d'une seul page On Affiche pas le 
													// les boutons 

 $("#section_bas").append('<ul id="pagine" class="pagination pagination-sm no-margin"></ul>');  
 $("#pagine").append('<li id="lignes" class="disabled"><span>'+(data.length-1)+' lignes</span></li>');   
 $("#pagine").append('<li><input type="button" value="&laquo;&laquo;" OnClick="data_page(1)"/></li>');
 $("#pagine").append('<li><input type="button" value="&laquo;" OnClick="Page_Prec()"/><li>');

 for(var i=1; i<=MAX_page; i++)
    $("#pagine").append('<li><input type="button" value="'+i+'" OnClick="data_page('+i+')"/></li>');
 
 $("#pagine").append('<li><input type="button" value="&raquo;" OnClick="Page_Suiv()"/></li>');
 $("#pagine").append('<li><input type="button" value="&raquo;&raquo;"  OnClick="data_page('+MAX_page+')"/></li>');
}

// ---------------------------------------------------------------------------------------
function Page_Suiv() {  if (NUM_page < MAX_page) NUM_page++;  data_page(NUM_page); }
function Page_Prec() {  if (NUM_page > 1) NUM_page--; data_page(NUM_page); }


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Construction de l'entete du Tableau avec la ligne data[0]
function entete_tableau(lin)
{
  $("#cor_tab").append('<thead><tr id="top"></tr></thead>');
 
 for (var i = 0; i<lin.length; i++)  
   {
    if (typeof(T_PAGINE[i])=='undefined') 
        $("#top").append('<th OnClick="CLIC_Sort_Col('+i+')">'+lin[i]+'</th>');
    else
     {
       if (T_PAGINE[i][0]==0);  
       if (T_PAGINE[i][0]==1) $("#top").append('<th OnClick="CLIC_Sort_Col('+i+')">'+lin[i]+'</th>');
     }
    }
}


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Affichage des lignes entre entete et le bas de page
function data_page(N)   // N=Numero de la Page.
{
  NUM_page=N;  
  Deb=(N-1)*NBL_page+1;  
  Fin=N*NBL_page+1;    if (Fin > data.length) Fin=data.length;
  $(".lig").remove(); 
  for (var i=Deb; i<Fin; i++)
  {
    $("#cor_tab").append('<tr class="lig" id="lig'+i+'"></tr>');
    for (j=0; j<data[0].length; j++)
    {
      $("#lig"+i).append('<td>'+data[i][j]+'</td>');
    }  // for j=
  } //for i=
} // function


// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
