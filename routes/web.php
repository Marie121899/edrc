<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AAController;
use App\Http\Controllers\BAController;
use App\Http\Controllers\CAController;
use App\Http\Controllers\NAController;
use App\Http\Controllers\OAController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\AdminTaxController;
use App\Http\Controllers\ALicenseController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\CitizenTaxController;
use App\Http\Controllers\BusinessTaxController;
use App\Http\Controllers\NonresidentController;
use App\Http\Controllers\AdminLicenseController;
use App\Http\Controllers\OrganizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/*------------------------------------------
--------------------------------------------
All Citizens Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:citizen'])->group(function () {
  
    Route::get('/citizen/home', [HomeController::class, 'index'])->name('home');

    Route::get('/citizen/dashboard', [CitizenController::class, 'index'])->name('citizen.dashboard');
    Route::post('/citizen/dashboard', [CitizenController::class, 'store']);

    /*
     Profile edit
     */
    Route::get('/citizen/profile/profile', [CitizenController::class, 'editProfile'])->name('citizen.profile.profile');
    Route::put('/citizen/profile/profile', [CitizenController::class, 'updateProfile'])->name('citizen.profile.update');
    //update details in admins table
    Route::get('/citizen/profile/profile', [CitizenController::class, 'editProfile'])->name('citizen.profile.profile');
    Route::put('/citizen/profile/profile', [CitizenController::class, 'updateProfile'])->name('citizen.profile.update');

    /*
    Passport Application
    */
    Route::get('/citizen/passport', [PassportController::class, 'index'])->name('citizen.passport.index');
    Route::get('/citizen/passport/create', [PassportController::class, 'create'])->name('citizen.passport.create');
    Route::post('/citizen/passport', [PassportController::class, 'store'])->name('citizen.passport.store');

      /*
    Visa Application
    */
    Route::get('/citizen/visa', [VisaController::class, 'index'])->name('citizen.visa.index');
    Route::get('/citizen/visa/create', [VisaController::class, 'create'])->name('citizen.visa.create');
    Route::post('/citizen/visa', [VisaController::class, 'store'])->name('citizen.visa.store');

    /**
     * Citizen Feedback Module
     */
    Route::get('/citizen/feedback/create', [FeedbackController::class, 'create'])->name('citizen.feedback.create');
    Route::post('/citizen/feedback', [FeedbackController::class, 'store'])->name('citizen.feedback.store');
    Route::get('/citizen/feedback', [FeedbackController::class, 'index'])->name('citizen.feedback.index');

    /**
     * Taxes Module
     */
    Route::get('/citizen/taxes', [CitizenTaxController::class, 'index'])->name('citizen.taxes.index');
    Route::get('/citizen/taxes/create', [CitizenTaxController::class, 'create'])->name('citizen.taxes.create');
    Route::post('/citizen/taxes', [CitizenTaxController::class, 'store'])->name('citizen.taxes.store');
    Route::get('/citizen/taxes/{tax}', [CitizenTaxController::class, 'show'])->name('citizen.taxes.show');

});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/dashboard', [AdminController::class, 'store']);

    /**
     * Profile edit
     */
    Route::get('/admin/profile/profile', [AdminController::class, 'editProfile'])->name('admin.profile.profile');
    Route::put('/admin/profile/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    //update details in admins table
    Route::get('/admin/profile/profile', [AdminController::class, 'editProfile'])->name('admin.profile.profile');
    Route::put('/admin/profile/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    /**
     * Add Users
     */
    //Admin
     Route::get('/admin/admin/list', [AAController::class, 'list'])->name('admin.admin.list');
     Route::get('/admin/admin/add', [AAController::class, 'create']);
     Route::post('/admin/admin/add', [AAController::class, 'store'])->name('admin.admin.store');
     Route::get('/admin/admin/{id}/edit', [AAController::class, 'edit'])->name('admin.admin.edit');
     Route::put('/admin/admin/{id}', [AAController::class, 'update'])->name('admin.admin.update');
     Route::get('admin/admin/{admin_id}/delete', [AAController::class, 'destroy']);
    //Citizen
     Route::get('/admin/citizen/list', [CAController::class, 'list'])->name('admin.citizen.list');
     Route::get('/admin/citizen/add', [CAController::class, 'create']);
     Route::post('/admin/citizen/add', [CAController::class, 'store'])->name('admin.citizen.store');
     Route::get('/admin/citizen/{id}/edit', [CAController::class, 'edit'])->name('admin.citizen.edit');
     Route::put('/admin/citizen/{id}', [CAController::class, 'update'])->name('admin.citizen.update');
     Route::get('admin/citizen/{citizen_id}/delete', [CAController::class, 'destroy']);
    //Non resident
     Route::get('/admin/nonresident/list', [NAController::class, 'list'])->name('admin.nonresident.list');
     Route::get('/admin/nonresident/add', [NAController::class, 'create']);
     Route::post('/admin/nonresident/add', [NAController::class, 'store'])->name('admin.nonresident.store');
     Route::get('/admin/nonresident/{id}/edit', [NAController::class, 'edit'])->name('admin.nonresident.edit');
     Route::put('/admin/nonresident/{id}', [NAController::class, 'update'])->name('admin.nonresident.update');
     Route::get('admin/nonresident/{nonresident_id}/delete', [NAController::class, 'destroy']);
    //Business
     Route::get('/admin/business/list', [BAController::class, 'list'])->name('admin.business.list');
     Route::get('/admin/business/add', [BAController::class, 'create']);
     Route::post('/admin/business/add', [BAController::class, 'store'])->name('admin.business.store');
     Route::get('/admin/business/{id}/edit', [BAController::class, 'edit'])->name('admin.business.edit');
     Route::put('/admin/business/{id}', [BAController::class, 'update'])->name('admin.business.update');
     Route::get('admin/business/{business_id}/delete', [BAController::class, 'destroy']);
    //Organization
     Route::get('/admin/organization/list', [OAController::class, 'list'])->name('admin.organization.list');
     Route::get('/admin/organization/add', [OAController::class, 'create']);
     Route::post('/admin/organization/add', [OAController::class, 'store'])->name('admin.organization.store');
     Route::get('/admin/organization/{id}/edit', [OAController::class, 'edit'])->name('admin.organization.edit');
     Route::put('/admin/organization/{id}', [OAController::class, 'update'])->name('admin.organization.update');
     Route::get('admin/organization/{organization_id}/delete', [OAController::class, 'destroy']);

    /*
    Passport Application
    */
     Route::get('/admin/passports', [PassportController::class, 'list'])->name('admin.passports.list');
     Route::get('/admin/passports/canceled', [PassportController::class, 'cancelled'])->name('admin.passports.cancelled');
     Route::get('/admin/passports/inreview', [PassportController::class, 'inReview'])->name('admin.passports.inreview');
     Route::get('/admin/passports/completed', [PassportController::class, 'completed'])->name('admin.passports.completed');
     Route::get('/admin/passports/processing', [PassportController::class, 'processing'])->name('admin.passports.processing');

     // Edit passport application status
     Route::get('/admin/passports/{passport}/edit', [PassportController::class, 'edit'])->name('admin.passports.edit');
     Route::put('/admin/passports/{passport}', [PassportController::class, 'update'])->name('admin.passports.update');


         /*
    Visa Application
    */
     Route::get('/admin/visas', [VisaController::class, 'list'])->name('admin.visas.list');
     Route::get('/admin/visas/canceled', [VisaController::class, 'canceled'])->name('admin.visas.canceled');
     Route::get('/admin/visas/approved', [VisaController::class, 'approved'])->name('admin.visas.approved');
     Route::get('/admin/visas/processing', [VisaController::class, 'processing'])->name('admin.visas.processing');

        // Edit Visa application status
     Route::get('/admin/visas/{visa}/edit', [VisaController::class, 'edit'])->name('admin.visas.edit');
     Route::put('/admin/visas/{visa}', [VisaController::class, 'update'])->name('admin.visas.update');

     /**
      * Feedbacks routes
      */
      Route::get('/admin/feedbacks', [FeedbackController::class, 'indexAdmin'])->name('admin.feedbacks.list');
      Route::get('/admin/feedbacks/tax', [FeedbackController::class, 'tax'])->name('admin.feedbacks.tax');
      Route::get('/admin/feedbacks/visa', [FeedbackController::class, 'visa'])->name('admin.feedbacks.visa');
      Route::get('/admin/feedbacks/pp', [FeedbackController::class, 'pp'])->name('admin.feedbacks.pp');
      Route::get('/admin/feedbacks/license', [FeedbackController::class, 'license'])->name('admin.feedbacks.license');
     
      /**
     *  Licenses Module
     */
    Route::get('/admin/licenses', [AdminLicenseController::class, 'index'])->name('admin.licenses.index');
    Route::get('/admin/licenses/{license}/edit', [AdminLicenseController::class, 'edit'])->name('admin.licenses.edit');
    Route::put('/admin/licenses/{license}', [AdminLicenseController::class, 'update'])->name('admin.licenses.update');

    /**
     * Taxes Module
     */
    Route::get('/admin/taxes', [AdminTaxController::class, 'index'])->name('admin.taxes.index');
    Route::get('/admin/taxes/{tax}/edit', [AdminTaxController::class, 'edit'])->name('admin.taxes.edit');
    Route::put('/admin/taxes/{tax}', [AdminTaxController::class, 'update'])->name('admin.taxes.update');
    Route::delete('/admin/taxes/{tax}', [AdminTaxController::class, 'destroy'])->name('admin.taxes.destroy');

    Route::get('/admin/taxes/income', [AdminTaxController::class, 'income'])->name('admin.taxes.income');
    Route::get('/admin/taxes/property', [AdminTaxController::class, 'property'])->name('admin.taxes.property');
    Route::get('/admin/taxes/business', [AdminTaxController::class, 'business'])->name('admin.taxes.business');
    Route::get('/admin/taxes/sales', [AdminTaxController::class, 'sales'])->name('admin.taxes.sales');
    Route::get('/admin/taxes/excise', [AdminTaxController::class, 'excise'])->name('admin.taxes.excise');
    Route::get('/admin/taxes/vat', [AdminTaxController::class, 'vat'])->name('admin.taxes.vat');
    Route::get('/admin/taxes/estate', [AdminTaxController::class, 'estate'])->name('admin.taxes.estate');
    Route::get('/admin/taxes/gift', [AdminTaxController::class, 'gift'])->name('admin.taxes.gift');
    Route::get('/admin/taxes/import', [AdminTaxController::class, 'import'])->name('admin.taxes.import');
    Route::get('/admin/taxes/fuel', [AdminTaxController::class, 'fuel'])->name('admin.taxes.fuel');
    Route::get('/admin/taxes/other', [AdminTaxController::class, 'other'])->name('admin.taxes.other');
});
  
