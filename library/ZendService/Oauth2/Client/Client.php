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
     * Overrides the abstract function to implement specific
     * ZF2 behaviour
     *
     * @param array $data Data that needs to be passed to access token request e.g. code
     * @return \ZendService\Oauth2\AccessToken\AccessTokenInterface
     */
    public function getAccessToken($data = array())
    {
        $response = $this->getAuthorizationGrant()->getAccessToken(
                $this->getHttpClient(),
                $data);
        
        if(! $response->isSuccess()) {
            throw new Exception('Request for access token failed: ' . $response->renderStatusLine());
        }
        
        $json = $response->getBody();
        
        return new AccessToken($json);
    }
    
}
