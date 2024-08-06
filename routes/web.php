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
use App\Http\Controllers\AuctionController;

Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

Route::post('/auctions/{auction}/bids', [AuctionController::class, 'placeBid']);

// Route::get('/auctions/{auction}/bids', function () {
//     $auction = ["id"=> 1, "item"=> "Item 1", "current_bid" => 20];
//     return view('auction', ["auction" => json_encode($auction)]);
// });

Broadcast::routes();
