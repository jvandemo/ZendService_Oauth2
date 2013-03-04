ZendService_Oauth2
==================

Oauth2 service for Zend Framework 2

### Status

Currently under development so please don't use in production environments yet...

### To do

- Write more and better documentation
- Implement automatic state generation and persistance
- Provide more unit tests
- Provide sample to use as service in Zend Framework 2

### Composer

ZendService_Oauth2 is now available as composer package on https://packagist.org/packages/jvandemo/zendservice-oauth2

### Live demo

There is a live demo available at http://jvandemo.my.phpcloud.com/ZendService_Oauth2/demos/ZendService/Oauth2/AuthorizationCode/index.php

The source of the demo page is included in the `demos` folder.

### Quick code walkthrough

Start by specifying your private oauth2.0 details in a config array:

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
```

Create a new Oauth2.0 client and pass the config:

```
$client = new Client($config);
```

Let the client build the authorization request for you:

```
$url = $client->getAuthorizationRequestUrl()
```

Redirect the user to the authorization request url:

```
// Sample to redirect from within your controller
return $this->redirect()->toUrl($url);
```

Grab the access token from the authorization response:

```
$code = $_GET['code'];
```

Use the authorization code to get an access token: 

```
$client->getAccessToken(array(
	'code' => $code
));
```

Once you have an access token, you can easily use the client perform GET requests:

```
$response = $client->get('http://api.youwishtoconnect.to/some_endpoint', array('param1', 'value1'));
```

or POST requests:

```
$response = $client->post('http://api.youwishtoconnect.to/some_endpoint', array('param1', 'value1'));
```

### Main features

- Provides a main `ZendService\Oauth2\Client\Client` class to interact with for ease of use
- Works out of the box with the following default configuration:
    + Uses `AuthorizationCode` as the default AuthorizationGrant
    + Uses `Zend\Http\Client` as the default Http client
    + Uses `ZendService\Oauth2\AccessToken\AccessToken` as the default AccessToken object
    + Uses `ZendService\Oauth2\Client\Client` as the default client implementation
- Supports custom client implementation to add or change behaviours
    + Can extend `ZendService\Oauth2\Client\AbstractClient`
    + Must implement `ZendService\Oauth2\Client\ClientInterface`
- Add custom Oauth2.0 flows by adding custom authorization grants:
    + Can extend `ZendService\Oauth2\AuthorizationGrant\AbstractAuthorizationGrant`
    + Must implement `ZendService\Oauth2\AuthorizationGrant\AuthorizationGrantInterface`
- Supports custom Http clients
    + Must implement `ZendService\Oauth2\Http\Client\ClientInterface`

### Suggestions?

Contact me, write a comment or better yet: fork, implement and create a pull request :-)
