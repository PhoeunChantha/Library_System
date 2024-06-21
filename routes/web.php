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
use FontLib\Table\Type\name;

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
// Route::group(['middleware' => ['auth' , 'isAdmin']], function () {
Route::middleware(['auth', 'isAdmin'])->group(function () {
    //Permission
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('can:create permission');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('can:update permission');
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    //Role
    Route::resource('roles', RoleController::class);
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('can:create role');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('can:update role');
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'AddPermissionToRole'])->name('AddPermissionToRole');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'UpdatePermissionToRole'])->name('UpdatePermissionToRole');

    //Users
    Route::resource('users', UserController::class);
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('can:create user');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('can:update user');
    Route::put('users', [UserController::class, 'updateStatus'])->name('user.update_Status');
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
    // Route::group(['prefix' => 'admin', 'as' => 'borrow.'],function(){
    //     Route::get('/index', [BorrowController::class, 'index'])->name('index');
    //     Route::get('/create', [BorrowController::class, 'create'])->name('create')->middleware('can:create borrow');
    //     Route::post('/index', [BorrowController::class, 'store'])->name('store');
    //     Route::get('/edit/{id}', [BorrowController::class, 'edit'])->name('edit')->middleware('can:update borrow');
    //     Route::put('/update/{id}', [BorrowController::class, 'update'])->name('update');
    //     Route::delete('/{id}', [BorrowController::class, 'destroy'])->name('destroy');
    //     Route::get('/show/{id}', [BorrowController::class, 'show'])->name('show')->middleware('can:view borrow');
    //     Route::put('borrow/update_IsHidden', [BorrowController::class, 'updateStatus'])->name('update_IsHidden');
    //     //update borrow and borrowdetail
    //     Route::put('/updateBoth/{id}', [BorrowController::class, 'updateBoth'])->name('updateBoth');
    // });
    Route::group(['prefix' => 'borrow', 'as' => 'borrow.'], function () {
        Route::get('/index', [BorrowController::class, 'index'])->name('index');
        Route::get('/create', [BorrowController::class, 'create'])->name('create')->middleware('can:create borrow');
        Route::post('/index', [BorrowController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BorrowController::class, 'edit'])->name('edit')->middleware('can:update borrow');
        Route::put('/update/{id}', [BorrowController::class, 'update'])->name('update');
        Route::delete('/{id}', [BorrowController::class, 'destroy'])->name('destroy');
        Route::get('/show/{id}', [BorrowController::class, 'show'])->name('show')->middleware('can:view borrow');
        Route::put('borrow/update_IsHidden', [BorrowController::class, 'updateStatus'])->name('update_IsHidden');
        Route::put('/updateBoth/{id}', [BorrowController::class, 'updateBoth'])->name('updateBoth');
    });




    //BorrowDetail
    Route::group(['prefix' => 'borrowdetail', 'as' => 'borrowdetail.'], function () {
        Route::get('/index', [BorrowDetailController::class, 'index'])->name('index');
        Route::get('/create', [BorrowDetailController::class, 'create'])->name('create')->middleware('can:create borrowdetail');
        Route::post('/index', [BorrowDetailController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BorrowDetailController::class, 'edit'])->name('edit')->middleware('can:update borrowdetail');
        Route::put('/update/{id}', [BorrowDetailController::class, 'update'])->name('update');
        Route::delete('/{id}', [BorrowDetailController::class, 'destroy'])->name('destroy');
        Route::get('/show/{id}', [BorrowDetailController::class, 'show'])->name('show')->middleware('can:view borrowdetail');
    });
});

// Route::middleware(['auth', 'isAdmin'])->group(function () {

//     // Permission routes
//     Route::resource('permissions', PermissionController::class);
//     Route::get('permissions/create', [PermissionController::class, 'create'])->middleware('can:create permission');
//     Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->middleware('can:update permission');
//     Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

//     // Role routes
//     Route::resource('roles', RoleController::class);
//     Route::get('roles/create', [RoleController::class, 'create'])->middleware('can:create role');
//     Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('can:update role');
//     Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
//     Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'AddPermissionToRole']);
//     Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'UpdatePermissionToRole']);

//     // User routes
//     Route::resource('users', UserController::class);
//     Route::get('users/create', [UserController::class, 'create'])->middleware('can:create user');
//     Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('can:update user');
//     Route::put('users', [UserController::class, 'updateStatus'])->name('user.update_Status');
//     Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

//     // Dashboard route
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('front.home');

//     // Customer routes
//     Route::prefix('customer')->name('customer.')->group(function () {
//         Route::get('/index', [CustomerController::class, 'index'])->name('index');
//         Route::get('/create', [CustomerController::class, 'create'])->name('create')->middleware('can:create customer');
//         Route::post('/index', [CustomerController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit')->middleware('can:update customer');
//         Route::put('/update/{id}', [CustomerController::class, 'update'])->name('update');
//         Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('destroy');
//         Route::get('/show/{id}', [CustomerController::class, 'show'])->name('show')->middleware('can:view customer');
//         Route::put('/update_IsHidden', [CustomerController::class, 'updateStatus'])->name('update_IsHidden');
//     });

