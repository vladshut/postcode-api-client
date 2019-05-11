PostcodeAPIClient
===================

PostcodeAPIClient is a PHP client library for the PostcodeAPI.nu web service. 

* [More information](https://www.postcodeapi.nu)
* [API documentation](https://swaggerhub.com/api/apiwise/postcode-api)

Requirements
------------

PostcodeAPIClient works with PHP 5.5.0 or up. This library depends on the [HTTPPlug](http://httplug.io/), see http://docs.php-http.org/en/latest/httplug/introduction.html.

Installation
------------

PostcodeAPIClient can easily be installed using [Composer](https://getcomposer.org/):

```bash
composer require vladshut/postcode-api-client
```

Usage
-----

Instantiate the client and replace the API key with your personal credentials:

```php
// Use the composer autoloader to load dependencies
require_once 'vendor/autoload.php';

// initiate client
$apiKey = 'replace_with_your_own_api_key';
// In this example we made use of the Guzzle6 as HTTPClient in combination with an HTTPPlug compatible adapter.
$client = new \VS\PostcodeAPI\Client(
    new Http\Adapter\Guzzle6\Client(
        new GuzzleHttp\Client([
            'headers' => [
                'X-Api-Key' => $apiKey
            ]
        ])
    )
);

// call endpoints
$response = $client->getAddresses('5041EB', 21);
$response = $client->getAddress('0855200000061001');
$response = $client->getPostcode('5041EB');

// Note that this call is only available with a premium account
$response = $client->getPostcodes('51.566405', '5.077171');
```

Note that to be able to run the example above you should have ran the following command, to have Guzzle6 and the Adapter available.

```bash
composer require php-http/guzzle6-adapter
```

Within Symfony project
----------------------

We recommend to use [Guzzle](https://github.com/guzzle/guzzle), to be able to use Guzzle in combination with the PostcodeApiClient you should also make use of the
[Guzzle6Adapter](https://github.com/php-http/guzzle6-adapter). By running the following command you automatically install Guzzle aswel.

```bash
composer require php-http/guzzle6-adapter
```

And add the following service definitions:
```yaml
project.http.guzzle.client:
    class: GuzzleHttp\Client
    arguments:
        - { headers: { X-Api-Key: 'replace_with_your_own_api_key' } }

project.http.adapter.guzzle.client:
    class: Http\Adapter\Guzzle6\Client
    arguments:
        - '@project.http.guzzle.client'

project.client.postal_code:
    class: VS\PostcodeAPI\Client
    arguments:
        - '@project.http.adapter.guzzle.client'
```

You should now be able use the `project.client.postal_code` service to make requests to the PostcodeAPI.
