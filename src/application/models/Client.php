<?php

/**
 * Gestion table `client`
 *
 * `cod_cli` int(11) NOT NULL AUTO_INCREMENT,
 * `pseudo` varchar(45) NOT NULL COMMENT 'Pseudo de connexion',
 * `bal_cli` varchar(45) NOT NULL COMMENT 'Adresse mail principale',
 * `nom_ccm` varchar(45) NOT NULL COMMENT 'Nom commercial de l''entreprise',
 * `nom_cli` varchar(40) DEFAULT NULL COMMENT 'Nom du(des) contact(s) ou responsable(s)',
 * `com_cli` varchar(250) DEFAULT NULL COMMENT 'Commentaire',
 * `sir_cli` varchar(25) DEFAULT NULL COMMENT 'Numero de siret + code etablissement',
 * `cod_tva` varchar(25) DEFAULT NULL COMMENT 'code tva intra-communautaire',
 * `tel_cli` varchar(15) DEFAULT NULL COMMENT 'Numero de téléphone fixe',
 * `gsm_cli` varchar(15) DEFAULT NULL COMMENT 'Numero de telephone mobile',
 * `fax_cli` varchar(15) DEFAULT NULL COMMENT 'Numero de fax',
 * `bal_sec_cli` varchar(45) DEFAULT NULL COMMENT 'Adresse mail secondaire',
 * `dat_cre_cli` date NOT NULL COMMENT 'Date de creation du client',
 * `dat_sup_cli` date DEFAULT NULL COMMENT 'Date de suppression',
 * `act_cli` varchar(1) NOT NULL DEFAULT 'O' COMMENT 'En activité (par default = O, suppression logique = N)',
 * `dat_con_cli` date DEFAULT NULL COMMENT 'Date de la derniere connexion',
 * `session_cli` varchar(10) DEFAULT NULL COMMENT 'Numero de session du client',
 * PRIMARY KEY (`cod_cli`),
 * UNIQUE KEY `pseudo` (`pseudo`),
 * UNIQUE KEY `bal_cli` (`bal_cli`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class ClientModel extends Model
{
    public function find($id)
    {
    	$query = "SELECT * FROM `client` WHERE cod_cli=:id";
    	
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