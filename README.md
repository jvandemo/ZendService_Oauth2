ZendService_Oauth2
==================

Oauth2 service for Zend Framework 2

### Status

Currently under development so please don't use in production environments yet...

### To do

- Write more and better documentation
- Provide more unit tests

### Composer

ZendService_Oauth2 is now available as composer package on https://packagist.org/packages/jvandemo/zendservice-oauth2

To include it in your project, add the following line to your `composer.json`:

```
"require": {
	"jvandemo/zendservice-oauth2" : "dev-master"
}
```

### Live demo

There is a live demo available at http://jvandemo.my.phpcloud.com/ZendService_Oauth2/demos/ZendService/Oauth2/AuthorizationCode/index.php

The source of the demo page is included in the `demos` folder.

### A quick demo

```
use ZendService\Oauth2\Client\Client;

// Create configuration
$config = array(

    // Oauth2 client options
    'client' => array(
        'client_id' => 'your_client_id',
	    'client_secret' => 'your_client_secret',
	    'authorization_url' => 'https://api.youwishtoconnect.to/authorize',
	    'access_token_url' => 'https://api.youwishtoconnect.to/access_token',
	    'redirect_uri' => 'http://www.yourwebsite.com/where_to_go_after_authorization',
	    'state' => 'somerandomstate',
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

// Create a new Oauth2.0 client and pass in the config
$client = new Client($config);

// Let the client build the authorization request for you:
$url = $client->getAuthorizationRequestUrl()

// Redirect the user to the authorization request url:
return $this->redirect()->toUrl($url);
```

The third party authorization server will redirect you to the url you specified in `redirect_uri`:

```
// Grab the access token from the authorization response:
$code = $_GET['code'];

// Use the authorization code to get an access token: 
$accessToken = $client->getAccessToken(array(
	'code' => $code
));
```

The access token is a very lightweight object that can be stored in a session or serialized in your backend system for later use, so you don't have to repeat the previous steps if not necessary.

Then, whenever you need to perform an Oauth2.0 request: 

```
// Create a client
$client = new Client($config);

// Get the token from your backend e.g. with unserialize
$accessToken = getAccessTokenFromYourBackend(); // Replace with your custom function

and perform GET requests
$response = $client->get('http://api.youwishtoconnect.to/some_endpoint', array('access_token', $accessToken->getAccessToken()));

// or POST requests
$response = $client->post('http://api.youwishtoconnect.to/some_endpoint', array('access_token', $accessToken->getAccessToken()));

// Some third parties e.g. Linkedin requires the token to be passed as `oauth2_access_token` parameter, so you can easily change it as required
$response = $client->get('http://api.youwishtoconnect.to/some_endpoint', array('oauth2_access_token', $accessToken->getAccessToken()));
```

By default, the `Zend\Http\Client` is used to perform the requests, so you get a 'Zend\Http\Response' obejct:

```
// Print the response body
echo $response->getBody()
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
