<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PropertiesController;
use App\Http\Controllers\Api\AnalyticTypesController;
use App\Http\Controllers\Api\PropertyAnalyticsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function(){
    return response()->json(['success' => true], 200);
});

// Auth registration and login routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Creating a middleware for apis for authentication
Route::middleware('auth:api')->group(function () {

    // Creating resource route but only to show and add property
    Route::resource('property', PropertiesController::class)->only([
        'index', 'show', 'store'
    ]);

    // Creating resource route but only to show analytic types
    Route::resource('analytic_types', AnalyticTypesController::class)->only([
        'index'
    ]);

    // Creating resource route but only to add and update property analytics
    Route::resource('property_analytics', PropertyAnalyticsController::class)->only([
        'store', 'update'
    ]);

    // Routes to show summary based on params
    Route::get('property_analytics/suburb_summary/{suburb}', [PropertyAnalyticsController::class, 'suburb']);
    Route::get('property_analytics/state_summary/{state}', [PropertyAnalyticsController::class, 'state']);
    Route::get('property_analytics/country_summary/{country}', [PropertyAnalyticsController::class, 'country']);
});

