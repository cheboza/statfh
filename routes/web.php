<?php

/*php artisan ui bootstrap
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PageController;

Route::get('/login', function (){
    if(!Auth::check()){
        return view('login');
    } else {
        return redirect()->route('shop');
    }
})->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/', function (){
        return redirect()->route('shop');
    });

    Route::get('/shop', [PageController::class, 'getPage'])->name('shop');
    Route::get('/{page}',  [PageController::class, 'getPage'])->where('page', 'goods|collections|sellers|brands|categories');

    Route::post('/shop', '\App\Http\Controllers\StatisticsController@shopStat');
    Route::post('/goods', '\App\Http\Controllers\StatisticsController@goodsStat');
    Route::post('/collections', '\App\Http\Controllers\StatisticsController@collectionsStat');
    Route::post('/sellers', '\App\Http\Controllers\StatisticsController@sellersStat');
    Route::post('/brands', '\App\Http\Controllers\StatisticsController@brandsStat');
    Route::post('/categories', '\App\Http\Controllers\StatisticsController@categoriesStat');

    Route::post('/goods/search', '\App\Http\Controllers\SearchController@searchGoodsByName');
    Route::post('/collections/search', '\App\Http\Controllers\SearchController@searchCollectionsByName');
});
// REMOVE late
Route::get('/regadmin', [RegisterController::class, 'regadmin']);
// \REMOVE
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// POST
Route::post('/login', [LoginController::class, 'authenticate']);

