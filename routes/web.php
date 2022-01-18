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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:clear');
    return 'CACHE CLEARED'; //Return anything
});

Auth::routes();

// FrontEnd Routes
Route::get('/','HomeController@index')->name('home');
Route::get('/about-us','HomeController@aboutUs')->name('about_us');
Route::get('/our-services','HomeController@ourServices')->name('our_services');
Route::get('/purchase/{id?}','HomeController@purchase')->name('purchase');
Route::get('/join-team','HomeController@joinTeam')->name('join_team');
Route::get('/contact-us','HomeController@contactUs')->name('contact_us');
Route::post('/contact-us','HomeController@contact')->name('contact_us');
Route::get('/our-tutors','HomeController@ourTutor')->name('our_tutors');
Route::get('/load-request-form/{id?}','HomeController@loadRequestForm')->name('load.request.form');
Route::get('/privacy-policy','HomeController@privacy')->name('privacy');

// BigBlueButton Session Routes
// Route::get('start-session/{id?}', 'BigBlueButtonController@startSession')->name('start.session');
// Route::get('bigblue-callback/{id?}', 'BigBlueButtonController@bigBlueCallback')->name('bigblue.callback');
// Route::get('join-session/{id?}/{type?}', 'BigBlueButtonController@joinSession')->name('join.session');

// Zoom Session Routes
Route::get('start-session/{id?}', 'ZoomController@startSession')->name('start.session');
Route::post('zoom-callback', 'ZoomController@zoomCallback')->name('zoom.callback');
Route::post('zoom-joined', 'ZoomController@zoomJoined')->name('zoom.joined');

// Google Calendar Routes
Route::get('/google-calendar/connect', 'GoogleCalendarController@connect')->name('calendar.connect');
Route::get('/google-calendar/oauth', 'GoogleCalendarController@store')->name('calendar.store');
Route::get('/google-calendar/success', 'GoogleCalendarController@success')->name('calendar.success');

// Stripe Connect Routes
Route::get('connect-account/{id}', 'StripeConnectController@connectAccount')->name('connect');
Route::get('stripe-account', 'StripeConnectController@goToStripe')->name('stripe.account');
Route::get('boarded/{enc}', 'StripeConnectController@boarded')->name('boarded');
Route::get('transfer/{id?}', 'StripeConnectController@transfer')->name('transfer');

// Conversation Routes

// Student Authenticated Routes
Route::prefix('student')->name('student.')->namespace('Student')->middleware('auth','student','session.check')->group(function() {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/check-session-start', 'DashboardController@checkSessionStart')->name('check.session.start');
    Route::get('/payment', 'PaymentController@paymentForm')->name('payment.form');
    Route::post('/payment-save', 'PaymentController@paymentSave')->name('payment.save');

    Route::get('/find-tutor','TutorController@ourTutor')->name('find.tutor');
    Route::get('/load-tutor-profile/{id?}','TutorController@loadTutorProfile')->name('load.tutor.profile');
    Route::get('/load-tutor-days/{id?}', 'TutorController@loadTutorDays')->name('load.tutor.days');
    Route::get('/load-tutor-intervals/{id?}/{day?}', 'TutorController@loadTutorIntervals')->name('load.tutor.intervals');
    Route::get('/tutor-request','TutorController@tutorRequest')->name('tutor.request');
    Route::get('/recurring-payment/{id?}', 'TutorController@recurringPayment')->name('recurring.payment');
    Route::post('/request-tutor','TutorController@requestTutor')->name('request.tutor');
    Route::get('/request-tutor-status/{action?}/{id?}','TutorController@requestTutorStatus')->name('request.tutor.status');

    Route::post('/request-refund','SessionHistoryController@refund')->name('refund');
    Route::get('/session-history', 'SessionHistoryController@history')->name('session.history');

    Route::get('/review/{id?}', 'DashboardController@review')->name('review');
    Route::post('/review-save', 'DashboardController@reviewSave')->name('review.save');

    Route::get('/edit-profile', 'DashboardController@profile')->name('edit.profile');
    Route::post('/edit-profile-save', 'DashboardController@profileSave')->name('edit.profile.save');

    Route::get('/chat', 'ChatController@chat')->name('chat');
    Route::get('tutor-contacts', 'ChatController@tutorContacts')->name('contacts');
    Route::get('/get-chat', 'ChatController@getChat')->name('get.chat');
    Route::post('/save-message', 'ChatController@saveMessage')->name('save.messsage');

    Route::get('/packages', 'PackageController@packages')->name('packages');
    Route::get('/package-payment/{id?}', 'PackageController@packagePayment')->name('package.payment');
    Route::post('/purchase', 'PackageController@purchase')->name('purchase');

});

