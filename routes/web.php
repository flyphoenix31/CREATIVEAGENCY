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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ChatUserController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DomainController;

Route::get( '/clearcache', function () {
    $exitCode = Artisan::call( 'cache:clear' );
    $exitCode = Artisan::call( 'view:clear' );
    $exitCode = Artisan::call( 'config:clear' );
    return response()->json(['success' => true, 'message' => 'cache:cleared']);
} )->name( 'clearcache' );

Route::get( '/deploy', function () {
    $exitCode = Artisan::call( 'deploy:prod' );
    return response()->json(['success' => true, 'message' => 'Done']);
} )->name( 'deploy' );



//Site Controller
Route::get('/', [SiteController::class, 'index'])->name( 'home' );
Route::get('contact-us', [SiteController::class, 'contactus'])->name( 'contact_us' );
Route::get('about', [SiteController::class, 'about'])->name( 'about' );
Route::get('services', [SiteController::class, 'services'])->name( 'services' );
Route::get('services/{type?}', [SiteController::class, 'service_more'])->name( 'service_detail' );
Route::get('portfolio', [SiteController::class, 'portfolio'])->name( 'portfolio' );
Route::get('portfolio/{type?}', [SiteController::class, 'portfolio_detail'])->name( 'portfolio_detail' );
Route::post('new-request', [SiteController::class, 'createRequest'])->name( 'storeNewrequest' );
Route::get('new-enquiry', [SiteController::class, 'showEnquiry'])->name( 'newenquiry' );
Route::post('store-enquiry', [SiteController::class, 'createEnquiry'])->name( 'store_enquiry' );

//Auth::routes(['verify' => true]);


//Shared Links
Route::get('view-invoice/{id?}', [InvoiceController::class, 'intdownload'])->name( 'dow_in' );

Route::get('quotation/{id?}', [QuotationController::class, 'viewQuotation'])->name( 'view_quotation' );

Route::post('check/protected', [ShareController::class, 'checkPassword'])->name( 'check_share_password' );

Route::get('shared/{uuid}/{folder?}', [ShareController::class, 'show'])->name( 'shared_filesorfolder' );

Route::get('download/{uuid}/{folder?}', [ShareController::class, 'download'])->name( 'download_files' );

Route::get('sharedfile/{name}', [FileAccessController::class, 'get_shared_file'])->name('get_shared_file');
Route::get('sharedthumbnail/{name}', [FileAccessController::class, 'get_share_thumbnail'])->name('get_share_thumbnail');

Route::post('sharedfile/add-comment', [CommentController::class, 'store'])->name('add_commnent');
Route::post('sharedfile/reply/store', [CommentController::class, 'replyStore'])->name('add_reply_comment');


Route::group( [ 'namespace' => 'Auth','middleware' => [ 'guest'] ], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name( 'login' );
    Route::post('login', [LoginController::class, 'dologin'])->name( 'submit_login' );
});

