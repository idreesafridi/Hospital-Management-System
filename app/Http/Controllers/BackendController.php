<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Speciality;
use App\Models\Category;
use App\Models\Education;
use App\Models\DoctorAttachment;
use App\Models\WorkExperience;
use App\Models\SpecialityFile;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\BlogAttachment;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\DoctorRegistered;
use App\Notifications\AppointmentCreated;
use Illuminate\Support\Facades\Notification;
use App\Models\Invoice;

class BackendController extends Controller
{
    public function dashboard()
    {
        $patients = User::where('role','Patient')->get();
        $doctors = User::where('role','Doctor')->get();
        $specialities = Speciality::get();
        $appointment = Appointment::get();
        $totalAmount = Appointment::sum('amount');
        $acceptedCounts = [];
        $rejectedCounts = [];
        $paidCounts = [];
        for ($month = 1; $month <= 12; $month++) {
            $acceptedCounts[] = Appointment::where('status', 'Accept')
                ->whereMonth('created_at', $month)
                ->count();
            $rejectedCounts[] = Appointment::where('status', 'Reject')
                ->whereMonth('created_at', $month)
                ->count();
            $paidCounts[] = Appointment::where('status', 'Paid')
                ->whereMonth('created_at', $month)
                ->count();
        }
        $paidCount = Appointment::where('status', 'Paid')->count();
        $rejectedCount = Appointment::where('status', 'Reject')->count();
    
        
        return view('backend.dashboard',compact('patients','doctors','appointment','totalAmount','paidCount','rejectedCount','acceptedCounts','rejectedCounts','paidCounts','specialities'));
    }

    public function AdminView($id){
        $admin = User::find($id);
        return view('backend.admin_view',compact('admin'));
    }
    public function AdminEdit($id){
        $admin = User::find($id);
        return view('backend.admin_update',compact('admin'));
    }

