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
        	
        	if(isset($params['context']) && isset($params['click'])) {
        		$model = new FamilleModel;
        		$elmt = $model->find($params['click']);
        		echo json_encode($elmt); exit;
        	} 
        	
        	elseif(isset($params['context'])) {
        		$model = new FamilleModel;
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
        		$this->create($data);
        	}
        	
        	/* Modification */
        	if(isset($data['create']) && !empty($data['ident'])) {
        		$this->update($data);
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
        	
        }
    }
    
    private function create($data)
    {
    	$errMessages = array();
    	$validMessages = array();
    	$errors = new ErrorModel();
    	$model = new FamilleModel();
    	
    	if($model->find($data['code'])) {
    		$errMessages[] = 'Cet élément existe déjà !';
    	}
    		
    	if(empty($errMessages)) {
    		$result = $model->create($data['code'], $data['lib']);
    			
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
    
    private function update($data)
    {
    	
    	$result = $model->update($data['code'], $data['lib']);
    		 
    	if (FALSE == $result) {
    		$errMessages[] = $errors->find('ERR-005');
    	} else {
    		$validMessages[] = $errors->find('MSG-002');
    		Url::redirect("/gestionFamille");
    	}
    	
    }
}