<?php 

class Layout
{
    /**
     * @var string
     */
    private $file;
    
    /**
     * @var View
     */
    private $view;
    
    /**
     * @var Request
     */
    private $request;
    
    /**
     * @var string
     */
    private $content;
    
    public function __construct(View $view)
    {
        $this->file = LAYOUT_PATH . DS . 'layout.phtml';
        $this->view = $view;
    }
    
    public function render()
    {
        $this->content = $this->view->render();
        
        $this->request = new Request;
        ob_start();
	    require $this->file;
        return ob_get_clean();
    }

    /**
     * Fonction qui permet d'afficher class="active" ou active sur le lien actif
     * @param string $url Nom du fichier ciblé par le lien
     * @param boolean optionnal $opt Retourne ou non 'class=""' dans la chaine générée
     * @return string Chaine vide si lien inactif, class="active" ou active si lien actif
     */
    public function isActive($page, $opt = false)
    {
        if ($page == $this->view->getRoute()) {
            if($opt) {
                return 'active';
            }
            return 'class="active"';
        }
        return '';
    }
}