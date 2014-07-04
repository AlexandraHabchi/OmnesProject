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
        
        $clientModel = new ClientModel;
        $this->view->clients = $clientModel->fetchAll();
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	if(!empty($data['login']) && !empty($data['password']) && !empty($data['confirm_pass']) && !empty($data['email'])){
        		$clientModel = new ClientModel();
        		if($data['password'] != $data['confirm_pass']) {
        			$errMessages[] = 'La confirmation du mot de passe est inexacte';
        		} 
        		if($clientModel->findByLogin($data['login'])) {
        			$errMessages[] = 'Cet identifiant existe déjà, choisissez-en un autre !';
        		}
        		if($clientModel->findByEmail($data['email'])) {
        			$errMessages[] = 'Cet e-mail est déjà utilisé !';
        		}
        		if(empty($errMessages)) {
        			$users_result = $clientModel->fetchAll();
        			
        			if(empty($users_result)) {
        				$result = $clientModel->create($data['login'], $data['password'], $data['email'], "Admin");
        			} else {
        				$result = $clientModel->create($data['login'], $data['password'], $data['email'], "Client");
        			}
        			
		        	if (FALSE == $result) {
		        		$errMessages[] = 'Problème d\'enregistrement';
		        	} else {
		        		$validMessages[] = 'Le compte a bien été créé';
		        		$newUser = $clientModel->findByLogin($data['login']);
		        	}
        		}
        		
        	}
        	
        	if(empty($data['login'])){
        		$errMessages[] = 'Login obligatoire';
        	}
        	
        	if(empty($data['email'])){
        		$errMessages[] = 'Email obligatoire';
        	}
        	
        	if(empty($data['password'])){
        		$errMessages[] = 'Password obligatoire';
        	}
        	
        	if(empty($data['confirm_pass'])){
        		$errMessages[] = 'Vous devez confirmer le mot de passe';
        	}

        	$this->view->errMessages = $errMessages;
        	$this->view->validMessages = $validMessages;
        	$this->view->inputs = array(
        			'login' => $data['login'],
        			'email' => $data['email'],
        			'password' => $data['password'],
        			'confirm_pass' => $data['confirm_pass']);
        
        }
        
        $this->view->auth = $this->request->getSession()->getNamespace('auth');
    }
}