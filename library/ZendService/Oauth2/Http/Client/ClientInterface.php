<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendService_Oauth2
 */

namespace ZendService\Oauth2\Http;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 */
interface ClientInterface
{
    
    /**
     * HTTP GET METHOD (static)
     *
     * @param  string $url
     * @param  array $query
     * @param  array $headers
     * @param  mixed $body
     * @return Response|bool
     */
    public function get($url, $query = array(), $headers = array(), $body = null);
    
    /**
     * HTTP POST METHOD (static)
     *
     * @param  string $url
     * @param  array $params
     * @param  array $headers
     * @param  mixed $body
     * @throws Exception\InvalidArgumentException
     * @return Response|bool
     */
    public function post($url, $params, $headers = array(), $body = null);
    
}
