<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//routing for creating a new cafe, modifying, and deleting

Route::get('/cafe/detail', \App\Http\Controllers\Cafe\DetailController::class)->name('cafe.detail');
Route::get('/cafe/detail/{cafeId}', \App\Http\Controllers\Cafe\Detail\ShowController::class)->name('cafe.detail.show')->where('cafeId', '[0-9]+');

//routing for creating a new post, updating, and deleting
Route::get('/post', \App\Http\Controllers\Post\ShowController::class)->name('post.show');

//routing for searching a specific cafe by keyword or province
Route::get('/cafe/search/keyword', \App\Http\Controllers\Cafe\Search\KeywordController::class)->name('cafe.search.keyword');
Route::get('/cafe/search/province', \App\Http\Controllers\Cafe\Search\ProvinceController::class)->name('cafe.search.province');
Route::get('/cafe/search', function () {
    return view('cafe.search');
})->name('cafe.search');

Route::middleware('auth')->group(function () {
    Route::get('/cafe/new', \App\Http\Controllers\Cafe\NewController::class)->name('cafe.new');
    Route::post('/cafe/create', \App\Http\Controllers\Cafe\CreateController::class)->name('cafe.create');
    Route::get('/cafe/update/{cafeId}', \App\Http\Controllers\Cafe\Update\ShowController::class)->name('cafe.update.show')->where('cafeId', '[0-9]+');
    Route::put('/cafe/update/{cafeId}', \App\Http\Controllers\Cafe\Update\PutController::class)->name('cafe.update.put')->where('cafeId', '[0-9]+');
    Route::delete('/cafe/delete/{cafeId}', \App\Http\Controllers\Cafe\DeleteController::class)->name('cafe.delete');

    Route::post('/post/create', \App\Http\Controllers\Post\CreateController::class)->name('post.create');

    //routing for updating a post
    Route::get('/post/update/{postId}', \App\Http\Controllers\Post\Update\ShowController::class)->name('post.update.show');
    Route::put('/post/update/{postId}', \App\Http\Controllers\Post\Update\PutController::class)->name('post.update.put')->where('postId', '[0-9]+');

    //routing for deleting a post
    Route::delete('/post/delete/{postId}', \App\Http\Controllers\Post\DeleteController::class)->name('post.delete');

    //routing for deleting a menu
    Route::delete('/cafe/delete/menu/{menuId}', \App\Http\Controllers\Cafe\Menu\DeleteController::class)->name('cafe.delete.menu');

    //routing for comment
    Route::get('/post/comment/{postId}', \App\Http\Controllers\Post\CommentShowController::class)->name('post.comment.show');
    Route::post('/post/comment/{postId}', \App\Http\Controllers\Post\CommentController::class)->name('post.comment.save');

});

require __DIR__.'/auth.php';