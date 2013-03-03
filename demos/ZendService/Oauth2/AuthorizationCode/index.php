<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendService_Oauth2
 */

include_once '../Autoload/_autoload.php';

// Include local config file
if (is_readable('config.local.php')) {
    $config = include 'config.local.php';
} else {
    $config = include 'config.local.php.dist';
}

use ZendService\Oauth2\Client\Client as Client;

$code = (isset($_GET['code'])) ? $_GET['code'] : null;

?>


<!DOCTYPE html>
<html>
  
    <head lang="en">
        <meta charset="utf-8">
        <title>ZendService Oauth2 demo page</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    </head>
  
    <body>
    
        <div class="container">
            <div class="row">
                <div class="span12">
                
                    <div class="page-header">
                        <h1>ZendService_Oauth2 <small>demo page</small></h1>
                    </div>
            
                    <?php
                    try{
                    ?>
                        <?php
                        $client = new Client($config);
                        $httpClient = new \ZendService\Oauth2\Http\Client\Client();
                        ?>
                            
                        <h4>Step 1: redirect user to Linkedin authorization page</h4>
                        <p><a class="btn" href="<?php echo $client->getAuthorizationRequestUrl(); ?>">Click to start authorization</a></p>
                        
                        <pre>ZendService_Oauth2 can build the authorization request url for you:<br><br><?php echo $client->getAuthorizationRequestUrl(); ?></pre>
                        
                        <?php if($code){ ?>
                        <h4>Step 2: Grab access token from authorization response</h4>
                        <pre>Code received: <?php echo $code ?></pre>
                        
                        <h4>Step 3: Get access token</h4>
                        <pre>ZendService_Oauth2 returned the following access token object:<br><br><?php var_dump($client->getAccessToken(array('code' => $code))) ?></pre>
                        <p><a class="btn" href="index.php">Start again</a></p>
                        <p><i class="icon-info-sign"></i>Refreshing the page will trigger an exception since the original authorization code expires once an access token is returned by Linkedin</p>
                        <?php } ?>
                        
                    <?php
                    } catch(\Exception $e) {
                    ?>
                    <h4>Exception</h4>
                    <pre><?php var_dump($e) ?></pre>
                    <?php
                    }
                    ?>
            
                </div>
            </div>
        </div>
        
    </body>

</html>





