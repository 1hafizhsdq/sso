<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pns;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public static string $SECRET_KEY = "FhfhvufvbjhTX$&jbknkf089qwemnb";

    public function username()
    {
        return 'username';
    }

    protected function authenticated(Request $request, $user)
    {
        $pns = Pns::where('nip',$user->id_nip)->first();
        $request->session()->put('user', [
            'nip' => $pns->nip,
            'nama' => $pns->nama,
        ]);

        $payload = [
            'nip' => $pns->nip,
            'nama' => $pns->nama,
        ];
        $jwt = JWT::encode($payload,LoginController::$SECRET_KEY, 'HS256');
        // setcookie('logged_in-SDA',$jwt);
        setcookie('logged_in-SDA',$jwt,time()+100,'/', '127.0.0.1','',FALSE);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        setcookie('logged_in-SDA','',time()-3600);

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
