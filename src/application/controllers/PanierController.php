<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class PanierController extends Controller
{
    public function action()
    {
        $this->view->user = $this->request->getSession()->getNamespace('user');
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	/* Ajout produit */ 
        	if(isset($data['context']) && isset($data['id_prd']) && isset($data['qte'])) {
        		$commande = $this->getCommand($this->view->user['id']);
        		$ligneModel = new LigneCommandeModel();
        		$lignes = $ligneModel->findByCommande($commande['id_cmd']);
        		
        		foreach($lignes as $ligne) {
        			if($ligne['cod_prd'] == $data['id_prd']) {
        				$result = $ligneModel->updateQte($commande['id_cmd'], $data['id_prd'], $data['qte']);
        			}
        		}
        		
        		if(!isset($result)) {
        			$result = $ligneModel->create($commande['id_cmd'], $data['id_prd'], $this->view->user['id'], $data['qte'], $commande['statut']);
        		}
        		
        		if($result == true) {
        			echo json_encode(array('message' => 'Produit ajouté au panier')); exit;
        		} else {
        			echo json_encode(array('message' => 'Problème d\'ajout au panier')); exit;
        		}
        	}
        }
    }
    
    private function getCommand($id_user) {
    	$cmdModel = new CommandeModel;
    	$commande = $cmdModel->findLastCommande($id_user);
    	
    	if($commande == false) {
    		$cmdModel->create($id_user);
    		$commande = $cmdModel->findLastCommande($id_user);
    	}
    	
    	return $commande;
    }
}