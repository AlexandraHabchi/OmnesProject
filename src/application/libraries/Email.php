<?php 

/**
 * Gestion d'envoi de mails
 * @author Alexandra
 *
 */
class Email
{
	/**
	 * Nom de l'expéditeur des mails du site
	 * @var string
	 */
	private static $nameExp = 'OMNES';
	
	/**
	 * Email l'expéditeur des mails du site
	 * @var string
	 */
	private static $mailExp = 'administrateur@omnespharma.com';
	
	/**
	 * Fonction de test de validité d'un email
	 * @param string $email Chaine de caractère à tester
	 * @return bool 
	 */
	public static function isEmail($email)
	{
	  $OK = filter_var($email, FILTER_VALIDATE_EMAIL);
	  return ($OK) ? true : false;
	}
	
	/**
	 * Fonction d'envoi d'un email simple sans piece jointe.
	 * @param string $dest e-mail du destinataire
	 * @param string $objet objet du mail
	 * @param string $msg message au format html
	 * @return bool en fct du succes ou de l'échec d'envoi du mail
	 */
	public static function envoi($dest, $objet, $msg)
	{
	  $NL="\n";
	  date_default_timezone_set ('Europe/Paris');
	  if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $dest))  $NL = "\r\n";  // On filtre les serveurs qui rencontrent des bogues.
	  
	  $entete = 'Content-type: text/html; charset=UTF-8' . $NL;     // Formatage du message HTML ou TEXT par defaut
	  $entete.= 'MIME-Version: 1.0' . $NL;
	  $entete.= 'From:"' . self::$nameExp . '"<' . self::$mailExp . '>' . $NL;
	  
	  $msgHtml = '<html><head><meta charset = "UTF-8" /></head><body>' . $msg . '</body></html>';

	  $OK = mail ($dest, $objet, $msgHtml, $entete);
	
	  return $OK;
	  
	}
}