// Parent Authenticated Routes
Route::prefix('parent')->name('parent.')->namespace('Parent')->middleware('auth','parent')->group(function() {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/check-session-start', 'DashboardController@checkSessionStart')->name('check.session.start');
    Route::get('/payment', 'PaymentController@paymentForm')->name('payment.form');
    Route::post('/payment-save', 'PaymentController@paymentSave')->name('payment.save');

    Route::get('/find-tutor','TutorController@ourTutor')->name('find.tutor');
    Route::get('/load-tutor-profile/{id?}','TutorController@loadTutorProfile')->name('load.tutor.profile');
    Route::get('/load-tutor-days/{id?}', 'TutorController@loadTutorDays')->name('load.tutor.days');
    Route::get('/load-tutor-intervals/{id?}/{day?}', 'TutorController@loadTutorIntervals')->name('load.tutor.intervals');
    Route::get('/tutor-request','TutorController@tutorRequest')->name('tutor.request');
    Route::get('/recurring-payment/{id?}', 'TutorController@recurringPayment')->name('recurring.payment');
    Route::post('/request-tutor','TutorController@requestTutor')->name('request.tutor');
    Route::get('/request-tutor-status/{action?}/{id?}','TutorController@requestTutorStatus')->name('request.tutor.status');

    Route::post('/request-refund','SessionHistoryController@refund')->name('refund');
    Route::get('/session-history', 'SessionHistoryController@history')->name('session.history');

    Route::get('/review/{id?}', 'DashboardController@review')->name('review');
    Route::post('/review-save', 'DashboardController@reviewSave')->name('review.save');

    Route::get('/edit-profile', 'DashboardController@profile')->name('edit.profile');
    Route::post('/edit-profile-save', 'DashboardController@profileSave')->name('edit.profile.save');

    Route::get('/chat', 'ChatController@chat')->name('chat');
    Route::get('tutor-contacts', 'ChatController@tutorContacts')->name('contacts');
    Route::get('/get-chat', 'ChatController@getChat')->name('get.chat');
    Route::post('/save-message', 'ChatController@saveMessage')->name('save.messsage');

    Route::get('/packages', 'PackageController@packages')->name('packages');
    Route::get('/package-payment/{id?}', 'PackageController@packagePayment')->name('package.payment');
    Route::post('/purchase', 'PackageController@purchase')->name('purchase');

});

// Tutor Unauthenticated routes
Route::prefix('tutor')->name('tutor.')->namespace('Tutor')->group(function() {
    Route::post('/register', 'RegisterController@register')->name('register');
    Route::get('/success','RegisterController@success')->name('register.success');
    Route::get('/pending-review', 'DashboardController@pendingReview')->name('pending.review');
});

// Tutor Authenticated Routes
Route::prefix('tutor')->name('tutor.')->namespace('Tutor')->middleware('auth','tutor')->group(function() {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/check-session', 'DashboardController@checkSession')->name('check.session');

    Route::get('/student-requests','StudentController@studentRequest')->name('student.requests');
    Route::get('/student-request-status/{action?}/{id?}','StudentController@studentRequestStatus')->name('student.request.status');
    Route::get('/student-request-delete/{id?}','StudentController@studentRequestDelete')->name('student.request.delete');

    Route::get('/session-history', 'SessionHistoryController@history')->name('session.history');
    Route::get('/session-delete/{id?}', 'SessionHistoryController@delete')->name('session.delete');

    Route::get('/review/{id?}', 'DashboardController@review')->name('review');
    Route::post('/review-save', 'DashboardController@reviewSave')->name('review.save');

    Route::get('/edit-profile', 'DashboardController@profile')->name('edit.profile');
    Route::post('/edit-profile-save', 'DashboardController@profileSave')->name('edit.profile.save');
    Route::post('/timetable-save', 'DashboardController@timetableSave')->name('timetable.save');

    Route::get('/payouts', 'DashboardController@payout')->name('payout');

    Route::get('/chat', 'ChatController@chat')->name('chat');
    Route::get('student-contacts', 'ChatController@studentContacts')->name('contacts');
    Route::get('/get-chat', 'ChatController@getChat')->name('get.chat');
    Route::post('/save-message', 'ChatController@saveMessage')->name('save.messsage');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->namespace('Admin')->middleware('auth','admin')->group(function() {
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::name('packages.')->prefix('packages')->group(function() {
        Route::get('list', 'PackageController@list')->name('list');
        Route::get('add', 'PackageController@add')->name('add');
        Route::get('edit/{id?}', 'PackageController@edit')->name('edit');
        Route::post('save/{id?}', 'PackageController@save')->name('save');
        Route::get('delete/{id?}', 'PackageController@delete')->name('delete');
    });

    Route::prefix('students')->group(function() {
        Route::get('', 'StudentController@studentList')->name('student');
        Route::get('delete/{id}', 'StudentController@delete')->name('student.delete');
    });

    Route::prefix('tutors')->group(function() {
        Route::get('', 'TutorController@tutorList')->name('tutor');
        Route::get('view/{id?}', 'TutorController@view')->name('tutor.view');
        Route::get('status/{id?}', 'TutorController@status')->name('tutor.status');
        Route::get('delete/{id?}', 'TutorController@delete')->name('tutor.delete');
        Route::post('set-hourly','TutorController@setHourly')->name('tutor.setHourly');
    });

    Route::prefix('requests')->group(function() {
        Route::get('', 'RequestController@request')->name('request');
        Route::get('delete/{id}', 'RequestController@delete')->name('request.delete');
    });

    Route::prefix('sessions')->group(function() {
        Route::get('', 'SessionController@sessionList')->name('session');
        Route::get('refund/{id?}','SessionController@refund')->name('refund');
        Route::get('delete/{id?}', 'SessionController@delete')->name('session.delete');
    });

    Route::prefix('parents')->group(function() {
        Route::get('', 'ParentController@parentList')->name('parent');
        Route::get('delete/{id}', 'ParentController@delete')->name('parent.delete');
    });

    Route::prefix('profile')->group(function() {
        Route::get('', 'ProfileController@profile')->name('profile');
        Route::post('reset-password', 'profileController@resetPassword')->name('profile.reset_password');
        Route::post('update-profile', 'profileController@update_Profile')->name('profile.update_profile');
    });

    Route::prefix('payouts')->group(function() {
        Route::get('', 'PayoutController@payouts')->name('payout');
        Route::get('delete/{id}', 'PayoutController@delete')->name('payout.delete');
    });


    Route::get('/cms-setting','SettingController@cmsSetting')->name('cms.setting');
    Route::post('/cms-store','SettingController@cmsStore')->name('cms.store');
    Route::get('/web-setting','SettingController@webSetting')->name('web.setting');
});
