<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class AplikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['aplikasi'] = Aplikasi::get();
        return view('admin.aplikasi.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['status'] = 0;
        return view('admin.aplikasi.form',$data);
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
            'nama_aplikasi' => 'required',
            'route_aplikasi' => 'required',
            'icon_aplikasi' => 'mimes:jpg,jpeg,png|max:2000'
        ], [
            'nama_aplikasi.required' => 'Nama Aplikasi tidak boleh kosong!',
            'route_aplikasi.required' => 'Route Aplikasi tidak boleh kosong!',
            'icon_aplikasi.mimes' => 'Tipe file ikon aplikasi harus jpg/jpeg/png!',
            'icon_aplikasi.max' => 'maksimal ukuran ikon aplikasi 2mb!',
        ]);
        if ($validator->fails()) {
            $error = "";
            foreach($validator->errors()->all() as $err){
                $error .= "<li>".$err."</li>";
            }
            $pesan = "<ul>".$error."</ul>";
            Toastr::error($pesan, 'Terjadi Kesalahan!');
            return back();
        }

        if ($request->hasfile('icon_aplikasi')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('icon_aplikasi')->getClientOriginalName());
            $request->file('icon_aplikasi')->move(public_path('icon_aplikasi'), $filename);
        
            Aplikasi::create([
                'nama_aplikasi' => $request->nama_aplikasi,
                'route_aplikasi' => $request->route_aplikasi,
                'icon_aplikasi' => $filename,
            ]);
        }
        Toastr::success('Berhasil menambakan data', 'Berhasil');
        return redirect('/aplikasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Aplikasi $aplikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Aplikasi $aplikasi)
    {
        $data['status'] = 1;
        $data['data'] = $aplikasi;
        return view('admin.aplikasi.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aplikasi $aplikasi)
    {
        $validator = Validator::make($request->all(), [
            'nama_aplikasi' => 'required',
            'route_aplikasi' => 'required',
            'icon_aplikasi' => 'mimes:jpg,jpeg,png|max:2000'
        ], [
            'nama_aplikasi.required' => 'Nama Aplikasi tidak boleh kosong!',
            'route_aplikasi.required' => 'Route Aplikasi tidak boleh kosong!',
            'icon_aplikasi.mimes' => 'Tipe file ikon aplikasi harus jpg/jpeg/png!',
            'icon_aplikasi.max' => 'maksimal ukuran ikon aplikasi 2mb!',
        ]);
        if ($validator->fails()) {
            $error = "";
            foreach($validator->errors()->all() as $err){
                $error .= "<li>".$err."</li>";
            }
            $pesan = "<ul>".$error."</ul>";
            Toastr::error($pesan, 'Terjadi Kesalahan!');
            return back();
        }

        if ($request->hasfile('icon_aplikasi')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('icon_aplikasi')->getClientOriginalName());
            $request->file('icon_aplikasi')->move(public_path('icon_aplikasi'), $filename);
            unlink(public_path().'\icon_aplikasi/'.$aplikasi->icon_aplikasi);
            
            Aplikasi::where('id',$aplikasi->id)->update([
                'nama_aplikasi' => $request->nama_aplikasi,
                'route_aplikasi' => $request->route_aplikasi,
                'icon_aplikasi' => $filename,
            ]);
        }else{
            Aplikasi::where('id',$aplikasi->id)->update([
                'nama_aplikasi' => $request->nama_aplikasi,
                'route_aplikasi' => $request->route_aplikasi,
            ]);
        }
        Toastr::success('Berhasil mengedit data', 'Berhasil');
        return redirect('/aplikasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aplikasi  $aplikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aplikasi $aplikasi)
    {
        unlink(public_path().'\icon_aplikasi/'.$aplikasi->icon_aplikasi);
        $aplikasi->delete();
        Toastr::success('Berhasil menghapus data', 'Berhasil');
        return redirect('/aplikasi');
    }
}
