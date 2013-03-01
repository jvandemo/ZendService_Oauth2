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

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage AuthorizationGrant
 */
interface AuthorizationGrantInterface
{
    /**
     * Get URL for authorization request
     *
     * @return string Authorization request URL
     */
    public function getAuthorizationRequestUrl();
    
    /**
     * Get access token
     *
     * @return \ZendService\Oauth2\AccessToken\AccessTokenInterface
     */
    public function getAccessToken();
    
    /**
     * Get refresh token
     *
     * @return \ZendService\Oauth2\RefreshToken\RefreshTokenInterface
     */
    public function getRefreshToken();
}
