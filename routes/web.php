<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DapiController;

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


// Route::get('wel', function () {
//     return view('welcome');
// });

Route::get('test/transaction','ProjectController@details');
//any type of test overall the app
Route::get('test','ProjectController@test');

///////////Dapi\\\\\\\\p
Route::get('sendSms', 'API\DapiController@sendSms');
Route::post('exchange-Token', 'home\DapiController@exchangeToken')->name('exchangeToken');
//Route::post('verify-Token', 'home\DapiController@verifyToken')->name('verifyToken');
//////////End-dapi\\\\\\


Route::get('index', 'LocalizationController@index');
Route::get('change/lang', 'home\MainController@welcome')->name('LangChange');

//////////Front-End\\\\\\\\\\\\\\\\
Route::group([
	'namespace' => 'home',
	'middleware' => 'localization'

], function (){
	Route::get('welcome', 'MainController@welcome')->name('welcome');
	Route::get('/', 'MainController@home')->name('home');
	Route::get('aboutUs', 'MainController@aboutUs')->name('aboutUs');
	Route::get('services', 'MainController@services')->name('services');
	Route::get('privacy', 'MainController@privacy')->name('privacy');
	Route::get('security', 'MainController@security')->name('security');
	Route::get('features', 'MainController@features')->name('features');
	Route::post('save-contacts', 'MainController@contacts')->name('save-contacts');
	Route::match(['get','post'],'language/{language_id}', 'MainController@language')->name('language');
// 	Route::get('portfolio', 'PortfolioController@index')->name('portfolio');
// 	Route::get('portfolio', 'PortfolioController@index')->name('portfolio');
// 	Route::match(['get','post'],'portfolio-detail/{id}', 'PortfolioController@details')->name('portfolio-detail');

// 	/////////////Contacts\\\\\\\\\\\\\\\\\
// 	Route::get('contact-us', 'ContactController@index')->name('contact-us');
// 	Route::post('save-contacts', 'ContactController@create')->name('save-contacts');
// 	Route::post('save-footer-contacts', 'ContactController@createFooter')->name('save-footer-contacts');
// 	Route::post('register_schedule_call', 'ContactController@scheduleCall')->name('register_schedule_call');
// 	Route::get('blog-details', 'ContactController@index')->name('blog-details');
// 	Route::get('blog', 'BlogController@indexHome')->name('blog');
// 	Route::match(['get','post'],'blog-detail/{id}', 'BlogController@blogDetails')->name('blog-details');

// 	Route::get('itsourcing', 'OutSourceController@index')->name('itsourcing');
// 	//*********Abou-Us***********\\
// 	Route::match(['get','post'],'about-us', 'BlogController@teamAbout')->name('about-us');
 });


