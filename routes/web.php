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
Route::get('setlocale/{locale}','home@set_locale');

Route::get('sms-response', 'home@sms_response');
Route::post('sms-response', 'home@sms_response');
Route::get('a/{CODE}', 'home@accept_url');
Route::get('r/{CODE}', 'home@reject_url');

Route::get('cron-job-5', 'home@cron_job_5');

Route::get('contact-us', 'home@contact_us');
Route::get('how-it-works', 'home@how_it_works');
Route::get('help', 'home@help');
Route::get('students', 'home@students');
Route::get('drivers', 'home@for_drivers');
Route::get('passengers', 'home@for_passengers');
Route::get('covid-19', 'home@covid');
Route::get('faq', 'home@faq');
Route::get('partners', 'home@partners');
Route::get('news', 'home@news');
Route::get('article/{URL}', 'home@article');
Route::get('terms-of-service', 'home@terms_service');
Route::get('terms-of-use', 'home@terms_use');
Route::get('privacy-policy', 'home@privacy_policy');
Route::get('satisfied-members', 'home@satisfied_members');

Route::get('search-ride', 'rides@search_rides');
Route::get('pink-rides', 'rides@search_rides');
Route::get('extra-care-rides', 'rides@search_rides');
Route::get('customize-rides', 'rides@search_rides');

Route::get('/', 'home@index');
Route::get('facebook-redirect', 'account@facebook_redirect');
Route::get('facebook-callback', 'account@facebook_callback');
Route::get('google-redirect', 'account@google_redirect');
Route::get('google-callback', 'account@google_callback');
Route::get('linkedin-redirect', 'account@linkedin_redirect');
Route::get('linkedin-callback', 'account@linkedin_callback');

Route::get('instagram-redirect', 'account@instagram_redirect');
Route::get('instagram-callback', 'account@instagram_callback');

Route::get('tiktok-redirect', 'account@tiktok_redirect');
Route::get('tiktok-callback', 'account@tiktok_callback');

Route::get('snapchat-redirect', 'account@snapchat_redirect');
Route::get('snapchat-callback', 'account@snapchat_callback');

Route::get('signup', 'account@signup');
Route::post('signup', 'account@signup');
Route::get('complete-signup', 'account@complete_signup');
Route::post('complete-signup', 'account@complete_signup');
Route::post('check-email', 'account@check_email');
Route::post('check-email2', 'account@check_email2');
Route::post('check-dob', 'account@check_dob');
Route::post('update-email', 'account@update_email');
Route::get('login', 'account@signin');
Route::post('signin', 'account@signin');
Route::get('forgot-password', 'account@forgot_password');
Route::post('forgot-password', 'account@forgot_password');
Route::get('set-password/{id}/{code}','account@set_password');
Route::post('set-password/{id}/{code}','account@set_password');
Route::get('signout', 'account@signout');

Route::get('verify-email', 'account@verify_email');
Route::post('send-verification-email', 'account@send_verification_email');
Route::get('ride/{URL}', 'rides@view_ride');

Route::get('verify/{ID}/{CODE}','account@verify');
Route::get('update-email/{ID}/{CODE}','account@update_email2');

    Route::get('driver/{USERNAME}', 'profile@driver_profile');
    Route::post('driver/{USERNAME}', 'profile@driver_profile');
    Route::get('passenger/{USERNAME}', 'profile@passenger_profile');
    Route::post('passenger/{USERNAME}', 'profile@passenger_profile');


 Route::get('paypal-cancel/{ID}', 'booking@paypal_cancel');
 Route::get('paypal-success/{ID}', 'booking@paypal_success');

Route::post('hide-warning', 'account@hide_warning');

