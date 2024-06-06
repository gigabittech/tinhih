<?php

use App\Events\NewTrade;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\CommunityMemberController;
use App\Http\Controllers\Admin\DrCertificateController;
use App\Http\Controllers\Admin\DrSpecializationController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ClientAppointmentController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\InitialEvaluationController;
use App\Http\Controllers\Admin\ProviderScheduleController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Resource\ResourceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssesmentController;
use App\Http\Controllers\Admin\ProgressNoteController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\EventController as APIEventController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PrintfulController;
use App\Http\Controllers\YouTubeController;
use App\Models\Admin\DrSpecialization;
use App\Models\Admin\ClientAppointment;
use App\Models\Admin\Donation;
use App\Models\Admin\InitialEvaluation;

use App\Models\User;

use App\Http\Controllers\Communication\ChatController;
// Identifying Controller
use App\Http\Controllers\IdentifyingData\DFSCustodyController;
use App\Http\Controllers\IdentifyingData\DomesticViolenceController;
use App\Http\Controllers\IdentifyingData\HouseholdEmergencyContactsController;
use App\Http\Controllers\IdentifyingData\InsuranceInformationController;
use App\Http\Controllers\IdentifyingData\PriorTreatmentTherapyGoalsController;
use App\Http\Controllers\IdentifyingData\RelationshipController;
use App\Http\Controllers\IdentifyingData\SymptomsController;
use App\Http\Controllers\IdentifyingData\CorrelatedSymptomsController;
use App\Http\Controllers\IdentifyingData\ParentsInformationController;
use App\Http\Controllers\IdentifyingData\UserCoRelatedSymtomController;
use App\Http\Controllers\IdentifyingData\SchoolWorkController;
use App\Http\Controllers\IdentifyingData\UserSymtomsController;
use App\Models\IdentifyingData\Relationship;
use Illuminate\Support\Facades\Artisan;
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



Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    return redirect()->back();
});
Route::get('/new-trade', function () {
    return view('welcome');
});

Route::fallback(function () {
    if (auth()->user()) {
        return view('errors.404');
    }
    return redirect()->route('login');
});


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['verify' => true]);
Route::get('/logout', [LoginController::class, 'logout']);


Route::get('/authorize', [\App\Http\Controllers\Admin\ZoomMeetingController::class, 'authorizeZoom'])->name('zoom.authorize');
Route::get('/callback', [\App\Http\Controllers\Admin\ZoomMeetingController::class, 'handleCallBack'])->name('zoom.handleCallBack');
Route::get('/change-password', [\App\Http\Controllers\Auth\PasswordController::class, 'changePassword'])->name('changePassword');
Route::post('/update-password', [\App\Http\Controllers\Auth\PasswordController::class, 'updatePassword'])->name('updatePassword');

// Resources Page Controller
Route::get('/recovery-resources', [ResourceController::class, 'recovery'])->name('recovery.resources');
Route::get('/terms-of-use', [ResourceController::class, 'terms_of_use'])->name('terms_of_use');



//Route::get('auth/google', [UserController::class, 'signInwithGoogle'])->name('google.login');
//Route::get('callback/google', [UserController::class, 'callbackToGoogle']);

//Google login
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [LoginController::class, 'handleGoogleCallback']);

