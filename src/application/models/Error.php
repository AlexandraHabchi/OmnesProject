<?php 

/**
 * Gestion table `message`
 *
 * 
  `id` varchar(12) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lib` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class ErrorModel extends Model
{
	public function find($id)
	{
		$query = "SELECT * FROM `message` WHERE id=:id";
		 
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		$result = $statement->fetch();
		
		if(empty($result)) {
			return 'Erreur inconnue';
		}
	
		return $result['lib'];
	}
	
	public function fetchAll()
	{
		$query = "SELECT * FROM `message`";
	
		$statement = $this->getDb()->prepare($query);
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		 
		return $statement->fetchAll();
	}
}