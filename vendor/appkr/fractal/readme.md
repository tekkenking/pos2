#Fractal wrapper for Laravel 5/Lumen#

[![Latest Stable Version](https://poser.pugx.org/appkr/fractal/v/stable)](https://packagist.org/packages/appkr/fractal) [![Total Downloads](https://poser.pugx.org/appkr/fractal/downloads)](https://packagist.org/packages/appkr/fractal) [![Latest Unstable Version](https://poser.pugx.org/appkr/fractal/v/unstable)](https://packagist.org/packages/appkr/fractal) [![License](https://poser.pugx.org/appkr/fractal/license)](https://packagist.org/packages/appkr/fractal)

This is a package, or rather, an **opinionated/laravelish use case of the famous [league/fractal](https://github.com/thephpleague/fractal) package for Laravel 5 and Lumen**.

This project was started to fulfill a personal RESTful API service needs. In an initial attempt to evaluate various php API packages for Laravel, I found that the features of those packages providing are well excessive of my requirement.

If your requirement is simple like mine, this is the right package. But if you need more delicate package, head over to [chiraggude/awesome-laravel](https://github.com/chiraggude/awesome-laravel#restful-apis) to find a right one.

Using this package, I didn't want user of this package to sacrifice Laravel's recommended coding practices without having to learn the package specific syntax/usage. And most importantly, I wanted he/she could build his/her API service quickly based on the examples provided.

## Simple Example Implementation
```php
<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Todo;
use App\Transformers\TodoTransformer;
use Appkr\Fractal\Http\Response;

class TodoController extends Controller
{
    protected $response;

    public function __construct(Response $respond)
    {
        $this->respond = $respond;
    }

    public function index()
    {
        return $this->respond->withPagination(
            Todo::latest()->paginate(25),
            new TodoTransformer,
            'todos'
        );
    }
```

---

##Index

- [Goal](#goal)
- [How to Install](#install)
- [Bundled Example](#example)
- [Best Practices](#best-practices)
    - [Route(API Endpoints)](#route)
    - [Controller](#controller)
    - [FormRequest](#form-request)
    - [Handle TokenMismatchException](#token)
    - [Formatting Laravel's General Exceptions.](#exception-formatting)
    - [CORS in Javascript Client](#cors)
- [Avaliable Response Methods](#api)
- [Access API Endpoints from a Client](#client)

---

<a name="goal"></a>
##Goal
1. Provides easy access to Fractal instance at Laravel 5/Lumen (ServiceProvider).
2. Provides easy way of make a Fractal transformed/serialized http response.
3. Provides configuration capability for Fractal and response format.
4. Provides use case examples, so that users can quickly copy & paste into his/her project.

<a name="install"></a>
##How to Install
**Setp #1:** Composer.

```json
"require": {
  "appkr/fractal": "0.5.*",
  "league/fractal": "@dev",
}
```

```bash
composer update
```

**`Important`** Since this package depends on the `setMeta()` api of the `league/fractal` which is available only at 0.13.*@dev, but the `league/fractal` have not been tagged as a stable(say 0.13) yet, so we need to explicitly lower the minimum-stability of the `league/fractal` at our root project's composer.json. Note that this is just a temporarily measure.

**Step #2:** Add the service provider.

```php
// For Laravel - config/app.php
'providers'=> [
    Appkr\Fractal\ApiServiceProvider::class,
]

// For Lumen - boostrap/app.php
$app->register(Appkr\Fractal\ApiServiceProvider::class);
```

**Step #3:** Publish assets.

```bash
// For Laravel only
$ php artisan vendor:publish --provider="Appkr\Fractal\ApiServiceProvider"
```

The config file is located at `config/fractal.php`.

Done !

---

<a name="api"></a>
##Avaliable Response Methods

These are the list of apis that `Appkr\Fractal\Http\Response` provides. By utilizing this apis you can be easily make a Fractal transformed/serialized http response. You can think of this as a view layer for your restful service:

```php
// Generic response. 
// If valid callback parameter is provided, jsonp response is provided.
// All other responses are depending upon this base respond() method.
respond(array $payload)

// Respond collection of resources
// If $transformer is not given as the second argument,
// this class does its best to transform the payload to a simple array
withCollection(
    \Illuminate\Database\Eloquent\Collection $collection, 
    \League\Fractal\TransformerAbstract|null $transformer, 
    string $resourceKey // for JsonApiSerializer only
)

// Respond single item
withItem(
    \Illuminate\Database\Eloquent\Model $model, 
    \League\Fractal\TransformerAbstract|null $transformer, 
    string $resourceKey // for JsonApiSerializer only
)

// Respond collection of resources with pagination
withPagination(
    \Illuminate\Contracts\Pagination\LengthAwarePaginator $paginator, 
    \League\Fractal\TransformerAbstract|null $transformer, 
    string $resourceKey // for JsonApiSerializer only
)

// Respond json formatted success message
// The format can be configurable at fractal.successFormat
success(string|array $message)

// Respond 201
// If a model is given at the first argument of this method,
// the class tries its best to transform the model to a simple array
created(string|array|\Illuminate\Database\Eloquent\Model $primitive)

// Respond 204
noContent()

// Generic error response
// All other error response depends upon this method
// If an instance of Exception is given as the first argument,
// this class does its best to properly set message and status code
error(string|array|\Exception $message)

// Respond 401
unauthorizedError(string|array $message)

// Respond 403
forbiddenError(string|array $message)

// Respond 404
notFoundError(string|array $message)

// Respond 406
notAcceptableError(string|array $message)

// Respond 409
conflictError(string|array $message)

// Respond 422
unprocessableError(string|array $message)

// Respond 500
internalError(string|array $message)

// Set http status code
// This method is chainable
setStatusCode(int $statusCode)

// Set http response header
// This method is chainable
setHeaders(array $headers)

// Set additional meta data
// This method is chainable
setMeta(array $meta)
```

### Available helper methods
```
// Determine the current framework is Laravel
is_laravel()

// Determine the current framework is Lumen
is_lumen()

// Determine if the current version of framework is based on 5.1
is_51()

// Determine if the current request is generated from an api client
is_api_request()

// Determine if the request is for update
is_update_request()

// Determine if the request is for delete
is_delete_request()
```

---

<a name="example"></a>
##Bundled Example

The package is bundled with some simple example. Those include:

- Database migrations and seeder
- routes definition, Eloquent Model and corresponding Controller
- FormRequest *(Laravel only)*
- Transformer
- Integration Test

If you want to see the the working example right away...

**Step #1:** Activate examples

```php
// Uncomment the line at vendor/appkr/fractal/src/ApiServiceProvider.php
$this->publishExamples();
```

**Step #2:** Migrate and seed tables

```bash
// Migrate/seed tables at a console
$ php artisan migrate --path=vendor/appkr/fractal/database/migrations
$ php artisan db:seed --class="Appkr\Fractal\Example\DatabaseSeeder"
```

**Step #3:** Boot up a test server and open at a browser

```bash
// Boot up a local server
$ php artisan serve
```

Head on to `http://localhost:8000/api/v1/resource`, and you should see below:

```json
{
  "data": [
    {
      "id": 100,
      "title": "Eos voluptatem officiis perferendis quas.",
      "description": null,
      "deprecated": true,
      "created_at": 1434608210,
      "manager": {
        "id": 5,
        "name": "mlittel",
        "email": "cora85@example.org",
        "created_at": 1434608210
      }
    },
    {
      "..."
    }
  ],
  "meta": {
    "version": 1,
    "pagination": {
      "total": 100,
      "count": 25,
      "per_page": 25,
      "current_page": 1,
      "total_pages": 4,
      "links": {
        "next": "http:\\/\\/localhost:8000\\/api\\/v1\\/resource\\/?page=2"
      }
    }
  }
}
```

**`Note`** If you finished evaluating the example, don't forget to rollback the migration and re-comment the unnecessary lines at `ApiServiceProvider`.

---

<a name="best-practices"></a>
##Best Practices

<a name="route"></a>
###Route (API Endpoints)
You can define your routes just like laravel way.

```php
// app/Http/routes.php

Route::group(['prefix' => 'api/v1'], function() {
    Route::resource(
        'something',
        SomethingController::class,
        ['except' => ['create', 'edit']]
    );
});

// For Lumen, checkout the example at vendor/appkr/fractal/src/example/routes-lumen.php
```

<a name="controller"></a>
###Controller
It is recommended for your `SomethingController` to inject `Appkr\Fractal\Http\Response`. Alternative ways are using `Appkr\Fractal\ApiResponse` trait, or `app('api.response')`.

```php
// Injectting Appkr\Fractal\Http\Response
class SomethingController 
{
    protected $respond;
    
    public function __construct(\Appkr\Fractal\Http\Response $respond)
    {
        $this->respond = $respond;
    }
    
    public function index() 
    {
        $this->respond->success('Hello API');
    }
}
```

```php
// Using trait
class SomethingController 
{
    use Appkr\Fractal\Http\ApiResponse;
    
    public function index() {
        // We can use $this->response() or $this->respond() interchangeably
        $this->response()->success('Hello API');
    }
}
```

```php
// Or get the instance out of the Service Container
class SomethingController 
{
    public function index() {
        app('api.response')->success('Hello API');
    }
}
```

<a name="form-request"></a>
###FormRequest
It is recommended for `YourFormRequest` to extend `Appkr\Fractal\Request`. By extending the abstract request of this package, validation or authorization errors are properly formatted just like you configured at the `config/fractal.php`. Or you may move the class body of `Appkr\Fractal\Http\Request` to your `App\Http\Requests\Request`.

```php
class YourFormRequest extends \Appkr\Fractal\Http\Request {}
```

<a name="transformer"></a>
###Transformer
This package follows original Fractal Transformer spec. Refer to the original [documentation](http://fractal.thephpleague.com/transformers/). An example transformers are provided with this package.

<a name="csrf"></a>
###Handle TokenMismatchException
Laravel 5/Lumen throws `TokenMismatchException` when an client sends a post request(create, update, or delete a resource) to the API endpoint. Because the client can exists in a separate domain or environment (e.g. android native application), no way for your server to publish csrf token to the client. It's more desirable to achieve a level of security through [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth) or equivalent measures. (Recommended articles: [scotch.io](https://scotch.io/tutorials/the-ins-and-outs-of-token-based-authentication), [angular-tips.com](http://angular-tips.com/blog/2014/05/json-web-tokens-introduction/))

So, let's just skip it. 

If your project is Laravel 5.1.* based, it couldn't be easier:

```php
// app/Http/Middleware/VerifyCsrfToken.php

protected $except = [
    'api/*' // or config('fractal/pattern')
];
```

In Laravel 5.0/Lumen, I did it like this:

```php
// For Laravel 5.0 - app/Http/Middleware/VerifyCsrfToken.php

public function handle($request, \Closure $next) {
    if ($request->is('api/*')) {
        return $next($request);
    }

    return parent::handle($request, $next);
}

// For Lumen, checkout Laravel\Lumen\Http\Middleware\VerifyCsrfToken 
// instead of App\Http\Middleware\VerifyCsrfToken.php
```

<a name="exception-formatting"></a>
###Formatting Laravel's General Exceptions.
For example, I thought 404 with json response was more appropriate for `Illuminate\Database\Eloquent\ModelNotFoundException`, when the request was originated from API clients, but the current version of Laravel just rendered 404 html page. To properly format this, I did:

```php
// app/Exceptions/Handlers.php

public function render($request, Exception $e) 
{
    // We can use is_api_request() helper instead of $request->is('api/*')
    if ($request->is('api/*')) { 
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException
            or $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return app('api.response')->notFoundError(
                    'Sorry, the resource you requested does not exist.'
                );
        }
        
        if ($e instanceof \Symfony\Component\Routing\Exception\MethodNotAllowedException
            or $e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                return app('api.response')->setStatusCode(405)->error(
                    'Sorry, the endpoint does not exist.'
                );
        }
        
        // Add yours ...
    }

    return parent::render($request, $e);
}
```

<a name="cors"></a>
###Fighting against CORS Issue in Javascript-based Web Client

I highly recommend utilize [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors).

---

<a name="client"></a>
##Access API Endpoints from a Client

Laravel is using method spoofing for `PUT|PATCH` and `DELETE` request, so your client should also request as so. For example if a client want to make a `PUT` request to `//host/api/v1/resource/1`, the client should send a `POST` request to the API endpoint with additional request body of `_method=put`.

Alternative way to achieve method spoofing in Laravel is using `X-HTTP-Method-Override` request header. The client has to send a POST request with `X-HTTP-Method-Override: PUT` header. 

Either way works, so it comes down to your preference.

Following table illustrates how an api client can access your api endpoint:

Http verb|Endpoint address|Mandatory param (or header)|Controller method|Description
---|---|---|---|---
GET|//host/api/v1/something| |`index()`|Get a collection of resource
GET|//host/api/v1/something/{id}| |`show()`|Get the specified resource
POST|//host/api/v1/something| |`store()`|Create new resource
POST|//host/api/v1/something/{id}|`_method=put` `(x-http-method-override: put)`|`update()`|Update the specified resource
POST|//host/api/v1/something/{id}|`_method=delete` `(x-http-method-override: delete)`|`delete()`|Delete the specified resource

---

##LICENSE

[The MIT License](https://raw.githubusercontent.com/appkr/fractal/master/LICENSE)
