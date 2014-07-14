<?php

/**
 * Controller Archives
 * @author Alexandra Habchi
 *
 */
class ArchiveController extends Controller
{
    public function action()
    {
        $this->view->user = $this->request->getSession()->getNamespace('user');
        
        if($this->request->getMethod() == 'GET') {
            $data = $this->request->getParams();
            if(isset($data['id'])) {
                $cmdModel = new CommandeModel;
                $commande = $cmdModel->find($data['id']);
                if(empty($commande)) {
                    $error = new ErrorModel;
                    $this->view->errMessage = $error->find('ERR-006');
                } else {
                    $this->view->commande = $commande;
                    $ligneModel = new LigneCommandeModel();
                    $lignes = $ligneModel->findByCommande($data['id']);
                    
                    foreach($lignes as $ligne) {
                        $prdModel = new ProduitModel();
                        $ligne['produit'] = $prdModel->find($ligne['cod_prd']);
                        $this->view->lignes[] = $ligne;
                    }
                    $archives = new CommandeModel;
                    foreach($archives->findByClient($this->view->user['id']) as $cmd) {
                        if($cmd['statut'] != 0) {
                            $this->view->archives[] = $cmd;
                        }
                    }
                }
            }
        	
        }
    }
}