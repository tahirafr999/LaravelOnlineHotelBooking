<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\CategoryController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\productController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EcommerceProductController;
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


Route::get('/', [productController::class,'FetchDataFrondend']);




// Dashboard

Route::get('Show_dashboard',function(){
    return view('admin.dashboard_stuff');
});


// Ecommerce Product
Route::post('/add-Ecommerce-product',[EcommerceProductController::class,'addEcommerceProduct']);


    // products
Route::get('add_product',function(){
return view('admin.products.add_product');
});
Route::view('manage_product', 'admin.products.manage_products');

// add hotel
Route::view('add_hotel', 'admin.hotel.add_hotel');
Route::post('/employee',[productController::class,'store']);
Route::get('manage_hotel',[productController::class,'FetchHotel']);
// Route::get('edit-hotel-data/{id}',[productController::class,'EditHotel']);
Route::get('edit-hotel/{hot_id}',[productController::class,'EditHotel']);
Route::post('update-employee/{id}',[productController::class,'UpdateHotel']);
Route::get('delete-hotel/{id}',[productController::class,'DeleteHotel']);
 

// Route to get data in frondend.
Route::get('fetch-data-frondend', [productController::class,'FetchDataFrondend']);



// category
Route::view('add_category','admin.category.add_category');
Route::view('list_category','admin.category.manage_category'); //show the categories in the nav bar
// Route::post('/get-all-category','CategoryController@store');
Route::post('/category_added','CategoryController@store');
Route::get('/category_display',[CategoryController::class, 'index']);
Route::post('/get_category_details',[CategoryController::class, 'GetCategoryDetails']);
Route::post('/updateCategoryDetails/{id}',[CategoryController::class, 'updateCategoryDetails']);
Route::post('getcategorybyid', 'CategoryController@edit');



// registarion
Route::view('registration', 'final_year_project.registration.registration');
// register new user
Route::post('registration_user',[RegistrationController::class,'store']);
Route::post('login_account',[RegistrationController::class,'login_sore']);
Route::view('FinalYearprojectLogin', 'final_year_project.registration.login');









Route::resource('ajax-crud', 'AjaxCrudController');

Route::post('ajax-crud/update', 'AjaxCrudController@update')->name('ajax-crud.update');

Route::get('ajax-crud/destroy/{id}', 'AjaxCrudController@destroy');



Route::get('/countries-list',[CountriesController::class, 'index'])->name('countries.list');
Route::post('/add-country',[CountriesController::class,'addCountry'])->name('add.country');
Route::get('/getCountriesList',[CountriesController::class, 'getCountriesList'])->name('get.countries.list');
Route::post('/getCountryDetails',[CountriesController::class, 'getCountryDetails'])->name('get.country.details');
Route::post('/updateCountryDetails',[CountriesController::class, 'updateCountryDetails'])->name('update.country.details');
Route::post('/deleteCountry',[CountriesController::class,'deleteCountry'])->name('delete.country');
Route::post('/deleteSelectedCountries',[CountriesController::class,'deleteSelectedCountries'])->name('delete.selected.countries');


// route to book a hotel
Route::view('want-to-book','final_year_project.want_to_book');
// my hotel add
Route::post('hotel_data',[HotelController::class,'store']);



Auth::routes(['verify' => true]); 


Route::get('login/{MailData}',[AuthController::class, 'verify_token']);

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('submit-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('submit-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// invoices

Route::get('/invoices',function(){
// return view('pdf');

$pdf = PDF::loadView('pdf')->setOptions(['defaultFont' => 'sans-serif']);
    return $pdf->download('invoice.pdf');
});


Route::get('/whatsapp',function(){
    return view('whats_app');

    });

Route::get('waping/send','productController@send');