<?php 

/**
 * Gestion table `produit`
 * 
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lib_prd` varchar(45) NOT NULL COMMENT 'Libellé du produit',
  `tva_cod` int(2) NOT NULL COMMENT 'Code TVA',
  `fam_cod` varchar(5) NOT NULL COMMENT 'Code famille',
  `lab_cod` int(11) NOT NULL COMMENT 'Code Fabricant',
  `prx_cat` float(10,2) NOT NULL COMMENT 'Prix Catalogue Pharmacien',
  `prx_net` float(10,2) NOT NULL COMMENT 'Prix Net Pharmacien',
  `nbp_col` int(5) NOT NULL COMMENT 'Nombre de produit par colis',
  `dat_der_cmd` date DEFAULT NULL COMMENT 'Date de la dernière Commande',
  `dat_pro_cmd` date DEFAULT NULL COMMENT 'Date de la prochaine Commande',
  `cdt_ccm` varchar(200) DEFAULT NULL COMMENT 'Condition Commerciale, commentaire uniquement',
  PRIMARY KEY (`id`)
 *
 * @author Alexandra
 * @category Models
 * @version 0.0.1
 */

class ProduitModel extends Model
{
	/**
	 * @var string
	 */
	private $table = 'produit';
	
	/**
	 * @var array
	 */
	private $cols = array('Code', 'Libellé', 'TVA', 'Famille', 'Fabricant', 'Prix catalogue', 'Prix net', 'Nombre de produits par colis', 'Dernière commande', 'Prochaine commande', 'Conditions commerciales');
	
	
	public function find($id)
	{
		$query = "SELECT produit.id, produit.lib_prd, 
						 tauxtva.tau_tva, famille.lib, fabricant.nom_lab,
						 produit.prx_cat, produit.prx_net, produit.nbp_col, 
						 produit.dat_der_cmd, produit.dat_pro_cmd, produit.cdt_ccm
				    FROM $this->table
				    JOIN fabricant
					  ON fabricant.cod_lab = produit.lab_cod
		            JOIN tauxtva
					  ON tauxtva.cod_tva = produit.tva_cod
		            JOIN famille
					  ON famille.code = produit.fam_cod
				   WHERE id=:id";
		 
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
		$query = "SELECT produit.id, produit.lib_prd, 
						 tauxtva.tau_tva, famille.lib, fabricant.nom_lab,
						 produit.prx_cat, produit.prx_net, produit.nbp_col, 
						 produit.dat_der_cmd, produit.dat_pro_cmd, produit.cdt_ccm
				    FROM $this->table
				    JOIN fabricant
					  ON fabricant.cod_lab = produit.lab_cod
		            JOIN tauxtva
					  ON tauxtva.cod_tva = produit.tva_cod
		            JOIN famille
					  ON famille.code = produit.fam_cod";
	
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
		$query = "INSERT INTO $this->table VALUES (NULL, :lib_prd, :tva_cod, :fam_cod, :lab_cod, :prx_cat, :prx_net, :nbp_col, :dat_der_cmd, :dat_pro_cmd, :cdt_ccm)";
		
    	$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':lib_prd', $data['lib_prd']);
    	$statement->bindParam(':tva_cod', $data['tva_cod']);
    	$statement->bindParam(':fam_cod', $data['fam_cod']);
    	$statement->bindParam(':lab_cod', $data['lab_cod']);
    	$statement->bindParam(':prx_cat', $data['prx_cat']);
    	$statement->bindParam(':prx_net', $data['prx_net']);
    	$statement->bindParam(':nbp_col', $data['nbp_col']);
    	$statement->bindParam(':dat_der_cmd', $data['dat_der_cmd']);
    	$statement->bindParam(':dat_pro_cmd', $data['dat_pro_cmd']);
    	$statement->bindParam(':cdt_ccm', $data['cdt_ccm']);
    	
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
					 SET lib_prd=:lib_prd, tva_cod=:tva_cod, fam_cod=:fam_cod, lab_cod=:lab_cod, prx_cat=:prx_cat, 
					 	 prx_net=:prx_net, nbp_col=:nbp_col, dat_der_cmd=:dat_der_cmd, dat_pro_cmd=:dat_pro_cmd, cdt_ccm=:cdt_ccm
				   WHERE id=:id";
		
		$statement = $this->getDb()->prepare($query);
    	$statement->bindParam(':id', $data['id']);
    	$statement->bindParam(':lib_prd', $data['lib_prd']);
    	$statement->bindParam(':tva_cod', $data['tva_cod']);
    	$statement->bindParam(':fam_cod', $data['fam_cod']);
    	$statement->bindParam(':lab_cod', $data['lab_cod']);
    	$statement->bindParam(':prx_cat', $data['prx_cat']);
    	$statement->bindParam(':prx_net', $data['prx_net']);
    	$statement->bindParam(':nbp_col', $data['nbp_col']);
    	$statement->bindParam(':dat_der_cmd', $data['dat_der_cmd']);
    	$statement->bindParam(':dat_pro_cmd', $data['dat_pro_cmd']);
    	$statement->bindParam(':cdt_ccm', $data['cdt_ccm']);
		 
		if($statement->execute() == false) {
			$errorInfo = $statement->errorInfo();
			echo $errorInfo[2];
			exit;
		}
		return TRUE;
	}
	
	public function delete($code)
	{
		$query = "DELETE FROM $this->table WHERE id=:code";
	
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