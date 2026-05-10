<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/tableau-de-bord';

    /**
     * Get the response for a successful password reset.
     */
    protected function sendResetResponse($request, $response)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => trans($response),
                'redirect' => $this->redirectPath(),
            ]);
        }

        return redirect($this->redirectPath())->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset.
     */
    protected function sendResetFailedResponse($request, $response)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'errors' => ['email' => [trans($response)]],
            ], 422);
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