    public function adminUpdate(Request $request,$id)
    {
        // return $request->all();
        $result = User::where('id',$id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            // 'status' => $request->status,
        ]);
        $profile = Profile::where('user_id',$id)->first();
        $filePath = $profile->profile_image;   
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $this->deleteFile($filePath);
            $filePath = $this->storeFile('profile_images', $file);
        }
        
             $result  = Profile::where('user_id',$id)->update([
                    'profile_image' => $filePath,
                    'phone_number' =>$request->phone_number ,
                    'date_of_birth'=>$request->date_of_birth ,
                    'address'=>$request->address ,
                    'about'=>$request->about ,
                ]);
           
                if( $result!=null){
                    return redirect()->route('admin_view',$id)->with(['type'=>'success','msg'=>'Admin Profile Update successfully','title'=>'Done!']);
                }else{
                    return redirect()->route('admin_view',$id)->with(['type'=>'error','msg'=>'Unable to Update Admin Profile','title'=>'Fail!']);
                }
    }
 
    public function speciality()
    {
        $specialities = Speciality::get();
        return view('backend.speciality',compact('specialities'));
    }

    public function specialityStore(Request $request)
    {
        //   return $request->all();
        extract($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean', 
        ]);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filePath = $this->storeFile('Speciality_images', $file); 
       
        }
        $speciality = Speciality::create([
            'parent_id'=>$request->parent_id,
            'name'=>$request->name,
            'status' => $request->status,
            'file' => $filePath,
        ]);
        
      
        if( $speciality!=null){
            return redirect()->route('speciality')->with(['type'=>'success','msg'=>'speciality created successfully','title'=>'Done!']);
        }else{
            return redirect()->route('speciality')->with(['type'=>'error','msg'=>'Unable to create speciality','title'=>'Fail!']);
        }
       
    }  

    public function specialityStatusUpdate(Request $request)
    {
        $speciality = Speciality::find($request->id);
    if ($speciality) {
        $speciality->status = $request->status;
        $speciality->save();
        return response()->json(['message' => 'Status updated successfully']);
    }
    return response()->json(['message' => 'Speciality not found'], 404);
    }

    public function specialityUpdate(Request $request)
   
    {
        //   return $request->all();
         extract($request->all());
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'status' => 'required|boolean', 
         ]);
         $Speciality = Speciality::where('id',$speciality_id)->first();
         $filePath = $Speciality->file;   
         if ($request->hasFile('file') && $request->file('file')->isValid()) {
             $file = $request->file('file');
             $this->deleteFile($filePath);
             $filePath = $this->storeFile('Speciality_images', $file);
         }

         $speciality = Speciality::where('id',$speciality_id)->update(['name'=>$name,'status'=>$status,'file'=>$filePath ,]);
         if($speciality){
             return redirect()->route('speciality')->with(['type'=>'success','msg'=>'Category Update successfully','title'=>'Done!']);
         }else{
             return redirect()->route('speciality')->with(['type'=>'error','msg'=>'Unable to Update category','title'=>'Fail!']);
         }
    }

    public function specialityDestroy($id)
    {
        $speciality = Speciality::find($id);

        if ($speciality) {
            $speciality->delete();
            return redirect()->route('speciality')->with(['type'=>'success','msg'=>'Speciality Deleted successfully','title'=>'Done!']);
        }else{
            return redirect()->route('speciality')->with(['type'=>'error','msg'=>'Unable to Delete Speciality','title'=>'Fail!']);
        }
    }

    public function doctorList()
    {
        $specialities = speciality::where('status',1)->get();

       $doctors = User::where('role', 'Doctor')->get();
        return view('backend.doctor_list',compact('doctors','specialities'));
    }

    public function patientDoctor()
    {
     $user = auth()->user();
    if($user->role === 'Patient'){
        $doctors = $user->patientappointments->where('patient_id',$user->id)->unique('doctor_id');
    }
      return view('backend.patient_doctor',compact('doctors'));
    }

    public function doctorStore(Request $request)
    {
        //  return $request->all();
        extract($request->all());
        $request->validate([
            'email' => 'required|email|unique:users,email', 
             'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);
        // var_dump($request->hasFile('file') && $request->file('file')->isValid());die;
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'role' =>$request->role,
            'password' => Hash::make($request->password),
        ]);

            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $file = $request->file('file');
                $filePath = $this->storeFile('doctor_images', $file); 
        
            }
            
            $Profile = Profile::create([
                'user_id' => $user->id,
                'profile_image' => $filePath,
                'speciality_id' =>  $request->speciality_id,
                
            ]);

            Education::create([
                'doctor_id' => $user->id,
            ]);
            WorkExperience::create([
                'doctor_id' => $user->id,
            ]);

            DoctorAttachment ::create([
                'doctor_id' => $user->id,
            ]);
        Mail::to($user->email)->send(new DoctorRegistered($user, 'password'));
           
            
    if( $Profile!=null){
        return redirect()->route('doctor')->with(['type'=>'success','msg'=>'Doctor created successfully','title'=>'Done!']);
       
    }
    else{
        return redirect()->route('doctor')->with(['type'=>'error','msg'=>'Unable to create Doctor','title'=>'Fail!']);
     }
    }
    public function doctorView($id){
        $doctor = User::with(['profile', 'education','doctorfiles','work'])->findOrFail($id);
        return view('backend.doctor_view',compact('doctor'));
    }
    public function doctorEdit($id){
        $doctor = User::find($id);
        return view('backend.doctor_update',compact('doctor'));
    }

    public function updateStatus(Request $request)
    {
        $doctor = User::find($request->id);
    if ($doctor) {
        $doctor->status = $request->status;
        $doctor->save();
        return response()->json(['message' => 'Status updated successfully']);
    }
    return response()->json(['message' => 'Doctor not found'], 404);
    }

    public function doctorUpdate(Request $request,$id)
    {
        //   return $request->all();
        extract($request->all());
        $user = User::where('id',$id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            // 'status' => $request->status,
        ]);

        $profile = Profile::where('user_id',$id)->first();
        $filePath = $profile->profile_image;   
        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {
            $file = $request->file('profile_image');
            $this->deleteFile($filePath);
            $filePath = $this->storeFile('profile_images', $file);
        }
        
        $profile  = Profile::where('user_id',$id)->update([
            'profile_image' => $filePath,
            'phone_number' =>$request->phone_number ,
            'date_of_birth'=>$request->date_of_birth ,
            'address'=>$request->address ,
            'about'=>$request->about ,
            'fee' => $request->fee,
            'start_time' =>$request->start_time,
            'end_time' => $request->end_time,
        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
            $path = $this->storeFile('doctor_attachments',$file);
            $doctorfile = DoctorAttachment::UpdateorCreate([
                    'doctor_id' => $id,
                    'file' => $path, 
                ] );
            }   
        }
        //single 
        // $education = Education::where('doctor_id',$id)->update([
        //  'university' => $request->university ,
        // 'degree' => $request->degree ,
        // 'start_date' => $request->start_date ,
        // 'end_date' => $request->end_date ,
        // ]);

        //multiple
        // Validate the inputs
    $request->validate([
        'university' => 'array|required',
        'university.*' => 'string|required',
        'degree' => 'array|required',
        'degree.*' => 'string|required',
        'start_date' => 'array|required',
        'start_date.*' => 'date|required',
        'end_date' => 'array|required',
        'end_date.*' => 'date|required',
        'education_id' => 'array|required', 
    ]);

    foreach ($request->university as $key => $university) {
        if (!empty($request->education_id[$key])) {
            Education::where('id', $request->education_id[$key])
                ->where('doctor_id', $id) 
                ->update([
                    'university' => $university,
                    'degree' => $request->degree[$key],
                    'start_date' => $request->start_date[$key],
                    'end_date' => $request->end_date[$key],
                ]);
        } else {
            // Create a new education record
            Education::create([
                'doctor_id' => $id,
                'university' => $university,
                'degree' => $request->degree[$key],
                'start_date' => $request->start_date[$key],
                'end_date' => $request->end_date[$key],
            ]);
        }
    }

        // single 
        // $work = WorkExperience::where('doctor_id',$id)->update([
        //     'hospital' => $request->hospital ,
        //    'start_date' => $request->work_start_date ,
        //    'end_date' => $request->work_end_date ,
        //    ]);

            // mulitple 
           
             // Validate the inputs
    $request->validate([
        'hospital' => 'array|required',
        'hospital.*' => 'string|required',
        'start_date' => 'array|required',
        'start_date.*' => 'date|required',
        'end_date' => 'array|required',
        'end_date.*' => 'date|required',
        'work_id' => 'array|required', // Ensure work_id is an array
    ]);

    foreach ($request->hospital as $key => $hospital) {
        if (isset($request->work_id[$key])) {
           $work = WorkExperience::where('id', $request->work_id[$key])
                ->where('doctor_id', $id) 
                ->update([
                    'hospital' => $hospital,
                    'start_date' => $request->start_date[$key],
                    'end_date' => $request->end_date[$key],
                ]);
        } else {
          $work = WorkExperience::create([
                'doctor_id' => $id,
                'hospital' => $hospital,
                'start_date' => $request->start_date[$key],
                'end_date' => $request->end_date[$key],
            ]);
        }
    }

        if($work !=null)
         {
            return redirect()->route('doctor_view',$id)->with(['type'=>'success','msg'=>'Patient Profile Update successfully','title'=>'Done!']);
         }
        else{
            return redirect()->route('doctor_view',$id)->with(['type'=>'error','msg'=>'Unable to Update Patient Profile','title'=>'Fail!']);
            }
    }

    public function doctorDestroy($id)
    {
        $doctor = User::find($id);
        if ($doctor) {
            $doctor->delete();
            return redirect()->route('doctor')->with(['type'=>'success','msg'=>'Doctor Deleted successfully','title'=>'Done!']);
        }else{
            return redirect()->route('doctor')->with(['type'=>'error','msg'=>'Unable to Delete Doctor','title'=>'Fail!']);
        }
    }

    public function patientList()
    {
        $patients = User::where('role','Patient')->get();
        return view('backend.patient_list',compact('patients'));
    }

    
    public function doctorPatient()
    {
        $user = Auth()->user();
        if($user->role === 'Doctor'){
            $patients = $user->doctorappointments->where('doctor_id',$user->id)->unique('patient_id');
        }
        return view('backend.doctor_patient',compact('patients'));
    }

    public function patientView($id){
        $patient = User::find($id);
        return view('backend.patient_view',compact('patient'));
    }
    public function patientEdit($id){
        $patient = User::find($id);
        return view('backend.patient_update',compact('patient'));
    }

    public function patientUpdate(Request $request,$id)
    {
        // return $request->all();
        $result = User::where('id',$id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            // 'status' => $request->status,
        ]);
        $profile = Profile::where('user_id',$id)->first();
        $filePath = $profile->profile_image;   
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $this->deleteFile($filePath);
            $filePath = $this->storeFile('profile_images', $file);
        }
             $result  = Profile::where('user_id',$id)->update([
                    'profile_image' => $filePath,
                    'phone_number' =>$request->phone_number ,
                    'date_of_birth'=>$request->date_of_birth ,
                    'address'=>$request->address ,
                    'about'=>$request->about ,
                ]);
           
                if( $result!=null){
                    return redirect()->route('patient_view',$id)->with(['type'=>'success','msg'=>'Patient Profile Update successfully','title'=>'Done!']);
                }else{
                    return redirect()->route('patient_view',$id)->with(['type'=>'error','msg'=>'Unable to Update Patient Profile','title'=>'Fail!']);
                }
    }

    public function patientDestroy($id)
    {
        $patient = User::find($id);
        if ( $patient) {
            $patient->delete();
            return redirect()->route('patient')->with(['type'=>'success','msg'=>'Patient Deleted successfully','title'=>'Done!']);
        }else{
            return redirect()->route('patient')->with(['type'=>'error','msg'=>'Unable to Delete Patient','title'=>'Fail!']);
        }
    }

    public function appointment()
    {
        $user = auth()->user();
        if($user->role === 'Patient'){
        $appointments = $user->patientappointments->where('patient_id',$user->id);
        }
        if($user->role === 'Doctor'){
            $appointments = $user->doctorappointments->where('doctor_id',$user->id);
        }
        if($user->role === 'Admin'){
            $appointments = Appointment::get();
        }

        $doctors = User::where('role','Doctor')->get();
        return view('backend.appointments',compact('appointments','doctors'));
    }
    public function bookappointmentStore(Request $request)
    {
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'appointment_time' => $request->Appointmenttime,
            'appointment_date' => $request->Appointmentdate,
            'status' => $request->status,
        ]);
    
        // Find the doctor by the given doctor_id
        $doctor = user::find($request->doctor_id);
    
        // Send the notification to the doctor
        if ($doctor) {
            $appointment->doctor->notify(new AppointmentCreated($appointment));
        }
        if($appointment!=null){
            return redirect()->route('appointment')->with(['type'=>'success','msg'=>'Appointment Book successfully','title'=>'Done!']);
        }else{
            return redirect()->route('appointment')->with(['type'=>'error','msg'=>'Unable to Book Appointment','title'=>'Fail!']);
        }

    }

    public function appointmentStatusUpdate(Request $request, $id)
    {
        // return $id;
        // return $request->all();
        $appointment = Appointment::where('id',$id)->update([
            'status' => $request->status,
            
        ]);
        if($appointment!=null){
            return redirect()->route('appointment')->with(['type'=>'success','msg'=>'Appointment Status Update successfully','title'=>'Done!']);
        }else{
            return redirect()->route('appointment')->with(['type'=>'error','msg'=>'Unable to Update Appointment Status','title'=>'Fail!']);
        }
    }

    public function invoiceView($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('payment.invoice', compact('appointment'));
    }


