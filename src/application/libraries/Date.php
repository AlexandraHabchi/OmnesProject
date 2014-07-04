<?php 

/**
 * Gestion de dates
 * @author Alexandra
 *
 */
class Date
{
	/**
	 * Recuperation de la date courante au format BDD MySQL
	 * et au fuseau horaire Europe/Paris
	 * @return string
	 */
	public static function getDatetime()
	{
		date_default_timezone_set('Europe/Paris');
		return date("Y-m-d H-i-s");
	}
	
	/**
	 * Convertir date au format yyyy-mm-dd hh:ii:ss
	 * vers format dd-mm-yyyy à hh:ii:ss
	 * et au fuseau horaire Europe/Paris
	 * @param string $date date recuperee au format BDD MySQL
	 * @return string $date_convert date convertie
	 */
	public static function convert($date) 
	{
		$tab_date = explode(" ", $date);
		$jour = $tab_date[0];
		$heure = $tab_date[1];
		$tab_jour = explode("-", $jour);
		$tab_jour = array_reverse($tab_jour);
		$jour = implode("-", $tab_jour);
		
		$date_convert = $jour . " à " . $heure;
		return $date_convert;
	}
}