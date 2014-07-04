<?php

/**
 * Model abstract qui nécessite une surcharge
 * @author Formateur
 *
 */
abstract Class Model
{
    public static $pdo = null;
    
    /**
     * Constructeur qui crée la connection à la BDD
     */
    public function __construct(){
        
        if(self::$pdo === null){
            $dsn = "mysql:host=127.0.0.1;dbname=tchat";
            $username = "tchat";
            $passwd = "0000";
            $options = array();
            
            self::$pdo = new PDO($dsn, $username, $passwd, $options);
        }
        
    }
    
    public function getDb(){
    	return self::$pdo;
    }
    
    abstract public function find($id);
    
    abstract public function fetchAll();
}