<?php

namespace App\Http\Controllers\Auth;

use Password;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class EmployeeForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:employee');
    }

    public function showLinkRequestForm()
    {
        return view('employee.passwords.email');
    }

    //defining which password broker to use, in our case its the admins
    protected function broker()
    {
        return Password::broker('employees');
    }

    public function sendResetLinkEmployee(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:employees,email',
        ]);

        $token = \Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $action_link = route('employee.password.reset', ['token' => $token, 'email' => $request->email]);
        $body = "Kita menerima request reset password untuk <b> Klinik Pengadaan </b> dengan akun " . $request->email .
            ". Anda dapat melakukan reset password melalui tombol dibawah ini.";

        Mail::send('sendmail', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('sikoperaja@gmail.com', 'Klinik Pengadaan');
            $message->to($request->email, 'Employee')
                ->subject('Reset Password');
        });

        return back()->with('success', 'Kami sudah mengirimkan link reset password ke e-mail');
    }
}
