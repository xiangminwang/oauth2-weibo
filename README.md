# OAuth2-Weibo
Weibo provider for league/oauth2-client

## Installation
```
composer require xiangminwang/oauth2-weibo
```

## Usage
```
$provider = new XiangminWang\OAuth2\Client\Provider\Weibo([
    'clientId' => '1104233555', // fill your "App Key"
    'clientSecret' => '978N7tmeH7TMQsKy', // fill your "App Sercet"
    'redirectUri' => 'http://example.com/oauth-endpoint',
]);
```

## TODO

- [x] Beta version
- [ ] Unit tests
- [ ] Full feature support
