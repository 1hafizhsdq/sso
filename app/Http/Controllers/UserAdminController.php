<?php

namespace App\Http\Controllers;

use App\Models\UserAdmin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['userAdmin'] = UserAdmin::get();
        return view('admin.user_admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['status'] = 0;
        return view('admin.user_admin.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
        ]);
        if ($validator->fails()) {
            $error = "";
            foreach ($validator->errors()->all() as $err) {
                $error .= "<li>" . $err . "</li>";
            }
            $pesan = "<ul>" . $error . "</ul>";
            Toastr::error($pesan, 'Terjadi Kesalahan!');
            return back();
        }

        UserAdmin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->username),
        ]);

        Toastr::success('Berhasil menambakan data', 'Berhasil');
        return redirect('/useradmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['status'] = 1;
        $data['data'] = UserAdmin::find($id);
        return view('admin.user_admin.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
        ]);
        if ($validator->fails()) {
            $error = "";
            foreach ($validator->errors()->all() as $err) {
                $error .= "<li>" . $err . "</li>";
            }
            $pesan = "<ul>" . $error . "</ul>";
            Toastr::error($pesan, 'Terjadi Kesalahan!');
            return back();
        }
        UserAdmin::where('id',$id)->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);
        Toastr::success('Berhasil mengedit data', 'Berhasil');
        return redirect('/useradmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserAdmin::where('id',$id)->delete();
        Toastr::success('Berhasil menghapus data', 'Berhasil');
        return redirect('/useradmin');
    }
}