//review
    public function ratingList()
    {
        $user = auth()->user();
        
        if ($user->role === 'Doctor') {
            $reviews = Review::where('doctor_id', $user->id)->get();
            $reviewCount = Review::get();
            return view('backend.review', compact('reviews','reviewCount'));
        } 
        if ($user->role === 'Patient') {
            $reviews = Review::where('user_id', $user->id)->get();
            $reviewCount = Review::get();
            return view('backend.review', compact('reviews','reviewCount'));
        }
        else{
            $reviews = Review::get();
            $reviewCount = Review::get();
            return view('backend.review', compact('reviews','reviewCount'));
        }
        
        
    }
    
    public function reviewUpdate(Request $request)
    {
        $review = Review::find($request->id);
    if ($review) {
        $review->status = $request->status;
        $review->save();
        return response()->json(['message' => 'Status updated successfully']);
    }
    return response()->json(['message' => 'review not found'], 404);
    }

    public function reviewDestroy($id)
    {
        $review = Review::find($id);

        if ($review) {
            $review->delete();
            return redirect()->route('rating')->with(['type'=>'success','msg'=>'Review Deleted successfully','title'=>'Done!']);
        }else{
            return redirect()->route('rating')->with(['type'=>'error','msg'=>'Unable to Delete Review','title'=>'Fail!']);
        }

    }
   //category
    public function categoryList()
    {
       $categories = Category::get();
       return view('backend.categorylist',compact('categories'));
    }
 
    public  function categoryStore(Request $request)
    {
        extract($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean', 
        ]);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filePath = $this->storeFile('category_images', $file); 
       
        }
        $Category = Category::create([
            'parent_category_id'=>$request->parent_category_id,
            'name'=>$request->name,
            'status' => $request->status,
            'file' => $filePath,
        ]);
        
      
        if( $Category!=null){
            return redirect()->route('category')->with(['type'=>'success','msg'=>'Category created successfully','title'=>'Done!']);
        }else{
            return redirect()->route('category')->with(['type'=>'error','msg'=>'Unable to create Category','title'=>'Fail!']);
        }
    }

    public function categoryUpdate(Request $request)
    {
        //   return $request->all();
        extract($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean', 
        ]);
        $category = Category::where('id',$category_id)->first();
        $filePath =  $category->file;   
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $this->deleteFile($filePath);
            $filePath = $this->storeFile('category_images', $file);
        }

        $category = Category::where('id',$category_id)->update(['name'=>$name,'status'=>$status,'file'=>$filePath ,]);
        if( $category){
            return redirect()->route('category')->with(['type'=>'success','msg'=>'Category Update successfully','title'=>'Done!']);
        }else{
            return redirect()->route('category')->with(['type'=>'error','msg'=>'Unable to Update Category','title'=>'Fail!']);
        }
    }

    public function categoryDestroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return redirect()->route('category')->with(['type'=>'success','msg'=>'Category Deleted successfully','title'=>'Done!']);
        }else{
            return redirect()->route('category')->with(['type'=>'error','msg'=>'Unable to Delete Category','title'=>'Fail!']);
        }
    }

