<?php

use App\Models\ChildItem;
use App\Models\ParentItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Scope binding work correctly here
Route::get('{parentItem}/{childItem}', function (ParentItem $parentItem, ChildItem $childItem) {
    return "OK";
})->scopeBindings()->name('works');

// Scope bindings break silently because a parameter is added between the parent and child items
Route::get('{parentItem}/{between}/{childItem}', function (ParentItem $parentItem, string $between, ChildItem $childItem) {
    return "OK";
})->scopeBindings()->name('broken');
