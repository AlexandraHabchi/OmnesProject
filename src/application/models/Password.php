<?php

/**
 * Gestion table `password`
 *
 * `id` int(11) NOT NULL AUTO_INCREMENT,
 * `login` varchar(254) NOT NULL,
 * `password` varchar(26) NOT NULL
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class PasswordModel extends Model
{
    public function find($id)
    {
    	
    }
    
    public function fetchAll()
    {
    	
    }
    
    public function create($login, $password)
    {
    	$query = "INSERT INTO password VALUES (NULL, :login, :password)";
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':login', $login);
    	$statement->bindParam(':password', $this->crypt_password($password));
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
    }
    
    public function findByLogin($login)
    {
    	$query = "SELECT * FROM `password` WHERE login=:login";
    
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':login', $login);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	
    	return $statement->fetch();
    }
    
    public function update($login, $password)
    {
    	$query = "UPDATE `password` SET password=:password WHERE login=:login";
    	
    	$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':login', $login);
		$statement->bindParam(':password', $password);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	 
    	return TRUE;
    }
    
    public function delete($id) 
    {
    	$query = "DELETE FROM `password` WHERE id=:id";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $id);
    	 
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
}