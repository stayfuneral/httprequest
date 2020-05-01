# HtttpRequest

Small PHP-SDK library for work with HTTP requests

### Installation

Add dependency in composer.json

```json
"require": {
    "ramapriya/http-request": "dev-master"
}
```

Evoke autoload file after installation or updating composer

```php
require __DIR__ . "/vendor/autoload.php";
```

All methods are static, don't need create new class object

### Methods

*`GetRequestMethod()`* get request method:

```php
$method = Request::GetRequestMethod();

switch($method) {
    case 'GET':
        // your code
        break;
    case 'POST':
        // your code
        break;
}
```

#### GET

*`isGet()`* check GET

```php
if(Request::isGet()!== false) {
    $name = htmlspecialchars(Request::Get('name'));
}
```

*`Get($param = null)`* get global `$_GET`. If `$param` isn't null, method returns value of param - `$_GET["param"]`, else - object `$_GET`

```php
if(!empty(Request::Get('email'))) {
    $email = htmlspecialchars(Request::Get('email'));
}
```

*`GetParams()`* get all keys of `$_GET`, method returns array of keys

```php
if(!in_array('user_id', Request::GetParams)) {
    echo json_encode("User ID isn't defined!");
}
```

#### POST

*`isPost()`* check POST

*`Post($param = null)`* get global `$_POST`. If `$param` isn't null, method returns value of param - `$_POST["param"]`, else - object `$_POST`

*`PostParams`* get all keys of `$_POST`, method returns array of keys

#### Raw requests (php://input)

Before:

```php
$json = file_get_contents("php://input");
$request = json_decode($json);

if(!empty($request)) {
    // your code
}
```

Now:

```php
if(Request::isRaw()) {
    $request = Request::Raw();
}
```

*`isRaw()`* check raw request

*`Raw($param = null)`* get decoded raw request. If `$param` isn't null, method returns value of param, else - decoded json

*`RawParams`* get all keys of `GetRawParams()`, method returns array of keys

#### Headers

*`GetAllHeaders()`* get all headers of request, method returns array

```php
$headers = Request::GetAllHeaders();
```

*`GetHostName()`* method returns host name

```php
$domain = Request::GetHostName();
```

*`isHttps()`* check HTTPS

```php
if(Request::isHttps() !== true) {
    die("Application works only with HTTPS!");
}
```

*`GetUserAgent()`* method returns User-Agent

```php
$userAgent = Request::GetUserAgent();
```
