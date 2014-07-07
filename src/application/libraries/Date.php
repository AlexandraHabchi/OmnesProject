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
	 * @param bool $time DEFAULT = false avec ou sans heure
	 * @return string
	 */
	public static function getDate($time = false)
	{
		date_default_timezone_set('Europe/Paris');
		if($time == true) {
			return date("Y-m-d H:i:s");
		}
		return date("Y-m-d");
		
	}
	
	/**
	 * Convertir date au format yyyy-mm-dd hh:ii:ss
	 * vers format dd-mm-yyyy à hh:ii:ss
	 * et au fuseau horaire Europe/Paris
	 * @param string $date date recuperee au format BDD MySQL
	 * @param bool $time DEFAULT = false avec ou sans heure
	 * @return string $date_convert date convertie
	 */
	public static function convert($date, $time = false) 
	{
		if($time == true) {
			$tab_date = explode(" ", $date);
			$jour = $tab_date[0];
			$heure = $tab_date[1];
		} else {
			$jour = $date;
		}
		
		$tab_jour = explode("-", $jour);
		$tab_jour = array_reverse($tab_jour);
		$jour = implode("-", $tab_jour);
		
		if($time == true) $date_convert = $jour . " à " . $heure;
		else $date_convert = $jour;
		return $date_convert;
	}
}