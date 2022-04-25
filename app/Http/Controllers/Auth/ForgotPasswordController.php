<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pns;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\EmailSidoarjo;
use App\Models\Password_reset;

class ForgotPasswordController extends Controller
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

    public function ForgetPassword()
    {
        return view('auth.forget-password');
    }

    public function ForgetPasswordStore(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:users',
        // ]);
        
        // $user = Pns::where('email_sidoarjokab', $request->email)->first();
        $user = Pns::where('email_sidoarjokab', $request->email)->first();
        if ($user === null) {
            Toastr::error('Email tidak ditemukan, silahkan gunakan email sidoarjokab anda!', 'Terjadi Kesalahan!');
            return back();
        }

        $token = Str::random(64);
        Password_reset::insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Mail::send('auth.forget-password-email', ['token' => $token], function ($message) use ($request) {
        //     $message->to($request->email);
        //     $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
        //     $message->subject('Reset Password');
        // });
        $send_data = ['token' => $token];
        Mail::to($request->email)->send(new EmailSidoarjo($send_data));

        return back()->with('message', 'Kami telah mengirimkan email reset password anda, silahkan buka di mail.sidoarjokab.go.id!');
    }

    public function ResetPassword($token)
    {
        return view('auth.forget-password-link', ['token' => $token]);
    }

    public function ResetPasswordStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required'
        ]);

        $update = Password_reset::where(['email' => $request->email, 'token' => $request->token])->first();

        if (!$update) {
            return back()->withInput()->with('error', 'Token salah!');
        }

        $user = Pns::where('email_sidoarjokab', $request->email)->first();
        $user = User::where('id_nip', $user->nip)->update(['password' => Hash::make($request->password),'psw' => $request->password]);

        // Delete password_resets record
        Password_reset::where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Password berhasil diubah!');
    }
}
