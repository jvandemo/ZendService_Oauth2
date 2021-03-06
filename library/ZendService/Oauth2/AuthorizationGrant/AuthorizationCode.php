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

use ZendService\Oauth2\AuthorizationGrant\AbstractAuthorizationGrant;
use ZendService\Oauth2\AuthorizationGrant\Exception\Exception;
use ZendService\Oauth2\Http\Client\ClientInterface as HttpClientInterface;

/**
 *
 * @category Zend
 * @package ZendService_Oauth2
 * @subpackage AuthorizationGrant
 */
class AuthorizationCode extends AbstractAuthorizationGrant
{

    /**
     * Client ID
     *
     * @var string
     */
    protected $_clientId = '';

    /**
     * Client secret
     *
     * @var string
     */
    protected $_clientSecret = '';

    /**
     * Response type
     *
     * @var string
     */
    protected $_responseType = 'code';

    /**
     * Grant type
     *
     * @var string
     */
    protected $_type = 'authorization_code';

    /**
     * Authorization URL
     *
     * URL of authorization endpoint
     *
     * @var string
     */
    protected $_authorizationUrl = '';

    /**
     * Authorization code
     *
     * Code received in response from authorization url
     * and necessary to request access token
     *
     * @var string
     */
    protected $_authorizationCode = '';

    /**
     * Access token URL
     *
     * URL of access token endpoint
     *
     * @var string
     */
    protected $_accessTokenUrl = '';

    /**
     * Request token URL
     *
     * URL of request token endpoint
     *
     * @var string
     */
    protected $_requestTokenUrl = '';

    /**
     * Redirect URL
     *
     * @var string
     */
    protected $_redirectUri = '';

    /**
     * Scope
     *
     * @var string
     */
    protected $_scope = '';

    /**
     * State
     *
     * @var string
     */
    protected $_state = '';

    /**
     *
     * @return string
     */
    public function getClientId ()
    {
        return $this->_clientId;
    }

    /**
     *
     * @param string $clientId
     * @return self
     */
    public function setClientId ($clientId)
    {
        $this->_clientId = $clientId;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getClientSecret ()
    {
        return $this->_clientSecret;
    }

    /**
     *
     * @param string $clientSecret
     * @return self
     */
    public function setClientSecret ($clientSecret)
    {
        $this->_clientSecret = $clientSecret;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getResponseType ()
    {
        return $this->_responseType;
    }

    /**
     *
     * @param string $responseType
     * @return self
     */
    public function setResponseType ($responseType)
    {
        $this->_responseType = $responseType;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getType ()
    {
        return $this->_type;
    }

    /**
     *
     * @param string $type
     * @return self
     */
    public function setType ($type)
    {
        $this->_type = $type;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAccessTokenUrl ()
    {
        return $this->_accessTokenUrl;
    }

    /**
     *
     * @param string $accessTokenUrl
     * @return self
     */
    public function setAccessTokenUrl ($accessTokenUrl)
    {
        $this->_accessTokenUrl = $accessTokenUrl;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getRequestTokenUrl ()
    {
        return $this->_requestTokenUrl;
    }

    /**
     *
     * @param string $requestTokenUrl
     * @return self
     */
    public function setRequestTokenUrl ($requestTokenUrl)
    {
        $this->_requestTokenUrl = $requestTokenUrl;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAuthorizationUrl ()
    {
        return $this->_authorizationUrl;
    }

    /**
     *
     * @param string $authorizationUrl
     * @return self
     */
    public function setAuthorizationUrl ($authorizationUrl)
    {
        $this->_authorizationUrl = $authorizationUrl;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAuthorizationCode ()
    {
        return $this->_authorizationCode;
    }

    /**
     *
     * @param string $authorizationCode
     * @return self
     */
    public function setAuthorizationCode ($authorizationCode)
    {
        $this->_authorizationCode = $authorizationCode;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getRedirectUri ()
    {
        return $this->_redirectUri;
    }

    /**
     *
     * @param string $redirectUri
     * @return self
     */
    public function setRedirectUri ($redirectUri)
    {
        $this->_redirectUri = $redirectUri;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getScope ()
    {
        return $this->_scope;
    }

    /**
     *
     * @param string $scope
     * @return self
     */
    public function setScope ($scope)
    {
        $this->_scope = $scope;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getState ()
    {
        return $this->_state;
    }

    /**
     *
     * @param string $state
     * @return self
     */
    public function setState ($state)
    {
        $this->_state = $state;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface::getAuthorizationUrl()
     */
    public function getAuthorizationRequestUrl ($data = array())
    {
        $queryData = array(
            'response_type' => $this->getResponseType(),
            'client_id' => $this->getClientId(),
            'redirect_uri' => $this->getRedirectUri(),
            'scope' => $this->getScope(),
            'state' => $this->getState()
        );
        
        if (is_array($data)) {
            $queryData = array_merge($queryData, $data);
        }
        
        return $this->getAuthorizationUrl() . '?' . http_build_query($queryData);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface::getAccessToken()
     */
    public function getAccessToken ($httpClient = null, $data = array())
    {
        
        // Handle invalid http client
        if (! $httpClient instanceof HttpClientInterface) {
            throw new Exception('Invalid Http client');
        }
        
        $accessTokenUrl = $this->getAccessTokenUrl();
        
        // Handle invalid access token url
        if (empty($accessTokenUrl)) {
            throw new Exception('Access token URL is not specified');
        }
        
        // Handle invalid code
        if (! array_key_exists('code', $data)) {
            throw new Exception('Please specify the authorization code in the data array');
        }
        
        $postData = array(
            'grant_type' => $this->getType(),
            'redirect_uri' => $this->getRedirectUri(),
            'client_id' => $this->getClientId(),
            'client_secret' => $this->getClientSecret()
        );
        
        // Merge code in postData
        if (is_array($data)) {
            $postData = array_merge($postData, $data);
        }
        
        return $httpClient->post($accessTokenUrl, $postData);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface::getRefreshToken()
     */
    public function getRefreshToken ($httpClient = null, $data = array())
    {
        
        // Handle invalid http client
        if (! $httpClient instanceof HttpClientInterface) {
            throw new Exception('Invalid Http client');
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface::get()
     */
    public function get ($httpClient, $url, $query = array(), $headers = array(), $body = null)
    {
        // Handle invalid http client
        if (! $httpClient instanceof HttpClientInterface) {
            throw new Exception('Invalid Http client');
        }
        
        return $httpClient->get($url, $query, $headers, $body);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface::post()
     */
    public function post ($httpClient, $url, $params, $headers = array(), $body = null)
    {
        // Handle invalid http client
        if (! $httpClient instanceof HttpClientInterface) {
            throw new Exception('Invalid Http client');
        }
        
        return $httpClient->post($url, $params, $headers, $body);
    }
}
