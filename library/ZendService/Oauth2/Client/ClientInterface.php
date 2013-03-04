<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendService_Oauth2
 */

namespace ZendService\Oauth2\Client;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 */
interface ClientInterface
{
    /**
     * Get authorization grant
     *
     * @return \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface
     */
    public function getAuthorizationGrant();
    
    /**
     * Set authorization grant
     *
     * @param \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface $_authorizationGrant
     * @return self
     */
    public function setAuthorizationGrant($authorizationGrant);
    
    /**
     * Get HTTP client
     *
     * @return \Zend\Http\Client
     */
    public function getHttpClient();
    
    /**
     * Set HTTP client
     *
     * @param \Zend\Http\Client $httpClient
     * @return self
     */
    public function setHttpClient($httpClient);
    
    /**
     * Get access token
     *
     * Convenience function that delegates to authoration grant
     *
     * @return \ZendService\Oauth2\AccessToken\AccessTokenInterface
     */
    public function getAccessToken($data = array(), $forceReload = false);
    
    /**
     * Set access token
     *
     * @param \ZendService\Oauth2\AccessToken\AccessTokenInterface $accessToken
     * @return self
     */
    public function setAccessToken($accessToken);
    
}
