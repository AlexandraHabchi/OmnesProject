<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class HomeController extends Controller
{
    public function action()
    {
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	/* Connexion */ 
        	if(isset($data['connect'])) {
        		$this->verifId($data);
        	}
        	
        	/* Mot de passe oublié */
        	if(isset($data['ajax']) && $data['ajax'] == 'oubliPwd') {
        		
        	}
        }
        
        $this->view->user = $this->request->getSession()->getNamespace('user');
    }
    
    private function verifId($data) 
    {
    	$errMessages = array();
    	$errors = new ErrorModel();
    	
    	$ideModel = new IdentifiantModel();
    	$result = $ideModel->findByLoginAndPassword($data['login'], $data['password']);
    	if (FALSE == $result) {
    		$errMessages[] = $errors->find('ERR-001');
    	} elseif($result['valid'] == 0) {
    		$errMessages[] = $errors->find('ERR-003');
    	} else {
    		$this->request->getSession()->setNamespace('user', $result);
    		$newClient = new ClientModel;
    		$newClient->updateLastConnect($result['id_cli']);
    	}
    	 
    	if(empty($data['login'])){
    		$errMessages[] = 'Login obligatoire';
    	}
    	 
    	if(empty($data['password'])){
    		$errMessages[] = 'Password obligatoire';
    	}
    	
    	$this->view->errMessages = $errMessages;
    	$this->view->inputs = array(
    			'login' => $data['login'],
    			'password' => $data['password']);
    }
}