<?php

/**
 * Gestion table `client`
 *
 * 
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(45) NOT NULL COMMENT 'Pseudo de connexion',
  `email` varchar(45) NOT NULL COMMENT 'Adresse mail principale',
  `nom_ccm` varchar(45) NOT NULL COMMENT 'Nom commercial de l''entreprise',
  `nom_cli` varchar(40) DEFAULT NULL COMMENT 'Nom du(des) contact(s) ou responsable(s)',
  `com_cli` varchar(250) DEFAULT NULL COMMENT 'Commentaire',
  `siret` varchar(25) DEFAULT NULL COMMENT 'Numero de siret + code etablissement',
  `tva` varchar(25) DEFAULT NULL COMMENT 'code tva intra-communautaire',
  `tel` varchar(15) DEFAULT NULL COMMENT 'Numero de téléphone fixe',
  `gsm` varchar(15) DEFAULT NULL COMMENT 'Numero de telephone mobile',
  `fax` varchar(15) DEFAULT NULL COMMENT 'Numero de fax',
  `email_sec` varchar(45) DEFAULT NULL COMMENT 'Adresse mail secondaire',
  `dat_crea` date NOT NULL COMMENT 'Date de creation du client',
  `dat_supp` date DEFAULT NULL COMMENT 'Date de suppression',
  `valid` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Blocage du compte',
  `dat_last_connect` date DEFAULT NULL COMMENT 'Date de la derniere connexion',
  `session` varchar(10) DEFAULT NULL COMMENT 'Numero de session du client',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
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
    	$query = "SELECT * FROM `client` WHERE valid=1";
    	 
    	$statement = $this->getDb()->prepare($query);
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	
    	return $statement->fetchAll();
    }
    
    public function create($pseudo, $email, $nom_ccm, $profil)
    {
    	$query = "INSERT INTO client 
    						  ( pseudo,  email,  nom_ccm, dat_crea) 
    				   VALUES (:pseudo, :email, :nom_ccm, :dat_crea)";
    	
    	$create = Date::getDate();
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':pseudo', $pseudo);
    	$statement->bindParam(':email', $email);
    	$statement->bindParam(':nom_ccm', $nom_ccm);
    	$statement->bindParam(':dat_crea', $create);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	$newClient = $this->findByPseudo($pseudo);
    	
    	$ideModel = new IdentifiantModel();
    	$OK = $ideModel->create($newClient['id'], $pseudo, $email, $profil);
    	
    	return $OK;
    }
    
    public function findByPseudo($pseudo)
    {
    	$query = "SELECT * FROM `client` WHERE pseudo=:pseudo";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':pseudo', $pseudo);
    	 
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
}