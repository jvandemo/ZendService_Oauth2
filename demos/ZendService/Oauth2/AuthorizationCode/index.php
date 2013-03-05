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

class LinkedinUri extends \Zend\Uri\Http
{

    const CHAR_UNRESERVED = 'a-zA-Z0-9_\-\.~\(\)';

    public static function encodePath ($path)
    {
        return $path;
    }
}

?>


<!DOCTYPE html>
<html>

<head lang="en">
<meta charset="utf-8">
<meta name="author" content="Jurgen Van de Moere">
<title>ZendService Oauth2 demo page</title>
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="span12">

                <div class="page-header">
                    <h1>
                        ZendService_Oauth2 <small>demo page</small>
                    </h1>
                </div>

                <p>ZendService_Oauth2 is a service to provide Oauth2.0 functionality in Zend Framework 2.</p>
                <p>
                    <a class="btn btn-info" href="https://github.com/jvandemo/ZendService_Oauth2">View complete source on GitHub</a>
                </p>
                <br>

                <div class="alert">
                    <i class="icon-info-sign"></i> Do not refresh this page. It will trigger an exception since the original authorization code expires once an access token is returned by Linkedin. Just click the "Start demo" button to start over and over again...
                </div>

                <div class="alert">
                    <i class="icon-info-sign"></i> Since I constantly alter this page to test the Oauth2 client, it's not uncommon to see strange behaviour if you visit this page while I'm working on it. Ideally, you should download this page from the
                    <a href="https://github.com/jvandemo/ZendService_Oauth2">GitHub repository</a>
                    and create your own demo page...
                </div>
                                
                    <?php
                    try {
                        ?>
                        <?php
                        $client = new Client($config);
                        $httpClient = new \ZendService\Oauth2\Http\Client\Client();
                        ?>
                            
                        <h4>Step 1: redirect user to Linkedin authorization page</h4>
                <p>
                    <a class="btn btn-success" href="<?php echo $client->getAuthorizationRequestUrl(); ?>">Start demo: connect with Linkedin</a>
                </p>
                <p>ZendService_Oauth2 can build the authorization request url for you:</p>

                <pre><?php echo $client->getAuthorizationRequestUrl(); ?></pre>
                        
                        <?php if($code){ ?>
                        
                        <h4>Step 2: Grab access token from authorization response</h4>
                <p>The following authorization code was returned:</p>

                <pre>Code received: <?php echo $code ?></pre>
                        
                        <?php $accessToken = $client->getAccessToken(array('code' => $code)); ?>
                        
                        <h4>Step 3: Get access token</h4>
                <p>ZendService_Oauth2 returned the following access token object:</p>

                <pre><?php var_dump($accessToken) ?></pre>

                <h4>Step 4: Perform get request</h4>
                <pre><?php echo $accessToken->getAccessToken() ?></pre>
                        
                <?php
                            // Get new client after getAccessToken to avoid 401 error
                            // Subsequent get and post requests can use the same client
                            $client = new Client($config);
                            $fields = array(
                                'id',
                                'first-name',
                                'last-name'
                            );
                            $fieldsString = '';
                            if (count($fields) > 0) {
                                $fieldsString = ':(' . implode(',', $fields) . ')';
                            }
                            $url = 'https://api.linkedin.com/v1/people/~' . $fieldsString;
                            
                            // Build custom Linkedin URI that doesn't escape the parentheses
                            $uri = new LinkedinUri($url);
                            
                            $response = $client->get($uri, array(
                                'oauth2_access_token' => $accessToken->getAccessToken(),
                                'format' => 'json'
                            ));
                            ?>
                
                <pre><?php echo $response->getBody() ?></pre>

                <p>
                    <a class="btn" href="index.php">Start again</a>
                </p>
                        
                        <?php } ?>
                        
                    <?php
                    } catch (\Exception $e) {
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





