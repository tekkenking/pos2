<?php

Route::group(['prefix' => 'api/v1'], function() {
    resource(
        'resource',
        Appkr\Fractal\Example\ResourceController::class,
        ['except' => ['create', 'edit']]
    );
});
