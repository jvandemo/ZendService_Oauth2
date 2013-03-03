<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendService_Oauth2
 * @link      http://tools.ietf.org/html/draft-ietf-oauth-v2-31 Oauth 2.0 draft
 *
 * Default implementation of HTTP client used to perform the HTTP requests
 *
 * Delegates to Zend\Http\Client
 *
 */

namespace ZendService\Oauth2\Http\Client;


use Zend\Http\Client as ZendHttpClient;
use Zend\Http\Request as ZendHttpRequest;
use ZendService\Oauth2\Http\Client\ClientInterface;
use ZendService\Oauth2\Http\Exception\Exception;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage Http
 */
class Client implements ClientInterface
{
    
    /**
     * Placeholder for Zend Http client
     * @var Zend\Http\ClientStatic
     */
    protected $_zendHttpClient = null;
    
    /**
     * Placeholder for options that are passed to the constructor
     *
     * These options are passed to the http client constructor
     *
     * @var mixed
     */
    protected $_options = null;
    
    /**
     * Constructor
     *
     * @param mixed $options Options that need to be passed to authorization grant
     */
    public function __construct($options = array())
    {
        $this->_options = $options;
    }
    
    /**
     * Get zend HTTP client
     *
     * @return \ZendService\Oauth2\Http\Zend\Http\ClientStatic
     */
    protected function _getZendHttpClient()
    {
        if(null === $this->_zendHttpClient) {
            $this->_zendHttpClient = new ZendHttpClient(null, $this->_options);
        }
        return $this->_zendHttpClient;
    }
    
    /**
     * (non-PHPdoc)
     * @see \ZendService\Oauth2\Http\ClientInterface::get()
     */
    public function get($url, $query = array(), $headers = array(), $body = null)
    {
        
        // Handle invalid URL
        if (empty($url)) {
            return false;
        }

        // Build request
        $request= new ZendHttpRequest();
        $request->setUri($url);
        $request->setMethod(ZendHttpRequest::METHOD_GET);

        if (!empty($query) && is_array($query)) {
            $request->getQuery()->fromArray($query);
        }

        if (!empty($headers) && is_array($headers)) {
            $request->getHeaders()->addHeaders($headers);
        }

        if (!empty($body)) {
            $request->setBody($body);
        }

        return $this->_getZendHttpClient()->send($request);
    }
    
    /**
     * (non-PHPdoc)
     * @see \ZendService\Oauth2\Http\ClientInterface::post()
     */
    public function post($url, $params, $headers = array(), $body = null)
    {

        // Handle invalid URL
        if (empty($url)) {
            return false;
        }

        // Build request
        $request= new ZendHttpRequest();
        $request->setUri($url);
        $request->setMethod(ZendHttpRequest::METHOD_POST);

        if (!empty($params) && is_array($params)) {
            $request->getPost()->fromArray($params);
        } else {
            throw new Exception('The array of post parameters is empty');
        }

        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type']= ZendHttpClient::ENC_URLENCODED;
        }

        if (!empty($headers) && is_array($headers)) {
            $request->getHeaders()->addHeaders($headers);
        }

        if (!empty($body)) {
            $request->setContent($body);
        }

        return $this->_getZendHttpClient()->send($request);
    }
}
