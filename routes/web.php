<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Http\Request;
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

// // main page, all listings
// Route::get('/', function () {
//     return view('listings', [
//         "listings" => Listing::all()
//     ]);
// });

// // single listing
// Route::get("/listings/{listing}", function (Listing $listing) {
//      return view("listing", [ 
//         "listing" => $listing
//     ]);
// });

// main page, all listings
Route::get('/', [ListingController::class, "index"]);

// show create form
Route::get('/listings/create',  [ListingController::class, "create"]);

// single listing
Route::get('/listings/{listing}',  [ListingController::class, "show"]);

