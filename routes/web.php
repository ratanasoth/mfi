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
// parameter
Route::get("/parameter", "ParameterController@index");
// country
Route::get("/country", "CountryController@index");
Route::get("/country/create", "CountryController@create");
Route::get("/country/edit/{id}", "CountryController@edit");
Route::get("/country/delete/{id}", "CountryController@delete");
Route::post("/country/save", "CountryController@save");
Route::post("/country/update", "CountryController@update");
// province
Route::get("/province", "ProvinceController@index");
Route::get("/province/create", "ProvinceController@create");
Route::get("/province/edit/{id}", "ProvinceController@edit");
Route::get("/province/delete/{id}", "ProvinceController@delete");
Route::post("/province/save", "ProvinceController@save");
Route::post("/province/update", "ProvinceController@update");
// district
Route::get("/district", "DistrictController@index");
Route::get("/district/create", "DistrictController@create");
Route::get("/district/edit/{id}", "DistrictController@edit");
Route::get("/district/delete/{id}", "DistrictController@delete");
Route::post("/district/save", "DistrictController@save");
Route::post("/district/update", "DistrictController@update");
// commune
Route::get("/commune", "CommuneController@index");
Route::get("/commune/create", "CommuneController@create");
Route::get("/commune/edit/{id}", "CommuneController@edit");
Route::get("/commune/delete/{id}", "CommuneController@delete");
Route::post("/commune/save", "CommuneController@save");
Route::post("/commune/update", "CommuneController@update");
// village
Route::get('/village', "VillageController@index");
Route::get('/village/create', "VillageController@create");
Route::get('/village/edit/{id}', "VillageController@edit");
Route::get('/village/delete/{id}', "VillageController@delete");
Route::post('/village/save', "VillageController@save");
Route::post('/village/update', "VillageController@update");
// Zone
Route::get('/zone', "ZoneController@index");
Route::get('/zone/create', "ZoneController@create");
Route::get('/zone/edit/{id}', "ZoneController@edit");
Route::get('/zone/delete/{id}', "ZoneController@delete");
Route::post('/zone/save', "ZoneController@save");
Route::post('/zone/update', "ZoneController@update");
// category
Route::get('/category', "CategoryController@index");
Route::get('/category/create', "CategoryController@create");
Route::get('/category/edit/{id}', "CategoryController@edit");
Route::get('/category/delete/{id}', "CategoryController@delete");
Route::post('/category/save', "CategoryController@save");
Route::post('/category/update', "CategoryController@update");
// product loan
Route::get('/product-loan', "ProductLoanController@index");
Route::get('/product-loan/create', "ProductLoanController@create");
Route::get('/product-loan/edit/{id}', "ProductLoanController@edit");
Route::get('/product-loan/delete/{id}', "ProductLoanController@delete");
Route::post('/product-loan/save', "ProductLoanController@save");
Route::post('/product-loan/update', "ProductLoanController@update");
// department
Route::get('/department', "DepartmentController@index");
Route::get('/department/create', "DepartmentController@create");
Route::get('/department/edit/{id}', "DepartmentController@edit");
Route::get('/department/delete/{id}', "DepartmentController@delete");
Route::post('/department/save', "DepartmentController@save");
Route::post('/department/update', "DepartmentController@update");
// position
Route::get('/position', "PositionController@index");
Route::get('/position/create', "PositionController@create");
Route::get('/position/edit/{id}', "PositionController@edit");
Route::get('/position/delete/{id}', "PositionController@delete");
Route::post('/position/save', "PositionController@save");
Route::post('/position/update', "PositionController@update");
// provision
Route::get('/provison', "ProvisionController@index");
Route::get('/provison/create', "ProvisionController@create");
Route::get('/provison/edit/{id}', "ProvisionController@edit");
Route::get('/provison/delete/{id}', "ProvisionController@delete");
Route::post('/provison/save', "ProvisionController@save");
Route::post('/provison/update', "ProvisionController@update");
// payment mood
Route::get("/payment-mood", "PaymentMoodController@index");
Route::get("/payment-mood/create", "PaymentMoodController@create");
Route::get("/payment-mood/edit/{id}", "PaymentMoodController@edit");
Route::get("/payment-mood/delete/{id}", "PaymentMoodController@delete");
Route::post("/payment-mood/save", "PaymentMoodController@save");
Route::post("/payment-mood/update", "PaymentMoodController@update");