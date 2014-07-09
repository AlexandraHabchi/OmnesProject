<?php

/**
 * Controller Gestion TVA
 * @author Alexandra
 *
 */
class GestionTvaController extends Controller
{
    public function action()
    {
    	$this->view->user = $this->request->getSession()->getNamespace('user');
        
        $errors = new ErrorModel();
        
        if($this->request->getMethod() == 'GET'){
        	$params = $this->request->getParams();
        	$model = new TvaModel;
        	$entete = $model->getCols();
        	
        	if(isset($params['context']) && isset($params['click'])) {
        		$elmt = $model->find($params['click']);
        		echo json_encode($elmt); exit;
        	} 
        	
        	elseif(isset($params['context'])) {
        		$list = $model->fetchAll();
        		array_unshift($list, $entete);
        		echo json_encode($list); exit;
        	}
        	
        }
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	$errMessages = array();
        	$validMessages = array();
        	$errors = new ErrorModel();
        	$model = new TvaModel;
        	 
        	/* Création */
        	if(isset($data['create']) && empty($data['ident'])) {
        	if($model->find($data['code'])) {
		    		$errMessages[] = 'Cet élément existe déjà !';
		    	}
		    		
		    	if(empty($errMessages)) {
		    		$result = $model->create($data['code'], $data['lib'], $data['taux']);
		    	}
        	}
        	
        	/* Modification */
        	if(isset($data['create']) && !empty($data['ident'])) {
        		$result = $model->update($data['ident'], $data['lib'], $data['taux']);
        	}
        	
        	/* Suppression */
        	if(isset($data['supp']) && !empty($data['ident'])) {
        		$reponse = $model->delete($data['ident']);
        	}
        	
        	if(isset($result)) {
        		if (FALSE == $result) {
	        		$errMessages[] = $errors->find('ERR-005');
	        	} else {
	        		$validMessages[] = $errors->find('MSG-002');
	        		Url::redirect("/gestionTva");
	        	}
        	}
        	
        	$this->view->errMessages = $errMessages;
        	$this->view->validMessages = $validMessages;
        	
        }
    }
}