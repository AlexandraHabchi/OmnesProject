<?php 

class Url
{
	public static function redirect($url) {
		if(!is_string($url)) { 
			return false;
		}
		header("Location:" . $url); exit;
	}
}