<?php 

/**
 * Objet Response
 * Represente la reponse HTTP qui sera renvoyee par le serveur HTTP au clien a la fin de l'execution
 * 
 * @category IP_lib
 * @version 0.0.1
 *
 */
class Response
{
    /**
     * Code de retour : statut HTTP
     * @var int
     */
    private $httpResponseCode = 200;
    
    /**
     * Entetes HTTP
     * @var array
     */
    private $headers = array();
    
    /**
     * Corps HTML de la page
     * @var string
     */
    private $body;
    
    /**
     * Tableau de correspondance Code HTTP / Message
     * @var array
     */
    private static $httpCodes = array(
    	200 => 'OK',
        301 => 'Moved Permanently',
        302 => 'Found',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal Server Error'
    );

    /**
     * @return the $httpResponseCode
     */
    public function send()
    {
        header("HTTP/1.1 {$this->httpResponseCode} " . self::$httpCodes[$this->httpResponseCode]);
        foreach($this->headers as $header) {
            header($header);
        }
        echo $this->body;
    }
    
    public function getHttpResponseCode()
    {
        return $this->httpResponseCode;
    }

	/**
     * @param number $httpResponseCode
     */
    public function setHttpResponseCode($httpResponseCode)
    {
        $this->httpResponseCode = $httpResponseCode;
    }

	/**
     * @return the $headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

	/**
     * @param multitype: $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }
    
    /**
     * @param string: $header
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

	/**
     * @return the $body
     */
    public function getBody()
    {
        return $this->body;
    }

	/**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
    
	/**
     * @return the $httpCodes
     */
    public static function getHttpCodes()
    {
        return self::$httpCodes;
    }

}