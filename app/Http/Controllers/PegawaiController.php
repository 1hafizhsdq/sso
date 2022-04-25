<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index(){
        $data['skpd'] = Skpd::orderBy('nama')->get();
        return view('admin.pegawai.index',$data);
    }

    public function pnsBySkpd($id)
    {
        $data = Skpd::select('skp_pns.nama', 'skp_jabatan.nama_jabatan', 'skp_pns.nip', 'skp_jabatan.kode_jabatan', 'skp_pns.nip')
        ->join('skp_unitorg', 'skp_skpd.id', '=', 'skp_unitorg.id_skpd')
        ->join('skp_jabatan', 'skp_unitorg.id_unit', '=', 'skp_jabatan.unit_organisasi')
        ->join('skp_jabatan_detail', 'skp_jabatan.kode_jabatan', '=', 'skp_jabatan_detail.kode_jabatan')
        ->join('skp_pns', 'skp_jabatan_detail.nip', '=', 'skp_pns.nip')
        ->orderBy('skp_jabatan.kode_jabatan', 'ASC')
            ->where('skp_skpd.id', $id)
            ->whereNull('skp_jabatan_detail.selesai_jabatan')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($data) {
                return '
                <a href="/reset-pegawai/'.$data->nip.'" id="reset" onclick="confirm(`Apakah anda yakin akan me-reset akun ini?`)" class="btn btn-xs btn-success" data-id="' . $data->nip . '" title="reset username & password"><i class="fas fa-sync"></i></a>
            ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function reset($nip){
        User::where('id_nip',$nip)->update([
            'username' => $nip,
            'password' => Hash::make($nip),
            'psw' => $nip,
        ]);

        Toastr::success('Berhasil me-reset data', 'Berhasil');
        return redirect('/pegawai');
    }
}