/*------------------------------------------
--------------------------------------------
All Non-Resident Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:nonresident'])->group(function () {
  
    Route::get('/nonresident/home', [HomeController::class, 'nonresidentHome'])->name('nonresident.home');

    Route::get('/nonresident/dashboard', [NonresidentController::class, 'index'])->name('nonresident.dashboard');
    Route::post('/nonresident/dashboard', [NonresidentController::class, 'store']);

        /**
     * Profile edit
     */
    Route::get('/nonresident/profile/profile', [NonresidentController::class, 'editProfile'])->name('nonresident.profile.profile');
    Route::put('/nonresident/profile/profile', [NonresidentController::class, 'updateProfile'])->name('nonresident.profile.update');
    //update details in admins table
    Route::get('/nonresident/profile/profile', [NonresidentController::class, 'editProfile'])->name('nonresident.profile.profile');
    Route::put('/nonresident/profile/profile', [NonresidentController::class, 'updateProfile'])->name('nonresident.profile.update');

         /*
    Visa Application
    */
    Route::get('/nonresident/visa', [VisaController::class, 'indexNR'])->name('nonresident.visa.index');
    Route::get('/nonresident/visa/create', [VisaController::class, 'createNR'])->name('nonresident.visa.create');
    Route::post('/nonresident/visa', [VisaController::class, 'storeNR'])->name('nonresident.visa.store');

    /**
     * Non Resident  Feedback Module
     */
    Route::get('/nonresident/feedback/create', [FeedbackController::class, 'createNR'])->name('nonresident.feedback.create');
    Route::post('/nonresident/feedback', [FeedbackController::class, 'storeNR'])->name('nonresident.feedback.store');
    Route::get('/nonresident/feedback', [FeedbackController::class, 'indexNR'])->name('nonresident.feedback.index');
});

