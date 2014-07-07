<?php

/**
 * Controller Inscription
 * @author Formateur
 *
 */
class GestionClientController extends Controller
{
    public function action()
    {
        $errMessages = array();
        $validMessages = array();
        
        $ideModel = new IdentifiantModel;
        $this->view->clients = $ideModel->fetchAll();
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
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
		        		$errMessages[] = 'Problème d\'enregistrement';
		        	} else {
		        		$validMessages[] = 'Le compte a bien été créé';
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
        
        $this->view->auth = $this->request->getSession()->getNamespace('auth');
    }
}