Route::group( [ 'prefix' => 'portal', 'middleware' => [ 'auth' ] ], function ()
{
    //Dashbord
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name( 'dashboard' );

    //Job
    Route::get('job/list', [JobController::class, 'list'])
        ->name( 'list_jobs' )
        ->middleware('role_or_permission:superadmin|manage_job');
    Route::get('job/show', [JobController::class, 'show'])
        ->name( 'view_job' )
        ->middleware('role_or_permission:superadmin|manage_job');
    Route::get('job/add', [JobController::class, 'create'])
        ->name( 'add_job' )
        ->middleware('role_or_permission:superadmin|create_job');
    Route::post('job/store', [JobController::class, 'store'])
        ->name( 'store_job' )
        ->middleware('role_or_permission:superadmin|create_job');
    Route::get('job/view/{slug}', [JobController::class, 'view'])
        ->name( 'view_job' )
        ->middleware('role_or_permission:superadmin|manage_job');
    Route::get('job/edit/{id?}', [JobController::class, 'edit'])
        ->name( 'edit_job' )
        ->middleware('role_or_permission:superadmin|update_job');
    Route::post('job/update', [JobController::class, 'update'])
        ->name( 'update_job' )
        ->middleware('role_or_permission:superadmin|update_job');
    Route::delete('job/delete', [JobController::class, 'destroy'])
        ->name( 'delete_job' )
        ->middleware('role_or_permission:superadmin|delete_job');

    Route::get('job/request/{slug?}', [JobController::class, 'viewRequests'])
        ->name( 'job_requests' )
        ->middleware('role_or_permission:superadmin|manage_job');


    Route::get('job/manage-request', [JobController::class, 'show'])
        ->name( 'manage_work_request' )
        ->middleware('role_or_permission:superadmin|manage_job');
    Route::post('job/close', [JobController::class, 'close'])
        ->name( 'close_job_ad' )
        ->middleware('role_or_permission:superadmin|manage_job');



    Route::post('job/ack', [JobController::class, 'acceptJob'])
        ->name( 'ack_job' )
        ->middleware('role_or_permission:superadmin|view_job');
    Route::post('job/reject', [JobController::class, 'rejectJob'])
        ->name( 'reject_job' )
        ->middleware('role_or_permission:superadmin|view_job');
    Route::get('jobs/open', [JobController::class, 'jobList'])
        ->name( 'job_cards' )
        ->middleware('role_or_permission:superadmin|view_job');

    Route::get('job/dsv/{slug}', [JobController::class, 'view'])
        ->name( 'designer_view_job' )
        ->middleware('role_or_permission:superadmin|view_job');

    Route::get('jobs/history', [JobController::class, 'jobHistory'])
        ->name( 'my_job_history' )
        ->middleware('role_or_permission:superadmin|view_job');
    Route::get('jobs/my-jobs', [JobController::class, 'activeJobList'])
        ->name( 'my_active_jobs' )
        ->middleware('role_or_permission:superadmin|view_job');
    Route::post('jobs/search', [JobController::class, 'searchJob'])
        ->name( 'search_job' )
        ->middleware('role_or_permission:superadmin|view_job');



    Route::get('jobs', [JobController::class, 'list'])
        ->name( 'bid_job' )
        ->middleware('role_or_permission:superadmin|view_job');
    Route::get('job/bid', [JobController::class, 'bidJob'])
        ->name( 'bid_job' )
        ->middleware('role_or_permission:superadmin|view_job');


    //Portfolio portfolio
    Route::get('portfolio', [PortfolioController::class, 'list'])
        ->name( 'portfoliolist' )
        ->middleware('role_or_permission:superadmin|view_portfolio');
    Route::get('view-portfolio', [PortfolioController::class, 'show'])
        ->name( 'view_portfolio' )
        ->middleware('role_or_permission:superadmin|view_portfolio');
    Route::get('add-portfolio', [PortfolioController::class, 'create'])
        ->name( 'add_portfolio' )
        ->middleware('role_or_permission:superadmin|add_portfolio');
    Route::post('store-portfolio', [PortfolioController::class, 'store'])
        ->name( 'store_portfolio' )
        ->middleware('role_or_permission:superadmin|add_portfolio');
    Route::get('edit-portfolio/{id?}', [PortfolioController::class, 'edit'])
        ->name( 'edit_portfolio' )
        ->middleware('role_or_permission:superadmin|update_portfolio');
    Route::post('update-portfolio', [PortfolioController::class, 'update'])
        ->name( 'update_portfolio' )
        ->middleware('role_or_permission:superadmin|update_portfolio');
    Route::delete('delete-portfolio', [PortfolioController::class, 'destroy'])
        ->name( 'delete_portfolio' )
        ->middleware('role_or_permission:superadmin|delete_portfolio');

    //Enquiry
    Route::get('enquiry-list', [AdminController::class, 'enquiryList'])
        ->name( 'enquirylist' )
        ->middleware('role_or_permission:superadmin|view_enquiry');
    Route::get('view-enquiry', [AdminController::class, 'viewEnquiry'])
        ->name( 'view_enquiry' )
        ->middleware('role_or_permission:superadmin|view_enquiry');
    Route::post('convert-enquiry', [AdminController::class, 'convertEnquiry'])
        ->name( 'convert_enquiry' )
        ->middleware('role_or_permission:superadmin|convert_enquiry');
    Route::post('reply-enquiry', [AdminController::class, 'replyEnquiry'])
        ->name( 'reply_enquiry' )
        ->middleware('role_or_permission:superadmin|reply_enquiry');
    Route::delete('delete-enquiry', [AdminController::class, 'destroyEnquiry'])
        ->name( 'delete_enquiry' )
        ->middleware('role_or_permission:superadmin|delete_enquiry');

    //Contact
    Route::get('contact/list', [ContactController::class, 'list'])
        ->name( 'contactlist' )
        ->middleware('role_or_permission:superadmin|view_contact');
    Route::get('contact/show', [ContactController::class, 'showContact'])
        ->name( 'show_contact' )
        ->middleware('role_or_permission:superadmin|view_contact');
    Route::get('contact/view', [ContactController::class, 'viewContact'])
        ->name( 'view_contact' )
        ->middleware('role_or_permission:superadmin|view_contact');
    Route::post('contact/create', [ContactController::class, 'store'])
        ->name( 'store_contact' )
        ->middleware('role_or_permission:superadmin|create_contact');
    Route::post('contact/update', [ContactController::class, 'update'])
        ->name( 'update_contact' )
        ->middleware('role_or_permission:superadmin|edit_contact');
    Route::delete('contact/delete', [ContactController::class, 'destroy'])
        ->name( 'delete_contact' )
        ->middleware('role_or_permission:superadmin|delete_contact');

    //Invoice
    Route::get('invoice-list', [InvoiceController::class, 'list'])
        ->name( 'invoicelist' )
        ->middleware('role_or_permission:superadmin|view_invoice');
    Route::get('new-invoice', [InvoiceController::class, 'create'])
        ->name( 'create_invoice' )
        ->middleware('role_or_permission:superadmin|create_invoice');
    Route::post('store-invoice', [InvoiceController::class, 'store'])
        ->name( 'store_invoice' )
        ->middleware('role_or_permission:superadmin|create_invoice');
    Route::get('edit-invoice/{id?}', [InvoiceController::class, 'edit'])
        ->name( 'edit_invoice' )
        ->middleware('role_or_permission:superadmin|edit_invoice');
    Route::post('update-invoice', [InvoiceController::class, 'update'])
        ->name( 'update_invoice' )
        ->middleware('role_or_permission:superadmin|edit_invoice');
    Route::get('preview-invoice/{id?}', [InvoiceController::class, 'preview'])
        ->name( 'preview_invoice' )
        ->middleware('role_or_permission:superadmin|view_invoice');
    Route::get('download-invoice/{id?}', [InvoiceController::class, 'download'])
        ->name( 'download_invoice' )
        ->middleware('role_or_permission:superadmin|view_invoice');
    Route::post('send-invoice/{id?}', [InvoiceController::class, 'sendInvoiceEmail'])
        ->name( 'email_invoice' )
        ->middleware('role_or_permission:superadmin|email_invoice');
    Route::delete('delete-invoice', [InvoiceController::class, 'destroy'])
        ->name( 'delete_invoice' )
        ->middleware('role_or_permission:superadmin|delete_invoice');

    //Quotation
    Route::get('quotation/list', [QuotationController::class, 'quotationList'])
        ->name( 'list_quotation' )
        ->middleware('role_or_permission:superadmin|view_quotation');
    Route::post('send-quotation', [QuotationController::class, 'sendQuotation'])
        ->name( 'send_quotation' )
        ->middleware('role_or_permission:superadmin|send_quotation');
    Route::get('quotation/get-status', [QuotationController::class, 'GetQuotationStatus'])
        ->name( 'get_quotation_status' )
        ->middleware('role_or_permission:superadmin|status_quotation');
    Route::post('quotation/update-status', [QuotationController::class, 'UpdateQuotationStatus'])
        ->name( 'update_quotation_status' )
        ->middleware('role_or_permission:superadmin|status_quotation');
    Route::post('quotation/store', [QuotationController::class, 'store'])
        ->name( 'store_quotation' )
        ->middleware('role_or_permission:superadmin|view_quotation');

    //File Share
    Route::get('files/{type?}', [FilesController::class, 'FileList'])
        ->name( 'list_files' )
        ->middleware('role_or_permission:superadmin|list_own_files');
    Route::any('file/rename', [FilesController::class, 'rename'])
        ->name( 'rename_file' )
        ->middleware('role_or_permission:superadmin|rename_file');

    Route::post('files/upload', [FilesController::class, 'addFiles'])
        ->name( 'upload_files' )
        ->middleware('role_or_permission:superadmin|upload_files');

    Route::delete('files/delete', [FilesController::class, 'deleteFile'])
        ->name( 'delete_file' )
        ->middleware('role_or_permission:superadmin|delete_files');

    Route::delete('files/delete-permanently', [FilesController::class, 'deletePermanently'])
        ->name( 'delete_file_permanently' )
        ->middleware('role_or_permission:superadmin|delete_files');

    Route::delete('files/restore', [FilesController::class, 'restoreFile'])
        ->name( 'restore_file' )
        ->middleware('role_or_permission:superadmin|restore_files');

    //Folder
    Route::get('folder/{uuid?}', [FolderController::class, 'FolderList'])
        ->name( 'list_folder' )
        ->middleware('role_or_permission:superadmin|list_own_files');

    Route::post('folder/create', [FolderController::class, 'createFolder'])
        ->name( 'create_folder' )
        ->middleware('role_or_permission:superadmin|create_folder');

    Route::delete('folder/delete', [FolderController::class, 'destroy'])
        ->name( 'delete_foler' )
        ->middleware('role_or_permission:superadmin|delete_folder');

    Route::post('folder/rename', [FolderController::class, 'rename'])
        ->name( 'rename_folder' )
        ->middleware('role_or_permission:superadmin|rename_folder');


    //Share
    Route::any('file/share', [ShareController::class, 'createFileShareLink'])
        ->name( 'genarete_share_file_link' )
        ->middleware('role_or_permission:superadmin|share_file');

    Route::any('file/edit-share', [ShareController::class, 'EditShare'])
        ->name( 'edt_share' )
        ->middleware('role_or_permission:superadmin|share_file');

    Route::any('file/sendmail', [ShareController::class, 'mailFileLink'])
        ->name( 'mail_share_link' )
        ->middleware('role_or_permission:superadmin|share_file');

    Route::any('file/removelink', [ShareController::class, 'removeSharing'])
        ->name( 'remove_share_link' )
        ->middleware('role_or_permission:superadmin|share_file');
    Route::get('file/{name}', [FileAccessController::class, 'get_file'])->name('file');
    Route::get('thumbnail/{name}', [FileAccessController::class, 'get_thumbnail'])->name('thumbnail');


    //Profile
    Route::get( 'my-profile',  [UsersController::class, 'myProfile'] )->name( 'myprofile' );
    Route::post( 'update-my-profile',  [UsersController::class, 'postUpdateMyProfile'] )->name( 'updatemyprofile' );
    Route::post('/store-profile-image', [UsersController::class, 'store_profile_image'])
        ->name('store_profile_image')
        ->middleware('role_or_permission:superadmin|change_profile_picture');
    Route::get( 'my-prossfile',  [UsersController::class, 'ss'] )->name( 'update-credentials' );


    //Roles
    Route::get('setting/roles', [RolesController::class, 'index'])
    ->name( 'rolelist' )
    ->middleware('role_or_permission:superadmin');
    Route::get('roles/get-data', [RolesController::class, 'get_role_with_permission'])
        ->name( 'get_role_with_permission' )
        ->middleware('role_or_permission:superadmin');
    Route::post('role/store', [RolesController::class, 'store'])
        ->name( 'store_role' )
        ->middleware('role_or_permission:superadmin');
    Route::post('roles/update-role-permission', [RolesController::class, 'update_role_permission'])
        ->name( 'update_role_permission' )
        ->middleware('role_or_permission:superadmin');
    Route::delete('roles/delete', [RolesController::class, 'destroy'])
        ->name( 'destroy_role' )
        ->middleware('role_or_permission:superadmin');

    //permission
    Route::get('setting/permission', [PermissionsController::class, 'index'])
        ->name( 'permissionlist' )
        ->middleware('role_or_permission:superadmin');
    Route::post('permission/store', [PermissionsController::class, 'store'])
        ->name( 'add_permission' )
        ->middleware('role_or_permission:superadmin');
    Route::get('permission/take', [PermissionsController::class, 'show'])
        ->name( 'get_permission' )
        ->middleware('role_or_permission:superadmin');
    Route::post('permission/update', [PermissionsController::class, 'update'])
        ->name( 'update_permission' )
        ->middleware('role_or_permission:superadmin');
    Route::delete('permission/delete', [PermissionsController::class, 'destroy'])
        ->name( 'delete_permission' )
        ->middleware('role_or_permission:superadmin');

    //users
    Route::get('users', [UsersController::class, 'index'])
        ->name( 'user_list' )
        ->middleware('role_or_permission:superadmin|view_user');
    Route::get('user/show', [UsersController::class, 'showuser'])
        ->name( 'show_user' )
        ->middleware('role_or_permission:superadmin|view_user');
    Route::post('user/store', [UsersController::class, 'store'])
        ->name( 'store_user' )
        ->middleware('role_or_permission:superadmin|create_user');
    Route::post('user/update', [UsersController::class, 'update_user'])
        ->name( 'update_user' )
        ->middleware('role_or_permission:superadmin|edit_user');
    Route::delete('user/delete', [UsersController::class, 'delete_user'])
        ->name( 'delete_user' )
        ->middleware('role_or_permission:superadmin|delete_user');
    Route::get('render-user-status', [UsersController::class, 'get_userstatus'])
        ->name( 'get_userstatus' )
        ->middleware('role_or_permission:superadmin|update_userstatus');
    Route::post('update-user-status', [UsersController::class, 'update_userstatus'])
        ->name( 'update_userstatus' )
        ->middleware('role_or_permission:superadmin|update_userstatus');
    Route::post('update-user-password', [UsersController::class, 'update_password'])
        ->name( 'update_password' )
        ->middleware('role_or_permission:superadmin|reset_user_password');
    Route::delete('bulk-user-delete', [UsersController::class, 'bulk_delete_user'])
        ->name( 'bulk_delete_user' )
        ->middleware('role_or_permission:superadmin|delete_user');
    Route::post('bulk-userstatus-change', [UsersController::class, 'update_bulk_userstatus'])
        ->name( 'update_bulk_userstatus' )
        ->middleware('role_or_permission:superadmin|update_bulk_userstatus');

    //Settings
    Route::get( '/admin/setting', [AdminController::class, 'setting'] )
        ->name( 'site_settings' )
        ->middleware('role_or_permission:superadmin|manage_settings');
    Route::post( '/admin/setting', [AdminController::class, 'update_setting'] )
        ->name( 'store_settings' )
        ->middleware('role_or_permission:superadmin|manage_settings');

    //Mail Setting
    Route::get('/mail-account', [MailController::class, 'list'])->name('mail_settings')->middleware('role_or_permission:superadmin');
	Route::post('/change-mail-account', [MailController::class, 'ChangeMailAccount'])->name('changemailaccount')->middleware('role_or_permission:superadmin');

    Route::post('mail/store', [MailController::class, 'store'])
        ->name( 'store_mail_account' )
        ->middleware('role_or_permission:superadmin');
    Route::get('mail/show', [MailController::class, 'show'])
        ->name( 'show_mail_account' )
        ->middleware('role_or_permission:superadmin');
    Route::post('mail/update', [MailController::class, 'update'])
        ->name( 'update_mail_account' )
        ->middleware('role_or_permission:superadmin');

	Route::get('/mail-limit', [MailController::class, 'DailyLimit'])->name('mail_daily_limit')->middleware('role_or_permission:superadmin');
	Route::get('/mail-error', [MailController::class, 'MailErrorList'])->name('mail_error_list')->middleware('role_or_permission:superadmin');

    //Audit Report
    Route::get('/audit-report', [AuditController::class, 'list'])->name('auditreport')->middleware('role_or_permission:superadmin');
    Route::get('/audit-show', [AuditController::class, 'show'])->name('audit_show_record')->middleware('role_or_permission:superadmin');

    Route::get('/shared-link-list', [ReportController::class, 'sharedLink'])->name('sharelinkviewreport')->middleware('role_or_permission:superadmin');
    Route::get('/mail-error', [MailController::class, 'MailErrorList'])->name('mailerrorreport')->middleware('role_or_permission:superadmin');
    Route::get('/outgoing-mail-report', [MailController::class, 'MailErrorList'])->name('sendmailreport')->middleware('role_or_permission:superadmin');





    //Country Setting
    Route::get('/country-list', [CountryController::class, 'list'])->name('country_list')->middleware('role_or_permission:superadmin');
	Route::post('/activate-country', [CountryController::class, 'activateCountry'])->name('activate_country')->middleware('role_or_permission:superadmin');
    Route::post('/disable-country', [CountryController::class, 'disableCountry'])->name('disable_country')->middleware('role_or_permission:superadmin');



});

