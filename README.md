ZendService_Oauth2
==================

Oauth2 service for Zend Framework 2

### Status

Currently under development so please don't use in production environments yet...

### Live demo

There is a live demo available at http://jvandemo.my.phpcloud.com/ZendService_Oauth2/demos/ZendService/Oauth2/AuthorizationCode/index.php

The source of the demo page is included in the `demos` folder.

### Code sample

```
use ZendService\Oauth2\Client\Client;

$config = array(

    // Oauth2 client options
    'client' => array(
        'client_id' => 'your_client_id',
	    'client_secret' => 'your_client_secret',
	    'authorization_url' => 'https://api.youwishtoconnect.to/authorize',
	    'access_token_url' => 'https://api.youwishtoconnect.to/access_token',
	    'redirect_uri' => 'http://www.yourwebsite.com/where_to_go_after_authorization'
    ),
    
    // Http client options
    'http' => array(
        'adapter'   => 'Zend\Http\Client\Adapter\Curl',
        'curloptions' => array(
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
        ),
    ),
);

// Create client
$client = new Client($config);

// Get authorization URL
$url = $client->getAuthorizationRequestUrl()

// Redirect to authorization page
...

// Get access token
$client->getAccessToken(array(
	'code' => 'code_your_received_from_authorization_server'
));

// Perform GET request
$response = $client->get('http://api.youwishtoconnect.to/some_endpoint', array('param1', 'value1'));

// Perform POST request
$response = $client->post('http://api.youwishtoconnect.to/some_endpoint', array('param1', 'value1'));
```
