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
        $errMessages = array();
        $errors = new ErrorModel();
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	if(!empty($data['login']) && !empty($data['password'])){
        		$ideModel = new IdentifiantModel();
        		$result = $ideModel->findByLoginAndPassword($data['login'], $data['password']);
        		if (FALSE == $result) {
        			$errMessages[] = $errors->find('ERR-001');
        		} elseif($result['valid'] == 0) {
        			print_r($result); exit;
        			$errMessages[] = $errors->find('ERR-003');
        		} else {
        			$this->request->getSession()->setNamespace('user', $result);
        			$newClient = new ClientModel;
        			$newClient->updateLastConnect($result['id_cli']);
        		}
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
        
        $this->view->user = $this->request->getSession()->getNamespace('user');
    }
}