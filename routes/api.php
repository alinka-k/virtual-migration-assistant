<?php

use App\Http\Controllers\Evaluation\MyEligibilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Evaluation\EvaluationController;
use App\Http\Controllers\Evaluation\EvaluationScoreController;

Route::group([

    'middleware' => ['api'],
    'prefix' => 'auth'

], function () {
    Route::post('facebook', ['as' => 'api.auth.facebook', 'uses' => 'Auth\SocialController@facebook']);
    Route::post('google', ['as' => 'api.auth.google', 'uses' => 'Auth\SocialController@google']);
    Route::post('office', ['as' => 'api.auth.office', 'uses' => 'Auth\SocialController@office']);
    Route::post('register', 'Auth\MainController@register');
    Route::post('login', 'Auth\MainController@login')->middleware('throttle:10,60');
    Route::get('verify', ['as' => 'api.auth.verify', 'uses' => 'Auth\MainController@verify'])
        ->middleware('signed:0');
    Route::get('user', 'User\UserController@index')->middleware('auth');
    Route::post('logout', 'Auth\MainController@logout')->middleware('auth');
    Route::get('refresh', 'Auth\MainController@refresh')->middleware('auth');
    Route::post('forgot-password', 'Auth\MainController@forgotPassword');
    Route::post('reset-password', 'Auth\ResetPassword@reset');
    Route::post('reset-password/{token}/{email}', 'Auth\ResetPassword@checkUrl');
});

Route::group([

    'middleware' => [
        'api',
        'auth',
    ],

], function () {
    Route::get('evaluation-score', [EvaluationScoreController::class, 'show']);
    Route::post('evaluate', [EvaluationController::class, 'store']);
    Route::post('evaluate-virtual', [EvaluationController::class, 'evaluate']);
});

Route::group([
    'middleware' => [
        'api',
        'auth',
    ],
], function () {
    Route::get('my-eligibility', [MyEligibilityController::class, 'index']);
    Route::get('my-eligibility/programs/count', [MyEligibilityController::class, 'programsCount']);
});

