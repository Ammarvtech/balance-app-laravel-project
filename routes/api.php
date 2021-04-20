<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\admin\FeatureController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\PreferencesController;
use App\Http\Controllers\API\DapiController;
use App\Http\Controllers\API\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('register', [AuthController::class, 'register']);
// Route::post('login', [AuthController::class, 'login']);

// Route::apiResource('projects', ProjectController::class)->middleware('auth:api');


    ///////////////***Dapi Api's***\\\\\\\\\\\\\\\\\\\\\\sendSms
	Route::post('sendSms', 'API\DapiController@sendSms');
	Route::post('accountVerify', 'API\UserController@emailVerify');
	Route::post('user/forgetPassword', 'API\UserController@forgetPassword');
    ///////////////////Authenticaton\\\\\\\\\\\\\\\\\\\\
	Route::post('user/login', 'API\UserController@login');
	Route::post('user/register', 'API\UserController@register');

	///*****\\Mobile app Sliders//*****\\\
	Route::get('app/slider/show', 'API\AppSliderController@index');
	Route::get('app/slider/show/{language}', 'API\AppSliderController@allSliders');
	Route::get('app/slider/show/{id}/{language}', 'API\AppSliderController@show');
	Route::post('app/slider/store', 'API\AppSliderController@store');
	Route::post('app/slider/update/{id}','API\AppSliderController@update');
	Route::delete('app/slider/delete/{id}','API\AppSliderController@destroy');

	Route::group(['middleware' => 'auth:api'], function(){   
	Route::post('dapi', 'API\DapiController@dapiAPI');
	Route::post('logout','API\UserController@logoutApi');
	Route::post('user/updateProfile', 'API\UserController@updateProfile');
	Route::post('user/details', 'API\UserController@details');
	Route::post('user/changePassword', 'API\UserController@changePassword');
		    ///*****\\Wallet//*****\\\
	Route::get('wallet/show', 'API\WalletController@walletDetails');
    ///*****\\languages//*****\\\
	Route::get('languages/show', 'API\PreferencesController@languages');
	Route::post('languages/store', 'API\PreferencesController@store');
	Route::post('languages/delete', 'API\PreferencesController@delete');
	Route::get('languages/show/{language}', 'API\PreferencesController@languagesId');
    ///*****\\labels//*****\\\	
    Route::group([
    'middleware' => 'localization'
    
    ], function (){

    Route::post('labels/show', 'API\TranslationController@labels');
    Route::post('labels/{language}', 'API\TranslationController@labelsName');
    });
    ///////////////////APP-Dashboard\\\\\\\\\\\\\\\\\\\\ 
	Route::post('userInfo', 'API\DashboardController@details');
	Route::get('bankAccounts', 'API\DapiController@bankAccount');
	Route::post('updateBankAccount', 'API\DapiController@updateBankAccount');
	Route::post('home/data', 'API\DashboardController@homeData');
	Route::post('wallet/data', 'API\DashboardController@walletData');
	Route::post('expenses', 'API\DashboardController@expenses');
	Route::post('balance/expenses', 'API\DashboardController@expenses');
	Route::post('categories', 'API\DashboardController@categoriesShow');
	Route::post('categories/store', 'API\DashboardController@CategoryStore');
    ///*****\\APP-Settings//*****\\\
	Route::post('settings', 'API\SettingController@settings');
	Route::post('updateSettings', 'API\SettingController@updateSettings');
    //notifications
    Route::post('save-token', 'API\DashboardController@saveToken')->name('save-token');
	//Route::get('notificationsHome', 'API\DashboardController@notificationsHome')->name('notificationsHome');
	Route::post('send-notification', 'API\DashboardController@sendNotification')->name('send.notification');
	///*****\\APP-Transactions//*****\\\
	Route::post('subscriptions/details', 'API\TranslationController@details');
	Route::post('update', 'API\TranslationController@update');
	Route::post('transaction/details', 'API\TranslationController@transactionDetails');
	Route::post('transaction/delete', 'API\TranslationController@transactionDelete');
	Route::post('transaction/imageDelete', 'API\ChargeController@transactionImageDelete');  
	///temp-transactions
	Route::get('tempDetails/details', 'API\TranslationController@tempDetails');
	Route::post('tempDetails/update', 'API\TranslationController@tempDetailsUpdate');

	///reports
	Route::post('reports/details', 'API\TranslationController@reports');
	//Route::post('tempDetails/update', 'API\TranslationController@tempDetailsUpdate');   
	///*****\\APP-Charge//*****\\\
	Route::post('create/charge', 'API\ChargeController@createCharge');
	Route::post('save/transaction', 'API\ChargeController@saveTransaction');
	Route::post('transaction/image', 'API\ChargeController@transactionImage');
	Route::post('transaction/update', 'API\ChargeController@transactionUpdate');
	///*****\\APP-Subscription//*****\\\
	Route::post('subscription/details', 'API\SubscriptionController@details');
	Route::post('subscribe', 'API\SubscriptionController@subscribe');
	Route::post('cancel/subscriptions', 'API\SubscriptionController@cancelSubscription');
	Route::post('add/card', 'API\SubscriptionController@addCard');
	Route::post('card/lists', 'API\SubscriptionController@viewCards');
    ///*****\\Features//*****\\\
	Route::get('feature/show', 'API\FeatureController@index');
	Route::get('feature/show/{language}', 'API\FeatureController@AllFeatures');
	Route::get('feature/show/{id}/{language}', 'API\FeatureController@featureById');
	Route::post('feature/store', 'API\FeatureController@store')->name('create-feature');
	Route::post('feature/update/{id}','API\FeatureController@update');
	Route::delete('feature/delete/{id}','API\FeatureController@destroy');
    ///*****\\Contacts//*****\\\
	Route::get('contact/show', 'API\ContactController@index');
	Route::get('contact/show/{id}', 'API\ContactController@show');
	Route::post('contact/store', 'API\ContactController@store');
	Route::delete('contact/delete/{id}','API\ContactController@destroy');
    ///*****\\Categories//*****\\\
	Route::get('category/show', 'API\CategoryController@index');
	Route::get('category/show/{language}', 'API\CategoryController@allCategories');
	Route::get('category/show/{id}/{language}', 'API\CategoryController@show');
	Route::post('category/store', 'API\CategoryController@store');
	Route::post('category/update/{id}','API\CategoryController@update');
	Route::delete('category/delete/{id}','API\CategoryController@destroy');
    ///*****\\Sliders//*****\\\
	Route::get('slider/show', 'API\SliderController@index');
	Route::get('slider/show/{language}', 'API\SliderController@allSliders');
	Route::get('slider/show/{id}/{language}', 'API\SliderController@show');
	Route::post('slider/store', 'API\SliderController@store');
	Route::post('slider/update/{id}','API\SliderController@update');
	Route::delete('slider/delete/{id}','API\SliderController@destroy');


    ///*****\\Faqs//*****\\\
	Route::get('faq/show', 'API\FaqController@index');
	Route::get('faq/show/{language}', 'API\FaqController@allFaqs');
	Route::get('faq/show/{id}/{language}', 'API\FaqController@show');
	Route::post('faq/store', 'API\FaqController@store');
	Route::post('faq/update/{id}','API\FaqController@update');
	Route::delete('faq/delete/{id}','API\FaqController@destroy');
    ///*****\\Testimonials//*****\\\
	Route::get('testimonial/show', 'API\TestimonialController@index');
	Route::get('testimonial/show/{language}', 'API\TestimonialController@allTestimonials');
	Route::get('testimonial/show/{id}/{language}', 'API\TestimonialController@show');
	Route::post('testimonial/store', 'API\TestimonialController@store');
	Route::post('testimonial/update/{id}','API\TestimonialController@update');
	Route::delete('testimonial/delete/{id}','API\TestimonialController@destroy');
	    ///*****\\Preferences//*****\\\
	Route::get('preferences/show', 'API\PreferencesController@index');
	Route::get('preferences/show/{language}', 'API\PreferencesController@allPreferences');
    

});