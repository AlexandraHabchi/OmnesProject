<?php 

/**
 * Gestion table `ligneCommande`
 * 
  `id_cmd` int(11) NOT NULL,
  `cod_prd` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `quantite` int(6) NOT NULL,
  `statut` int(2) NOT NULL,
  UNIQUE KEY `cod_prd` (`cod_prd`),
  KEY `id_cli` (`id_cli`),
  KEY `id_cmd` (`id_cmd`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class LigneCommandeModel extends Model
{
	/**
	 * @var string
	 */
	private $table = 'ligneCommande';
	
	public function find($id) {}

	public function fetchAll() {}
	
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
	
	public function findByCommande($id_cmd)
	{
		$query = "SELECT * FROM $this->table WHERE id_cmd=:id";
			
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id_cmd);
			
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return  $statement->fetchAll();
	}

	public function findByProduitAndStatut($cod_prd, $statut)
	{
		$query = "SELECT * FROM $this->table WHERE cod_prd=:id AND statut=:statut";
			
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $cod_prd);
		$statement->bindParam(':statut', $statut);
			
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return  $statement->fetchAll();
	}
	
	public function create($id_cmd, $cod_prd, $id_cli, $quantite, $statut)
	{
		$query = "INSERT INTO $this->table VALUES (:id_cmd, :cod_prd, :id_cli, :quantite, :statut)";
    	
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id_cli', $id_cli);
    	$statement->bindParam(':id_cmd', $id_cmd);
    	$statement->bindParam(':cod_prd', $cod_prd);
    	$statement->bindParam(':quantite', $quantite);
    	$statement->bindParam(':statut', $statut);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
	}
	
	public function updateQte($id_cmd, $cod_prd, $quantite) 
	{
		$query = "UPDATE $this->table 
					 SET quantite=:quantite 
				   WHERE id_cmd=:id_cmd
					 AND cod_prd=:cod_prd";
		 
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id_cmd', $id_cmd);
		$statement->bindParam(':cod_prd', $cod_prd);
		$statement->bindParam(':quantite', $quantite);
										 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
	    return TRUE;
	}
	
	public function delete($id_cmd, $cod_prd)
	{
		$query = "DELETE FROM $this->table
				   WHERE id_cmd=:id_cmd
				     AND cod_prd=:cod_prd";
			
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id_cmd', $id_cmd);
		$statement->bindParam(':cod_prd', $cod_prd);
						
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
}