<?php 

/**
 * Gestion table `commande`
 * 
  `id_cmd` int(11) NOT NULL AUTO_INCREMENT,
  `id_cli` int(11) NOT NULL,
  `date_crea` date NOT NULL,
  `statut` varchar(45) NOT NULL,
  PRIMARY KEY (`id_cmd`),
  KEY `id_cli` (`id_cli`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class CommandeModel extends Model
{
	/**
	 * @var string
	 */
	private $table = 'commande';
	
	/**
	 * @var array
	 */
	private static $statuts = array(
		0 => 'non validée',
		1 => 'validée, en cours de commande',
		2 => 'commandée, en attente de livraison',
		3 => 'livrée, bientôt chez vous',
		4 => 'terminée',
	);
	
	public function find($id)
	{
		$query = "SELECT * FROM $this->table WHERE id_cmd=:id";
		 
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return  $statement->fetch();
	}
	
	public function findByClient($id_cli)
	{
		$query = "SELECT * FROM $this->table WHERE id_cli=:id";
			
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id_cli);
			
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return  $statement->fetchAll();
	}
	
	public function findLastCommande($id_cli)
	{
		$query = "SELECT * FROM $this->table WHERE id_cli=:id AND statut=0";
			
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id_cli);
			
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
	
	public function create($id_cli)
	{
		$query = "INSERT INTO $this->table VALUES (NULL, :id_cli, :date_crea, 0)";
    	
		$date = Date::getDate();
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id_cli', $id_cli);
    	$statement->bindParam(':date_crea', $date);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
	}
	
	public function nextStep($id_cmd)
	{
		$currentCommande = $this->find($id_cmd);
		$statut = $currentCommande['statut'] + 1;
		$query = "UPDATE $this->table SET statut=:statut WHERE id_cmd=:id_cmd";
	
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id_cmd', $id_cmd);
		$statement->bindParam(':statut', $statut);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
	
	/**
	 * @return the $status
	 */
	public function getStatus() {
		return self::status;
	}
	
}