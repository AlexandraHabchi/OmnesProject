<?php 

/**
 * Gestion table `famille`
 * 
  `id` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lib` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class FamilleModel extends Model
{
	public function find($id)
	{
		$query = "SELECT * FROM `famille` WHERE code=:id";
		 
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
		$query = "SELECT * FROM `famille`";
	
		$statement = $this->getDb()->prepare($query);
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		 
		return $statement->fetchAll();
	}
}