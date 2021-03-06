<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('','HomeController@index')->name('login');

Route::prefix('dicegolf')->group(function () {
    Route::get('', 'DiceGolfController@index');

    Route::get('stats', 'DiceGolfController@stats');
    Route::get('most-games', 'DiceGolfController@most_games');
    Route::get('hole-in-one', 'DiceGolfController@hole_in_one');
    Route::get('most-popular', 'DiceGolfController@most_popular');
});

Route::get('twitch-chat-stats', 'ChatStatsController@index');
Route::get('twitch-chat-stats/stats', 'ChatStatsController@stats');

Route::get('experiments', 'ExperimentalController@index');

Route::middleware('auth')->group(function () {
    Route::get('admin/flag-selector', 'UserController@flag_selector');
});

/*
 * OAUTH CALLBACKS
 */
Route::get('oauth/twitch', 'ExperimentalController@login_twitch');
