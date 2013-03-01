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
 * General Oauth 2.0 client class that delegates actions to an
 * authorization grant.
 *
 * An authorization grant represents an authorization flow and contains
 * custom behavior depending on the authorization grant type.
 *
 * If no authorization grant is set, the client will default to an authorization code
 * grant since it is most commonly used.
 *
 * Uses the Zend\Http\Client for handling HTTP requests.
 */
namespace ZendService\Oauth2\Client;

use Zend\Http\Client as HttpClient;
use ZendService\Oauth2\AuthorizationGrant\AuthorizationCode;
use ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface;
use ZendService\Oauth2\Client\ClientInterface;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage Client
 */
class AbstractClient implements ClientInterface
{

    /**
     * Convenience placeholder for options that are passed to the constructor
     *
     * These options are passed to the authorizationGrant when it is instantiated
     *
     * No getter or setter defined because it should not be publicly available
     *
     * @var mixed
     */
    protected $_options = null;

    /**
     * Oauth2.0 authorization grant
     *
     * @var \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface
     */
    protected $_authorizationGrant = null;

    /**
     * HTTP client placeholder
     *
     * @var \Zend\Http\Client
     */
    protected $_httpClient = null;

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
     * Get authorization grant
     *
     * @return \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface
     */
    public function getAuthorizationGrant()
    {
        if (null === $this->_authorizationGrant) {
            $this->_authorizationGrant = new AuthorizationCode($this->_options);
        }
        return $this->_authorizationGrant;
    }

    /**
     * Set authorization grant
     *
     * @param \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface $_authorizationGrant
     * @return self
     */
    public function setAuthorizationGrant($authorizationGrant)
    {
        if ($authorizationGrant instanceof AuthorizationGrantInterface) {
            $this->_authorizationGrant = $authorizationGrant;
        }
        return $this;
    }

    /**
     * Get HTTP client
     *
     * @return \Zend\Http\Client
     */
    public function getHttpClient()
    {
        return $this->_httpClient;
    }

    /**
     * Set HTTP client
     *
     * @param \Zend\Http\Client $httpClient
     * @return self
     */
    public function setHttpClient($httpClient)
    {
        if ($httpClient instanceof HttpClient) {
            $this->_httpClient = $httpClient;
        }
        return $this;
    }

    /**
     * Get URL for authorization request
     *
     * Convenience function that delegates to authoration grant
     *
     * @return string Authorization request URL
     */
    public function getAuthorizationRequestUrl()
    {
        return $this->getAuthorizationGrant()->getAuthorizationRequestUrl();
    }

    /**
     * Get access token
     *
     * Convenience function that delegates to authoration grant
     *
     * @return \ZendService\Oauth2\AccessToken\AccessTokenInterface
     */
    public function getAccessToken()
    {
        return $this->getAuthorizationGrant()->getAccessToken();
    }

    /**
     * Get refresh token
     *
     * Convenience function that delegates to authoration grant
     *
     * @return \ZendService\Oauth2\RefreshToken\RefreshTokenInterface
     */
    public function getRefreshToken()
    {
        return $this->getAuthorizationGrant()->getRefreshToken();
    }
}