Route::group(['middleware' => 'auth'], function () {



    Route::get('/step/1', 'account@step1of5');
    Route::post('/step/1', 'account@manage_steps');


    Route::get('/step/2', 'account@step2of5');
    Route::post('/step/2', 'account@manage_steps');
    

    Route::get('/step/3', 'account@step3of5');


    Route::get('/step/4', 'account@step4of5');
    Route::post('/step/4', 'account@manage_steps');
    
    Route::get('/step/5', 'account@step5of5');
    Route::post('/step/5', 'account@manage_steps');
    
    Route::post('upload-profile-image', 'account@upload_profile_image');
    Route::post('upload-car-image', 'account@upload_car_image');
    Route::post('upload-id-card-image', 'account@upload_id_card_image');

    Route::get('dashboard', 'account@dashboard')->name('user.dashboard');
    Route::get('personal-information', 'profile@personal_information');
    Route::post('personal-information', 'profile@personal_information');
    Route::get('photo', 'profile@photo');
    Route::post('photo', 'profile@photo');
    Route::get('preferences', 'profile@preferences');
    Route::post('preferences', 'profile@preferences');
    Route::get('vehicle', 'profile@vehicle');
    Route::post('vehicle', 'profile@vehicle');
    Route::get('password', 'profile@password');
    Route::post('password', 'profile@password');
    Route::get('payments', 'profile@payments');
    Route::post('payments', 'profile@payments');
    Route::get('booking-credits', 'profile@booking_credits');
    Route::post('booking-credits', 'profile@booking_credits');
    Route::get('verify-phone', 'profile@verify_phone');
    Route::post('verify-phone', 'profile@verify_phone');
    Route::get('verify-driver', 'profile@verify_driver');
    Route::post('verify-driver', 'profile@verify_driver');
    Route::get('verify-student', 'profile@verify_student');
    Route::post('verify-student', 'profile@verify_student');
    Route::get('home-address', 'profile@home_address');
    Route::post('home-address', 'profile@home_address');
    Route::get('phone', 'profile@phone');
    Route::post('phone', 'profile@phone');
    Route::get('email', 'profile@email');
    Route::post('email', 'profile@email');
    Route::get('ratings-left', 'profile@ratings_left');
    Route::get('ratings-received', 'profile@ratings_received');
    Route::get('close-account', 'profile@close_account');
    Route::post('close-account', 'profile@close_account');
    
    Route::get('refer-friend', 'profile@refer_friend');
    Route::post('refer-friend', 'profile@refer_friend');
    
    Route::get('all-transactions', 'profile@all_transactions');
    Route::post('all-transactions', 'profile@all_transactions');
    Route::get('request-withdrawal', 'profile@request_withdrawal');
    Route::post('request-withdrawal', 'profile@request_withdrawal');
    
    Route::get('post-ride', 'rides@post_ride');
    Route::post('post-ride', 'rides@post_ride');
    Route::get('edit-ride/{ID}', 'rides@edit_ride');
    Route::post('edit-ride/{ID}', 'rides@edit_ride');
    Route::get('my-rides', 'rides@my_rides');
    Route::get('rides-posted', 'rides@rides_posted');
    Route::get('past-rides', 'rides@past_rides');
    
    Route::get('closed-rides', 'rides@rides_closed');

    Route::get('book-seat/{ID}', 'rides@book_ride');
    Route::post('book-seat/{ID}', 'booking@book_seat');
    Route::post('ride-completed', 'booking@ride_completed');
    Route::post('ride-feedback', 'booking@ride_feedback');
    Route::post('change-status', 'booking@change_status');
    
    Route::get('cancel-seat/{ID}', 'booking@cancel_seat');
    Route::post('cancel-seat/{ID}', 'booking@cancel_seat');
    Route::get('cancel-passenger/{ID}', 'booking@cancel_passenger');
    Route::post('cancel-passenger/{ID}', 'booking@cancel_passenger');
    Route::get('cancel-ride/{ID}', 'booking@cancel_ride');
    Route::post('cancel-ride/{ID}', 'booking@cancel_ride');
    Route::get('close-ride/{ID}', 'booking@close_ride');
    Route::post('close-ride/{ID}', 'booking@close_ride');

    Route::get('reopen-ride/{ID}', 'booking@reopen_ride');
    
    Route::get('leave-feedback/{ID}', 'booking@leave_feedback');
    Route::post('leave-feedback/{ID}', 'booking@leave_feedback');
    
    Route::post('check-time', 'rides@check_time');
    Route::post('check-time-edit', 'rides@check_time_edit');
});

