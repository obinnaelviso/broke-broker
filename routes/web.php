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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/tyni', 'HomeController@tradetyni')->name('tradetyni');
Route::get('/contact-us', 'HomeController@contact_us')->name('contact_us');
Route::post('/contact-us', 'HomeController@contact');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/terms-and-conditions', 'HomeController@terms_conditions')->name('terms_conditions');
Route::get('/privacy-policy', 'HomeController@privacy_policy')->name('privacy_policy');
//--- Users Route
Route::group(['prefix'=>'/user'], function() {
    Route::get('/home', 'User\DashboardController@home')->name('user.home');


    Route::get('/trade', 'User\DashboardController@trade')->name('user.trade');

//-----------------> Transaction Pin
    Route::get('/transaction-pin', 'User\DashboardController@transaction_pin')->name('user.transaction.pin');
    Route::post('/transaction-pin/process', 'User\DashboardController@process_pin')->name('user.process.pin');

//-----------------> Fund money Routes
	Route::get('/deposit', 'User\DashboardController@add_money')->name('user.fund_wallet');
	Route::post('/add-money/pay', 'User\PaystackController@checkout')->name('user.pay');
	Route::get('/add-money/payment/callback', 'User\PaystackController@handleGatewayCallback');

//-----------------> Withdraw money Routes
	Route::get('/withdraw', 'User\DashboardController@withdraw_money')->name('user.withdraw');
	Route::get('/withdraw-money/history', 'User\DashboardController@withdraw_history')->name('user.withdraw_money.history');
	Route::post('/withdraw/money', 'User\WalletController@withdraw')->name('user.withdraw');
	Route::post('/withdraw-money/{withdraw_request}/cancel', 'User\WalletController@withdraw_cancel')->name('user.withdraw_money.cancel');

    //-----------------> Withdraw money Routes
    Route::get('/investments/', 'User\DashboardController@investments')->name('user.investments');
    Route::get('/investments/plans', 'User\DashboardController@investment_plans')->name('user.investments.plans');
    Route::get('/investments/plans/{investmentPlan}', 'User\DashboardController@investment_select')->name('user.investments.plans.select');
    Route::post('/investments/plans/{investmentPlan}/invest', 'User\DashboardController@invest')->name('user.investments.plans.invest');

//-----------------> Transfer money Routes
	Route::get('/transfer-money', 'User\DashboardController@transfer_money')->name('user.transfer_money');
	Route::post('/transfer-money', 'User\WalletController@transfer');

//-----------------> Profile Routes
	Route::get('/profile', 'User\ProfileController@index')->name('user.profile');
	Route::get('/profile/edit', 'User\ProfileController@profile_edit')->name('user.profile.edit');
	Route::post('/profile/edit', 'User\ProfileController@edit_profile');
	Route::get('/change-password', 'User\ProfileController@change_password')->name('user.profile.change_password');
	Route::post('/change-password', 'User\ProfileController@password_change');

//-----------------> Account Statement Routes
	Route::get('/account-statement', 'User\DashboardController@account_statement')->name('user.account_statement');

//-----------------> Promo Code Routes
	Route::get('/redeem-promo-code', 'User\DashboardController@redeem_pc')->name('user.redeem_pc');
	Route::post('/redeem-promo-code', 'User\DashboardController@pc_redeem')->name('user.pc_check');

});

