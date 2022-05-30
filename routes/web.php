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

Route::get('/', [App\Http\Controllers\PublicController::class,'index'])->name('welcome');
Route::get('/about-us',[App\Http\Controllers\PublicController::class,'about'])->name('about');
Route::get('/contact-us',[App\Http\Controllers\PublicController::class,'contact'])->name('contact');
Route::get('/term-of-service',[App\Http\Controllers\PublicController::class,'termsofservice'])->name('terms-of-service');
Route::get('/privacy-statement',[App\Http\Controllers\PublicController::class,'privacy'])->name('privacy');
Route::get('blogs/{slug}',[App\Http\Controllers\BlogController::class,'view']);
Route::get('blog-list',[App\Http\Controllers\BlogController::class,'blogs']);
Route::resource('blogs',App\Http\Controllers::class);
Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/upload', [App\Http\Controllers\ClientController::class, 'sell']);
Route::post('post-document',[App\Http\Controllers\ClientController::class,'post_document'])->name('post-document');
Route::get('/uploads',[App\Http\Controllers\ClientController::class,'uploads'])->name('uploads');
Route::get('profile',[App\Http\Controllers\ClientController::class,'profile'])->name('profile');
Route::get('upload-files/{id}',[App\Http\Controllers\ClientController::class,'upload_files'])->name('upload-files');
Route::post('/uploadFile', [App\Http\Controllers\ClientController::class, 'uploadFile'])->name('uploadFile');
Route::get('my-uploads', [App\Http\Controllers\ClientController::class, 'my_uploads'])->name('my-uploads');
Route::get('edit-document/{id}', [App\Http\Controllers\ClientController::class, 'edit_document'])->name('edit-document');
Route::get('downloads', [App\Http\Controllers\ClientController::class, 'downloads'])->name('downloads');
Route::get('fetch-downloads', [App\Http\Controllers\ClientController::class, 'fetch_downloads'])->name('fetch-downloads');
Route::get('download/{filename}', [App\Http\Controllers\PublicController::class, 'download_file'])->name('download');
Route::post('update-profile', [App\Http\Controllers\ClientController::class, 'update_profile'])->name('update-profile');
Route::post('update-paypal', [App\Http\Controllers\ClientController::class, 'update_paypal'])->name('update-paypal');
Route::post('update-password', [App\Http\Controllers\ClientController::class, 'update_password'])->name('update-password');
Route::post('deactivate-account', [App\Http\Controllers\ClientController::class, 'deactivate_account'])->name('deactivate-account');
Route::post('notes-update', [App\Http\Controllers\ClientController::class, 'notes_update'])->name('notes-update');
Route::post('file-update', [App\Http\Controllers\ClientController::class, 'file_update'])->name('file-update');
Route::post('notifications', [App\Http\Controllers\ClientController::class, 'fetch_notifications'])->name('notifications');
Route::post('mark-as-read', [App\Http\Controllers\ClientController::class, 'mark_as_read'])->name(' mark-as-read');
Route::get('view-document/{slug}',[App\Http\Controllers\ClientController::class,'view_document'])->name('view-document');
Route::post('post-review',[App\Http\Controllers\ClientController::class,'post_review'])->name('post-review');

Route::get('earnings', [App\Http\Controllers\ClientController::class, 'earnings'])->name('earnings');
Route::get('fetch-earnings', [App\Http\Controllers\ClientController::class, 'fetch_earnings'])->name('fetch-earnings');
Route::post('fileDelete/{id}',[\App\Http\Controllers\ClientController::class,'file_delete'])->name('fileDelete');

Route::post('uploadImg',[App\Http\Controllers\ClientController::class,'upload_profile_img'])->name('uploadImg');

Route::get('search/', [App\Http\Controllers\PublicController::class,'documents'])->name('search');
Route::get('document-preview/{slug}', [App\Http\Controllers\PublicController::class,'document_preview']);
Route::get('cart', [App\Http\Controllers\PublicController::class, 'cart'])->name('cart');

