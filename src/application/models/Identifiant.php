<?php

/**
 * Gestion table `identifiant`
 *
 * 
  `id_cli` int(11) NOT NULL COMMENT 'Code client',
  `pseudo` varchar(45) NOT NULL COMMENT 'Pseudo utilisateur',
  `email` varchar(45) NOT NULL COMMENT 'Adresse mail client',
  `valid` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Blocage du compte',
  `profil` varchar(45) NOT NULL COMMENT 'Profil du compte',
  `session` varchar(10) DEFAULT NULL COMMENT 'Numero de la derniere session',
  PRIMARY KEY (`id_cli`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class IdentifiantModel extends Model
{
    public function find($id) 
    {
    	$query = "SELECT * FROM `identifiant` WHERE id_cli=:id";
    	
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
    	$query = "SELECT * 
    			    FROM `identifiant`
    			    JOIN client
    			      ON client.id = identifiant.id_cli";
    	 
    	$statement = $this->getDb()->prepare($query);
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	
    	return $statement->fetchAll();
    }
    
    public function create($id_cli, $pseudo, $email, $profil)
    {
    	$query = "INSERT INTO identifiant VALUES (:id_cli, :pseudo, :email, 1, :profil, NULL)";
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id_cli', $id_cli);
    	$statement->bindParam(':pseudo', $pseudo);
    	$statement->bindParam(':email', $email);
    	$statement->bindParam(':profil', $profil);
    	
    	$passwordModel = new PasswordModel();
    	$OK = $passwordModel->create($id_cli, $pseudo, $email);
    	
    	if($statement->execute() == false || $OK != true) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
    }
    
    public function findByLoginAndPassword($login, $password)
    {
    	$query = "SELECT *
    			    FROM `identifiant` 
    			    JOIN password
    				  ON password.id_cli = identifiant.id_cli
    			   WHERE (pseudo=:login OR email=:login)
    				 AND password.hashed = :hashed";
    	
    	$pwdModel = new PasswordModel();
    
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':login', $login);
    	$statement->bindParam(':hashed', $pwdModel->crypt_password($password));
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return $statement->fetch();
    }
    
    public function delete($id)
    {
    	$query = "UPDATE `identifiant` SET valid=0 WHERE id_cli=:id";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $id);
    	 
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	
    	$cliModel = new ClientModel;
    	$OK = $cliModel->delete($id);
    	
    	return $OK;
    }
    
    public function activate($id)
    {
    	$query = "UPDATE `identifiant` SET valid=1 WHERE id_cli=:id";
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $id);
    
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	 
    	$cliModel = new ClientModel;
    	$OK = $cliModel->activate($id);
    	 
    	return $OK;
    }
}