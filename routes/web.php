<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

route::get('/',[HomeController::class,'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
route::get('redirect',[HomeController::class,'redirect']);
route::get('show_category',[AdminController::class,'show_category']);
route::get('show_add_category',[AdminController::class,'show_add_category']);
route::get('edit_category/{id}',[AdminController::class,'edit_category']);
route::delete('delete_category/{id}',[AdminController::class,'delete_category']);
route::post('add_category',[AdminController::class,'add_category']);


route::get('add_purchase_page',[AdminController::class,'add_purchase_page']);
route::post('add_purchase_data',[AdminController::class,'add_purchase_data']);
route::get('show_purchase_page',[AdminController::class,'show_purchase_page']);
route::post('add_purchase_data_jquery',[AdminController::class,'add_purchase_data_jquery']);
route::get('show_purchase_jquery',[AdminController::class,'show_purchase_jquery']);
route::delete('delete_purchase/{id}',[AdminController::class,'delete_purchase']);
route::get('edit_purchase/{id}',[AdminController::class,'edit_purchase']);

route::get('add_product_page',[AdminController::class,'add_product_page']);
route::get('show_product_page',[AdminController::class,'show_product_page']);
route::post('add_product_data',[AdminController::class,'add_product_data']);
route::post('add_product_json',[AdminController::class,'add_product_json']);
route::get('show_product_json',[AdminController::class,'show_product_json']);
route::delete('delete_product/{id}',[AdminController::class,'delete_product']);
route::get('edit_product/{id}',[AdminController::class,'edit_product']);


route::get('show_supplier_page',[AdminController::class,'show_supplier_page']);
route::post('add_supplier_json',[AdminController::class,'add_supplier_json']);
route::get('show_supplier_data_json',[AdminController::class,'show_supplier_data_json']);
route::delete('delete_supplier/{id}',[AdminController::class,'delete_supplier']);
route::get('edit_supplier/{id}',[AdminController::class,'edit_supplier']);

route::get('show_sale_page',[AdminController::class,'show_sale_page']);
route::post('add_sale_json',[AdminController::class,'add_sale_json']);
route::get('show_sale_data_json',[AdminController::class,'show_sale_data_json']);
route::delete('delete_sale/{id}',[AdminController::class,'delete_sale']);

route::get('sale_report',[AdminController::class,'report']);
route::post('sale_reports',[AdminController::class,'generateReport']);

route::get('purchase_report',[AdminController::class,'purchase_report']);
route::post('purchase_reports',[AdminController::class,'generate_purchase_Report']);


route::get('logout',[HomeController::class,'logout']);



