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
 * Zend Framework 2 Oauth 2.0 client class that delegates actions to an
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

use ZendService\Oauth2\AccessToken\AccessToken;
use ZendService\Oauth2\Client\AbstractClient;
use ZendService\Oauth2\Client\Exception\Exception;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage Client
 */
class Client extends AbstractClient
{

    /**
     * Get access token
     *
     * Overrides the default abstract function to implement specific
     * ZF2 behaviour
     *
     * (non-PHPdoc)
     * @see \ZendService\Oauth2\Client\AbstractClient::getAccessToken()
     */
    public function getAccessToken($data = array(), $forceReload = false)
    {
        if ((null === $this->_accessToken) || $forceReload) {
            
            // Send http request
            $response = $this->getAuthorizationGrant()->getAccessToken(
                    $this->getHttpClient(),
                    $data);
            
            // Handle invalid response
            if (! $response->isSuccess()) {
                throw new Exception(
                        'Request for access token failed: ' .
                                 $response->renderStatusLine());
            }
            
            // Create and set new access token
            $json = $response->getBody();
            $this->_accessToken = new AccessToken($json);
        }
        
        return $this->_accessToken;
    }
}
