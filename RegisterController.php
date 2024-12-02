<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;
use Carbon\Carbon;
use Psy\Readline\Hoa\Console;
use Symfony\Component\Console\Logger\ConsoleLogger;

class RegisterController extends Controller
{
    private $user;
    public function googlepage(Request $request)
    {
        $request->session()->put('registration', $request->all());
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback(Request $req)
    {
        try {
            $this->user = Socialite::driver('google')->user();
            $registrationData = $req->session()->get('registration');
            $password = $registrationData['password'];
            $passwordConfirmation = $registrationData['password_confirmation'];

            if ($password !== $passwordConfirmation) {
                return redirect()->route('register')->with(['message' => 'Password Confirmation Do Not Match']);
            }

            $finduser = User::where('google_id', $this->user->id)->first();
            if ($finduser) {
                
                return redirect()->route('register')->with('message', 'User Already Registered');
            } else {
                $newUser = User::create([
                    'name' =>  $registrationData['name'],
                    'email' => $this->user->email,
                    'google_id' => $this->user->id,
                    'phone' => $registrationData['phone'],
                    'address' => $registrationData['address'],
                    'password' => Hash::make($registrationData['password'])
                ]);

                $newUser->email_verified_at = now();
                $newUser->save();

                return redirect()->route('login')->with([
                    'email' => $this->user->email,
                    'password' => $registrationData['password'],
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Registration Unsuccessful');
        }
    }
    public function googlepagelogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallbacklogin()
    {
        try {
            $this->user = Socialite::driver('google')->user();
            $finduser = User::where('email', $this->user->email)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('redirect');
            } else {
                  $newuser = User::create([
                    'name' =>  $this->user->name,
                    'email' => $this->user->email,
                    'password' =>  Hash::make('12345678'),
                    'google_id' => $this->user->id,
                    'usertype' => '0',
                ]);
                Auth::login($newuser);
                return redirect()->intended('redirect');
            
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    

    public function registerUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:8',
            'phone' => 'required|max:10',
            'address'=> 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withErrors(['confirmpassword' => 'The password confirmation does notjjj match.'])->withInput();
        }

        $newuser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'google_id' => $request->google_id,
            'phone' =>$validatedData['phone'],
            'address' =>$validatedData['address'],
            'password' => Hash::make($validatedData['password']), // Encrypt the password securely
            'usertype'=>'0',
            'email_verified_at' => Carbon::now(),
        ]);

        Auth::login($newuser);
        return redirect()->intended('redirect');
    }
    
    public function newlogin(Request $request){
        if ($request->Password !== $request->ConfirmPassword) {
            return redirect()->back()->withErrors(['confirmpassword' => 'The password confirmation does not match.'])->withInput()->with(['confirmpassword' , "The password confirmation does not match"]);
        }
        else{
          $validatedData = $request->validate([
                    'Password' => 'required|string|min:8',
                    'Phone' => 'required|min:10',
                    'Address'=> 'required|string|max:255',
                ]);
        $user=Auth::user(); 
         $finishsetup=User::find($user->id);   
           $finishsetup->password= Hash::make($validatedData['Password']);
           $finishsetup->phone=  $validatedData['Phone'];  
           $finishsetup->address=  $validatedData['Address'];
           $finishsetup->save(); 
           return redirect('/');
            }
        }
       public function newlogin2(){
        return view('home.newlogin');
       }
    }
 
    
    

