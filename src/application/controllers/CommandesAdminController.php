<?php

/**
 * Controller Commandes en cours -> admin
 * @author Alexandra Habchi
 *
 */
class CommandesAdminController extends Controller
{
    public function action()
    {
        $this->view->user = $this->request->getSession()->getNamespace('user');

        $commandeModel = new LigneCommandeModel;
        $commandes = $commandeModel->findByStatut('1');

        $produit = array();
        $i = 0;
        
        if($this->request->getMethod() == 'GET') {
            $data = $this->request->getParams();
            
        }
    }

    private function triProduits($array)
    {
        $newArray[] = $array[$i];
        while($array[$i]['cod_prd'] == $array[$i+1]['cod_prd']) {
            $newArray[] = $array[$i]; $i++;
        }
        echo $i;
        var_dump($newArray); exit;
    }
}