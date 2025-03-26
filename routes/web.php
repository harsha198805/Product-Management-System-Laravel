<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;



Route::get('/login', function () {
    return redirect()->route('login');
});


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Auth::routes(['register' => false]);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/send-email', [ContactController::class, 'sendEmail'])->name('contact.submit');
Route::get('/category/{slug}', [HomeController::class, 'categoryPage'])->name('category.show');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

});
Route::middleware(['auth', 'user'])->group(function () {
    // Route::get('/', function () {
    //     return redirect()->route('user.dashboard');
    // });
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/products', 'index')->name('products.index');
        Route::get('/admin/products/create', 'create')->name('products.create');
        Route::post('/admin/products', 'store')->name('products.store');
        Route::get('/admin/products/edit/{product}', 'edit')->name('products.edit');
        Route::post('/admin/products/{product}', 'update')->name('products.update');
        Route::delete('/admin/products/{product}', 'destroy')->name('products.destroy');
        Route::get('/admin/products/search', 'search')->name('products.search');
        Route::get('/admin/products/getdata', 'getdata')->name('products.getdata');
        Route::get('/admin/category_list', 'getCategoryList');
        Route::post('/admin/add_new_category', 'addNewCategory');
        Route::patch('/admin/products/update-status', 'updateStatus')->name('products.updateStatus');
    });


    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'index')->name('categories.index');
        Route::get('/admin/categories/create', 'create')->name('categories.create');
        Route::get('/admin/categories/show/{category}', 'show')->name('categories.show');
        Route::post('/admin/categories', 'store')->name('categories.store');
        Route::get('/admin/categories/edit/{category}', 'edit')->name('categories.edit');
        Route::post('/admin/categories/{category}', 'update')->name('categories.update');
        Route::delete('/admin/categories/{category}', 'destroy')->name('categories.destroy');
        Route::get('/admin/categories/search', 'search')->name('categories.search');
        Route::get('/admin/categories/getdata', 'getdata')->name('categories.getdata');
        Route::patch('/admin/categories/update-status', 'updateStatus')->name('categories.updateStatus');
    });

    Route::controller(BlogController::class)->group(function () {
        Route::get('/admin/blogs', 'index')->name('blogs.index');
        Route::get('/admin/blogs/create', 'create')->name('blogs.create');
        Route::post('/admin/blogs', 'store')->name('blogs.store');
        Route::get('/admin/blogs/edit/{blog}', 'edit')->name('blogs.edit');
        Route::post('/admin/blogs/{blog}', 'update')->name('blogs.update');
        Route::delete('/admin/blogs/{blog}', 'destroy')->name('blogs.destroy');
        Route::get('/admin/blogs/search', 'search')->name('blogs.search');
        Route::get('/admin/blogs/getdata', 'getdata')->name('blogs.getdata');
        Route::patch('/admin/blogs/update-status', 'updateStatus')->name('blogs.updateStatus');
    });
});
