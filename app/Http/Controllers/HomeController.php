<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (isset($_COOKIE['logged_in-SDA'])) {
        //     $jwt = $_COOKIE['logged_in-SDA'];

        //     $payload = JWT::decode($jwt, new Key('FhfhvufvbjhTX$&jbknkf089qwemnb', 'HS256'));
        //     // dd($payload);
        // } else {
        //     // Session::flash('tidaklogin', 'Anda belum login, Silahkan login terlebih dahulu!');
        //     // return route('login');
        //     return 'belum login';
        // }
        $data['aplikasi'] = Aplikasi::get();
        return view('index',$data);
    }

    public function updateAkun(){
        $data['username'] = User::where('id_nip', session()->get('user')['nip'])->first();
        return view('updateakun',$data);
    }
    
    public function editUsername(Request $request){
        User::where('id',$request->userid)->update(['username' => $request->username_baru]);
        Toastr::success('Berhasil merubah username', 'Berhasil');
        return back();
    }
    
    public function editPassword(Request $request){
        $user = User::find($request->userid);
        if (!Hash::check($request->password_lama, $user->password)) {
            Toastr::error('Password lama tidak sama!', 'Terjadi Kesalahan!');
            return back();
        } else {
            if ($request->password_baru != $request->re_password_baru) {
                Toastr::error('Password baru tidak sama!', 'Terjadi Kesalahan!');
                return back();
            } else {
                User::where('id', $request->userid)->update([
                    'password' => Hash::make($request->password_baru),
                    'psw' => $request->password_baru,
                ]);
                Toastr::success('Berhasil merubah password', 'Berhasil');
                return back();
            }
        }
    }
}
