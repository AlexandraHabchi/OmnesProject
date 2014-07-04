<?php

/**
 * Class qui gère les Sessions
 * @author Formateur
 *
 */
class Session {
    
    /**
     * Construction de la Session et initialisation
     */
    public function __construct(){
        session_start();
    }
    
    /**
     * Récupération d'un espace de nom situé dans la SESSION
     * @param string $name
     * @return mixed
     */
    public function getNamespace($name){
        if (isset($_SESSION[$name])){
            return $_SESSION[$name];
        }
        return FALSE;
    }
    
    /**
     * Setter d'un espace de nom situé dans la SESSION
     * @param string $name
     * @param mixed $value
     */
    public function setNamespace($name, $value){
        $_SESSION[$name] = $value;
        return $this;
    }
    
    /**
     * Récupération de la SESSION
     * @return unknown
     */
    public function getSession(){
        return $_SESSION;
    }
    
    /**
     * Suppression de la SESSION
     * @return boolean
     */
    public function unsetSession(){
        unset($_SESSION);
        return TRUE;
    }
    
    /**
     * Suppression d'un espace de nom dans la SESSION
     * @param string $name
     * @return boolean
     */
    public function unsetNamespace($name){
        unset($_SESSION[$name]);
        return TRUE;
    }
    
}