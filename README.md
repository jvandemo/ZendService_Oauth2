ZendService_Oauth2
==================

Oauth2 service for Zend Framework 2

### Status

Currently under development so please don't use in production environments yet...

### Code sample

```
use ZendService\Oauth2\Client\Client;

$config = array(
    'client_id' => 'your_client_id',
    'client_secret' => 'your_client_secret',
    'authorization_url' => 'https://api.youwishtoconnect.to/authorize',
    'access_token_url' => 'https://api.youwishtoconnect.to/access_token',
    'redirect_uri' => 'http://www.yourwebsite.com/where_to_go_after_authorization'
);

// Create client
$client = new Client($config);

$url = $client->getAuthorizationRequestUrl()

```