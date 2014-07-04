<?php 

/**
 * Objet Router
 * Permet d'analyser une requete HTTP entrante (objet Request)
 * pour determiner la route interne de l'application (controller à appeler)
 * 
 * @category IP_lib
 * @version 0.0.1
 *
 */
class Router
{
    /**
     * @var Request
     */
    private $request;
    
    /**
     * Constructeur
     * @param Request $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }// end of __construct
    
    /**
     * Router de l'application : analyse une URI ($uri) et determine
     * le nom du controller qui devra etre chargé
     */
    public function route()
    {
        $route = $this->getPath();
        /*
         * Regles de routage :
        * - la route correspond au nom du controller 
        */
        if('' == $route) {
            $route = 'home';
        }
        
        if(!file_exists(CONTROLLER_PATH . DS . ucfirst($route) . 'Controller.php')) { 
            $route = 'error'; 
        }
        
        $this->request->setRoute($route);
    }
    
    /**
     * Fonction qui permet de récupérer la valeur 'path' d'une URI
     * @return string $uriPath
     */
    private function getPath()
    {
        $uri = $this->request->getUrl();
        
        $uriPath = parse_url($uri, PHP_URL_PATH);
        // $uriQueryString = parse_url($uri, PHP_URL_QUERY);
        
        $uriPath = strtolower($uriPath);
        
        return $uriPath;
    }
    
}