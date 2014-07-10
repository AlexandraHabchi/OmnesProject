<?php 

/**
 * Gestion table `imagerie`
 * 
  `cod_prd` int(11) NOT NULL COMMENT 'Code produit',
  `lnk_prd` varchar(125) DEFAULT NULL COMMENT 'Lien externe',
  UNIQUE KEY `image_produit` (`cod_prd`,`lnk_prd`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class ImagerieModel extends Model
{
	/**
	 * @var string
	 */
	private $table = 'imagerie';
	
	/**
	 * @var array
	 */
	private $cols = array('Produit', 'Lien');
	
	public function find($id)
	{
		$query = "SELECT * FROM $this->table WHERE cod_prd=:id";
			
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->bindParam(':link', $link);
			
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return  $statement->fetchAll();
	}
	
	public function findImage($id, $link)
	{
		$query = "SELECT * FROM $this->table WHERE cod_prd=:id AND lnk_prd=:link";
		 
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':id', $id);
		$statement->bindParam(':link', $link);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return  $statement->fetch();
	}
	
	public function fetchAll()
	{
		$query = "SELECT produit.lib_prd, imagerie.lnk_prd
				    FROM $this->table
				    JOIN produit
					  ON produit.id = imagerie.cod_prd";
	
		$statement = $this->getDb()->prepare($query);
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		 
		return $statement->fetchAll();
	}
	
	public function create($cod_prd, $lnk_prd)
	{
		$uploads_dir = PUBLIC_PATH . '/img/produits'; $i = 0;
		if(is_dir($uploads_dir)) {
			if ($lnk_prd['error'] == 0) {
				$tmp_name = $lnk_prd["tmp_name"];
				$file = explode('.', $lnk_prd["name"]);
				$name = array_shift($file);
				$file = implode('.', $file);
				while(file_exists($uploads_dir . '/' . $name . $i . '.' . $file)) {
					$i++;
				}
				$file = $name . $i . '.' . $file;
				if(move_uploaded_file($tmp_name, "$uploads_dir/$file")) $link = "$uploads_dir/$file";
			}
		}
		
		if(!isset($link)) { return false; }
		$query = "INSERT INTO $this->table VALUES (:cod_prd, :lnk_prd)";
		
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':cod_prd', $cod_prd);
    	$statement->bindParam(':lnk_prd', $link);
    	
    	if($statement->execute() == false) {
    		$errorInfo = $statement->errorInfo();
    		echo $errorInfo[2];
    		exit;
    	}
    	return TRUE;
	}
	
	public function delete($code, $link)
	{
		$query = "DELETE FROM $this->table WHERE cod_prd=:code AND lnk_prd=:lnk_prd";
	
		$statement = $this->getDb()->prepare($query);
		$statement->bindParam(':code', $code);
		$statement->bindParam(':link', $link);
			
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