////////////Back End\\\\\\\\\
Route::group([
	'namespace' => 'admin',
], function (){
		Route::match(['get','post'],'admin', 'AdminController@login')->name('admin');
		Route::get('/logout', 'AdminController@logout');
		Route::group(['middleware'=> ['auth','admin']], function(){
		Route::get('dashboard', 'AdminController@index')->name('dashboard');
		Route::get('settings', 'AdminController@settings');
		Route::get('my-profile', 'AdminController@my_profile');
		Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
		Route::get('/admin/settings', 'AdminController@settings');
		   //**********Users************\\
		Route::match(['get','post'],'adduser','UsersController@addUser');
		Route::match(['get','post'],'saveuser','UsersController@saveuser');
		Route::get('view-users','UsersController@viewUsers')->name('view.users');
		Route::match(['get','post'],'edit-user/{id}','UsersController@editUser');
		Route::match(['get','post'],'update-user','UsersController@updateUser');
		Route::any('delete-user/{id}','UsersController@deleteUser');
		Route::get('search-user', 'UsersController@search')->name('search.user');
	    //**********Category************\\
	    Route::match(['get','post'],'searchCategories','CategoryController@searchCategories');
	    Route::match(['get','post'],'add-category','CategoryController@addCategory');
		Route::match(['get','post'],'create-category', 'CategoryController@create')->name('create-feature');
	    Route::match(['get','post'],'edit-category/{id}','CategoryController@editCategory');
	    Route::match(['get','post'],'delete-category/{id}','CategoryController@deleteCategory');
	    Route::get('view-categories','CategoryController@viewCategories');
		    //**********Contacts************\\
		Route::get('contacts', 'ContactUsController@index')->name('contacts');
		Route::get('delete-contact/{id}', 'ContactUsController@deleteContact')->name('delete-contact');
		Route::get('add-mail/{id}', 'ContactUsController@addMail')->name('add-mail');
		Route::post('send-mail', 'ContactUsController@sendEmail')->name('send-mail');
		    //**********Preferences************\\
		Route::match(['get','post'],'preferences', 'PreferenceController@index')->name('preferences');
		Route::match(['get','post'],'preference-create/{id}', 'PreferenceController@create')->name('preference-create');
		    //**********Preferences about-us************\\
		Route::match(['get','post'],'about', 'PreferenceController@about')->name('about');
		Route::match(['get','post'],'about-create/{id}', 'PreferenceController@aboutCreate')->name('about-create');
		//**********Preferences app-features************\\
		Route::match(['get','post'],'feature', 'PreferenceController@feature')->name('feature');
		Route::match(['get','post'],'feature-create/{id}', 'PreferenceController@featureCreate')->name('feature-create');
		    //**********news************\\
		Route::match(['get','post'],'news', 'NewsLetterController@index')->name('news');
		    //**********Faqs************\\
		Route::match(['get','post'],'add-faq', 'FaqsController@addFaq')->name('add-faq');
		Route::match(['get','post'],'create-faq', 'FaqsController@create')->name('add-faq');
		Route::match(['get','post'],'view-faqs', 'FaqsController@viewFaq')->name('view-faqs');
		Route::match(['get','post'],'edit-faq/{id}','FaqsController@editFaq')->name('edit-faq');
		Route::match(['get','post'],'delete-faq/{id}','FaqsController@deleteFaq')->name('delete-faq');
		    //**********Languages************\\
		Route::match(['get','post'],'add-language', 'LanguageController@addLanguage')->name('add-language');
		Route::match(['get','post'],'view-language', 'LanguageController@viewLanguage')->name('view-language');
		Route::match(['get','post'],'edit-language/{language_id}','LanguageController@editLanguage')->name('edit-language');
		Route::match(['get','post'],'delete-language/{language_id}','LanguageController@deleteLanguage')->name('delete-language');
			//**********Slider************\\
		Route::match(['get','post'],'add-slider', 'SliderController@addSlider')->name('add-slider');
		Route::match(['get','post'],'create-slider', 'SliderController@create')->name('add-slider');
		Route::match(['get','post'],'view-slider', 'SliderController@viewSlider')->name('view-slider');
		Route::match(['get','post'],'edit-slider/{id}','SliderController@editSlider')->name('edit-slider');
		Route::match(['get','post'],'delete-slider/{id}','SliderController@deleteSlider')->name('delete-slider');

		//*********** App Slider **********\\

		Route::match(['get','post'],'add-app-slider', 'SliderController@addAppSlider')->name('add-app-slider');
		Route::match(['get','post'],'create-app-slider', 'SliderController@appCreate')->name('add-app-slider');
		Route::match(['get','post'],'view-app-slider', 'SliderController@viewAppSlider')->name('view-app-slider');
		Route::match(['get','post'],'edit-app-slider/{id}','SliderController@editAppSlider')->name('edit-app-slider');
		Route::match(['get','post'],'delete-app-slider/{id}','SliderController@deleteAppSlider')->name('delete-app-slider');

		   //*********Clients***********\\
		Route::match(['get','post'],'view-clients', 'ClientController@index')->name('view-clients');
		Route::match(['get','post'],'add-clients', 'ClientController@addClient')->name('add-clients');
		Route::match(['get','post'],'create-client', 'ClientController@create')->name('create-client');
		Route::match(['get','post'],'edit-client/{id}','ClientController@editClient')->name('edit-client');
		Route::match(['get','post'],'delete-client/{id}','ClientController@deleteClient')->name('delete-client');
			//*********Testimonials***********\\
		Route::match(['get','post'],'view-testimonial', 'TestimonialController@index')->name('view-developer');
		Route::match(['get','post'],'add-testimonial', 'TestimonialController@addTestimonial')->name('add-testimonial');
		Route::match(['get','post'],'create-testimonial', 'TestimonialController@create')->name('create-developer');
		Route::match(['get','post'],'edit-testimonial/{id}','TestimonialController@editTestimonial')->name('edit-developer');
		Route::match(['get','post'],'delete-testimonial/{id}','TestimonialController@deleteTestimonial')->name('delete-developer');
			//*********Pages***********\\
		Route::match(['get','post'],'view-page', 'PagesController@index')->name('view-developer');
		Route::match(['get','post'],'add-page', 'PagesController@addPage')->name('add-testimonial');
		Route::match(['get','post'],'create-page', 'PagesController@create')->name('create-developer');
		Route::match(['get','post'],'edit-page/{id}','PagesController@editPage')->name('edit-developer');
		Route::match(['get','post'],'delete-page/{id}','PagesController@deletePage')->name('delete-developer');
		//*********Features***********\\
		Route::match(['get','post'],'view-feature', 'FeatureController@index')->name('view-service');
		Route::match(['get','post'],'add-feature', 'FeatureController@addFeature')->name('add-feature');
		Route::match(['get','post'],'create-feature', 'FeatureController@create')->name('create-feature');
		Route::match(['get','post'],'edit-feature/{id}','FeatureController@editFeature')->name('edit-feature');
		Route::match(['get','post'],'delete-feature/{id}','FeatureController@deleteFeature')->name('delete-feature');
		//**********Team************\\
		Route::match(['get','post'],'add-team', 'TeamMateController@addTeam')->name('add-team');
		Route::match(['get','post'],'view-team', 'TeamMateController@viewTeam')->name('view-team');
		Route::match(['get','post'],'edit-team/{id}','TeamMateController@editTeam')->name('edit-team');
		Route::match(['get','post'],'delete-team/{id}','TeamMateController@deleteTeam')->name('delete-team');
		Route::match(['get','post'],'delete-team/{id}','TeamMateController@deleteTeam')->name('delete-team');
		
		//********News***************\\
		Route::match(['get','post'],'add-news', 'NewsLetterController@addNews')->name('add-news');



    });
});

