<?php

/**
 * Controller Panier
 * @author Alexandra Habchi
 *
 */
class PanierController extends Controller
{
    public function action()
    {
        $this->view->user = $this->request->getSession()->getNamespace('user');
        
        if($this->request->getMethod() == 'GET'){
        	$data = $this->request->getParams();
        	
        	$commande = $this->getCommand($this->view->user['id']);
        	$this->view->commande = $commande;
        	$ligneModel = new LigneCommandeModel();
        	$lignes = $ligneModel->findByCommande($commande['id_cmd']);
        	
        	foreach($lignes as $ligne) {
        		$prdModel = new ProduitModel();
        		$ligne['produit'] = $prdModel->find($ligne['cod_prd']);
        		$this->view->lignes[] = $ligne;
        	}
            $archives = new CommandeModel;
            foreach($archives->findByClient($this->view->user['id']) as $cmd) {
                if($cmd['statut'] != 0) {
                    $this->view->archives[] = $cmd;
                }
            }
        }
        
        if($this->request->getMethod() == 'POST') {
        	$data = $this->request->getParams();
        	
        	/* Ajout/modif produit */ 
        	if(isset($data['context']) && isset($data['id_prd']) && isset($data['qte'])) {
        		$commande = $this->getCommand($this->view->user['id']);
        		$ligneModel = new LigneCommandeModel();
        		$lignes = $ligneModel->findByCommande($commande['id_cmd']);
        		
        		foreach($lignes as $ligne) {
        			if($ligne['cod_prd'] == $data['id_prd']) {
        				if($data['qte'] == 0) {
        					$result = $ligneModel->delete($commande['id_cmd'], $data['id_prd']);
        					$msg = 'Produit supprimé du panier';
        				} else {
        					$result = $ligneModel->updateQte($commande['id_cmd'], $data['id_prd'], $data['qte']);
        					$msg = 'Quantité modifiée dans le panier';
        				}
        			}
        		}
        		
        		if(!isset($result)) {
        			$result = $ligneModel->create($commande['id_cmd'], $data['id_prd'], $this->view->user['id'], $data['qte'], $commande['statut']);
        			$msg = 'Produit ajouté au panier';
        		}
        		
        		if($result == true) {
        			echo json_encode(array('message' => $msg)); exit;
        		} else {
        			echo json_encode(array('message' => 'Problème d\'ajout au panier')); exit;
        		}
        	}
        	
        	/* Envoi commande */
        	if(isset($data['context']) && isset($data['id_cmd'])) {
        		$commande = new CommandeModel();
        		$result = $commande->nextStep($data['id_cmd']);
        		
        	
        		if($result == true) {
        			echo json_encode(array('message' => 'Commande envoyée !')); exit;
        		} else {
        			echo json_encode(array('message' => 'Problème d\'envoi de la commande')); exit;
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