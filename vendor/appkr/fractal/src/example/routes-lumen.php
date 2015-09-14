<?php

$app->group(['prefix' => 'api/v1'], function($app) {
    $app->get('resource',[
        'as' => 'api.v1.resource.index',
        'uses' => \Appkr\Fractal\Example\ResourceControllerForLumen::class . '@index'
    ]);
    $app->get('resource/{id}',[
        'as' => 'api.v1.resource.show',
        'uses' => \Appkr\Fractal\Example\ResourceControllerForLumen::class . '@show'
    ]);
    $app->post('resource',[
        'as' => 'api.v1.resource.store',
        'uses' => \Appkr\Fractal\Example\ResourceControllerForLumen::class . '@store'
    ]);
    $app->put('resource/{id}',[
        'as' => 'api.v1.resource.update',
        'uses' => \Appkr\Fractal\Example\ResourceControllerForLumen::class . '@update'
    ]);
    $app->delete('resource/{id}',[
        'as' => 'api.v1.resource.destroy',
        'uses' => \Appkr\Fractal\Example\ResourceControllerForLumen::class . '@destroy'
    ]);
});
