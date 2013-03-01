<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_View
 * @link      http://tools.ietf.org/html/draft-ietf-oauth-v2-31 Oauth 2.0 draft
 */
namespace ZendService\Oauth2\AuthorizationGrant;

use ZendService\Oauth2\AuthorizationGrant\AbstractAuthorizationGrant;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
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
     * Redirect URI
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
     * @return string
     */
    public function getClientId()
    {
        return $this->_clientId;
    }

	/**
     * @param string $clientId
     * @return self
     */
    public function setClientId($clientId)
    {
        $this->_clientId = $clientId;
        return $this;
    }

	/**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->_clientSecret;
    }

	/**
     * @param string $clientSecret
     * @return self
     */
    public function setClientSecret($clientSecret)
    {
        $this->_clientSecret = $clientSecret;
        return $this;
    }

	/**
     * @return string
     */
    public function getResponse_type()
    {
        return $this->_response_type;
    }

	/**
     * @param string $response_type
     * @return self
     */
    public function setResponse_type($response_type)
    {
        $this->_response_type = $response_type;
        return $this;
    }

	/**
     * @return string
     */
    public function getRedirect_uri()
    {
        return $this->_redirect_uri;
    }

	/**
     * @param string $redirect_uri
     * @return self
     */
    public function setRedirect_uri($redirect_uri)
    {
        $this->_redirect_uri = $redirect_uri;
        return $this;
    }

	/**
     * @return string
     */
    public function getScope()
    {
        return $this->_scope;
    }

	/**
     * @param string $scope
     * @return self
     */
    public function setScope($scope)
    {
        $this->_scope = $scope;
        return $this;
    }

	/**
     * @return string
     */
    public function getState()
    {
        return $this->_state;
    }

	/**
     * @param string $state
     * @return self
     */
    public function setState($state)
    {
        $this->_state = $state;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface::getAuthorizationUri()
     */
    public function getAuthorizationUri()
    {
        
    }
    
    public function getAccessToken()
    {
        
    }
    
    public function getRefreshToken()
    {
        
    }
}