Route::get('add-to-cart/{id}', [App\Http\Controllers\PublicController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [App\Http\Controllers\PublicController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [App\Http\Controllers\PublicController::class, 'remove'])->name('remove.from.cart');

Route::get('pay-failed',[App\Http\Controllers\PayPalPaymentController::class,'pay_failed'])->name('pay-failed');
Route::get('pay-success',[App\Http\Controllers\PayPalPaymentController::class,'pay_success'])->name('pay-success');
Route::post('paypal-capture-payment',[App\Http\Controllers\PayPalPaymentController::class,'capturePayment']);
Route::get('paypal-payout',[App\Http\Controllers\PayPalPaymentController::class,'paypalpayout'])->name('paypal-payout');
Route::post('verify-payment',[App\Http\Controllers\PayPalPaymentController::class,'verify'])->name('verify-payment');

Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class,'adminLogin'])->name('adminLogin');
Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']); 
Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class,'createAdmin']);
Route::middleware(['auth'])->group(function () {
    Route::get('checkout', [App\Http\Controllers\PublicController::class, 'checkout'])->name('checkout');
});
Route::group(['middleware' => 'auth:admin'], function () {
    Route::post('/logout/admin', [App\Http\Controllers\Auth\LoginController::class,'AdminLogout'])->name('AdminLogout');

    Route::group(['prefix' => 'admin'], function()  
    { 
        Route::get('/dashboard',[\App\Http\Controllers\Admin\AdminController::class,'dashboard'])->name('admin');
        Route::get('users',[\App\Http\Controllers\Admin\AdminController::class,'users'])->name('users');
        Route::get('get_all_users',[\App\Http\Controllers\Admin\AdminController::class,'get_all_users'])->name('get_all_users');
        Route::get('file-uploads',[\App\Http\Controllers\Admin\AdminController::class,'uploads'])->name('file-uploads');
        Route::get('get_all_uploads',[\App\Http\Controllers\Admin\AdminController::class,'get_all_uploads'])->name('get_all_uploads');
        Route::get('user-profile/{id}',[\App\Http\Controllers\Admin\AdminController::class,'user_profile'])->name('user-profile');
        Route::get('user-uploads/{id}',[\App\Http\Controllers\Admin\AdminController::class,'user_uploads'])->name('user-uploads');
        Route::get('user-downloads/{id}',[\App\Http\Controllers\Admin\AdminController::class,'user_downloads'])->name('user-downloads');
        Route::get('user-transactions/{id}',[\App\Http\Controllers\Admin\AdminController::class,'user_transactions'])->name('user-transactions');
        Route::get('document-view/{id}',[\App\Http\Controllers\Admin\AdminController::class,'document_view'])->name('document-view');
        Route::post('deleteFile/{id}',[\App\Http\Controllers\Admin\AdminController::class,'delete_file'])->name('deleteFile');

        Route::get('general-ledger',[\App\Http\Controllers\Admin\TransactionController::class,'general_ledger'])->name('general-ledger');
        Route::get('sales',[\App\Http\Controllers\Admin\TransactionController::class,'sales'])->name('sales');
        Route::get('get_all_sales',[\App\Http\Controllers\Admin\TransactionController::class,'get_all_sales'])->name('get_all_sales');
        Route::get('withdrawals',[\App\Http\Controllers\Admin\TransactionController::class,'withdrawals'])->name('withdrawals');
        Route::get('get_all_withdrawals',[\App\Http\Controllers\Admin\TransactionController::class,'get_all_withdrawals'])->name('get_all_withdrawals');
        Route::get('transactions',[\App\Http\Controllers\Admin\TransactionController::class,'transactions'])->name('transactions');
        Route::get('get_all_transactions',[\App\Http\Controllers\Admin\TransactionController::class,'get_all_transactions'])->name('get_all_transactions');
        Route::get('fetch-general-ledger',[\App\Http\Controllers\Admin\TransactionController::class,'fetch_general_ledger'])->name('fetch-general-ledger');
        Route::get('account-balance',[\App\Http\Controllers\Admin\TransactionController::class,'account_balance'])->name('Admin-account-balance');
        Route::get('fetch-account-balance',[\App\Http\Controllers\Admin\TransactionController::class,'fetch_account_balance'])->name('fetch-account-balance');


        Route::resource('subjects', \App\Http\Controllers\Admin\SubjectController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

        Route::get('profile',[\App\Http\Controllers\Admin\SettingController::class,'profile'])->name('Adminprofile');
        Route::get('system-users',[\App\Http\Controllers\Admin\SettingController::class,'system_users'])->name('system-users');
        Route::post('post-users',[\App\Http\Controllers\Admin\SettingController::class,'post_user'])->name('postUser');

        Route::get('blogs',[App\Http\Controllers\BlogController::class,'adminBlog'])->name('admin-blogs');
        Route::get('blogs/create',[App\Http\Controllers\BlogController::class,'create']);
        Route::get('blogs/edit/{id}',[App\Http\Controllers\BlogController::class,'edit']);
        Route::post('blogs/store',[App\Http\Controllers\BlogController::class,'store']);

    });

});
Route::post('payment',[App\Http\Controllers\PesapalController::class,'payment']);
Route::get('pesapal-callback',[App\Http\Controllers\PesapalAPIController::class,'handleCallback'])->name('pesapal-callback');
Route::get('pesapal-ipn', ['as'=>'pesapal-ipn', 'uses'=>'Knox\Pesapal\PesapalAPIController@handleIPN']);
Route::get('donepayment',[App\Http\Controllers\PesapalController::class,'paymentsuccess'])->name('paymentsuccess');
Route::get('paymentconfirmation', [App\Http\Controllers\PesapalController::class,'paymentconfirmation'])->name('paymentconfirmation');

Route::group(['prefix' => '/webhooks'], function () {
    //PESAPAL
});