//     // CustomerType routes
//     Route::prefix('customertype')->name('customertype.')->group(function () {
//         Route::get('/index', [CustomerTypeController::class, 'index'])->name('index');
//         Route::get('/create', [CustomerTypeController::class, 'create'])->name('create')->middleware('can:create customertype');
//         Route::post('/index', [CustomerTypeController::class, 'store'])->name('store');
//         Route::delete('/{id}', [CustomerTypeController::class, 'destroy'])->name('destroy');
//     });

//     // Book routes
//     Route::prefix('book')->name('book.')->group(function () {
//         Route::get('/index', [BookController::class, 'index'])->name('index');
//         Route::get('/create', [BookController::class, 'create'])->name('create')->middleware('can:create book');
//         Route::post('/index', [BookController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [BookController::class, 'edit'])->name('edit')->middleware('can:update book');
//         Route::put('/update/{id}', [BookController::class, 'update'])->name('update');
//         Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy');
//         Route::get('/show/{id}', [BookController::class, 'show'])->name('show')->middleware('can:view book');
//         Route::put('/update_IsHidden', [BookController::class, 'updateStatus'])->name('update_IsHidden');
//     });

//     // Catalog routes
//     Route::prefix('catalog')->name('catalog.')->group(function () {
//         Route::get('/index', [CatalogController::class, 'index'])->name('index');
//         Route::get('/create', [CatalogController::class, 'create'])->name('create')->middleware('can:create catalog');
//         Route::post('/index', [CatalogController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [CatalogController::class, 'edit'])->name('edit')->middleware('can:update catalog');
//         Route::put('/update/{id}', [CatalogController::class, 'update'])->name('update');
//         Route::delete('/{id}', [CatalogController::class, 'destroy'])->name('destroy');
//         Route::get('/show/{id}', [CatalogController::class, 'show'])->name('show')->middleware('can:view catalog');
//         Route::put('/update_IsHidden', [CatalogController::class, 'updateStatus'])->name('update_IsHidden');
//     });

//     // Librarian routes
//     Route::prefix('librarian')->name('librarian.')->group(function () {
//         Route::get('/index', [LibrarianController::class, 'index'])->name('index');
//         Route::get('/create', [LibrarianController::class, 'create'])->name('create')->middleware('can:create librarian');
//         Route::post('/index', [LibrarianController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [LibrarianController::class, 'edit'])->name('edit')->middleware('can:update librarian');
//         Route::put('/update/{id}', [LibrarianController::class, 'update'])->name('update');
//         Route::delete('/{id}', [LibrarianController::class, 'destroy'])->name('destroy');
//         Route::get('/show/{id}', [LibrarianController::class, 'show'])->name('show')->middleware('can:view librarian');
//         Route::put('/update_IsHidden', [LibrarianController::class, 'updateStatus'])->name('update_IsHidden');
//     });

//     // Borrow routes
//     Route::prefix('admin/borrow')->name('admin.borrow.')->group(function () {
//         Route::get('/index', [BorrowController::class, 'index'])->name('index');
//         Route::get('/create', [BorrowController::class, 'create'])->name('create')->middleware('can:create borrow');
//         Route::post('/index', [BorrowController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [BorrowController::class, 'edit'])->name('edit')->middleware('can:update borrow');
//         Route::put('/update/{id}', [BorrowController::class, 'update'])->name('update');
//         Route::delete('/{id}', [BorrowController::class, 'destroy'])->name('destroy');
//         Route::get('/show/{id}', [BorrowController::class, 'show'])->name('show')->middleware('can:view borrow');
//         Route::put('/update_IsHidden', [BorrowController::class, 'updateStatus'])->name('update_IsHidden');
//         Route::put('/updateBoth/{id}', [BorrowController::class, 'updateBoth'])->name('updateBoth');
//     });

//     // BorrowDetail routes
//     Route::prefix('borrowdetail')->name('borrowdetail.')->group(function () {
//         Route::get('/index', [BorrowDetailController::class, 'index'])->name('index');
//         Route::get('/create', [BorrowDetailController::class, 'create'])->name('create')->middleware('can:create borrowdetail');
//         Route::post('/index', [BorrowDetailController::class, 'store'])->name('store');
//         Route::get('/edit/{id}', [BorrowDetailController::class, 'edit'])->name('edit')->middleware('can:update borrowdetail');
//         Route::put('/update/{id}', [BorrowDetailController::class, 'update'])->name('update');
//         Route::delete('/{id}', [BorrowDetailController::class, 'destroy'])->name('destroy');
//         Route::get('/show/{id}', [BorrowDetailController::class, 'show'])->name('show')->middleware('can:view borrowdetail');
//     });
// });

Auth::routes();

// Route::get('/', [LoginController::class, 'index'])->name('login');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/unauthorized', function () {
    abort(401);
})->name('unauthorized');
