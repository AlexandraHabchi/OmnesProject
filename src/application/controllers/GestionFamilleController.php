<?php

/**
 * Controller Gestion Famille
 * @author Alexandra
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
        	$model = new FamilleModel;
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
        	$model = new FamilleModel();
        	 
        	/* Création */
        	if(isset($data['create']) && empty($data['ident'])) {
        		if($model->find($data['code'])) {
		    		$errMessages[] = 'Cet élément existe déjà !';
		    	}
		    		
		    	if(empty($errMessages)) {
		    		$result = $model->create($data['code'], $data['lib']);
		    	}
        	}
        	
        	/* Modification */
        	if(isset($data['create']) && !empty($data['ident'])) {
        		$result = $model->update($data['code'], $data['lib']);
        	}
        	
        	/* Suppression */
        	if(isset($data['supp']) && !empty($data['ident'])) {
        		$result = $model->delete($data['ident']);
        	}
        	
        	if(isset($result)) {
        		if (FALSE == $result) {
	        		$errMessages[] = $errors->find('ERR-005');
	        	} else {
	        		$validMessages[] = $errors->find('MSG-002');
	        		Url::redirect("/gestionFamille");
	        	}
        	}
        	
        	$this->view->errMessages = $errMessages;
        	$this->view->validMessages = $validMessages;
        	
        }
    }
}