/*------------------------------------------
--------------------------------------------
All Business Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:business'])->group(function () {
  
    Route::get('/business/home', [HomeController::class, 'businessHome'])->name('business.home');

    Route::get('/business/dashboard', [BusinessController::class, 'index'])->name('business.dashboard');
    Route::post('/business/dashboard', [BusinessController::class, 'store']);

    /**
     * Profile edit
     */
    Route::get('/business/profile/profile', [BusinessController::class, 'editProfile'])->name('business.profile.profile');
    Route::put('/business/profile/profile', [BusinessController::class, 'updateProfile'])->name('business.profile.update');
    //update details in admins table
    Route::get('/business/profile/profile', [BusinessController::class, 'editProfile'])->name('business.profile.profile');
    Route::put('/business/profile/profile', [BusinessController::class, 'updateProfile'])->name('business.profile.update');

    /**
     * Business  Feedback Module
     */
    Route::get('/business/feedback/create', [FeedbackController::class, 'createB'])->name('business.feedback.create');
    Route::post('/business/feedback', [FeedbackController::class, 'storeB'])->name('business.feedback.store');
    Route::get('/business/feedback', [FeedbackController::class, 'indexB'])->name('business.feedback.index');

    /**
     *  Licenses Module
     */
    Route::get('/business/licenses', [LicenseController::class, 'index'])->name('licenses.index');
    Route::get('/business/licenses/apply', [LicenseController::class, 'showApplyForm'])->name('licenses.apply');
    Route::post('/business/licenses/apply', [LicenseController::class, 'apply']);

    /**
     * Taxes Module
     */
    Route::get('/business/taxes', [BusinessTaxController::class, 'index'])->name('business.taxes.index');
    Route::get('/business/taxes/create', [BusinessTaxController::class, 'create'])->name('business.taxes.create');
    Route::post('/business/taxes', [BusinessTaxController::class, 'store'])->name('business.taxes.store');
    Route::get('/business/taxes/{tax}', [BusinessTaxController::class, 'show'])->name('business.taxes.show');


});

