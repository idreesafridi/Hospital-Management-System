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
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\Review;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\BlogTag;
use App\Models\Comment;
use App\Models\InstagramDetail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Invoice;
use App\Models\Invoice as InvoiceModel;
use Stripe\Event;
use Stripe\Exception\ApiErrorException;



class WebsiteController extends Controller
{
   

    public function index()
    {
    $doctors = User::where('status',1)->where('role', 'Doctor')->get()->unique('id')->take(5);
    $specialities = Speciality::with('children')->where('parent_id', null)->get();
    $blogs = Blog::latest('created_at')->paginate(3);
    return view('website.index',compact('doctors','specialities','blogs'));
    }


    public function aboutUs()
    {
        return view('website.aboutus');
    }

    public function newsletter(Request $request)
    {
        $newsletter = Newsletter::create([
            'email'=>$request->email
        ]);
        if($newsletter!=null){
            return redirect()->route('website_index')->with(['type'=>'success','msg'=>'Created successfully','title'=>'Done!']);
        }else{
            return redirect()->route('website_index')->with(['type'=>'error','msg'=>'Unable to Create','title'=>'Fail!']);
        }
          
    }

    public function doctorProfile($id)
    {
        $doctor = User::with(['profile', 'education','doctorfiles','work','reviewdoctor','reviewpatient'])->findOrFail($id);
        $reviews = $doctor->reviewdoctor()->paginate(5);
        $totalReviews = $doctor->reviewdoctor()->count(); 
        $days = [
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
        ];
        
        return view('website.doctor_profile',compact('doctor','days','reviews','totalReviews'));
    }