//------------>>>>>>>>>>>>>>>----------- Admin -------------->
Route::group(['prefix'=>'/suser'], function() {
//--------------------> Admin Login
	Route::get('/login', 'Auth\LoginAController@showAdminLogin')->name('suser.login');
	Route::post('/login', 'Auth\LoginAController@login');
	Route::post('/logout', 'Auth\LoginAController@logout')->name('suser.logout');

//--------------------> Admin Register
	Route::get('/register', 'Auth\RegisterAController@showAdminRegisterForm')->name('suser.register');
	Route::post('/register', 'Auth\RegisterAController@register');

//--------------------> Admin Passsword Reset
    Route::get('password/reset', 'Auth\ForgotPasswordAController@showLinkRequestForm')->name('suser.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordAController@sendResetLinkEmail')->name('suser.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordAController@showResetForm')->name('suser.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordAController@reset')->name('suser.password.update');

//--------------------> Admin Dashboard
	Route::get('/home', 'Admin\DashboardController@home')->name('suser.home');

//--------------------> Withdraw Requests
	Route::get('/transfer-requests', 'Admin\WithdrawController@index')->name('suser.withdraw_requests');
	Route::post('/transfer-requests/{withdraw_request}/process', 'Admin\WithdrawController@request_response')->name('suser.process_withdraw');

//--------------------> Manage Users
	Route::get('/manage-users', 'Admin\UsersController@index')->name('suser.manage_users');
	Route::get('/manage-users/user/{user}', 'Admin\UsersController@manage_user')->name('suser.manage_user');
	Route::post('/manage-users/user/{user}/update-email', 'Admin\UsersController@update_email')->name('suser.update_email');
	Route::post('/manage-users/user/{user}/update-account', 'Admin\UsersController@account_status')->name('suser.account_status');
	Route::post('/manage-users/user/{user}/update-wallet', 'Admin\UsersController@wallet_status')->name('suser.wallet_status');
	Route::post('/manage-users/user/{user}/transactions', 'Admin\UsersController@addUserTransactions')->name('suser.add_user_transactions');
	Route::delete('/manage-users/user/{user}/delete', 'Admin\UsersController@delete_user')->name('suser.delete_user');
	Route::put('/manage-users/user/{user}/edit-balance', 'Admin\UsersController@edit_balance')->name('suser.edit_balance');

//--------------------> Configure Nwallet
	Route::get('/configure-nwallet', 'Admin\NwalletController@index')->name('suser.configure_nwallet');
	Route::post('/configure-nwallet', 'Admin\NwalletController@configure');
	Route::get('/edit-website', 'Admin\NwalletController@configure_homepage')->name('suser.configure_homepage');
	Route::post('/configure-nwallet/homepage', 'Admin\NwalletController@edit_homepage');

//--------------------> Manage Admin
	Route::get('/manage-admin', 'Admin\SUsersController@index')->name('suser.manage_admin');
	Route::post('/manage-admin/{suser}/account-status', 'Admin\SUsersController@account_status')->name('suser.saccount_status');
	Route::get('/manage-admin/edit-profile', 'Admin\SUsersController@profile_edit')->name('suser.edit_profile');
	Route::post('/manage-admin/edit-profile', 'Admin\SUsersController@edit_profile');
	Route::get('/manage-admin/change-password', 'Admin\SUsersController@password_change')->name('suser.change_password');
	Route::post('/manage-admin/change-password', 'Admin\SUsersController@change_password');

//------------------------> Manage Investment Plans
	Route::get('/investments', 'Admin\InvestmentsController@index')->name('suser.investments');
	Route::put('/investments/{investment}/cancel', 'Admin\InvestmentsController@cancel')->name('suser.investments.cancel');
	Route::put('/investments/{investment}/complete', 'Admin\InvestmentsController@complete')->name('suser.investments.complete');
	Route::get('/investments/plans', 'Admin\InvestmentsController@plans')->name('suser.investments.plans');
	Route::post('/investments/plans/add', 'Admin\InvestmentsController@plans_add')->name('suser.investments.plans.add');
	Route::put('/investments/plans/{investmentPlan}/edit', 'Admin\InvestmentsController@plans_edit')->name('suser.investments.plans.edit');
	Route::delete('/investments/plans/{investmentPlan}/delete', 'Admin\InvestmentsController@plans_delete')->name('suser.investments.plans.delete');

//--------------------> Transactions
	Route::get('/transactions', 'Admin\TransactionsController@index')->name('suser.transactions');
	Route::post('/transactions/add', 'Admin\TransactionsController@add_transaction')->name('suser.transactions.add');
	Route::get('/default-transactions', 'Admin\TransactionsController@defaultTransactions')->name('suser.default-transactions');
	Route::post('/default-transactions/add', 'Admin\TransactionsController@addDefaultTransactions')->name('suser.default-transactions.add');
	Route::delete('/default-transactions/{transaction}/delete', 'Admin\TransactionsController@deleteDefaultTransactions')->name('suser.default-transactions.delete');
    Route::delete('/transactions/{transaction}/delete', 'Admin\TransactionsController@delete_transaction')->name('suser.transactions.delete');

//--------------------> OTPs
    Route::get('/otps', 'Admin\OtpController@index')->name('suser.otps');
    Route::post('/otps/generate', 'Admin\OtpController@generate')->name('suser.otps.generate');
    Route::put('/otps/{otp}/deactivate', 'Admin\OtpController@deactivate')->name('suser.otps.deactivate');

//--------------------> Mail Users
	Route::get('/mailings', 'Admin\MailingController@index')->name('suser.mailings');
	Route::post('/mailings', 'Admin\MailingController@send');

//--------------------> Promo Codes
	Route::get('/manage-promo-code', 'Admin\PromoCodeController@index')->name('suser.manage_pc');
	Route::post('/manage-promo-code/', 'Admin\PromoCodeController@add_promo_group');
	Route::post('/manage-promo-code/{pc_type}/status', 'Admin\PromoCodeController@disable_group')->name('suser.disable_group');
	Route::get('/manage-promo-code/{pc_type}/', 'Admin\PromoCodeController@promo_codes')->name('suser.promo_codes');
	Route::post('/manage-promo-code/{pc_type}/', 'Admin\PromoCodeController@add_promo_code');
	Route::post('/manage-promo-code/{pc_type}/pc/{promo_code}/assign', 'Admin\PromoCodeController@assign_pc')->name('suser.assign_pc');
	Route::post('/manage-promo-code/{pc_type}/pc/{promo_code}/status', 'Admin\PromoCodeController@disable_pc')->name('suser.disable_pc');
	Route::post('/manage-promo-code/{pc_type}/remove-pc/{assigned_pc}/user', 'Admin\PromoCodeController@remove_pc')->name('suser.remove_pc');
});

Auth::routes(['verify' => true]);
