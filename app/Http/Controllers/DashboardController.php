<?php

namespace App\Http\Controllers;

use App\Models\UserAdmin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function updateAkun()
    {
        $data['username'] = UserAdmin::where('name', session()->get('user')['nama'])->first();
        return view('updateakun', $data);
    }

    public function editUsername(Request $request)
    {
        UserAdmin::where('id', $request->userid)->update(['username' => $request->username_baru]);
        Toastr::success('Berhasil merubah username', 'Berhasil');
        return back();
    }

    public function editPassword(Request $request)
    {
        $user = UserAdmin::find($request->userid);
        if (!Hash::check($request->password_lama, $user->password)) {
            Toastr::error('Password lama tidak sama!', 'Terjadi Kesalahan!');
            return back();
        } else {
            if ($request->password_baru != $request->re_password_baru) {
                Toastr::error('Password baru tidak sama!', 'Terjadi Kesalahan!');
                return back();
            } else {
                UserAdmin::where('id', $request->userid)->update([
                    'password' => Hash::make($request->password_baru),
                ]);
                Toastr::success('Berhasil merubah password', 'Berhasil');
                return back();
            }
        }
    }
}
