<?php
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\user;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware(['auth']);

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware(['auth']);

Route::post('/posts', [PostController::class, 'store']);

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::PUT('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::DELETE('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
// comment
Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comments.store');
Route::DELETE('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Githup
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {

    $githubUser = Socialite::driver('github')->user();
    // dd($githubUser);

    $user = User::updateOrCreate(
     [
        'name' => $githubUser->nickname,
        'email' => $githubUser->email,
    ]);

    Auth::login($user);

    return redirect('/posts');


});

//goggle
Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {

    $User = Socialite::driver('google')->user();
    // dd($githubUser);

    $user = User::updateOrCreate(
     [
        'name' => $User->nickname,
        'email' => $User->email,
    ]);

    Auth::login($user);

    return redirect('/posts');


});