<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessEntityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Route for Bank Accounts (used in dashboard and show page)
Route::get('/business-entities/{businessEntity}/bank-accounts', [BusinessEntityController::class, 'getBankAccounts'])->name('business-entities.bank-accounts.api');
