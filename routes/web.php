<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/register', function () {
    return redirect('/');
});

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('medicineCategories', MedicineCategoryController::class);
    Route::resource('inventories', InventoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('prices', PriceController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('saleDetails', SaleDetailController::class);
    Route::resource('miscExpenditures', MiscExpenditureController::class);
    Route::post('/get-price','SaleController@getprice')->name('sales.price');
    Route::post('/order-store','SaleController@orderStore')->name('order.store');

    Route::post('/getAutoSuggestProduct','ProductController@getAutoSuggestProduct')->name('getAutoSuggestProduct.name');
    Route::post('/getAutoSuggestGeneric','ProductController@getAutoSuggestGeneric')->name('getAutoSuggestGeneric.name');
//    Route::get('/getUniqueProduct', 'ProductController@getUniqueProduct')->name('getUniqueProduct.name');

    Route::post('/getAutoSuggestInvntryProduct','InventoryController@getAutoSuggestInvntryProduct')->name('getAutoSuggestInvntryProduct.name');
    Route::post('/getAutoSuggestInvntryGeneric','InventoryController@getAutoSuggestInvntryGeneric')->name('getAutoSuggestInvntryGeneric.name');
    Route::post('/getAutoSuggestProductId','InventoryController@getAutoSuggestProductId')->name('getAutoSuggestProductId.name');
    Route::post('/getInvntryProductNameById','InventoryController@getInvntryProductNameById')->name('getInvntryProductNameById');
    Route::get('/getInventoryProduct', 'InventoryController@getInventoryProduct');


    Route::get('/stock_available_report','ReportController@stock_available_report')->name('stock_available_report');
    Route::get('/search_stock_available', 'ReportController@search_stock_available');

    Route::get('/stock_unavailable_report','ReportController@stock_unavailable_report')->name('stock_unavailable_report');
    Route::get('/search_stock_unavailable', 'ReportController@search_stock_unavailable');

    Route::get('/date_expired_report','ReportController@date_expired_report')->name('date_expired_report');
    Route::get('/search_date_expired_product', 'ReportController@search_date_expired_product');

    Route::get('/datewise_sales_report','ReportController@datewise_sales_report')->name('datewise_sales_report');
    Route::get('/search_datewise_sales_report', 'ReportController@search_datewise_sales_report');

    Route::get('/datewise_purchase_report','ReportController@datewise_purchase_report')->name('datewise_purchase_report');
    Route::get('/search_datewise_purchase_report', 'ReportController@search_datewise_purchase_report');

    Route::get('/generate-pdf/{sales_id}', 'PDFController@generatePDF');


});
