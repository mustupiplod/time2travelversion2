<?php

//for admin
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CmsPagesController as AdminCMSController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\FeaturedCityController;



//for web
use App\Http\Controllers\webapi\HomeController;



//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
##Front User Authentication Route
Route::post('/login',[UserLoginController::class,'postLogin']);
Route::post('/register',[UserLoginController::class,'register']);
Route::get('/logout',[UserLoginController::class,'logout']);
Route::post('/check-email',[UserLoginController::class,'checkEmail']);
Route::get('auth/google',[UserLoginController::class,'redirectToGoogle']);
Route::get('/auth/google/callback',[UserLoginController::class,'handleGoogleCallback']);
Route::get('auth/facebook',[UserLoginController::class,'redirectToFacebook']);
Route::get('/auth/facebook/callback',[UserLoginController::class,'handleFacebookCallback']);

Route::get('/forget-password',[UserLoginController::class,'forgetPasswordView']);
Route::post('/forget-password',[UserLoginController::class,'forgetPassword']);
Route::get('/password/reset/{token}',[UserLoginController::class,'resetPassword']);
Route::post('/update-forget-password',[UserLoginController::class,'updateForgotPassword']);




Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('user')->group(function () {


});

//cms pages route
Route::get('/about-us', [CmsPagesController::class, 'about_us'])->name('user.about_us');

//submit contact us form
Route::post('/contact-us/store', [ContactUsController::class, 'store'])->name('user.contact.store');





//admin routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('/signin', [AdminLoginController::class, 'admLogin'])->name('admin.signin');
    Route::get('forgot-password', [AdminLoginController::class, 'forgotPass'])->name('admin.forgot_password');
    Route::post('forgot-pass', [AdminLoginController::class, 'forgotPassMail'])->name('admin.forgot_pass');
    Route::get('reset-password/{token}', [AdminLoginController::class, 'checkLink']);
    Route::post('reset-password', [AdminLoginController::class, 'newPassword'])->name('admin.new_pwd');
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('logout', [AdminLoginController::class, 'adminLogout'])->name('admin.logout');
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dash');
    Route::get('change-password', [AdminLoginController::class, 'changePassword'])->name('admin.change_pass');

    //categories
    Route::get('category-list', [CategoryController::class, 'index'])->name('admin.categ_list');
    Route::get('category-add', [CategoryController::class, 'create'])->name('admin.categ_add');
    Route::post('category-store', [CategoryController::class, 'store'])->name('admin.categ_store');
    Route::get('category-edit/{id}', [CategoryController::class, 'editCateg'])->name('admin.categ_edit');
    Route::post('category-update', [CategoryController::class, 'updateCateg'])->name('admin.categ_update');
    Route::get('category-delete', [CategoryController::class, 'deleteCateg'])->name('admin.categ_delete');

    //user mnagement
    Route::get('user-list', [UserManagementController::class, 'user_list'])->name('admin.user_list');
    Route::get('user-active', [UserManagementController::class, 'user_active'])->name('admin.user_active');
    Route::get('user-export', [UserManagementController::class, 'export_data'])->name('admin.user_export');


    // Faqs
    Route::get('faq-add', [FaqController::class, 'addFaq'])->name('admin.add_faq');
    Route::get('faq-list', [FaqController::class, 'index'])->name('admin.list_faq');
    Route::get('faq-edit/{id}', [FaqController::class, 'editFaq'])->name('admin.edit_faq');
    Route::post('faq-create', [FaqController::class, 'storeFaq'])->name('admin.create_faq');
    Route::post('faq-update', [FaqController::class, 'updateFaq'])->name('admin.update_faq');
    Route::post('faq-delete', [FaqController::class, 'deteleFaq'])->name('admin.delete_faq');

    // CMS Pages
    Route::get('cms-page-add', [AdminCMSController::class, 'addCmsPage'])->name('admin.add_cms_page');
    Route::get('cms-page-list', [AdminCMSController::class, 'index'])->name('admin.list_cms_page');
    Route::get('cms-page-view-edit/{id}', [AdminCMSController::class, 'editCmsPage'])->name('admin.edit_cms_page');
    Route::post('cms-page-create', [AdminCMSController::class, 'storeCmsPage'])->name('admin.create_cms_page');
    Route::post('cms-page-update', [AdminCMSController::class, 'updateCmsPage'])->name('admin.update_cms_page');




    //display contact us list
    Route::get('contact-list', [ContactUsController::class, 'admin_list'])->name('admin.contact-list');

    //routes to add hotels
    Route::group(['prefix' => 'hotel'],function() {
        Route::get('list',[HotelController::class,'list'])->name('hotel.list');
        Route::get('add',[HotelController::class,'create'])->name('hotel.create');
        Route::post('store',[HotelController::class,'store'])->name('hotel.store');

    });

    Route::group(['prefix' => 'flight'],function() {
        Route::get('list',[FlightController::class,'list'])->name('flight.list');
        Route::get('add',[FlightController::class,'create'])->name('flight.create');
        Route::post('store',[FlightController::class,'store'])->name('flight.store');

    });

    Route::group(['prefix' => 'featured-city'],function() {
        Route::get('list',[FeaturedCityController::class,'list'])->name('featured_city.list');
        Route::get('add',[FeaturedCityController::class,'create'])->name('featured_city.create');
        Route::post('store',[FeaturedCityController::class,'store'])->name('featured_city.store');
        Route::get('status-change',[FeaturedCityController::class,'change_status'])->name('featured_city.change_status');

    });




});

