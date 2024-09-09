<?php

use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

// Routes for Front PAGE
Route::get('/', [ArticleController::class, 'index'])->name('index');
Route::get('/category/{id}', [ArticleController::class, 'category'])->name('category');
Route::get('/full/{title}/{id}', [ArticleController::class, 'full'])->name('full');
Route::get('/contact', [ArticleController::class, 'contact'])->name('contact');
Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('send.email');
Route::get('/search', [ArticleController::class, 'search'])->name('search');


// Routes for ArticleController
Route::get('admin', [ArticleController::class, 'admin_index'])->middleware(['auth'])->name('admin.index');
Route::get('admin/create', [ArticleController::class, 'create'])->name('admin.create');
Route::post('admin', [ArticleController::class, 'store'])->name('admin.store'); 
Route::get('/admin/articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.edit');
Route::put('/admin/articles/{id}', [ArticleController::class, 'update'])->name('admin.update');
Route::delete('/admin/articles/{id}', [ArticleController::class, 'destroy'])->name('admin.destroy');
Route::get('admin/create_video', [ArticleController::class, 'create_video'])->name('admin.create.video');
Route::post('admin/video_store', [ArticleController::class, 'video_store'])->name('admin.video.store');
Route::get('admin/index_video', [ArticleController::class, 'index_video'])->middleware(['auth'])->name('admin.index_video');


// Routes for AuthorController
Route::get('admin/create_author', [AuthorController::class, 'create_author'])->name('admin.create.author');
Route::post('admin/create_author', [AuthorController::class, 'store_author'])->name('admin.store.author');

// Routes for CategoryController
Route::get('admin/create_category', [CategoryController::class, 'create'])->name('admin.create.category');
Route::post('admin/store_category', [CategoryController::class, 'store'])->name('admin.store.category');
Route::get('admin/categories/index', [CategoryController::class, 'index'])->name('admin.categories.index');
Route::get('admin/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
Route::get('admin/categories/index/{id}/hide', [CategoryController::class, 'hide'])->name('admin.categories.hide');
Route::get('categories/{id}/unhide', [CategoryController::class, 'unhide'])->name('admin.categories.unhide');
Route::resource('categories', CategoryController::class);
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
Route::get('/admin/categories/{id}/move-up', [CategoryController::class, 'moveUp'])->name('admin.categories.moveUp');
Route::get('/admin/categories/{id}/move-down', [CategoryController::class, 'moveDown'])->name('admin.categories.moveDown');






// Authentication Routes
Route::get('auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('auth/login', [LoginController::class, 'login']);
Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('auth/logout', function () {
    Auth::logout();
    return redirect('auth/login');
})->name('logout');

// Registration Routes (if you have registration enabled)
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);