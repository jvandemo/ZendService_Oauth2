<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Service
 */

include_once '../Autoload/_autoload.php';

// Include local config file
$config = include 'config.local.php';

use ZendService\Oauth2\Client\Client as Client;

try{
?>
    <?php
    $client = new Client(array(
        'client_id' => $config['client']['client_id']
    ));
    ?>
    
    <h4>Client</h4>
    <pre>
    <?php var_dump($client) ?>
    </pre>
    
    <h4>Authorization Grant</h4>
    <pre>
    <?php var_dump($client->getAuthorizationGrant()); ?>
    </pre>

<?php
} catch(\Exception $e) {
?>
<h4>Exception</h4>
<pre><?php var_dump($e) ?></pre>
<?php
}
?>