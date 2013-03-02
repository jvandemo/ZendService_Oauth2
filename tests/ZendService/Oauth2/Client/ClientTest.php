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

use ZendService\Oauth2\Client\Client;
use ZendService\Oauth2\AuthorizationGrant\AuthorizationCode;

/**
 * @category   Zend
 * @package    ZendService_Oauth2
 * @subpackage Client
 * @group      ZendService
 * @group      ZendService_Oauth2
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The client object instance
     *
     * @var \ZendService\Oauth2\Client\Client
     */
    protected $_client = null;

    /**
     * Enter description here...
     *
     * @return \ZendService\Oauth2\Client\Client
     */
    public function getClient()
    {
        if(null === $this->_client) {
            $this->_client = new Client();
        }
        return $this->_client;
    }

    public function setUp()
    {
    }

    public function tearDown()
    {
    }
    
    public function testGetClient()
    {
        $this->assertNotNull($this->getClient());
    }
    
    public function testAuthorizationGrantIsAuthorizationCodeByDefault()
    {
        $this->assertTrue($this->getClient()->getAuthorizationGrant() instanceof AuthorizationCode);
    }
    
}