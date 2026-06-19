<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

// Die Route verweist nun sauber auf die "index" Methode im ProductController
Route::get('/products', [ProductController::class, 'index']);