//blog
    public function blogList()
    {
        $userId = auth()->user()->id;
        $blogs = Blog::where('user_id', $userId)->paginate(6); 
       return view('backend.bloglist',compact('blogs'));
    }

    public function blogStatus(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($blog) {
            $blog->status = $request->status;
            $blog->save();
            return response()->json(['message' => 'Status updated successfully']);
        }
        return response()->json(['message' => 'blog not found'], 404);

    }

    public function blogDetail($id)
    {
        $blog = Blog::find($id);
       return view('backend.blog_detail',compact('blog'));
    }

    public function blogAdd()
    {
        $categories = Category::get();
       return view('backend.blog_add',compact('categories'));
    }

    public function blogStore(Request $request)
   {
    // return $request->all();
    extract($request->all());
    // Validate the request
    // $validated = $request->validate([
    //     'blogtitle' => 'required|string|max:255',
    //     'blogContent' => 'required|string',
    //     'status' => 'required|boolean',
    //     'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // Validate each file
    // ]);

    $blog = Blog::create([
        'user_id' => auth()->user()->id,
        'category_id' => $request->category_id,
        'title' => $request->blogtitle,
        'description' => $request->blogcontent,
        'status' => $request->status,
    ]);
    if ($blog) {
        $attachmentsSaved = true;

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                if ($file->isValid()) {
                    $filePath = $this->storeFile('blog_attachments', $file);

                    $attachment = BlogAttachment::create([
                        'blog_id' => $blog->id,
                        'file' => $filePath,
                    ]);

                    if (!$attachment) {
                        $attachmentsSaved = false; 
                    }
                }
            }
        }
        if (isset($tags) && $tags!=null) {
            foreach (explode(',',$tags) as $tag) {
                $tag = BlogTag::create([
                    'blog_id' => $blog->id,
                    'name' => $tag,
                ]);
            }
        }
        if ($attachmentsSaved) {
            return redirect()->route('blog_list')->with(['type' => 'success', 'msg' => 'Blog Created successfully', 'title' => 'Done!']);
        } else {
            return redirect()->route('blog_list')->with(['type' => 'error', 'msg' => 'Blog created, but some attachments failed to save', 'title' => 'Warning!']);
        }
    } else {
        return redirect()->route('blog_list')->with(['type' => 'error', 'msg' => 'Unable to Create Blog', 'title' => 'Fail!']);
    }

    }

    public function blogEdit($id)
    {
        $blog = Blog::find($id);
        $categories = Category::get();
        return view('backend.blog_edit',compact('blog','categories'));
    }

    public function blogUpdate(Request $request,$id)
    {
            //   return $request->all();
            extract($request->all());
            // $validated = $request->validate([
            //     'name' => 'required|string|max:255',
            //     'status' => 'required|boolean', 
            // ]);
            $blog = Blog::where('id',$id)->update([
                // 'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,
                'title' => $request->blogtitle,
                'description' => $request->blogcontent,
                'status' => $request->status,
            ]);
            if (isset($tags) && $tags != null) {
                BlogTag::where('blog_id', $id)->delete();
                foreach (explode(',',$tags) as $tag) {
                    $tag = BlogTag::create([
                        'blog_id' => $id,
                        'name' => $tag,
                    ]);
                }
            }
            $blog = BlogAttachment::where('blog_id', $id)->first();
            $filePath = $blog->file;   
            if ($request->hasFile('file')) {
                $this->deleteFile($filePath);
                foreach ($request->file('file') as $file) {
                    if ($file->isValid()) {
                        $filePath = $this->storeFile('blog_attachments', $file);
                        $attachment = BlogAttachment::updateOrCreate(
                            ['blog_id' => $blog->id],
                            ['file' => $filePath]
                        );
                    }
                }
            }
            if ($attachment) {
                return redirect()->route('blog_list')->with(['type' => 'success', 'msg' => 'Blog Update successfully', 'title' => 'Done!']);
            } else {
                return redirect()->route('blog_list')->with(['type' => 'error', 'msg' => 'Uable to Update Blog', 'title' => 'Warning!']);
            }
           
    }

    public function blogDestroy($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->delete();
            return redirect()->route('blog_list')->with(['type'=>'success','msg'=>'Blog Deleted successfully','title'=>'Done!']);
        }else{
            return redirect()->route('blog_list')->with(['type'=>'error','msg'=>'Unable to Delete Blog','title'=>'Fail!']);
        }
    }
}
