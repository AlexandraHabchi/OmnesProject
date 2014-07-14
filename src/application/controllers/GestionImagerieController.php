<?php

/**
 * Controller Gestion Imagerie
 * @author Alexandra Habchi
 *
 */
class GestionImagerieController extends Controller
{
    public function action()
    {
    	$this->view->user = $this->request->getSession()->getNamespace('user');
        
        $errors = new ErrorModel();
        
        $produit = new ProduitModel();
        $this->view->produits = $produit->fetchAll();
         
        if($this->request->getMethod() == 'GET'){
        	$params = $this->request->getParams();
        	$model = new ImagerieModel;
        	$entete = $model->getCols();
        	
        	if(isset($params['context']) && isset($params['click'])) {
        		//$elmt = $model->find($params['click']);
        		//echo json_encode($elmt); exit;
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
        	$model = new ImagerieModel();
        	 
        	/* Création */
        	if(isset($data['create']) && empty($data['ident'])) {
		    	$result = $model->create($data['cod_prd'], $_FILES['lnk_prd']);
        	}
        	
        	/* Suppression */
        	if(isset($data['supp']) && !empty($data['ident'])) {
        		//$result = $model->delete($data['ident']);
        	}
        	
        	if(isset($result)) {
        		if (FALSE == $result) {
	        		$errMessages[] = $errors->find('ERR-005');
	        	} else {
	        		$validMessages[] = $errors->find('MSG-002');
	        		Url::redirect("/gestionImagerie");
	        	}
        	}
        	
        	$this->view->errMessages = $errMessages;
        	$this->view->validMessages = $validMessages;
        	
        }
    }
}