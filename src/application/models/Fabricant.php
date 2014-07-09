<?php 

/**
 * Gestion table `fabricant`
 * 
  `cod_lab` int(11) NOT NULL AUTO_INCREMENT,
  `nom_lab` varchar(45) NOT NULL COMMENT 'Nom commercial',
  `sit_web` varchar(250) DEFAULT NULL COMMENT 'Lien vers site web du fabricant',
  `tel_lab` varchar(15) DEFAULT NULL COMMENT 'Téléphone',
  `fax_lab` varchar(15) DEFAULT NULL COMMENT 'Fax',
  `bal_lab` varchar(45) DEFAULT NULL COMMENT 'E-mail',
  `nom_rep` varchar(45) DEFAULT NULL COMMENT 'Nom du repésentant',
  `tel_rep` varchar(15) DEFAULT NULL COMMENT 'Téléphone du repésentant',
  `fax_rep` varchar(15) DEFAULT NULL COMMENT 'Fax du repésentant',
  `bal_rep` varchar(45) DEFAULT NULL COMMENT 'E-mail du repésentant',
  `com_lab` varchar(250) DEFAULT NULL COMMENT 'Commentaire',
  PRIMARY KEY (`cod_lab`),
  UNIQUE KEY `nom_lab` (`nom_lab`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class FabricantModel extends Model
{
	/**
	 * @var string
	 */
	private $table = 'fabricant';
	
	/**
	 * @var array
	 */
	private $cols = array('Code', 'Nom', 'Site web', 'Téléphone', 'Fax', 'Email', 'Nom du représentant', 'Téléphone', 'Fax', 'Email', 'Commentaires');
	
	
	public function find($id)
	{
		$query = "SELECT * FROM $this->table WHERE cod_lab=:id";
		 
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return  $statement->fetch();
	}
	
	public function fetchAll()
	{
		$query = "SELECT * FROM $this->table";
	
		$statement = $this->getDb()->prepare($query);
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		 
		return $statement->fetchAll();
	}
	
	public function create(Array $data)
	{
		$query = "INSERT INTO $this->table VALUES (NULL, :name, :website, :tel, :fax, :email, :nom_rep, :tel_rep, :fax_rep, :email_rep, :comment)";
    	
		$date = Date::getDate();
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':name', $data['name']);
    	$statement->bindParam(':website', $data['website']);
    	$statement->bindParam(':tel', $data['tel']);
    	$statement->bindParam(':fax', $data['fax']);
    	$statement->bindParam(':email', $data['email']);
    	$statement->bindParam(':nom_rep', $data['nom_rep']);
    	$statement->bindParam(':tel_rep', $data['tel_rep']);
    	$statement->bindParam(':fax_rep', $data['fax_rep']);
    	$statement->bindParam(':email_rep', $data['email_rep']);
    	$statement->bindParam(':comment', $data['comment']);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
	}
	
	public function update(Array $data)
	{
		$query = "UPDATE $this->table 
					 SET nom_lab=:name, sit_web=:website, tel_lab=:tel, fax_lab=:fax, bal_lab=:email, 
					 	 nom_rep=:nom_rep, tel_rep=:tel_rep, fax_rep=:fax_rep, bal_rep=:email_rep, com_lab=:comment
				   WHERE cod_lab=:id";
		
		$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $data['code']);
    	$statement->bindParam(':name', $data['name']);
    	$statement->bindParam(':website', $data['website']);
    	$statement->bindParam(':tel', $data['tel']);
    	$statement->bindParam(':fax', $data['fax']);
    	$statement->bindParam(':email', $data['email']);
    	$statement->bindParam(':nom_rep', $data['nom_rep']);
    	$statement->bindParam(':tel_rep', $data['tel_rep']);
    	$statement->bindParam(':fax_rep', $data['fax_rep']);
    	$statement->bindParam(':email_rep', $data['email_rep']);
    	$statement->bindParam(':comment', $data['comment']);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
	
	public function delete($code)
	{
		$query = "DELETE FROM $this->table WHERE cod_lab=:code";
	
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':code', $code);
			
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
	
	/**
	 * @return the $cols
	 */
	public function getCols() {
		return $this->cols;
	}
	
}