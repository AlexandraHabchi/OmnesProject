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
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	if(!empty($data['login']) && !empty($data['password'])){
        		$ideModel = new IdentifiantModel();
        		$result = $ideModel->findByLoginAndPassword($data['login'], $data['password']);
        		if (FALSE == $result) {
        			$errMessages[] = 'Login & Password not match';
        		} elseif($result['valid'] == 0) {
        			print_r($result); exit;
        			$errMessages[] = 'Ce compte a été supprimé';
        		} else {
        			$this->request->getSession()->setNamespace('auth', $result);
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
        
        $this->view->auth = $this->request->getSession()->getNamespace('auth');
    }
}