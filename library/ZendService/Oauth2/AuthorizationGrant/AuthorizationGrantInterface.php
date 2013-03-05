<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendService_Oauth2
 * @link      http://tools.ietf.org/html/draft-ietf-oauth-v2-31 Oauth 2.0 draft
 */
namespace ZendService\Oauth2\AuthorizationGrant;

/**
 *
 * @category Zend
 * @package ZendService_Oauth2
 * @subpackage AuthorizationGrant
 */
interface AuthorizationGrantInterface
{

    /**
     * Get URL for authorization request
     *
     * @param array $data
     *            Associative array with data to add to query parameters
     * @return string Authorization request URL
     */
    public function getAuthorizationRequestUrl ($data);

    /**
     * Get access token
     *
     * @param \ZendService\Oauth2\Http\Client\ClientInterface $httpClient
     *            Http client to delegate request to
     * @return \ZendService\Oauth2\AccessToken\AccessTokenInterface
     */
    public function getAccessToken ($httpClient);

    /**
     * Get refresh token
     *
     * @param \ZendService\Oauth2\Http\Client\ClientInterface $httpClient
     *            Http client to delegate request to
     * @return \ZendService\Oauth2\RefreshToken\RefreshTokenInterface
     */
    public function getRefreshToken ($httpClient);

    /**
     * Perform GET request
     *
     * @param \ZendService\Oauth2\Http\Client\ClientInterface $httpClient
     *            Http client to delegate request to
     * @param string $url            
     * @param array $query            
     * @param array $headers            
     * @param string $body            
     *
     * @return mixed Response
     */
    public function get ($httpClient, $url, $query = array(), $headers = array(), $body = null);

    /**
     * Perform POST request
     *
     * @param \ZendService\Oauth2\Http\Client\ClientInterface $httpClient
     *            Http client to delegate request to
     * @param string $url            
     * @param array $params            
     * @param array $headers            
     * @param string $body            
     *
     * @return mixed Response
     */
    public function post ($httpClient, $url, $params, $headers = array(), $body = null);
}
