<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Service
 */
namespace ZendServiceTest\Oauth2\Client;

use ZendService\Oauth2\AuthorizationGrant\AuthorizationCode;

/**
 *
 * @category Zend
 * @package ZendService_Oauth2
 * @subpackage Client
 *             @group ZendService
 *             @group ZendService_Oauth2
 */
class AuthorizationCodeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * The grant object instance
     *
     * @var \ZendService\Oauth2\AuthorizationGrant\AuthorizationCode
     */
    protected $_authorizationCode = null;

    /**
     * Get authorization code
     *
     * @return \ZendService\Oauth2\Client\Client
     */
    public function getAuthorizationCode ()
    {
        if (null === $this->_authorizationCode) {
            $this->_authorizationCode = new AuthorizationCode();
        }
        return $this->_authorizationCode;
    }

    public function setUp ()
    {}

    public function tearDown ()
    {}

    public function testGetAuthorizationCode ()
    {
        $this->assertNotNull($this->getAuthorizationCode());
    }

    public function testGetAuthorizationRequestUrl ()
    {
        $data = array(
            'client_id' => 'clientid',
            'client_secret' => 'clientsecret',
            'authorization_url' => 'authorizationurl',
            'access_token_url' => 'accesstokenurl'
        );
        $authorizationCode = new AuthorizationCode($data);
        
        $expectedQueryData = array(
            'response_type' => 'code',
            'client_id' => $data['client_id'],
            'redirect_uri' => '',
            'scope' => '',
            'state' => ''
        );
        $expectedAuthorizationRequestUrl = 'authorizationurl?' . http_build_query($expectedQueryData);
        
        $this->assertEquals($expectedAuthorizationRequestUrl, $authorizationCode->getAuthorizationRequestUrl());
    }
}