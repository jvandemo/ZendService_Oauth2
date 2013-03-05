<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendService_Oauth2
 *
 * Allows for a custom HTTP client and can be replaced by mock client for testing purposes
 */
namespace ZendService\Oauth2\Http\Client;

/**
 *
 * @category Zend
 * @package ZendService_Oauth2
 * @subpackage Http
 */
interface ClientInterface
{

    /**
     * HTTP GET METHOD (static)
     *
     * @param string|\Zend\Uri\UriInterface $uri            
     * @param array $query            
     * @param array $headers            
     * @param mixed $body            
     * @return Response bool
     */
    public function get ($uri, $query = array(), $headers = array(), $body = null);

    /**
     * HTTP POST METHOD (static)
     *
     * @param string|\Zend\Uri\UriInterface $uri            
     * @param array $params            
     * @param array $headers            
     * @param mixed $body            
     * @throws Exception\InvalidArgumentException
     * @return Response bool
     */
    public function post ($uri, $params, $headers = array(), $body = null);
}
