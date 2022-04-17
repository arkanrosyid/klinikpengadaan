<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Password;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;

class AdminResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showResetForm(Request $request, $token = null) {
        return view('admins.passwords.reset')
            ->with(['token' => $token, 'email' => $request->email]
            );
    }


    //defining which guard to use in our case, it's the admin guard
    protected function guard()
    {
        return Auth::guard('admin');
    }

    //defining our password broker function
    protected function broker() {
        return Password::broker('admins');
    }

    public function validateAdmin(array $data) {

        return Validator::make($data, [
        
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            
        ]);
        
    }


    public function resetCek(Request $request){

        $this->validateAdmin($request->all())->validate();
       
        $check_token = DB::table('password_resets')
        ->where(
            [
                'email' => $request->email,
                'token' => $request->token,
            ]
        )->first();

        if(!$check_token){
            return back()->withinput()->with('fail','Token invalid');
        }else {
            $date = $check_token->created_at;
            $exp_date = strtotime('+1 hours', strtotime($date));
            $exp_date = date('Y-m-d H:i:s',$exp_date);
        
            $now = Carbon::now();
            
            if($now > $exp_date){
                DB::table('password_resets')
                ->where(
                    [
                        'email' => $request->email,
                        'token' => $request->token,
                    ]
                )->delete();
    
                return back()->withinput()->with('fail','token kadaluarsa');
            }else {
                Admin::where('email', $request->email)->update([
                    'password'=> bcrypt($request->password)
                ]);
    
                DB::table('password_resets')->where([
                    'email' => $request->email,
                ])->delete();
    
                return redirect('login/admin')->with('info', 'Password berhasil diubah!')
                ->with('verifedEmail',$request->email);
            }
        }
    }
}