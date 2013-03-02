<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_View
 * @link      http://tools.ietf.org/html/draft-ietf-oauth-v2-31 Oauth 2.0 draft
 *
 * HTTP client used to perform the HTTP requests
 *
 * Delegates to Zend\Http\ClientStatic
 *
 */

namespace ZendService\Oauth2\Http\Client;

use ZendService\Oauth2\Http\ClientInterface;
use Zend\Http\ClientStatic;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage Http
 */
class Client implements ClientInterface
{
    
    /**
     * Placeholder for static HTTP client
     * @var Zend\Http\ClientStatic
     */
    protected $_clientStatic = null;
    
    /**
     * Get static HTTP client
     *
     * @return \ZendService\Oauth2\Http\Zend\Http\ClientStatic
     */
    public function getClientStatic()
    {
        if(null === $this->_clientStatic) {
            $this->_clientStatic = new ClientStatic();
        }
        return $this->_clientStatic;
    }
    
    /**
     * Set static HTTP client
     *
     * @param Zend\Http\ClientStatic $clientStatic
     * @return self
     */
    public function setClientStatic($clientStatic)
    {
        if($clientStatic instanceof ClientStatic) {
            $this->_clientStatic = $clientStatic;
        }
        return $this;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ZendService\Oauth2\Http\ClientInterface::get()
     */
    public function get($url, $query = array(), $headers = array(), $body = null)
    {
        
        // Delegate to static HTTP client
        return $this->getClientStatic()->get($url, $query, $headers, $body);
    }
    
    /**
     * (non-PHPdoc)
     * @see \ZendService\Oauth2\Http\ClientInterface::post()
     */
    public function post($url, $params, $headers = array(), $body = null)
    {
        
        // Delegate to static HTTP client
        return $this->getClientStatic()->post($url, $params, $headers, $body);
    }
}
