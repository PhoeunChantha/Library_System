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
Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    //Permission
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/create', [App\Http\Controllers\PermissionController::class, 'create'])->middleware('can:create permission');
    Route::get('permissions/{permission}/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->middleware('can:update permission');
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    //Role
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/create', [App\Http\Controllers\RoleController::class, 'create'])->middleware('can:create role');
    Route::get('roles/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->middleware('can:update role');
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'AddPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'UpdatePermissionToRole']);

    //Users
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->middleware('can:create user');
    Route::get('users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->middleware('can:update user');

    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('front.home');

    //Customers
    Route::get('/customer/index', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create')->middleware('can:create customer');
    Route::post('/customer/index', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit')->middleware('can:update customer');
    Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/customer/show/{id}', [CustomerController::class, 'show'])->name('customer.show')->middleware('can:view customer');
    Route::put('customer/update_IsHidden', [CustomerController::class, 'updateStatus'])->name('customer.update_IsHidden');


    //CustomerType
    Route::get('/customertype/index', [CustomerTypeController::class, 'index'])->name('customertype.index');
    Route::get('/customertype/create', [CustomerTypeController::class, 'create'])->name('customertype.create')->middleware('can:create customertype');
    Route::post('/customertype/index', [CustomerTypeController::class, 'store'])->name('customertype.store');
    Route::delete('/customertype/{id}', [CustomerTypeController::class, 'destroy'])->name('customertype.destroy');

    //Book
    Route::get('/book/index', [BookController::class, 'index'])->name('book.index');
    Route::get('/book/create', [BookController::class, 'create'])->name('book.create')->middleware('can:create book');
    Route::post('/book/index', [BookController::class, 'store'])->name('book.store');
    Route::get('/book/edit/{id}', [BookController::class, 'edit'])->name('book.edit')->middleware('can:update book');
    Route::put('/book/update/{id}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/book/show/{id}', [BookController::class, 'show'])->name('book.show')->middleware('can:view book');
    Route::put('book/update_IsHidden', [BookController::class, 'updateStatus'])->name('book.update_IsHidden');


    //Catalog
    Route::get('/catalog/index', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/create', [CatalogController::class, 'create'])->name('catalog.create')->middleware('can:create catalog');
    Route::post('/catalog/index', [CatalogController::class, 'store'])->name('catalog.store');
    Route::get('/catalog/edit/{id}', [CatalogController::class, 'edit'])->name('catalog.edit')->middleware('can:update catalog');
    Route::put('/catalog/update/{id}', [CatalogController::class, 'update'])->name('catalog.update');
    Route::delete('/catalog/{id}', [CatalogController::class, 'destroy'])->name('catalog.destroy');
    Route::get('/catalog/show/{id}', [CatalogController::class, 'show'])->name('catalog.show')->middleware('can:view catalog');
    Route::put('catalog/update_IsHidden', [CatalogController::class, 'updateStatus'])->name('catalog.update_IsHidden');


    //Librarian
    Route::get('/librarian/index', [LibrarianController::class, 'index'])->name('librarian.index');
    Route::get('/librarian/create', [LibrarianController::class, 'create'])->name('librarian.create')->middleware('can:create librarian');
    Route::post('/librarian/index', [LibrarianController::class, 'store'])->name('librarian.store');
    Route::get('/librarian/edit/{id}', [LibrarianController::class, 'edit'])->name('librarian.edit')->middleware('can:update librarian');
    Route::put('/librarian/update/{id}', [LibrarianController::class, 'update'])->name('librarian.update');
    Route::delete('/librarian/{id}', [LibrarianController::class, 'destroy'])->name('librarian.destroy');
    Route::get('/librarian/show/{id}', [LibrarianController::class, 'show'])->name('librarian.show')->middleware('can:view librarian');
    Route::put('librarian/update_IsHidden', [LibrarianController::class, 'updateStatus'])->name('librarian.update_IsHidden');

    //Borrow
    Route::get('/borrow/index', [BorrowController::class, 'index'])->name('borrow.index');
    Route::get('/borrow/create', [BorrowController::class, 'create'])->name('borrow.create')->middleware('can:create borrow');
    Route::post('/borrow/index', [BorrowController::class, 'store'])->name('borrow.store');
    Route::get('/borrow/edit/{id}', [BorrowController::class, 'edit'])->name('borrow.edit')->middleware('can:update borrow');
    Route::put('/borrow/update/{id}', [BorrowController::class, 'update'])->name('borrow.update');
    Route::delete('/borrow/{id}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
    Route::get('/borrow/show/{id}', [BorrowController::class, 'show'])->name('borrow.show')->middleware('can:view borrow');
    Route::put('borrow/update_IsHidden', [BorrowController::class, 'updateStatus'])->name('borrow.update_IsHidden');


    //BorrowDetail
    Route::get('/borrowdetail/index', [BorrowDetailController::class, 'index'])->name('borrowdetail.index');
    Route::get('/borrowdetail/create', [BorrowDetailController::class, 'create'])->name('borrowdetail.create')->middleware('can:create borrowdetail');
    Route::post('/borrowdetail/index', [BorrowDetailController::class, 'store'])->name('borrowdetail.store');
    Route::get('/borrowdetail/edit/{id}', [BorrowDetailController::class, 'edit'])->name('borrowdetail.edit')->middleware('can:update borrowdetail');
    Route::put('/borrowdetail/update/{id}', [BorrowDetailController::class, 'update'])->name('borrowdetail.update');
    Route::delete('/borrowdetail/{id}', [BorrowDetailController::class, 'destroy'])->name('borrowdetail.destroy');
    Route::get('/borrowdetail/show/{id}', [BorrowDetailController::class, 'show'])->name('borrowdetail.show')->middleware('can:view borrowdetail');
});

Auth::routes();

// Route::get('/', [LoginController::class, 'index'])->name('login');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/unauthorized', function () {
    abort(401);
})->name('unauthorized');