Route::get('/admin/login', 'admin\login@index');
Route::post('/admin/login', 'admin\login@index');
Route::get('/admin/changepassword', 'admin\changepassword@index');
Route::post('/admin/changepassword', 'admin\changepassword@index');



Route::post('/admin/forgot', 'admin\forgot@index');
Route::get('/admin/forgot', 'admin\forgot@index');


Route::get('/api/suspend_ride', 'api@suspend_ride');


Route::post('/api/check_email', 'api@check_email');
Route::get('/api/check_email', 'api@check_email');


Route::get('/admin', 'admin\home@login');

Route::group(['middleware' => 'admin_auth'], function () {
 Route::get('/admin/access-portal/{ID}', 'admin\dashboard@access_portal');
    
 Route::get('/admin/booking-credits', 'admin\rides@booking_credits');
 Route::post('/admin/booking-credits', 'admin\rides@booking_credits');
    
 Route::get('/admin/site-settings', 'admin\site@site_settings');
 Route::post('/admin/site-settings', 'admin\site@site_settings');
 Route::get('/admin/site-colors', 'admin\site@site_colors');
 Route::post('/admin/site-colors', 'admin\site@site_colors');
 Route::get('/admin/site-questions', 'admin\site@site_questions');
 Route::post('/admin/site-questions', 'admin\site@site_questions');
 Route::get('/admin/preview', 'admin\site@previews');

 Route::get('/admin/video-setting', 'admin\videos@index');
Route::post('/admin/video-setting', 'admin\videos@index');
    
 Route::get('/admin/rides', 'admin\rides@rides');
 Route::post('/admin/rides', 'admin\rides@rides');
 Route::get('/admin/bookings', 'admin\rides@bookings');
 Route::post('/admin/bookings', 'admin\rides@bookings');
 Route::get('/admin/reviews', 'admin\rides@reviews');
 Route::post('/admin/reviews', 'admin\rides@reviews');
 Route::get('/admin/transactions', 'admin\rides@transactions');
 Route::post('/admin/transactions', 'admin\rides@transactions');
    
 Route::get('/admin/new-article', 'admin\site@new_article');
 Route::post('/admin/new-article', 'admin\site@new_article');
 Route::get('/admin/edit-article/{ID}', 'admin\site@edit_article');
 Route::post('/admin/edit-article/{ID}', 'admin\site@edit_article');
 Route::get('/admin/all-articles', 'admin\site@all_articles');
 Route::post('/admin/all-articles', 'admin\site@all_articles');
    
 Route::get('/admin/withdrawal-requests', 'admin\site@withdrawal_requests');
 Route::post('/admin/withdrawal-requests', 'admin\site@withdrawal_requests');
    
 Route::get('/admin/portals', 'admin\staff@index');
 Route::post('/admin/portals', 'admin\staff@index');
    
 Route::get('admin/import-data','admin\companies_data@import_data');
 Route::post('admin/import-data','admin\companies_data@fetch_data_xlsx');
    
 Route::get('admin/companies-data','admin\companies_data@index');
 Route::post('admin/companies-data','admin\companies_data@index');
    
 Route::get('/admin/verify-drivers', 'admin\users@verify_drivers');
 Route::post('/admin/verify-drivers', 'admin\users@verify_drivers');
 Route::get('/admin/verify-students', 'admin\users@verify_students');
 Route::post('/admin/verify-students', 'admin\users@verify_students');
    
 Route::get('/admin/dashboard', 'admin\dashboard@index');
 Route::get('/admin/users', 'admin\users@index');
 Route::post('/admin/users', 'admin\users@index');
 Route::get('/admin/user/{id}', 'admin\users@view_user');

 Route::get('/admin/pending-users', 'admin\users@pending_users');
 Route::post('/admin/pending-users', 'admin\users@pending_users');
 Route::get('/admin/review-orders', 'admin\users@review_orders');
 Route::post('/admin/review-orders', 'admin\users@review_orders');
 Route::get('/admin/picks', 'admin\picks@index');
 Route::post('/admin/picks', 'admin\picks@manage_forms');
 Route::get('/admin/manage-faq', 'admin\faq@manage_faq');
 Route::post('/admin/manage-faq', 'admin\faq@add_faq');
 Route::get('/admin/manage-blogs', 'admin\blogs@index');
 Route::post('/admin/manage-blogs', 'admin\blogs@manage_forms');
 Route::get('/admin/edit-blog/{ID}', 'admin\blogs@edit_blog');
 Route::post('/admin/edit-blog/{ID}', 'admin\blogs@edit_blog');
 Route::get('/admin/free-picks','admin\picks@free_picks');
 Route::post('/admin/free-picks','admin\picks@free_picks');
    
 Route::get('/admin/users/clearBalance', 'admin\users@clearBalance');
 Route::get('/admin/manager-applications', 'admin\manager_applications@index');
 Route::post('/admin/manager-applications', 'admin\manager_applications@index');
 Route::get('/admin/logout', 'admin\logout@index');
 Route::get('/admin/manage-categories', 'admin\manage_categories@index');
 Route::post('/admin/manage-categories', 'admin\manage_categories@index');
 Route::get('/admin/edit-category/{id}', 'admin\manage_categories@edit_category');
 Route::post('/admin/edit-category/{id}', 'admin\manage_categories@edit_category');
 Route::get('/admin/manage-projects', 'admin\manage_projects@index');
 Route::post('/admin/manage-projects', 'admin\manage_projects@index');
 Route::get('/admin/edit-project/{id}', 'admin\edit_project@index');
 Route::post('/admin/edit-project/{id}', 'admin\edit_project@index');
 Route::get('/admin/change-password', 'admin\change_password@index');
 Route::post('/admin/change-password', 'admin\change_password@index');
 Route::get('/admin/projects-reports', 'admin\projects_reports@index');
 Route::post('/admin/projects-reports', 'admin\projects_reports@index');
 Route::get('/admin/set-commissions', 'admin\commissions@index');
 Route::post('/admin/set-commissions', 'admin\commissions@manage_form');
 Route::get('/admin/business-commissions', 'admin\commissions@business_commissions');
 Route::post('/admin/business-commissions', 'admin\commissions@manage_business_form');
 Route::get('/admin/faq/{ID}', 'admin\faq@manage_faq');
 Route::post('/admin/faq/{ID}', 'admin\faq@add_faq');
    
 Route::get('/admin/edit-faq-topic/{ID}', 'admin\faq@edit_faq_topic');
 Route::post('/admin/edit-faq-topic/{ID}', 'admin\faq@edit_faq_topic');
    
 Route::get('/admin/edit-question/{ID}', 'admin\faq@edit_question');
 Route::post('/admin/edit-question/{ID}', 'admin\faq@edit_question');
 Route::get('/admin/withdrawal', 'admin\withdrawal@index');
 Route::post('/admin/withdrawal', 'admin\withdrawal@manage_forms');






});

Route::post('/api/user/login', 'api@login');

Route::post('/api/user/first_step', 'api@firstStep');
Route::get('/api/user/first_step', 'api@firstStep');

Route::post('/api/submit_third_form', 'api@submitThirdForm');

Route::post('/api/submit_fourth_form', 'api@submitForthForm');


Route::get('/api/user/skip_third_function', 'api@skipthirdfunction');

Route::post('/step/2/upload_picture', 'api@uploadStep2Picture');

Route::get('/skip/fourth_step', 'api@skipFourthStep');

Route::get('/skip/fifth_step', 'api@skipFifthStep');

Route::post('/api/user/send_verification_code', 'api@smsVerification');

Route::post('/api/user/verify_sms_code', 'api@verifySmsCode');

Route::post('/api/forgot', 'api@forgotSendEmail');

Route::get('/sign_up_steps_finished', 'api@signUpFinished');

Route::get('changepassword/{URL}', 'api@changePassword');

Route::post('/api/changeYourPassword', 'api@changeYourPassword');

Route::post('/api/user_register', 'api@register');

Route::post('/api/copy_paste_ride', 'api@copyPasteRide');


Route::post('/api/resend_verification', 'api@resend_confirm_email');