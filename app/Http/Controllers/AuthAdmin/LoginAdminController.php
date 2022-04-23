<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

class LoginAdminController extends Controller
{
    public function index(){
        return view('auth.loginAdmin');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);

        if($validator->fails()){
            Session::flash('tidaklogin', 'Username dan password tidak boleh kosong!');
            return redirect('internal');
        }else{
            $getUser = UserAdmin::where('username', $request->username)->first();

            if(empty($getUser)){
                Session::flash('tidaklogin', 'User tidak ada');
                return redirect('internal');
            }else{
                $cekPassword = Hash::check($request->password,$getUser['password']);
                if($cekPassword == true){
                    $request->session()->put('user', [
                        'nip' => 'admin',
                        'nama' => $getUser['name'],
                    ]);

                    return redirect('dashboard');
                }else{
                    Session::flash('tidaklogin', 'Username atau Password salah!');
                    return redirect('internal');
                }
            }
        }
    }

    public function logout(){
        session()->forget('user', [
            'nip','nama'
        ]);
        return redirect('internal');
    }
}