    public function book(Request $request)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
        ]);
    
        try {
            $existingAppointment = Appointment::where('doctor_id', $validatedData['doctor_id'])
                                              ->where('appointment_date', $validatedData['appointment_date'])
                                              ->where('appointment_time', $validatedData['appointment_time'])
                                              ->first();
    
            if ($existingAppointment) {
                return response()->json(['success' => false, 'message' => 'This appointment time is already booked. Please choose another time.']);
            }
    
            $appointment = Appointment::create([
                'patient_id' => auth()->id(),  // Authenticated patient
                'doctor_id' => $validatedData['doctor_id'],
                'appointment_date' => $validatedData['appointment_date'],
                'appointment_time' => $validatedData['appointment_time'],
            ]);
    
            return response()->json(['success' => true, 'message' => 'Appointment booked successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'There was an error booking your appointment.']);
        }
    }
    


    public function doctorBooking($id)
    {
        $doctor = User::with(['profile', 'education', 'doctorfiles', 'work'])->findOrFail($id);
        
        $start_time = $doctor->profile->start_time;
        $end_time = $doctor->profile->end_time; 

        if (empty($start_time) || empty($end_time)) {

            $start_time = '09:00'; 
            $end_time = '17:00';    
        }

        $start = Carbon::createFromFormat('H:i', $start_time);
        $end = Carbon::createFromFormat('H:i', $end_time);
    
        $time_slots = [];
        while ($start->lessThanOrEqualTo($end)) {
            $time_slots[] = $start->format('h:i A'); // Add formatted time slot to array
            $start->addHour(); // Increment by 1 hour (or adjust based on your slot intervals)
        }

        $appointments = Appointment::where('doctor_id', $id)
        ->whereBetween('appointment_date', [now()->startOfWeek(), now()->endOfWeek()])
        ->select('id','appointment_date', 'appointment_time','status')
        ->get();
    
        $bookedAppointments = [];
    
        foreach ($appointments as $appointment) {
            $dayOfWeek = Carbon::parse($appointment->appointment_date)->format('l'); // Get day of the week (e.g., "Monday")
            $time = $appointment->appointment_time;
            $status = $appointment->status;
            $appointment_id =  $appointment->id;
            $bookedAppointments[] = $time . ' ' . $dayOfWeek; 
             
            $bookedAppointments[] = [
                'appointment_id' => $appointment_id,
                'time' => $time,
                'day' => $dayOfWeek,
                'status' => $status,
            ];
        }
    
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    
        return view('website.booking', compact('doctor', 'days', 'bookedAppointments','time_slots'));
    }

    public function contactUs()
    {
      return view('website.contact_us');
    }

    public function contactStore(Request $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        if($contact!=null){
            return redirect()->route('contact')->with(['type'=>'success','msg'=>'Thank You For Contact Us','title'=>'Done!']);
               }
        else{
            return redirect()->route('contact')->with(['type'=>'error','msg'=>'Unable to Contact Us','title'=>'Fail!']);
         }
    }

    public function doctorList(Request $request)
    {
        $doctors = User::where('status',1)->where('role','Doctor')->paginate(5);
        $specialities = Speciality::get();
        if ($request->ajax()) {
            $view = view('website.doctor_items', compact('doctors'))->render();
    
            return response()->json([
                'doctors' => $view,
                'has_more' => $doctors->hasMorePages(),
                'next_url' => $doctors->nextPageUrl(),
            ]);
        }
        return view('website.doctorlist',compact('doctors','specialities'));
    }

    public function ratingStore(Request $request)
    {
        // return $request->all();
       
       $review = Review::create([
        'user_id' => auth()->user()->id,
        'doctor_id' => $request->doctor_id,
        'title' => $request->title,
        'review' => $request->review,
    ]);
    if($review!=null){
        return redirect()->route('doctor_profile',$request->doctor_id)->with(['type'=>'success','msg'=>'Review add succesfuly','title'=>'Done!']);
           }
    else{
        return redirect()->route('doctor_profile',$request->doctor_id)->with(['type'=>'error','msg'=>'Unable to add review','title'=>'Fail!']);
     }

    }

    public function blogList()
    {
        $blogs = Blog::where('status',1)->paginate(6);
        $latestblogs = Blog::latest('created_at')->where('status',1)->get();
        $categories = Category::where('status',1)->get();
        $tags = BlogTag::get();
        return view('website.blog_list',compact('blogs','latestblogs','categories','tags'));
    }

    public function blogDetail($id)
    {
        $blog  = Blog::find($id);
        $latestblogs = Blog::latest('created_at')->where('status',1)->get();
        $categories = Category::where('status',1)->get();
        $tags = BlogTag::get();
        return view('website.blog_detail',compact('blog','latestblogs','categories','tags'));
    }   
    
    public function blogTagdetail($id)
    {
        $tag_detail = BlogTag::find($id);
    //    $blog_tag_detail= Blog::where('id', $tag_detail->blog_id)->get();
   
        $blogs_tag = $tag_detail->blog;
        //  dd($blogs_tag);
        $latestblogs = Blog::latest('created_at')->where('status',1)->get();
        $categories = Category::where('status',1)->get();
        $tags = BlogTag::get();
        return view('website.blogtag_detail',compact('tag_detail', 'blogs_tag','latestblogs','categories','tags'));
        
                
    }
    
    public function categoryWise(category $category)
    {
     $blogs = $category->blogs()->where('status',1)->paginate(6);
     $latestblogs = Blog::latest('created_at')->where('status',1)->get();
        $categories = Category::where('status',1)->get();
        $tags = BlogTag::get();
         return view('website.category_wiseblog', compact('category', 'blogs','latestblogs','categories','tags'));
    }

    public function comment(Request $request)
    {
        $comment = Comment::create([
            'user_id'=>auth()->user()->id,
            'blog_id' => $request->blog_id,
            'name' =>$request->name,
            'comment' => $request->comment,
            'email'=>$request->email
        ]);
        if($comment!=null){
            return redirect()->back()->with(['type'=>'success','msg'=>'Comment add succesfuly','title'=>'Done!']);
               }
        else{
            return redirect()->back()->with(['type'=>'error','msg'=>'Unable to add Comment','title'=>'Fail!']);
         }

    }


    public function doctorSearch(Request $request)
    
    {
        $date = $request->get('search_date');
        $specialists = $request->get('select_specialist', []);
    
        if ($date) {
            try {
                $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
            } catch (\Exception $e) {
                return back()->with('error', 'Invalid date format. Please use DD/MM/YYYY.');
            }
        }
    
        $query = User::query();
    
        if ($date) {
            $query->whereDate('created_at', '=', $date);
        }
    
        if (!empty($specialists)) {
            $query->whereHas('profile', function ($query) use ($specialists) {
                $query->whereIn('speciality_id', $specialists);
            });
        }
    
        $doctors = $query->paginate(10);
        $specialities = Speciality::get();
    
        return view('website.doctorlist', compact('doctors','specialities'));
    }

    public function searchDoctor(Request $request)
   
        {
            $doctorName = $request->get('doctor_name');
        
            $query = User::where('role', 'Doctor');

            // Add a condition to filter by doctor's name if provided
            if ($doctorName) {
                $query->where('name', 'LIKE', '%' . $doctorName . '%'); 
            }
        
            $doctors = $query->paginate(5);
            $specialities = Speciality::get();
            return view('website.doctorlist', compact('doctors','specialities'));
        }

   
   
}
