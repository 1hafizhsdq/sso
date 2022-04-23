<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;

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
        return view('main.app');
    }
}