Route::group( [ 'prefix' => 'portal/domain', 'middleware' => [ 'auth' ] ], function ()
{
    //Domain Manager
    Route::get('list', [DomainController::class, 'list'])
        ->name( 'domain_list' )
        ->middleware('role_or_permission:superadmin|manage_domain');
    Route::get('show', [DomainController::class, 'show'])
        ->name( 'show_domain' )
        ->middleware('role_or_permission:superadmin|manage_domain');
    Route::get('view', [DomainController::class, 'viewContact'])
        ->name( 'view_domain' )
        ->middleware('role_or_permission:superadmin|manage_domain');
    Route::post('create', [DomainController::class, 'store'])
        ->name( 'store_domain' )
        ->middleware('role_or_permission:superadmin|manage_domain');
    Route::post('update', [DomainController::class, 'update'])
        ->name( 'update_domain' )
        ->middleware('role_or_permission:superadmin|manage_domain');
    Route::delete('delete', [DomainController::class, 'destroy'])
        ->name( 'delete_domain' )
        ->middleware('role_or_permission:superadmin|manage_domain');
});





Route::group( [ 'prefix' => 'notification', 'middleware' => [ 'auth' ] ], function ()
{
    Route::get('list', [NotificationController::class, 'list'])->name('notificationlist');
    Route::post('mark-as-read', [NotificationController::class, 'markAsRead'])->name('notificationmarkasread');
    Route::post('mark-as-unread', [NotificationController::class, 'markAsUnread'])->name('notificationmarkasunread');
    Route::post('mark-all-as-read', [NotificationController::class, 'markAllAsRead'] )->name('notificationmarkallasread');
    Route::post('clear-notification', [NotificationController::class, 'clearRecord'] )->name('clearnotification');
    Route::post('clear-all-notification', [NotificationController::class, 'clearAll'] )->name('clearallnotification');
    Route::get('count', [NotificationController::class, 'getCount'] )->name('getCount');
});

