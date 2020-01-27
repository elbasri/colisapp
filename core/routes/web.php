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

Route::get('/', 'FrontController@index')->name('front.index');
Route::get('aboutus', 'FrontController@aboutus')->name('front.aboutus');
Route::get('contactus', 'FrontController@contactus')->name('front.contactus');
Route::get('faq', 'FrontController@faq')->name('front.faq');
Route::post('visitor/message', 'FrontController@visitorMessage')->name('visitor.message');
Route::post('search/colis', 'FrontController@searchColis')->name('search.colis');

Route::group(['middleware' => 'CacheRemover'], function() {

    Route::group(['prefix' => 'admin'], function () {

        Route::group(['middleware' => 'CheckLogin'], function() {

            Route::get('/', function () {
                return view('admin/login');
            })->name('admin');

            Route::post('authenticate', 'LoginController@authenticate')->name('admin.authenticate');
        });

        Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {

            Route::post('logout', function () {
                Auth::guard('admin')->logout();
                return redirect('admin');
            });
             
            /*
             * Authorise route list
             */
            //change password route
            Route::get('changePassword', 'AdminController@changePassword')->name('changepassform');
            Route::put('changePassword', 'AdminController@updatePassword')->name('changepassssubmit');
            //profile route
            Route::get('profile', 'AdminController@profileView')->name('admin.profile');
            Route::put('profile', 'AdminController@updateProfile');
            //basic setting route list
            Route::get('basicSetting', 'GeneralSettingController@basicSetting')->name('admin.basicSetting');
            Route::put('basicSetting/{basicSetting}', 'GeneralSettingController@updateBasicSetting')->name('admin.basicSettingUpdate');
            //sms setting route list
            Route::get('smsSetting', 'GeneralSettingController@smsSetting')->name('admin.smsSetting');
            Route::put('smsSetting/{smsSetting}', 'GeneralSettingController@updateSmsSetting')->name('admin.smsSettingUpdate');
            //email setting route list
            Route::get('emailSetting', 'GeneralSettingController@emailSetting')->name('admin.emailSetting');
            Route::put('emailSetting/{emailSetting}', 'GeneralSettingController@updateEmailSetting')->name('admin.emailSettingUpdate');

            //colis unit info route list
            Route::resource('colis/unit', 'UnitController');
            //colis type info route list
            Route::resource('colis/type', 'ColisTypeController');

            //Branch Info
            Route::resource('branch', 'BranchController');

            //Branch Manager Info & customer view route 
            Route::resource('branchmanager', 'BranchManagerController');
            Route::post('branchmanager/changepassword', 'BranchManagerController@changePassword')->name('branchmanager.changepassword');
            Route::get('customer/{branch}', 'UserController@allUserList')->name('admin.branch.customer');

            //dashboard
            Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');

            //company income route
            Route::get('company/income', 'BranchManagerController@companyIncome')->name('admin.company.income');

            //branch wise company income route
            Route::get('branch/income/{branch}', 'BranchManagerController@branchIncome')->name('admin.branch.income');
            Route::get('branch/income/{branch}/{date}', 'BranchManagerController@dateWiseBranchIncome')->name('admin.branch.income.date');
            Route::get('customer/branch/income/{branch}/{customer}', 'BranchManagerController@customerWiseBranchIncome')->name('admin.branch.income.customer');

            //frontend setting route list
            Route::get('frontend/testimonial', 'FrontendSettingController@testimonial')->name('frontend.testimonial');
            Route::put('frontend/testimonial', 'FrontendSettingController@testimonialUpdate');
            Route::post('frontend/testimonial/store', 'FrontendSettingController@storeNewTestimonial')->name('frontend.storeTestimonial');
            Route::put('frontend/testimonial/{testimonial}', 'FrontendSettingController@updateNewTestimonial')->name('frontend.updateTestimonial');
            Route::delete('frontend/testimonial/{testimonial}/delete', 'FrontendSettingController@deleteTestimonial')->name('frontend.deleteTestimonial');
            Route::get('frontend/logoicon', 'FrontendSettingController@logoicon')->name('frontend.logoicon');
            Route::put('frontend/logoicon', 'FrontendSettingController@logoiconUpdate');
            Route::get('frontend/social', 'FrontendSettingController@social')->name('frontend.social');
            Route::post('frontend/social', 'FrontendSettingController@socialAdd');
            Route::put('frontend/social/{social}', 'FrontendSettingController@socialUpdate')->name('frontend.socialUpdate');
            Route::delete('frontend/social/{social}', 'FrontendSettingController@socialDestroy')->name('frontend.socialDestroy');
            Route::get('frontend/background', 'FrontendSettingController@background')->name('frontend.background');
            Route::put('frontend/background', 'FrontendSettingController@backgroundUpdate');
            Route::get('frontend/headertext', 'FrontendSettingController@headertextsetting')->name('frontend.headertext');
            Route::put('frontend/headertext/{setting}', 'FrontendSettingController@headertextsettingUpdate')->name('frontend.headertextupdate');
            Route::get('frontend/coliscount', 'FrontendSettingController@coliscount')->name('frontend.coliscount');
            Route::put('frontend/coliscount/{setting}', 'FrontendSettingController@coliscountUpdate')->name('frontend.coliscountupdate');
            Route::get('frontend/aboutus', 'FrontendSettingController@aboutus')->name('frontend.aboutus');
            Route::PUT('frontend/aboutus', 'FrontendSettingController@updateAboutUs');
            Route::get('frontend/contactus', 'FrontendSettingController@contactus')->name('frontend.contactus');
            Route::PUT('frontend/contactus', 'FrontendSettingController@updateContactus');
            Route::get('frontend/footer', 'FrontendSettingController@footer')->name('frontend.footer');
            Route::PUT('frontend/footer', 'FrontendSettingController@updateFooter');
            Route::get('frontend/searchcolis', 'FrontendSettingController@searchcolis')->name('frontend.searchcolis');
            Route::put('frontend/searchcolis', 'FrontendSettingController@searchcolisUpdate');
            //faq crud
            Route::get('frontend/faq', 'FrontendSettingController@faq')->name('frontend.faq');
            Route::post('frontend/faq/store', 'FrontendSettingController@storeNewFaq')->name('frontend.storeFaq');
            Route::put('frontend/faq/{faq}', 'FrontendSettingController@updateNewFaq')->name('frontend.updateFaq');
            Route::delete('frontend/faq/{faq}/delete', 'FrontendSettingController@deleteFaq')->name('frontend.deleteFaq');

            //service section route list
            Route::get('frontend/services', 'FrontendSettingController@services')->name('frontend.services');
            Route::put('frontend/services', 'FrontendSettingController@servicesUpdate');
            Route::post('frontend/services/store', 'FrontendSettingController@storeNewServices')->name('frontend.storeServices');
            Route::put('frontend/services/{services}', 'FrontendSettingController@updateNewServices')->name('frontend.updateServices');
            Route::delete('frontend/services/{services}/delete', 'FrontendSettingController@deleteServices')->name('frontend.deleteServices');
            
            //service section route list
            Route::get('frontend/prices', 'FrontendSettingController@prices')->name('frontend.prices');
            Route::put('frontend/prices', 'FrontendSettingController@pricesUpdate');
            Route::post('frontend/prices/store', 'FrontendSettingController@storeNewPrices')->name('frontend.storePrices');
            Route::put('frontend/prices/{prices}', 'FrontendSettingController@updateNewPrices')->name('frontend.updatePrices');
            Route::delete('frontend/prices/{prices}/delete', 'FrontendSettingController@deletePrices')->name('frontend.deletePrices');

            //visitor message list show
            Route::get('front/visitorMessage', 'FrontendSettingController@showVisitorMessage')->name('frontend.visitorMessage');
            Route::delete('front/visitorMessage/{message}', 'FrontendSettingController@deleteVisitorMessage')->name('frontend.deleteVisitorMessage');
        });
    });




    Auth::routes();
    Auth::routes(['verify' => true]);
    // Authentication Routes...
    Route::get('login', [
        'as' => 'login',
        'uses' => 'Auth\LoginController@showLoginForm'
    ]);
    Route::post('login', [
        'as' => 'login',
        'uses' => 'Auth\LoginController@login'
    ]);
    Route::get('signup', [
        'as' => 'signup',
        'uses' => 'Auth\RegisterController@showRegistrationForm'
    ]);
    Route::post('signup', [
        'as' => 'signup',
        'uses' => 'Auth\RegisterController@create'
    ]);
    



    Route::group(['namespace' => 'Manager'], function () {Route::post('password/reset', 'PasswordResetController@sendResetLink')->name('password.reset');
        Route::get('password/reset/{token}', 'PasswordResetController@resetLink')->name('password.token');
        Route::put('password/change', 'PasswordResetController@passwordReset')->name('password.change');        
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'manager', 'prefix' => 'manager', 'namespace' => 'Manager'], function () {

        Route::resource('drivers', 'DriverController');
  
        // Route::get('drivers', 'DriverController@index')->name('drivers.list');
        // Route::get('drivers/list', 'DriverController@index')->name('drivers.list');
        // Route::get('drivers/create', 'DriverController@create')->name('drivers.create');
        // Route::post('drivers/create', 'DriverController@store')->name('drivers.store');
        // Route::get('drivers/changePassword', 'ManagerController@driverChangePassword')->name('driver.changepassword');


        //user profile & credentials routes
        Route::get('profile', 'ManagerController@profileView')->name('manager.profile');
        Route::put('profile', 'ManagerController@updateProfile');

        //all branch list route
        Route::get('branch/list', 'ManagerController@branchList')->name('manager.branchlist');

        //all branch customer route list
        Route::resource('branchcustomer', 'BranchCustomerController');
        Route::post('branchcustomer/changepassword', 'BranchCustomerController@changePassword')->name('branchcustomer.changepassword');
      
        // Route::post('drivers/changepassword', 'DriverController@changePassword')->name('branchcustomer.changepassword');

        //Departure & Upcoming colis info route list
        Route::get('departure/colis', 'ColisInfoController@departureBranchColisList')->name('departure.manager');
        Route::get('upcoming/colis', 'ColisInfoController@upcomingBranchColisList')->name('upcoming.manager');
        Route::get('departure/invoice/{colisInfo}', 'ColisInfoController@colisInvoice')->name('manager.departure.invoice');
        Route::get('upcoming/invoice/{colisInfo}', 'ColisInfoController@upcomingColisInvoice')->name('manager.upcoming.invoice');

        //print slip route list
        Route::get('colis/slip/{id}', 'ColisInfoController@printSlipView')->name('manager.colis.slip');

        //branch income route 
        Route::get('branch/income', 'CompanyPaymentController@branchWiseIncome')->name('manager.branch.income');
        Route::get('branch/income/date/{date}', 'CompanyPaymentController@dateWiseBranchIncome')->name('manager.branch.income.date');
        Route::get('branch/income/customer/{customer}', 'CompanyPaymentController@customerWiseBranchIncome')->name('manager.branch.income.customer');

        //change password route
        Route::get('changePassword', 'ManagerController@changePassword')->name('manager.changepassword');
        Route::put('changePassword', 'ManagerController@updatePassword');
    });


    Route::group(['prefix' => 'customer', 'namespace' => 'Customer'], function () {


            Route::get('/', function () {
                return view('customer/login');
            })->name('customer');
            Route::post('authenticate', 'LoginController@authenticate')->name('customer.authenticate');
            
            
            Route::get('password/request', 'PasswordResetController@showLinkRequestForm')->name('customer.password.request');
            Route::post('password/reset', 'PasswordResetController@sendResetLink')->name('customer.password.reset');
            Route::get('password/reset/{token}', 'PasswordResetController@resetLink')->name('customer.password.token');
            Route::put('password/change', 'PasswordResetController@passwordReset')->name('customer.password.change');
            
            
        Route::group(['middleware' => 'customer',], function () {

            Route::post('logout', function () {
                Auth::logout();
                return redirect('customer');
            })->name('customer.logout');
            //customer dashboard
            Route::get('dashboard', 'CustomerController@dashboard')->name('customer.dashboard');
            Route::get('add', 'CustomerController@add')->name('customer.add');

            //user profile & credentials routes
            Route::get('profile', 'CustomerController@profileView')->name('customer.profile');
            Route::put('profile', 'CustomerController@updateProfile');

            //branch list
            Route::get('branch/list', 'CustomerController@branchList')->name('customer.branchlist');

            //colis info route list
            Route::resource('colis', 'ColisInfoController');
            Route::get('colis/invoice/{colisInfo}', 'ColisInfoController@colisInvoice')->name('colis.invoice');
            Route::put('colis/receive/customer', 'ColisInfoController@receiveColis')->name('colis.receive');
            Route::put('colis/payment/customer', 'ColisInfoController@paidColis')->name('colis.payment.customer');
            //print slip route list
            Route::get('colis/slip/{id}', 'ColisInfoController@printSlipView')->name('customer.colis.slip');

            //search deliver colis
            Route::get('colis/deliver/search', 'ColisInfoController@searchDeliverColis')->name('colis.deliver.search');
            Route::post('colis/deliver/search', 'ColisInfoController@showDeliverColis');
            //send deliver notification
            Route::get('colis/deliver/notification', 'ColisInfoController@notifyView')->name('colis.deliver.notify');
            Route::post('colis/deliver/notification', 'ColisInfoController@findColis');
            Route::post('colis/deliiver/notification/send', 'ColisInfoController@sendNotification')->name('send.notification.colis');
            //Cash Collection Route
            Route::get('cash/collection', 'ColisInfoController@customerCasheCollection')->name('customer.cashe.collection');

            //change password route
            Route::get('changePassword', 'CustomerController@changePassword')->name('customer.changepassword');
            Route::put('changePassword', 'CustomerController@updatePassword');
            
        });
    });
});
