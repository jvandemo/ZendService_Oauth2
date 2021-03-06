# HTTP Client

ZendService Oauth2 contains it's own HTTP client and HTTP client interface to allow you 
to write your own custom HTTP client and provide a mock client for testing.

### Default HTTP client

If no HTTP client is set explicitly, ZendService Oauth2 will delegate all HTTP requests
to Zend\Http\ClientStatic.

### Custom HTTP client

To use your own custom HTTP client, create a new class that implements
`ZendService\Oauth2\Http\Client\ClientInterface` and let the Oauth2 client use it:

```
$client = new \ZendService\Oauth2\Client\Client;
$client->setHttpClient(new YourCustomHttpClient());
```

