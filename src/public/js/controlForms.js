// ================================================================================================================

// =================================================================================================================
//  Declaration des variables globales pour les fonctions de contrôle
//
var mess = "Les champs suivants sont necessaires au traitement de votre demande :\n";
var mess_init = "Les champs suivants sont necessaires au traitement de votre demande :\n";  
var necessaire = 0;                     // Variable marquant l'erreur (0 : tout va bien, 1 : blocage demande)
var NbLock=0; var MaxLock=1;            // Varible pour la repitition de Saisie
var check = {};

// =================================================================================================================
function OnAlerte(champ, mess)  // message d'alerte dans le Div "alerte"
{
  if(mess!='')
  {
      $("#alerte").html('');
      $("#alerte").append(mess);
      bloque(champ);
  }
  else
  {
      $("#alerte").html('');
      $("#"+champ).removeClass("error");
      check[champ]=1;
  } 
}

// =================================================================================================================
// Fonction de blocage de la saisie si elle n'est pas conforme
function bloque(champ)      // Blocage Champ pour la saisie à nouveau
{
    $("#"+champ).addClass("error");         // Ajoute class="error"   
    var ctrl = document.getElementById(champ);    
    NbLock++;
    if (NbLock >= MaxLock) { NbLock=0; return; } 
    ctrl.focus();                                                                                 
    ctrl.select();                          // On selectionne le contenu pour faciliter la reprise de la saisie
    check[champ]=0;                                               
}


// =================================================================================================================
// Fonction qui renvoie la date du jour au format JJ-MM-AAAA
function aujourdhui()   // Renvoie la date du jour au format JJ-MM-AAAA
{ 
   var d=new Date();      
   var J=d.getDate(); var M=d.getMonth()+1; var A=d.getFullYear();
   return (J<10 ? '0'+J:J)+"-"+(M<10?'0'+M:M)+"-"+A;
}

// =================================================================================================================
// Fonction de ctrl de date au format JJ MM AAAA ou JJmmAAAA
function OnDate(champ)         // Controle format date jjmmaaaa ou JJ MM AAAA 
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
    
  var TJ=[0,31,28,31,30,31,30,31,31,30,31,30,31];
    
  if (len == 8) RE = /^\d/; 
    else RE = /^\d{2}([\/]|[\-]|[\.]|[\ ])+\d{2}([\/]|[\-]|[\.]|[\ ])+\d{2}(\d{2})*$/;
  if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 

  JJ=parseInt(val.substr(0,2)); 
  if (len==8) { MM=parseInt(val.substr(2,2)); AA=parseInt(val.substr(4,4)); }
     else { MM=parseInt(val.substr(3,2)); AA=parseInt(val.substr(6,4)); }
  
  if (AA<1900 || AA>=2200) Ok=1;
  if (MM<=0 || MM>12) Ok=1; 
  if (AA%4==0) TJ[2]=29; 
  if (JJ<0 || JJ>TJ[MM]) Ok=1;
  if (Ok==1 && NbLock < MaxLock) { OnAlerte(champ, 'Format date incorrecte.  JJ-MM-AAAA ou JJMMAAAA'); } 
  if (Ok==0) { ctrl.value=(JJ<10 ? '0'+JJ:JJ)+'-'+(MM<10?'0'+MM:MM)+'-'+AA; OnAlerte(champ, ''); } 
}

// ==============================================================================================
function OnVide(champ)          // Champs Obligatoire ....Not Null
{ 
  var ctrl = document.getElementById(champ);       var Ok=0;  
  var len=ctrl.value.length;    var typ=ctrl.type;                    
  var val=ctrl.value;  

  if (len<1) Ok=1; 
  if (Ok==1 && NbLock < MaxLock) { OnAlerte(champ, 'Information obligatoire'); }
  if (Ok==0) { OnAlerte(champ, ''); }
}

