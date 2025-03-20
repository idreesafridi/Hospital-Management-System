<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Profile;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
    //    return $request->all();\
     extract($request->all());
        // $request->validate([
        //     // 'name' => ['required', 'string', 'max:255'],
        //     // 'first_name' => ['required', 'string', 'max:255'],
        //     // 'last_name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'role'  => ['required','string'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'role' =>$request->role,
            'password' => Hash::make($request->password),
        ]);
        $filePath = Null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filePath = $this->storeFile('patient_images', $file); 
       
        }
        $profile = Profile::create([
            'user_id' => $user->id,
            'profile_image' => $filePath,
        ]);

     
        //  Mail::to($user->email)->send(new UserCredentialsMail($user, 'password'));
        // $admin = User::where('role', 'Admin')->first(); 
        // if ($admin) {
        //     $admin->notify(new NewUserRegistered($user));
    
        // } 


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
