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
 */
namespace ZendService\Oauth2\AccessToken;

use Zend\Json\Json;
use ZendService\Oauth2\AccessToken\AccessTokenInterface;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage AccessToken
 */
class AccessToken implements AccessTokenInterface
{

    /**
     * Access token
     *
     * @var string
     */
    protected $_accessToken = '';

    /**
     * Token type
     *
     * @var string
     */
    protected $_tokenType = '';

    /**
     * Expires in (seconds)
     *
     * @var int
     */
    protected $_expiresIn = 0;

    /**
     * Refresh token
     *
     * @var string
     */
    protected $_refreshToken = '';

    /**
     * Scope
     *
     * @var string
     */
    protected $_scope = '';

    /**
     * Constructor
     *
     * @param string|array $data String with json or array
     */
    public function __construct($data = null)
    {
        
        // Try to fill object from passed data if possible
        if (is_array($data)) {
            $this->fromArray($data);
        } elseif (is_string($data)) {
            $this->fromJson($data);
        }
    }

    /**
     * Fill access token properties from Json object
     *
     * @param string $json
     * @return self
     */
    public function fromJson($json = '')
    {
        $data = Json::decode($json);
        
        return $this->fromArray($data);
    }

    /**
     * Fill access token properties from array
     *
     * @param array $data
     * @return self
     */
    public function fromArray($data = array())
    {
        
        // Handle invalida data
        if (! is_array($data)) {
            return;
        }
        
        if (array_key_exists('access_token', $data)) {
            $this->setAccessToken($data['access_token']);
        }
        
        if (array_key_exists('token_type', $data)) {
            $this->setTokenType($data['token_type']);
        }
        
        if (array_key_exists('expires_in', $data)) {
            $this->setExpiresIn($data['expires_in']);
        }
        
        if (array_key_exists('refresh_token', $data)) {
            $this->setRefreshToken($data['refresh_token']);
        }
        
        if (array_key_exists('scope', $data)) {
            $this->setScope($data['scope']);
        }
        
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->_accessToken;
    }

    /**
     * @param string $accessToken
     * @return self
     */
    public function setAccessToken($accessToken)
    {
        $this->_accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType()
    {
        return $this->_tokenType;
    }

    /**
     * @param string $tokenType
     * @return self
     */
    public function setTokenType($tokenType)
    {
        $this->_tokenType = $tokenType;
        return $this;
    }

    /**
     * @return number
     */
    public function getExpiresIn()
    {
        return $this->_expiresIn;
    }

    /**
     * @param number $expiresIn
     * @return self
     */
    public function setExpiresIn($expiresIn)
    {
        $this->_expiresIn = $expiresIn;
        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->_refreshToken;
    }

    /**
     * @param string $refreshToken
     * @return self
     */
    public function setRefreshToken($refreshToken)
    {
        $this->_refreshToken = $refreshToken;
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
}