// =================================================================================================================
// Fonction de verification d'une plage de nombres (entre X et Y)
function OnLimite(champ,X,Y)    // Saisie limite    val € [X..Y]
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;    var typ=ctrl.type;
  var val=ctrl.value; 

  Ok=(isNaN(val)?1:0);

  if (val<X || val>Y) Ok=1;
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Valeur limite entre '+X+' et '+Y);}  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnAlpha(champ)          // Champ Alphabétique sans accents ni caractères spéciaux
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
    
  RE = /^([A-Za-z]+[ ]*[-]*[A-Za-z]*)+$/;
  if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Uniquement des caractères alphabétiques sans accents');}  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnAlphaNum(champ)          // Champ Alphabétique avec accents et numérique
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
    
  RE = /^[A-Za-zàâäéèêëîïôùûç\s,'0-9\-]+$/;;
  if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Uniquement des caractères alphanumériques sans symboles');}  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnPhone(champ)
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
   
  RE = /^(0[1-68])(?:[ _.-]?(\d{2})){4}$/;
  if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Format téléphonique invalide');}  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnPasswd(champ)
{
  OnAlerte(champ, '');
}

// =================================================================================================================
function OnNumber(champ)
{
   var ctrl = document.getElementById(champ);       var Ok=0;
   var len=ctrl.value.length;    var typ=ctrl.type;
   var val=ctrl.value;         
      
   RE = /^[0-9]+$/;
   if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 
   if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Format numérique entier invalide'); }  
   if (Ok==0) { ctrl.value=val; OnAlerte(champ, '');} 
}

// =================================================================================================================
function OnFloat(champ)
{
   var ctrl = document.getElementById(champ);       var Ok=0;
   var len=ctrl.value.length;    var typ=ctrl.type;
   var val=ctrl.value;         
      
   RE = /^[0-9\.\,]+$/;   if (!RE.test(ctrl.value)) Ok=1;  
   val=val.replace(',','.');    Ok=(isNaN(val)?1:0); 
   if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Format numérique décimal invalide'); }  
   if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnUrl(champ) 
{
  var ctrl = document.getElementById(champ);          var Ok=0;
  var len=ctrl.value.length;       var typ=ctrl.type;
  var val=ctrl.value;         
    
  RE = /^[A-Za-z,'0-9\-\_\/\:\.\?\=\&]+$/;;
  if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Lien ou URL invalide'); }  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnMail(champ)
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
    
  RE = /^[A-Za-z0-9\.\-_]+[@][A-Za-z0-9\-\.]+[\.][A-Za-z][A-Za-z][A-Za-z]?$/;
  if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Adresse mail invalide'); }  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnRadio(champ)          // Fonction pour le test des boutons radio
{
   var ctrl = document.getElementById(champ);       var Ok=1;
   var len=ctrl.value.length;                var typ=ctrl.type;
   var val=ctrl.value;         
   
   for ( i = 0; i < ctrl.length; i++ )     // Si on trouve un bouton coche, on le marque
      if (ctrl[i].status)  Ok=0; 
   if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Eléments à cocher'); }  
   if (Ok==0) { OnAlerte(champ, ''); } 
}
// =================================================================================================================



// =================================================================================================================
function OnLenMin(champ,X)
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
    
  
  if (len<X) Ok=1; // Expression reguliere 
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Nombre de caractere Insufissant >='+X); }  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnLenMax(champ,X)
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
    
  
  if (len>X) Ok=1; // Expression reguliere 
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Nombre de caractere très important <='+X); }  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
function OnLenLim(champ,X,Y)
{
  var ctrl = document.getElementById(champ);       var Ok=0;
  var len=ctrl.value.length;                var typ=ctrl.type;
  var val=ctrl.value;         
    
  
  if (len<X || len>Y) Ok=1;
  if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Nombre de caractere Limite entre '+X+' et '+Y);}  
  if (Ok==0) { ctrl.value=val; OnAlerte(champ, ''); } 
}

// =================================================================================================================
// Fonction pour verifier la coherence de deux saisies de mot de passe
// Cette fonction se declenche a partir du second champ uniquement
function CheckPwd(champ1,champ2) 
{   
   var prems = document.getElementById(champ1);  var deuze = document.getElementById(champ2);

   if (!prems.value)      // Si le premier champ n'est pas rempli
      {  OnAlerte(champ1, 'Vous n\'avez pas saisi votre mot de passe'); }
   else 
      if ( prems.value != deuze.value ) 
        {
            deuze.value = "";// Reinitialisation des deux champs     prems.value = "";    
            OnAlerte(champ1,'La confirmation de votre mot de passe n\'est pas exacte.');  // Envoi d'une alerte
        }
      else OnAlerte(champ2, '');
}

// =================================================================================================================
// Fonction pour verifier si le champ est un code postal
function OnPostal(champ)
{
   var ctrl = document.getElementById(champ);       var Ok=0;
   var len=ctrl.value.length;    var typ=ctrl.type;
   var val=ctrl.value;         
      
   RE = /^\d{5}$/;
   if (!RE.test(ctrl.value)) Ok=1; // Expression reguliere 
   if (Ok==1 && NbLock<MaxLock) {  OnAlerte(champ, 'Code postal invalide'); }  
   if (Ok==0) { ctrl.value=val; OnAlerte(champ, '');} 
}
// =================================================================================================================
// Fonction pour initialiser l'objet de vérification du formulaire
// A placer dans la methode OnLoad du Body
function ini_check()
{
  var inputs = document.getElementsByTagName('input');
  for(var i=0; i<inputs.length; i++)
  {
    if(inputs[i].type!='button') 
    {
      check[inputs[i].id]=0;
      if(inputs[i].onblur!=null) MaxLock++;
    }
  }
}

// =================================================================================================================
// Fonction pour controler l'ensemble des champs du formulaire avant envoi vers php
// A placer dans la methode OnClick du bouton de validation du formulaire
function check_form()
{
  var OK = 1;
  var inputs = document.getElementsByTagName('input');
  for(var i=0; i<inputs.length; i++)
  {
    if(inputs[i].type!='button') if(inputs[i].onblur==null) check[inputs[i].id]=1;
    if(check[inputs[i].id]==0) inputs[i].onblur();
    if(inputs[i].type!='button') OK=OK&&check[inputs[i].id];
  }
  if(OK) { $('#alerte').html('envoi formulaire'); bouton_valide(); }
}

// =================================================================================================================
// ===========         Fonction pour un ecran d'information  Pop-Ups         =======================================
function open_comment(data)
{
  $("#cbox").remove();
  $("body").append('<div id="cbox"></div>');
  $("#cbox").append('<div id="cboxContent"></div>');
  $("#cboxContent").append('<div id="cboxBtn"><input id="fermer" type="button" value="X" OnClick="close_comment();"/></div>');
  $("#cboxContent").append('<p>'+data+'</p>');  
}

function close_comment()
{
    $("#cbox").remove();
}
// ================================================================================================================



// =================================================================================================================
// Fonction de ctrl de validite de la saisie
// Creation d'une variable pour marquer s'il y a incoherence de saisie ou pas
var probleme = 0;
// =================================================================================================================
// Fonction de validation du formulaire
function resultat(formulaire) 
{
  // Si on a marque qu'au moins un champ etait vide
  if ( necessaire == 1 )    // Affichage du message d'erreur avec tous les champs en erreur
    { 
        alert(mess); 
    }

  // Si aucun champ n'est vide
  if ( necessaire == 0 ) 
    {   
        envoi();
    }

  // Quoi qu'il arrive, on re-initialise le message d'erreur pour permettre un autre passage des tests
    mess = mess_init;
    necessaire = 0;
}

function validite(formulaire, champ, format, mini, maxi) 
{
    
    var ctrl = document.getElementById('document.' + formulaire + '.' + champ);    // Creation d'un raccourci pour manipuler le champ a tester
    probleme = 0;                                                   // Initialisation de la variable
    
// definition de la variable 'RE'= test d'expression reguliere, on fonction du FORMAT
    if ( format == "A" ) { RE = /^([A-Za-z]+[ ]*[-]*[A-Za-z]*)+$/;}            //  A   : alphabetique
    if ( format == "AN" ) { RE = /^[A-Za-zàâäéèêëîïôùûç\s,'0-9\-]+$/;}         //  AN  : alphanumerique
	if ( format == "URL" ) { RE = /^[A-Za-z,'0-9\-\_\/\:\.\?\=\&]+$/;}          //  URL  : adresse URL
    if ( format == "N" ) { RE = /^\d+$/;}                                      //  N   : numerique
	if ( format == "ND" ) { RE = /^['0-9\.]+$/;}                                //  ND  : Nombre Decimal
    if ( format == "CP" ) { RE = /^\d{5}$/;}                                   //  CP  : code postal francais (5 chiffres)
    if ( format == "D" ) { RE = /^\d{2}([\/]|[\-])+\d{2}([\/]|[\-])+\d{2}(\d{2})*$/;}   //  D   : Date (xx/xx/xx ou xx/xx/xxxx ou xx-xx-xx ou xx-xx-xxxx)
    if ( format == "EMAIL" ) { RE = /^[A-Za-z0-9\.\-_]+[@][A-Za-z0-9\-\.]+[\.][A-Za-z][A-Za-z][A-Za-z]?$/;}   //    EMAIL   : email

// On ne fera les tests que si le champ est rempli d'au moins un caractere (pas vide)
    if (ctrl.value.length > 0) 
      {    // Si on ne trouve pas dans le champ l'expression reguliere recherchee
        if (!RE.test(ctrl.value)) 
          {
            alert('Votre saisie est incorrecte.');          // Envoi d'une alerte
            probleme = 1;                                   // On marque que la saisie n'est pas coherente
          }

        // Tests de longueur du champ (nombre de caracteres saisis)
        // Si il a ete specifie '0', le test n'est pas effectue
        if ( mini != 0 ) 
          {       
            if ( ctrl.value.length < mini )    // Si la longueur de la saisie est inferieure au minimum demande
               {  // Envoi d'une alerte
                    alert('Vous devez saisir au moins ' + mini + ' caracteres.');  
                    probleme = 1;
                }
          }

        // Si la longueur de la saisie est superieure au maximum demande
        if ( maxi != 0 ) 
          {
            if ( ctrl.value.length > maxi ) 
                {
                   alert('Vous ne devez pas saisir plus de ' + maxi + ' caracteres.');
                   probleme = 1;
                }
          }

        // Si on a marque qu'il y avait un probleme
        if ( probleme == 1 ) { bloque(formulaire,champ); }  // On active le blocage du champ
      }
}
// =================================================================================================================



// =================================================================================================================

