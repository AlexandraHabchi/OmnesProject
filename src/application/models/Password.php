<?php

/**
 * Gestion table `password`
 *
  `id_cli` int(11) NOT NULL COMMENT 'Code d''identification',
  `hashed` varchar(250) NOT NULL COMMENT 'Mot de passe',
  `clear` varchar(250) NOT NULL COMMENT 'Mot de passe',
  `changer` tinyint(1) DEFAULT '1' NOT NULL COMMENT 'Changement obligatoire de mot de passe',
  `nbr_cnx` int(11) DEFAULT NULL COMMENT 'Nombre de connexions avec le meme mot de passe',
  `last_chg` date DEFAULT NULL COMMENT 'Date du dernier changement de mot de passe',
  `nbr_oub` int(11) DEFAULT NULL COMMENT 'Nombre de demandes pour oubli de mot de passe',
  UNIQUE KEY (`id_cli`),
  KEY `id_cli` (`id_cli`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class PasswordModel extends Model
{
    public function find($id)
    {
    	$query = "SELECT * FROM `password` WHERE id_cli=:id";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $id);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	
    	return $statement->fetch();
    }
    
    public function fetchAll()
    {
    	
    }
    
    public function create($id_cli, $pseudo, $email)
    {
    	$query = "INSERT INTO password VALUES (:id_cli, :password, :clear, 1, NULL, NULL, NULL)";
    	
    	$mdp = $this->generate(6);
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id_cli', $id_cli);
    	$statement->bindParam(':password', $this->crypt_password($mdp));
    	$statement->bindParam(':clear', $mdp);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	$objet = 'Ouverture de votre compte Omnes Pharma';
    	$msg = '<b>Felicitations !</b><br>';
    	$msg.= 'Vous avez maintenant un compte sur Omnes Pharma.<br>';
    	$msg.= 'Vos identifiants : <b>' . $pseudo . '</b> ou <b>' . $email . '</b><br>';
    	$msg.= 'Votre mot de passe : <b>' . $mdp . '</b>';
    	
    	$OK = Email::envoi($email, $objet, $msg);
    	
    	$errors = new ErrorModel;
    	if($OK != 1) {
    		echo $errors->find('ERR-004'); exit;
    	}
    	return TRUE;
    }
    
    public function oubli($id_cli, $email)
    {
    	$query = "UPDATE `password` 
    				 SET hashed=:password, clear=:clear, last_chg=:last_chg, changer=1
    			   WHERE id_cli=:id_cli";
    	
    	$auj = Date::getDate();
    	$mdp = $this->generate(6);
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id_cli', $id_cli);
    	$statement->bindParam(':password', $this->crypt_password($mdp));
    	$statement->bindParam(':clear', $mdp);
    	$statement->bindParam(':last_chg', $auj);
    	 
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	$objet = 'Oubli de votre mot de passe Omnes Pharma';
    	$msg = 'Voici votre nouveau mot de passe Omnes Pharma a utiliser lors de votre prochaine connexion<br>';
    	$msg.= 'Votre mot de passe : <b>' . $mdp . '</b>';
    	 
    	$OK = Email::envoi($email, $objet, $msg);
    	 
    	$errors = new ErrorModel;
    	if($OK != 1) {
    		echo $errors->find('ERR-004'); exit;
    	}
    	return TRUE;
    }
    
    public function update($id_cli, $password)
    {
    	$query = "UPDATE `password` 
    				 SET hashed=:password, clear=:clear, last_chg=:last_chg, nbr_cnx=0, changer=0
    			   WHERE id_cli=:id_cli";
    	
    	$auj = Date::getDate();
    	$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id_cli', $id_cli);
		$statement->bindParam(':password', $this->crypt_password($password));
		$statement->bindParam(':clear', $password);
		$statement->bindParam(':last_chg', $auj);
		
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	 
    	return TRUE;
    }
    
    public function crypt_password($password)
    {
    	$salt_begin = "&dr5864\vjf8ef4FRcd";
    	$salt_end   = "kopl58K4b56teez#c&/u";
    	$crypt_begin = crypt($password, $salt_begin);
    	$crypt_end = crypt($crypt_begin, $salt_end);
    	
    	return $crypt_end;
    }
    
    /**
     * Fonction de generation d'un mot de passe Aleatoire
     * @param int $len longueur du mot de passe
     * @return string $mdp mot de passe alphanumérique
     */
	function generate($len)
	{
	  $mdp='';
	  while ( $len > 0 )
	    {
	      $X = rand(48,122);
	      if (($X>=48 && $X<=57) || ($X>=65 && $X<=90) ||($X>=97 && $X<=122))   // [0..9, A..Z, a..z]
	        {  $mdp.=chr($X); $len--; }
	    }
	  return $mdp;
	}
}