//Facebook login
Route::get('/login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);


//Printfull Product
Route::get('/printful/products', [PrintfulController::class, 'getSyncedProducts'])->name('showProduct');
Route::post('/add-to-cart', [PrintfulController::class, 'addCart'])->name('add');
Route::get('/cart', [PrintfulController::class, 'viewCart'])->name('cart');
Route::get('/checkout', [PrintfulController::class, 'checkout'])->name('printful.checkout');
Route::get('/checkout2', [PrintfulController::class, 'processCheckout'])->name('printful.processCheckout');
Route::get('/printful/order/{orderId}', [PrintfulController::class, 'orderConfirmation'])->name('printful.orderConfirmation');


Route::post('/place-order', [PrintfulController::class, 'placeOrder']);


// Route::get('/printful/synced-products', [PrintfulController::class, 'getSyncedProducts']);

// Event Route




Route::group(['prefix' => 'private-panel', 'middleware' => ['auth']], function () {

    Route::get('/get-assessment-by-appointment-id/{id}', [AssesmentController::class, 'getAssessmentByAppointmentId'])->name('getAssessmentByAppointmentId');


    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/videos', [DashboardController::class, 'video'])->name('video');

    // Notification Route
    Route::get('notification-mark-as-read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notification.markRead');


    // Donation Route
    Route::resource('donation', DonationController::class);
    Route::get('checkout', [DonationController::class, 'checkout'])->name('payment.checkout');
    Route::get('toggle-donation', [DonationController::class, 'toggleStatus'])->name('donation.toggleStatus');


    // Events Route
    Route::get('/events', [EventController::class, 'viewEvent'])->name('viewEvent');
    Route::get('toggle-event', [EventController::class, 'toggleStatus'])->name('event.toggleStatus');



    Route::resource('appointment', AppointmentController::class);
    Route::post('appointment-delete-all', [AppointmentController::class, 'deleteAll'])->name('appointments.delete-selected');
    Route::get('toggle-appointment', [AppointmentController::class, 'toggleStatus'])->name('appointment.toggleStatus');

    Route::get('provider-appointment', [AppointmentController::class, 'providerAppointment'])->name('providerAppointment');

    Route::get('client-appointment', [AppointmentController::class, 'clientAppointment'])->name('clientAppointment');



    // This Route Are For Admin Management
    Route::group(['middleware' => 'admin'], function () {


        Route::get('/client-list', 'App\Http\Controllers\Admin\ClientController@admin_index')->name('client.index');

        Route::resource('admin', AdminController::class);

        // Quote Route
        Route::resource('quote', QuoteController::class);
        Route::post('/quotes/delete-all', [QuoteController::class, 'deleteAll'])->name('quotes.delete-selected');

        // Event Route
        Route::resource('event', EventController::class);
        Route::post('update-event-status', [APIEventController::class, 'updateEventStatus'])->name('event.status-update');
        // Route::post('/events/delete-all', [EventController::class, 'deleteAll'])->name("events.delete-selected");
        Route::post('/events/delete-all', [EventController::class, 'deleteAll'])->name("events.delete-selected");

        // Specialization Route
        Route::resource('specialization', SpecializationController::class);
        Route::post('/specialization/delete-all', [SpecializationController::class, 'deleteAll'])->name("specializations.delete-selected");


        // Certification Route
        Route::resource('certification', CertificationController::class);
        Route::post('/certifications/delete-all', [CertificationController::class, 'deleteAll'])->name("certifications.delete-selected");


        Route::resource('user', UserController::class);
        Route::post('/providers/delete-all', [UserController::class, 'deleteAll'])->name('providers.delete-selected');

        // delete clients
        Route::post('/clients/delete-selected', [ClientController::class, 'deleteAll'])->name('clients.delete-selected');


        // Profile Routes Start
        Route::prefix('/profile')->group(function () {
            Route::get('/profile', 'App\Http\Controllers\Admin\ProfileController@profileAdmin')->name('profile.admin');
            Route::get('/settings/{id}', 'App\Http\Controllers\Admin\ProfileController@adminSettings')->name('profile.settings');

            // Route::get('/profile', 'App\Http\Controllers\Admin\ClientController@admin_profile')->name('profile.admin');
            Route::get('/create', 'App\Http\Controllers\Admin\ClientController@create')->name('profile.create');
            Route::post('/store', 'App\Http\Controllers\Admin\ClientController@store')->name('profile.store');
            Route::get('/edit/{id}', 'App\Http\Controllers\Admin\ClientController@edit')->name('profile.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Admin\ClientController@update')->name('profile.update');
            Route::post('/destroy/{id}', 'App\Http\Controllers\Admin\ClientController@destroy')->name('profile.destroy');
        });
        // Client Routes Ends
    });
    // Admin Routes Ends

    // Provider Routes Start 
    Route::group(['middleware' => 'provider'], function () {
        // Provider Appointment Index
        Route::get('provider-Index', [AppointmentController::class, 'providerIndex'])->name('providerIndex');

        Route::resource('drcertificate', DrCertificateController::class);
        Route::get('toggle-drcertificate', [DrCertificateController::class, 'toggleStatus'])->name('drcertificate.toggleStatus');

        Route::resource('drspecialization', DrSpecializationController::class);
        Route::get('toggle-drspecialization', [DrSpecializationController::class, 'toggleStatus'])->name('drspecialization.toggleStatus');

        Route::resource('provider_schedule', ProviderScheduleController::class);
        Route::get('toggle-provider_schedule', [ProviderScheduleController::class, 'toggleStatus'])->name('provider_schedule.toggleStatus');


        Route::prefix('/provider')->group(function () {
            Route::get('/index', 'App\Http\Controllers\Admin\ProviderController@index')->name('provider.index');
            Route::get('/settings/{id}', 'App\Http\Controllers\Admin\ProviderController@settings')->name('provider.profile.settings');
            Route::get('/create', 'App\Http\Controllers\Admin\ProviderController@create')->name('provider.create');
            Route::post('/store', 'App\Http\Controllers\Admin\ProviderController@store')->name('provider.store');
            Route::get('/edit/{id}', 'App\Http\Controllers\Admin\ProviderController@edit')->name('provider.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Admin\ProviderController@update')->name('provider.update');
            Route::post('/destroy/{id}', 'App\Http\Controllers\Admin\ProviderController@destroy')->name('provider.destroy');
        });
    });
    // Provider Routes End

    // Community Member Routes Start
    Route::group(['middleware' => 'community_member'], function () {

        // This Route Are For profile Management
        Route::prefix('/community_member')->group(function () {
            Route::get('/index', 'App\Http\Controllers\Admin\CommunityMemberController@index')->name('community_member.index');
            Route::get('/settings/{id}', 'App\Http\Controllers\Admin\CommunityMemberController@settings')->name('community_member.profile.settings');
            Route::get('/create', 'App\Http\Controllers\Admin\CommunityMemberController@create')->name('community_member.create');
            Route::post('/store', 'App\Http\Controllers\Admin\CommunityMemberController@store')->name('community_member.store');
            Route::get('/edit/{id}', 'App\Http\Controllers\Admin\CommunityMemberController@edit')->name('community_member.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Admin\CommunityMemberController@update')->name('community_member.update');
            Route::post('/destroy/{id}', 'App\Http\Controllers\Admin\CommunityMemberController@destroy')->name('community_member.destroy');
        });
    });
    // Community Member Routes End

    // Client Routes Start
    Route::group(['middleware' => 'client'], function () {

        // Client Appointment Index
        Route::get('client-index', [AppointmentController::class, 'clientIndex'])->name('clientIndex');
        Route::get('client-appointments', [AppointmentController::class, 'clientAppointments'])->name("client-appointments");

        Route::resource('initial_evaluation', InitialEvaluationController::class);
        Route::get('toggle-initial_evaluation', [InitialEvaluationController::class, 'toggleStatus'])->name('initial_evaluation.toggleStatus');

        // Identifying Route Start

        // Parents Information Route
        Route::resource('insurance', InsuranceInformationController::class);
        Route::get('toggle-insurance', [InsuranceInformationController::class, 'toggleStatus'])->name('insurance.toggleStatus');

        // Parents Information Route
        Route::resource('identifying', ParentsInformationController::class);
        Route::put('identifying1/{id}', [ParentsInformationController::class, 'update1'])->name('identifying.update1');
        Route::get('toggle-identifying', [ParentsInformationController::class, 'toggleStatus'])->name('identifying.toggleStatus');


        Route::resource('household_emergency_contact', HouseholdEmergencyContactsController::class);
        Route::get('toggle-household_emergency_contact', [HouseholdEmergencyContactsController::class, 'toggleStatus'])->name('household_emergency_contact.toggleStatus');

        Route::resource('DFS_custody', DFSCustodyController::class);
        Route::get('toggle-DFS_custody', [DFSCustodyController::class, 'toggleStatus'])->name('DFS_custody.toggleStatus');

        Route::resource('prior_treatment_therapy_goal', PriorTreatmentTherapyGoalsController::class);
        Route::get('toggle-prior_treatment_therapy_goal', [PriorTreatmentTherapyGoalsController::class, 'toggleStatus'])->name('prior_treatment_therapy_goal.toggleStatus');

        Route::resource('relationship', RelationshipController::class);

        Route::resource('domestic_violence', DomesticViolenceController::class);
        Route::get('toggle-domestic_violence', [DomesticViolenceController::class, 'toggleStatus'])->name('domestic_violence.toggleStatus');

        Route::resource('symtoms', SymptomsController::class);
        Route::get('toggle-symtoms', [SymptomsController::class, 'index'])->name('symtoms.toggleStatus');

        Route::resource('co_related_symtoms', CorrelatedSymptomsController::class);
        Route::get('toggle-co_related_symtoms', [CorrelatedSymptomsController::class, 'toggleStatus'])->name('co_related_symtoms.toggleStatus');

        Route::resource('user_co_related_symtoms', UserCoRelatedSymtomController::class);
        Route::get('toggle-user_co_related_symtoms', [UserCoRelatedSymtomController::class, 'toggleStatus'])->name('client_appointment.toggleStatus');

        Route::resource('user_symtoms', UserSymtomsController::class);
        Route::get('toggle-user_co_related_symtoms', [UserSymtomsController::class, 'toggleStatus'])->name('client_appointment.toggleStatus');


        Route::resource('school_work_data', SchoolWorkController::class);
        Route::get('toggle-school_work_data', [SchoolWorkController::class, 'toggleStatus'])->name('school_work_data.toggleStatus');


        Route::prefix('/client')->group(function () {
            Route::get('/index', 'App\Http\Controllers\Admin\ProfileController@profileClient')->name('client.manage');
            Route::get('/settings/{id}', 'App\Http\Controllers\Admin\ProfileController@clientSettings')->name('client.profile.settings');
            Route::get('/create', 'App\Http\Controllers\Admin\ClientController@create')->name('client.create');
            Route::post('/store', 'App\Http\Controllers\Admin\ClientController@store')->name('client.store');
            Route::get('/edit/{id}', 'App\Http\Controllers\Admin\ClientController@edit')->name('client.edit');
            Route::post('/update/{id}', 'App\Http\Controllers\Admin\ClientController@update')->name('client.update');
            Route::post('/destroy/{id}', 'App\Http\Controllers\Admin\ClientController@destroy')->name('client.destroy');
        });



    });
    //  Client Routes End

    // Routes start for all authenticated users
    // Appointment ProgressNote
    Route::resource('progress-notes', ProgressNoteController::class);
    Route::get('/get-progress-note-by-appointment-id/{id}', [ProgressNoteController::class, 'getProgressNotesByAppointmentId'])->name('getProgressNotesByAppointmentId');
    // Assesment Resource
    Route::resource('assesments', AssesmentController::class);
    Route::get('/get-assessment-by-appointment-id/{id}', [AssesmentController::class, 'getAssessmentByAppointmentId'])->name('getAssessmentByAppointmentId');
    // Routes end for all authenticated users


    Route::resource('chat', ChatController::class);
    Route::post('/chat/send', [ChatController::class, 'send']);
    Route::get('/chat-get', [ChatController::class, 'getMessage']);


    // API ROUTES
    Route::get('get-specialization', [\App\Http\Controllers\API\SpecializationController::class, 'getSpecializations'])->name('specializations.get');
    Route::get('get-providers-by-specialization', [\App\Http\Controllers\API\ProviderController::class, 'getSpecifications'])->name('providers.getBySPId');
    Route::get('get-clients', [\App\Http\Controllers\API\ClientController::class, 'getAllClients'])->name('clients.all');
    Route::get('get-patients', [\App\Http\Controllers\API\ClientController::class, 'getClients'])->name('clients.get');
    Route::post('save-appointment', [\App\Http\Controllers\API\AppointmentController::class, 'saveAppointment'])->name('appointment.save');
    Route::get('check-appointment', [\App\Http\Controllers\API\AppointmentController::class, 'checkAppointment'])->name('appointment.check');
    Route::get('get-provider-schedule', [\App\Http\Controllers\API\ProviderController::class, 'getSchedulesOfProviders'])->name('schedules.get');
    // Assessment Complete
    Route::post('assessment-complete', [AssesmentController::class, 'assessmentComplete'])->name('assessmentComplete');
});