/*------------------------------------------
--------------------------------------------
All Organization Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:organization'])->group(function () {
  
    Route::get('/organization/home', [HomeController::class, 'organizationHome'])->name('organization.home');

    Route::get('/organization/dashboard', [OrganizationController::class, 'index'])->name('organization.dashboard');
    Route::post('/organization/dashboard', [OrganizationController::class, 'store']);

                /**
     * Profile edit
     */
    Route::get('/organization/profile/profile', [OrganizationController::class, 'editProfile'])->name('organization.profile.profile');
    Route::put('/organization/profile/profile', [OrganizationController::class, 'updateProfile'])->name('organization.profile.update');
    //update details in admins table
    Route::get('/organization/profile/profile', [OrganizationController::class, 'editProfile'])->name('organization.profile.profile');
    Route::put('/organization/profile/profile', [OrganizationController::class, 'updateProfile'])->name('organization.profile.update');

    /**
     * Org  Feedback Module
     */
    Route::get('/organization/feedback/create', [FeedbackController::class, 'createO'])->name('organization.feedback.create');
    Route::post('/organization/feedback', [FeedbackController::class, 'storeO'])->name('organization.feedback.store');
    Route::get('/organization/feedback', [FeedbackController::class, 'indexO'])->name('organization.feedback.index');


});

Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'perform'])->name('logout.perform');
 
