<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleLoginController;

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

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/privacy-policy', function() {
    return view('privacy');
})->name('privacy');

Route::get('/terms-of-service', function() {
    return view('termsOfService');
})->name('termsOfService');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/notifications', function() {
    return view('notification');
})->name('notifications');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');

//routing for creating a new cafe, modifying, and deleting

Route::get('/cafe/detail', \App\Http\Controllers\Cafe\DetailController::class)->name('cafe.detail');
Route::get('/cafe/detail/{cafeId}', \App\Http\Controllers\Cafe\Detail\ShowController::class)->name('cafe.detail.show')->where('cafeId', '[0-9]+');

Route::get('/', \App\Http\Controllers\Post\ShowController::class)->name('post.show');

//routing for a specific user
Route::get('/cafeseekers/{userId}', \App\Http\Controllers\ShowUserController::class)->name('cafeseeker')->where('userId', '[0-9]+');

//Route for all posts
Route::get('/posts', \App\Http\Controllers\Post\AllPostsShowController::class)->name('post.posts');

//routing for searching a specific cafe by keyword or province
Route::get('/cafe/search/keyword', \App\Http\Controllers\Cafe\Search\KeywordController::class)->name('cafe.search.keyword');
Route::get('/cafe/search/province', \App\Http\Controllers\Cafe\Search\ProvinceController::class)->name('cafe.search.province');

Route::middleware('auth')->group(function () {
    Route::get('/cafe/new', \App\Http\Controllers\Cafe\NewController::class)->name('cafe.new');
    Route::post('/cafe/create', \App\Http\Controllers\Cafe\CreateController::class)->name('cafe.create');
    Route::get('/cafe/update/{cafeId}', \App\Http\Controllers\Cafe\Update\ShowController::class)->name('cafe.update.show')->where('cafeId', '[0-9]+');
    Route::put('/cafe/update/{cafeId}', \App\Http\Controllers\Cafe\Update\PutController::class)->name('cafe.update.put')->where('cafeId', '[0-9]+');
    Route::delete('/cafe/delete/{cafeId}', \App\Http\Controllers\Cafe\DeleteController::class)->name('cafe.delete');

    Route::post('/post/create/{cafeId}', [\App\Http\Controllers\Post\CreateController::class, 'create'])->name('post.create.cafe')->where('cafeId', '[0-9]+');
    Route::get('/mark-as-read', [\App\Http\Controllers\Post\CreateController::class, 'markAsRead'])->name('mark-as-read');

    //routing for updating a post
    Route::get('/post/update/{postId}', \App\Http\Controllers\Post\Update\ShowController::class)->name('post.update.show');
    Route::put('/post/update/{postId}', \App\Http\Controllers\Post\Update\PutController::class)->name('post.update.put')->where('postId', '[0-9]+');

    //routing for deleting a post
    Route::delete('/post/delete/{postId}', \App\Http\Controllers\Post\DeleteController::class)->name('post.delete');

    //routing for deleting a menu
    Route::delete('/cafe/delete/menu/{menuId}', \App\Http\Controllers\Cafe\Menu\DeleteController::class)->name('cafe.delete.menu')->where('menuId', '[0-9]+');

    //routing for comment
    Route::get('/post/comment/{postId}', \App\Http\Controllers\Post\CommentShowController::class)->name('post.comment.show');
    Route::post('/post/comment/{postId}', \App\Http\Controllers\Post\CommentController::class)->name('post.comment.save');
    Route::post('/post/reply/{postId}/{commentId}', \App\Http\Controllers\Post\ReplyController::class)->name('post.reply.create')->where('commentId', '[0-9]+')->where('postId', '[0-9]+');
    Route::put('/post/reply/{postId}/{commentId}', \App\Http\Controllers\Post\Update\ReplyController::class)->name('post.reply.put')->where('commentId', '[0-9]+')->where('postId', '[0-9]+');
    Route::delete('/post/reply/{commentId}', \App\Http\Controllers\Post\DeleteReplyController::class)->name('post.reply.delete')->where('commentId', '[0-9]+');

    Route::get('/contact-form', [\App\Http\Controllers\FormControroller::class, 'index'])->name('form');
    Route::post('/contact-form',  [\App\Http\Controllers\FormControroller::class, 'sendMail']);

    Route::get('dashboard/followers', \App\Http\Controllers\ShowFollowerController::class)->name('dashboard.followers');
    Route::get('dashboard/followings', \App\Http\Controllers\ShowFollowingController::class)->name('dashboard.followings');
});

require __DIR__.'/auth.php';