Route::group( [ 'middleware' => [ 'auth' ] ], function ()
{

});

Route::group( [ 'prefix' => 'chat', 'middleware' => [ 'auth' ] ], function ()
{
    Route::get('/', [ChatController::class, 'index'])->name('chat');

    //Message
    Route::get('/message/{id}', [ChatController::class, 'getMessage'])->name('message');
    Route::post('message', [ChatController::class, 'sendMessage']);
    Route::post('typing', [ChatController::class, 'sendTyping']);
    Route::get('/lastmessage/{id}', [ChatController::class, 'getLastMessage']);
    //Search Recent Contact
    Route::get('/recentsearch', [ChatUserController::class, 'recentsearch'] );

    //Update avatar
    //Route::post('/updateavatar', 'UserController@update')->name('updateavatar');

    //Update Name
   // Route::post('/nameupdate', 'UserController@nameupdate')->name('nameupdate');

    //Delete Contact
    //Route::delete('/delete/{id}', 'UserController@destroy')->name('contact.destroy');

    //Search Contact
    Route::get('/search', [ChatUserController::class, 'search'] );



    //chat Message Search
    //Route::get('/messagesearch','UserController@messagesearch');

    //Delete Message
    Route::get('/deleteMessage/{id}', [ChatController::class, 'deleteMessage'] );

    // Delete Conversation
    Route::get('/deleteConversation/{id}', [ChatController::class, 'deleteConversation'] )->name('conversation.delete');

    //Group Create
    Route::post('/groups', [GroupController::class, 'store'] )->name('groups');

    //Group Search
    Route::get('/groupsearch', [GroupController::class, 'groupsearch'] );

    //Group Massage
    Route::get('/groupmessage/{id}', [GroupController::class, 'getGroupMessage'] )->name('groupmessage');
    Route::post('groupmessage',  [GroupController::class, 'sendGroupMessage']);
    Route::get('/grouplastmessage/{id}', [GroupController::class, 'getGroupLastMessage'] );

    // Delete Group Message
    Route::get('/deletegroupmessage/{id}', [GroupController::class, 'deletegroupmessage']);

    // Delete Group Conversation
    Route::get('/deleteGroupConversation/{id}',[GroupController::class, 'deleteGroupConversation'] )->name('groupconversation.delete');

    //Group Message Search
    Route::get('/groupmessagesearch', [GroupController::class, 'groupmessagesearch'] );
});





//Route::any('download-in', [InvoiceController::class, 'download'])->name( 'download_invoice' );



Route::any('logout', [LoginController::class, 'logout'])->name( 'logout' );



Route::get('test-preview-invoice/{id?}', [InvoiceController::class, 'preview'])
        ->name( 'test_preview_invoice' );
