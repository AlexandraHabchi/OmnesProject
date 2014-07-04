<?php

/**
 * Controller global
 * Socle de construction des pages
 * 
 * @category IP_lib
 * @version 0.0.1
 *
 */
abstract class Controller
{
    /**
     * @var Request
     */
    protected $request;
    
    /**
     * @var Response
     */
    protected $response;
    
    /**
     * @var View
     */
    protected $view;
    
    /**
     * @var Layout
     */
    protected $layout;
    
    /**
     * @var Boolean
     */
    protected $disabledLayout = false;
    
    /**
     * Constructeur
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->init();
        $this->switchContext();
        $this->view = new View($this->request->getRoute(), $this->context);
        if($this->disabledLayout === false) {
        	$this->layout = new Layout($this->view);
        }
    }
    
    public function switchContext()
    {
    	$params = $this->request->getParams();
    	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    		$this->setDisabledLayout();
    		$defaultContext = 'ajax';
    	} else {
    		$defaultContext = 'html';
    	}
    	if(isset($params['context']) && !empty($params['context'])) {
    		$this->context = $params['context'];
    	} else {
    		$this->context = $defaultContext;
    	}
    }
    
    /**
	 * @param boolean $disabledLayout
	 */
	public function setDisabledLayout($bool = true) {
		$this->disabledLayout = $bool;
	}

	public function init(){}
    
    abstract public function action();
    
    public function __destruct()
    {
    	if($this->disabledLayout === false) {
    		$viewContent = $this->layout->render();
    	} else {
    		$viewContent = $this->view->render();
    	}
        $this->response->setBody($viewContent);
    }
}