<?php 

/**
 * Gestion table `famille`
 * 
  `code` varchar(5) NOT NULL,
  `lib` varchar(45) NOT NULL COMMENT 'Libellé',
  PRIMARY KEY (`code`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class FamilleModel extends Model
{
	private $table = 'famille';
	
	private $cols = array('code', 'lib');
	
	public function find($id)
	{
		$query = "SELECT * FROM $this->table WHERE code=:id";
		 
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
	
	public function create($code, $lib)
	{
		$query = "INSERT INTO $this->table VALUES (:code, :lib)";
    	 
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':code', $code);
    	$statement->bindParam(':lib', $lib);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
	}
	
	public function update($code, $lib)
	{
		$query = "UPDATE $this->table SET lib=:lib WHERE code=:code";
	
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':code', $code);
		$statement->bindParam(':lib', $lib);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
	
	public function delete($code)
	{
		$query = "DELETE FROM $this->table WHERE code=:code";
	
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':code', $code);
			
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
}