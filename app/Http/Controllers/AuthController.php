<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use DB;


use Session;
use App\User;
use Hash;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }
      
    /**
     * Write code on Method
     * 
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('/')
                        ->withSuccess('You have Successfully logged in');
        }
  
        return redirect("login")->withSuccess('Sorry! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        // $request->validate([
        //     'company_name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|min:6',
        // ]);
        
           
        $data = $request->all();
        $check = $this->create($data);

        $MailData = array(
            'company_name' => $request->company_name,
            'randomId' =>  $request->verify_token,
        );

        $email = $request->email;
    
         
        // Mail::to($email)->send(new SendMail($MailData));
        return redirect('login')->with('success', 'Thanks for contacting us!');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'company_name' => $data['company_name'],
        'email' => $data['email'],
        'username' => $data['username'],
        'password' => Hash::make($data['password']),
        'cpassword' => Hash::make($data['cpassword']),
        'verify_token' =>  $data['verify_token']
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    function verify_token($MailData){
        $token = $MailData;
            $User_token = User::select('verify_token','email_verified_at')
                           ->where('verify_token', '=', $token)
                           ->count();
    // if(Customer::where('customer_id', 'LIKE', $request->customer_id)->orWhere('package_id', 2)->count() > 0) {
    // // your code here 
    // }
            if($User_token){
                // $row = $check_token ;
                if (User::where('email_verified_at'==0, 'verify_token'==$token))
                // if ($row['verify_status'] == '0')
                {
                     DB::table('users')
                      // find your user by their email
                   // optional - to ensure only one record is updated.
                    ->update(array('email_verified_at' => 1));
                                        // $update_query = "UPDATE users SET email_verified_at	='1' WHERE verify_token='$clicked_token' LIMIT 1";
                    return redirect("login")->with('success','Email is Verified Please Login !!!');

                    
                }
                else{
                  
                    return redirect("login")->with('success','Email Already is Not verified!!!');
                }
        
        
            }else{
                return redirect("login")->with('success','This email Dont Exists !!!');
             
        
        
            }
        
    }
}