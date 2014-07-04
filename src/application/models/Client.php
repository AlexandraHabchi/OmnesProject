<?php

/**
 * Gestion table `client`
 *
 * `id` int(11) NOT NULL AUTO_INCREMENT,
 * `login` varchar(255) NOT NULL,
 * `email` varchar(255) NOT NULL,
 * `profil` varchar(255) NOT NULL,
 * `supprimer` tinyint(1) NOT NULL DEFAULT '0',
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class ClientModel extends Model
{
    public function find($id)
    {
    	$query = "SELECT * FROM `client` WHERE id=:id";
    	
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
    	$query = "SELECT * FROM `client` WHERE supprimer=0";
    	 
    	$statement = $this->getDb()->prepare($query);
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	
    	return $statement->fetchAll();
    }
    
    public function findByLoginAndPassword($login, $password)
    {
    	$query = "SELECT * 
    			    FROM `client`
    			    JOIN password
    			      ON password.login = client.login
    			   WHERE ( client.login = :login OR client.email = :login )
    				 AND password.password = :password;";
    	
    	$passwordModel = new PasswordModel();
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':login', $login);
    	$statement->bindParam(':password', $passwordModel->crypt_password($password));
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
		
    	return $statement->fetch();
    }
    
    public function findByEmail($email)
    {
    	$query = "SELECT * FROM `client` WHERE email=:email";
    
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':email', $email);
    	 
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	 
    	return $statement->fetch();
    }
    
    public function findByLogin($login)
    {
    	$query = "SELECT * FROM `client` WHERE login=:login";
    
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':login', $login);
    	 
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	 
    	return $statement->fetch();
    }
    
    public function create($login, $password, $email, $profil)
    {
    	$query = "INSERT INTO client VALUES (NULL, :login, :email, :profil, 0)";
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':login', $login);
    	$statement->bindParam(':email', $email);
    	$statement->bindParam(':profil', $profil);
    	
    	$passwordModel = new PasswordModel();
    	$OK = $passwordModel->create($login, $password);
    	
    	if($statement->execute() == false || $OK != true) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
    }
    
    public function updateUserByAdmin(Array $data, $id)
    {
    	$query = "UPDATE `client` SET profil=:profil WHERE id=:id";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':profil', $data['profil']);
		$statement->bindParam(':id', $id);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	 
    	return TRUE;
    }
    
    public function delete($id) 
    {
    	$query = "UPDATE `client` SET supprimer = 1 WHERE id=:id";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $id);
    	 
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	
    	return TRUE;
    }
}