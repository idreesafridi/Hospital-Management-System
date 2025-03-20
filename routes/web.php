<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\StripeController;
use App\Models\Notification;




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
// Route::get('/api-search',[WebsiteController::class, 'apiSearch'])->name('api_search');
// Route::get('/search/results', [WebsiteController::class, 'searchApi'])->name('search.results');

Route::get('/', [WebsiteController::class, 'index'])->name('website_index');

Route::get('/doctorlist',[WebsiteController::class,'doctorList'])->name('doctorlist');
Route::get('/doctor-profile/{id}', [WebsiteController::class, 'doctorProfile'])->name('doctor_profile');
Route::get('/doctor-booking/{id}', [WebsiteController::class, 'doctorBooking'])->name('doctor_booking');
Route::get('/contacts',[WebsiteController::class,'contactUs'])->name('contact');
Route::get('/abouts',[WebsiteController::class,'aboutUs'])->name('about');
Route::post('/newsletters', [WebsiteController::class, 'newsletter'])->name('newsletter');
Route::post('/contact-store',[WebsiteController::class,'contactStore'])->name('contact_store');
Route::get('/blogs-list',[WebsiteController::class,'blogList'])->name('bloglist');
Route::get('/blogs-detail/{id}',[WebsiteController::class,'blogDetail'])->name('blogdetail');
Route::post('/comments',[WebsiteController::class,'comment'])->name('comment');
Route::get('/category-wise/{id}',[WebsiteController::class,'categoryWiseBlog'])->name('category_wise');
Route::get('/appointments', [WebsiteController::class, 'getAppointments'])->name('appointments');

Route::post('/book-appointment', [WebsiteController::class, 'book'])->name('book-appointment');

Route::get('/blog/tag/blogdetail/{id}', [WebsiteController::class, 'blogTagdetail'])->name('blog_tagdetails');
Route::get('category/wise/blog/{category}',[WebsiteController::class,'categoryWise'])->name('category_wise');

Route::get('/search', [WebsiteController::class, 'doctorSearch'])->name('search.results');
Route::get('/search-doctor', [WebsiteController::class, 'searchDoctor'])->name('search.doctor');


Route::get('/dashboards', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/notifications/{notification}/read', function (Notification $notification) {
    $notification->markAsRead();
    return response()->json(['status' => 'success']);
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout', [StripeController::class, 'checkout'])->name('checkout');
    Route::get('/success', [StripeController::class, 'success'])->name('success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');
 
    Route::post('/rating/store', [WebsiteController::class, 'ratingStore'])->name('rating_store');

    Route::get('/index',[BackendController::class, 'index'])->name('backend_index');
    Route::get('/dashboard',[BackendController::class, 'dashboard'])->name('backend_dashboard');

    Route::get('/admin/view/{id}',[BackendController::class, 'adminView'])->name('admin_view');
    Route::get('/admin/edit/{id}',[BackendController::class, 'adminEdit'])->name('admin_edit');
    Route::put('/admin/update/{id}',[BackendController::class, 'adminUpdate'])->name('admin_update');

    Route::get('/specailities',[BackendController::class, 'speciality'])->name('speciality');
    Route::post('/specailities/store',[BackendController::class, 'specialityStore'])->name('speciality_store');
    Route::put('/specailities/update',[BackendController::class, 'specialityUpdate'])->name('speciality_update');
    Route::put('/specailities/status',[BackendController::class, 'specialityStatusUpdate'])->name('update.specialitystatus');
    Route::delete('/specaility/delete/{id}',[BackendController::class, 'specialityDestroy'])->name('speciality_destroy');

    Route::get('/doctors',[BackendController::class, 'doctorList'])->name('doctor');
    Route::get('/patient-doctors',[BackendController::class, 'patientDoctor'])->name('patient_doctor');
    Route::post('/doctors/store',[BackendController::class, 'doctorStore'])->name('doctor_store');
    Route::get('/doctor/view/{id}',[BackendController::class, 'doctorView'])->name('doctor_view');
    Route::get('/doctor/edit/{id}',[BackendController::class, 'doctorEdit'])->name('doctor_edit');
    Route::put('/doctor/update/{id}',[BackendController::class, 'doctorUpdate'])->name('doctor_update');
    Route::put('/doctor/status',[BackendController::class, 'updateStatus'])->name('update.status');
    Route::delete('/doctor/delete/{id}',[BackendController::class, 'doctorDestroy'])->name('doctor_destroy');

    Route::get('/appointments',[BackendController::class, 'appointment'])->name('appointment');
    Route::post('/appointments/store',[BackendController::class, 'bookappointmentStore'])->name('bookappointment_store');
    Route::put('/appointments/status/{id}',[BackendController::class, 'appointmentStatusUpdate'])->name('appointmentstatus_update');
    Route::get('/appointments/invoice/{id}',[BackendController::class, 'invoiceView'])->name('invoice_view');
   
   

    Route::get('/patients',[BackendController::class, 'patientList'])->name('patient');
    Route::get('/doctor-patients',[BackendController::class, 'doctorPatient'])->name('doctor_patient');
    Route::get('/patient/view/{id}',[BackendController::class, 'patientView'])->name('patient_view');
    Route::get('/patient/edit/{id}',[BackendController::class, 'patientEdit'])->name('patient_edit');
    Route::put('/patient/update/{id}',[BackendController::class, 'patientUpdate'])->name('patient_update');

    Route::get('/ratings',[BackendController::class,'ratingList'])->name('rating');
    Route::put('/rating/update',[BackendController::class,'reviewUpdate'])->name('update.reviewstatus');
    Route::delete('/rating/delete/{id}',[BackendController::class,'reviewDestroy'])->name('review_destroy');
   

    Route::get('categories',[BackendController::class,'categoryList'])->name('category');
    Route::post('categories',[BackendController::class,'categoryStore'])->name('category_store');
    Route::put('categories/update',[BackendController::class,'categoryUpdate'])->name('category_update');
    Route::delete('categories/destroy/{id}',[BackendController::class,'categoryDestroy'])->name('category_destroy');

    Route::get('/blogs',[BackendController::class,'blogList'])->name('blog_list');
    Route::get('/blogs/add',[BackendController::class,'blogAdd'])->name('blog_add');
    Route::post('/blogs-store',[BackendController::class,'blogStore'])->name('blog_store');
    Route::get('/blogs/detail/{id}',[BackendController::class,'blogDetail'])->name('blog_details');
    Route::get('/blogs/edit/{id}',[BackendController::class,'blogEdit'])->name('blog_edit');
    Route::put('/blogs/update/{id}',[BackendController::class,'blogUpdate'])->name('blog_update');
    Route::put('blog/status',[BackendController::class,'blogStatus'])->name('update.blogstatus');
    Route::delete('blog/destroy/{id}',[BackendController::class,'blogDestroy'])->name('blog_destroy');
 
   

    
   
});

require __DIR__.'/auth.php';
