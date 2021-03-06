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
Route::group(['middleware'=>['LoginCheck']],function(){
// Dashboard



Route::get('Show_dashboard',function(){
    return view('admin.dashboard_stuff');
});

Route::get('cart_details',function(){
    return view('cart_details');
});

Route::get('/cart_details',[EcommerceProductController::class,'getCartAllProducts']);


});

// Ecommerce Product
Route::post('/add-Ecommerce-product',[EcommerceProductController::class,'addEcommerceProduct']);
Route::get('/product-display',[EcommerceProductController::class,'getAllProducts']);
Route::get('/get_product_details/{pro_id}',[EcommerceProductController::class,'getProductDetails']);
Route::post('update-product/{id}',[EcommerceProductController::class,'getupdateProduct']);
Route::get('delete-product/{id}',[EcommerceProductController::class,'getdeleteHotel']);

//product suggested details page
Route::get('/detailPageProduct/{id}',[EcommerceProductController::class,'getSuggestedProductDetails']);


// Cart Count 
Route::post('/countCart/{id}',[EcommerceProductController::class,'getCountCart']);

//cart grand price total
Route::post('/CartGrandPrice',[EcommerceProductController::class,'getCartGrandPrice']);
Route::get('/cart/update-quantity/{quantity}/{id}','EcommerceProductController@updateCartQuantity');
Route::get('/checkout',[EcommerceProductController::class,'getCheckout']);
Route::post('/place-order',[EcommerceProductController::class,'getPlaceOrder']);
Route::get('/thanks',[EcommerceProductController::class,'thanks']);
Route::get('/stripe ',[EcommerceProductController::class,'getStripe']); 
Route::post('/stripe-payment',[EcommerceProductController::class,'getStripePayment']); 

//crypto Currency
Route::get('/crypto', [EcommerceProductController::class,'getCryptoCurrency']);


// excel data upload
Route::get('/import-users', [EcommerceProductController::class,'importUsers'])->name('import');
Route::post('/upload-users', [EcommerceProductController::class, 'uploadUsers'])->name('upload');

Route::get('export/', [EcommerceProductController::class, 'export'])->name('export');



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
// Route::get('fetch-data-frondend', [productController::class,'FetchDataFrondend']);



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

// Route::get('/home', 'HomeController@index')->name('home');


// invoices



// Route::get('/invoices',function(){
// return view('pdf');

// $pdf = PDF::setOptions(['isHtml5ParserEnabled'=>true, 'isRemoteEnabled'=>true])->loadview('pdf',compact('pic'));
//     return $pdf->download('invoice.pdf');
// });

Route::get('/invoices','EcommerceProductController@pdf');

Route::get('/whatsapp',function(){
    return view('whats_app');

    });

Route::get('waping/send','productController@send');