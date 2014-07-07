<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class ModifierClientController extends Controller
{
    public function action()
    {
    	$errMessages = array();
    	$errors = new ErrorModel();
    	
        $this->view->user = $this->request->getSession()->getNamespace('user');
        $id_mofif = $this->request->getSession()->getNamespace('id_modif');
        
        $ideModel = new IdentifiantModel;
        $this->view->user_modif = $ideModel->find($id_mofif);
        
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	if(isset($data['id']) && isset($data['profil']) && isset($data['valider'])) {
        		$result = $ideModel->updateByAdmin($data['profil'], $data['id']);
        		
        		if (FALSE == $result) {
        			$errMessages[] = $errors->find($id);
        		} else {
        			Url::redirect("/gestionClient");
        		}
        	}
        }
    }//
}//