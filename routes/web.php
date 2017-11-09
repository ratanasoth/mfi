<?php

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
header('Access-Control-Allow-Headers: X-Requested-With, origin, content-type');
Route::get('/', function () {
    return redirect('/login');
});
// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");
Route::get('/user/branch/{id}', "UserController@branch");
Route::post('/user/branch/save', "UserController@add_branch");
Route::get('/user/branch/delete/{id}', "UserController@delete_branch");
// role
Route::get("/role", "RoleController@index");
Route::get("/role/create", "RoleController@create");
Route::get("/role/edit/{id}", "RoleController@edit");
Route::get("/role/delete/{id}", "RoleController@delete");
Route::post("/role/save", "RoleController@save");
Route::post("/role/update", "RoleController@update");
//Auth::routes();
Route::auth();
Route::get('/home', 'HomeController@index')->name('home');
// sale
Route::get('/sale', "SaleController@index");
// pos
Route::get('/pos', "POSController@index");
// purchase
Route::get("/purchase", "PurchaseController@index");
// inventory
Route::get("/inventory", "InventoryController@index");
// settings
Route::get('/setting', "SettingController@index");
// Accounting
Route::get('/accounting', "AccountingController@index");
// company
Route::get('/company', "CompanyController@index");
Route::get('/company/detail/{id}', "CompanyController@detail");
Route::get('/company/create', "CompanyController@create");
Route::get('/company/delete/{id}', "CompanyController@delete");
Route::get('/company/edit/{id}', "CompanyController@edit");
Route::post('/company/save', "CompanyController@save");
Route::post('/company/update', "CompanyController@update");
// branch
Route::get("/branch", "BranchController@index");
Route::get("/branch/create", "BranchController@create");
Route::get("/branch/edit/{id}", "BranchController@edit");
Route::get("/branch/delete/{id}", "BranchController@delete");
Route::post("/branch/save", "BranchController@save");
Route::post("/branch/update", "BranchController@update");
// category
Route::get("/category", "CategoryController@index");
Route::get("/category/create", "CategoryController@create");
Route::get("/category/edit/{id}", "CategoryController@edit");
Route::get("/category/delete/{id}", "CategoryController@delete");
Route::post("/category/save", "CategoryController@save");
Route::post("/category/update", "CategoryController@update");

/// warehouse
Route::get("/warehouse", "WarehouseController@index");
Route::get("/warehouse/create", "WarehouseController@create");
Route::get("/warehouse/edit/{id}", "WarehouseController@edit");
Route::get("/warehouse/delete/{id}", "WarehouseController@delete");
Route::post("/warehouse/save", "WarehouseController@save");
Route::post("/warehouse/update", "WarehouseController@update");

// unit
Route::get("/unit", "UnitController@index");
Route::get("/unit/create", "UnitController@create");
Route::get("/unit/edit/{id}", "UnitController@edit");
Route::get("/unit/delete/{id}", "UnitController@delete");
Route::post("/unit/save", "UnitController@save");
Route::post("/unit/update", "UnitController@update");

// supplier
Route::get("/supplier", "SupplierController@index");
Route::get("/supplier/create", "SupplierController@create");
Route::get("/supplier/edit/{id}", "SupplierController@edit");
Route::get("/supplier/delete/{id}", "SupplierController@delete");
Route::post("/supplier/save", "SupplierController@save");
Route::post("/supplier/update", "SupplierController@update");

// product
Route::get("/product", "ProductController@index");
Route::get("/product/create", "ProductController@create");
Route::get("/product/detail/{id}", "ProductController@detail");
Route::get("/product/edit/{id}", "ProductController@edit");
Route::get("/product/delete/{id}", "ProductController@delete");
Route::post("/product/save", "ProductController@save");
Route::post("/product/update", "ProductController@update");
