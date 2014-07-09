<?php

/**
 * Controller Accueil
 * @author Formateur
 *
 */
class ChangePwdController extends Controller
{
    public function action()
    {
    	$this->view->user = $this->request->getSession()->getNamespace('user');
        if($this->request->getMethod() == 'POST'){
        	$data = $this->request->getParams();
        	
        	/* Update mot de passe */
        	if(isset($data['changePwdBtn'])) {
        		$pwdModel = new PasswordModel();
        		$result = $pwdModel->update($this->view->user['id_cli'], $data['password']);
				if($result == true) {
        			Url::redirect('/home');
        		}
        	}
        	
        	/* Plus tard */
        	if(isset($data['later'])) {
        		Url::redirect('/home');
        	}
        }
    }
}