<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\BorrowDetailController;
use App\Http\Controllers\CustomerTypeController;

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
    return view('auth.login');
});

Route::group(['middleware' => ['isAdmin']], function () {
    //Permission
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);
    //Role
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    //  ->middleware('permission:delete role');

    //
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'AddPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'UpdatePermissionToRole']);
    //Users
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('front.home');
    // Route::get('/Dashboard', [DashboardController::class, 'customer'])->name('customer.index');
    //Customers
    Route::get('/customer/index', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/index', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/customer/show/{id}', [CustomerController::class, 'show'])->name('customer.show');

    //CustomerType
    Route::get('/customertype/index', [CustomerTypeController::class, 'index'])->name('customertype.index');
    Route::get('/customertype/create', [CustomerTypeController::class, 'create'])->name('customertype.create');
    Route::post('/customertype/index', [CustomerTypeController::class, 'store'])->name('customertype.store');
    Route::delete('/customertype/{id}', [CustomerTypeController::class, 'destroy'])->name('customertype.destroy');
    //book
    Route::get('/book/index', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/book/index', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/show/{id}', [BookController::class, 'show'])->name('book.show');

    //Catalog
    Route::get('/catalog/index', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/catalog/index', [CatalogController::class, 'store'])->name('catalog.store');
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'edit'])->name('catalog.edit');
    Route::put('/catalog/update/{id}', [CatalogController::class, 'update'])->name('catalog.update');
    Route::delete('/catalog/{id}', [CatalogController::class, 'destroy'])->name('catalog.destroy');
    Route::get('/catalog/show/{id}', [CatalogController::class, 'show'])->name('catalog.show');
    //Librarian
    Route::get('/librarian/index', [LibrarianController::class, 'index'])->name('librarian.index');
    Route::get('/librarian/create', [LibrarianController::class, 'create'])->name('librarian.create');
    Route::post('/librarian/index', [LibrarianController::class, 'store'])->name('librarian.store');
    Route::get('/librarian/edit/{id}', [LibrarianController::class, 'edit'])->name('librarian.edit');
    Route::put('/librarian/update/{id}', [LibrarianController::class, 'update'])->name('librarian.update');
    Route::delete('/librarian/{id}', [LibrarianController::class, 'destroy'])->name('librarian.destroy');
    Route::get('/librarian/show/{id}', [LibrarianController::class, 'show'])->name('librarian.show');
    //Borrow
    Route::get('/borrow/index', [BorrowController::class, 'index'])->name('borrow.index');
    Route::get('/borrow/create', [BorrowController::class, 'create'])->name('borrow.create');
    Route::post('/borrow/index', [BorrowController::class, 'store'])->name('borrow.store');
    Route::get('/borrow/edit/{id}', [BorrowController::class, 'edit'])->name('borrow.edit');
    Route::put('/borrow/update/{id}', [BorrowController::class, 'update'])->name('borrow.update');
    Route::delete('/borrow/{id}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
    Route::get('/borrow/show/{id}', [BorrowController::class, 'show'])->name('borrow.show');
    //BorrowDetail
    Route::get('/borrowdetail/index', [BorrowDetailController::class, 'index'])->name('borrowdetail.index');
    Route::get('/borrowdetail/create', [BorrowDetailController::class, 'create'])->name('borrowdetail.create');
    Route::post('/borrowdetail/index', [BorrowDetailController::class, 'store'])->name('borrowdetail.store');
    Route::get('/borrowdetail/edit/{id}', [BorrowDetailController::class, 'edit'])->name('borrowdetail.edit');
    Route::put('/borrowdetail/update/{id}', [BorrowDetailController::class, 'update'])->name('borrowdetail.update');
    Route::delete('/borrowdetail/{id}', [BorrowDetailController::class, 'destroy'])->name('borrowdetail.destroy');
    Route::get('/borrowdetail/show/{id}', [BorrowDetailController::class, 'show'])->name('borrowdetail.show');
});
Auth::routes();

// Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
