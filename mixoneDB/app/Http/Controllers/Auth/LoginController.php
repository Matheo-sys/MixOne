<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * The user has been authenticated.
     * Overriding default behavior to prevent redirecting to API/AJAX endpoints
     * if the session expired while the message widget was polling.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        $intendedUrl = session()->pull('url.intended', $this->redirectPath());

        // Si l'URL stockée pointe vers les requêtes asynchrones en arrière-plan,
        // on ignore cette URL et on redirige de force vers l'accueil.
        if (str_contains($intendedUrl, '/message/') || str_contains($intendedUrl, '/api/')) {
            $intendedUrl = $this->redirectTo;
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Connexion réussie ! Content de vous revoir ' . $user->first_name . '.',
                'redirect' => $intendedUrl
            ]);
        }

        return redirect()->to($intendedUrl);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => 'L\'adresse email ou le mot de passe est incorrect.',
                'errors' => [
                    'email' => ['Identifiants incorrects.']
                ]
            ], 422);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
