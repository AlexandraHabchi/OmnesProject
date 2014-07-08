<?php

/**
 * Controller Inscription
 * @author Formateur
 *
 */
class GestionFamilleController extends Controller
{
    public function action()
    {
    	$this->view->user = $this->request->getSession()->getNamespace('user');
        
        $errors = new ErrorModel();
        
        if($this->request->getMethod() == 'GET'){
        	$params = $this->request->getParams();
        	$entete = array('Code', 'Libellé');
        	if(isset($params['context'])) {
        		$model = new FamilleModel;
        		$list = $model->fetchAll();
        		array_unshift($list, $entete);
        		echo json_encode($list); exit;
        	}
        }
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	/* Création */
        	if(isset($data['create'])) {
        		$this->create($data);
        	}
        	
        	/* Suppression */
        	if(isset($data['supp'])) {
        		$reponse = $ideModel->delete($data['id']);
        		if (FALSE == $reponse) {
        			$errMessages[] = $errors->find('ERR-005');;
        		} else {
        			Url::redirect("/gestionClient");
        		}
        	}
        	
        	/* Modification */
        	if(isset($data['modif']) && isset($data['id'])) {
        		$this->request->getSession()->setNamespace('id_modif', $data['id']);
        		Url::redirect("/modifierClient");
        	}
        }
    }
    
    private function create($data)
    {
    	$errMessages = array();
    	$validMessages = array();
    	$errors = new ErrorModel();
    	$ideModel = new IdentifiantModel;
    	
    	if(empty($data['nom_ccm'])){
    		$errMessages[] = 'Nom commercial obligatoire';
    	}
    	
    	if(empty($data['pseudo'])){
    		$errMessages[] = 'Pseudo obligatoire';
    	}
    	
    	if(empty($data['email']) || !Email::isEmail($data['email'])){
    		$errMessages[] = 'Email valide obligatoire';
    	}
    	 
    	if(empty($errMessages)) {
    		$clientModel = new ClientModel();
    		if($clientModel->findByPseudo($data['pseudo'])) {
    			$errMessages[] = 'Cet identifiant existe déjà, choisissez-en un autre !';
    		}
    		if($clientModel->findByEmail($data['email'])) {
    			$errMessages[] = 'Cet e-mail est déjà utilisé !';
    		}
    		
    		if(empty($errMessages)) {
    			$users_result = $clientModel->fetchAll();
    			 
    			if(empty($users_result)) {
    				$result = $clientModel->create($data['pseudo'], $data['email'], $data['nom_ccm'], "Admin");
    			} else {
    				$result = $clientModel->create($data['pseudo'], $data['email'], $data['nom_ccm'], "Client");
    			}
    			 
    			if (FALSE == $result) {
    				$errMessages[] = $errors->find('ERR-005');
    			} else {
    				$validMessages[] = $errors->find('MSG-002');
    				Url::redirect("/gestionClient");
    			}
    		}
    	
    	}
    	
    	$this->view->errMessages = $errMessages;
    	$this->view->validMessages = $validMessages;
    	$this->view->inputs = array(
    			'nom_ccm' => $data['nom_ccm'],
    			'pseudo' => $data['pseudo'],
    			'email' => $data['email']);
    }
}