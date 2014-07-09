<?php 

/**
 * Gestion table `tauxtva`
 * 
  `cod_tva` int(2) NOT NULL,
  `lib_tva` varchar(45) NOT NULL COMMENT 'Libellé',
  `tau_tva` float(5,2) NOT NULL COMMENT 'Taux de tva à diviser par 100',
  `dat_cre` date NOT NULL COMMENT 'Date de création',
  PRIMARY KEY (`cod_tva`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class TvaModel extends Model
{
	/**
	 * @var string
	 */
	private $table = 'tauxtva';
	
	/**
	 * @var array
	 */
	private $cols = array('Code', 'Libellé', 'Taux TVA', 'Date de création');
	
	
	public function find($id)
	{
		$query = "SELECT * FROM $this->table WHERE cod_tva=:id";
		 
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
	
	public function create($code, $lib, $taux)
	{
		$query = "INSERT INTO $this->table VALUES (:code, :lib, :taux, :date)";
    	
		$date = Date::getDate();
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':code', $code);
    	$statement->bindParam(':lib', $lib);
    	$statement->bindParam(':taux', $taux);
    	$statement->bindParam(':date', $date);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
	}
	
	public function update($id, $lib, $taux)
	{
		$query = "UPDATE $this->table SET lib_tva=:lib, tau_tva=:taux WHERE cod_tva=:id";
	
		$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':taux', $taux);
    	$statement->bindParam(':lib', $lib);
    	$statement->bindParam(':id', $id);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
	
	public function delete($code)
	{
		$query = "DELETE FROM $this->table WHERE cod_tva=:code";
	
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