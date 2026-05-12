<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/tableau-de-bord';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'profile'   => ['required', 'in:studio,artist'],
            'username'  => ['nullable', 'string', 'min:3', 'max:30', 'regex:/^[a-zA-Z0-9._]+$/', 'unique:users,username'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/'],
        ], [
            'profile.required' => 'Veuillez sélectionner un profil.',

            'username.min'     => 'Le nom d\'utilisateur doit contenir au moins 3 caractères.',
            'username.max'     => 'Le nom d\'utilisateur ne peut pas dépasser 30 caractères.',
            'username.regex'   => 'Le nom d\'utilisateur ne peut contenir que des lettres, chiffres, points et underscores.',
            'username.unique'  => 'Ce nom d\'utilisateur est déjà pris.',

            'first_name.required' => 'Le prénom est requis.',
            'first_name.string' => 'Le prénom doit être une chaîne de caractères valide.',
            'first_name.max' => 'Le prénom ne peut pas dépasser 255 caractères.',

            'last_name.required' => 'Le nom de famille est requis.',
            'last_name.string' => 'Le nom de famille doit être une chaîne de caractères valide.',
            'last_name.max' => 'Le nom de famille ne peut pas dépasser 255 caractères.',

            'email.required' => 'L\'adresse email est requise.',
            'email.string' => 'L\'adresse email doit être une chaîne de caractères valide.',
            'email.email' => 'L\'adresse email doit être un format valide.',
            'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',

            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.regex' => 'Le mot de passe doit contenir au moins une lettre majuscule, une minuscule et un chiffre',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'email' => $data['email'],
        ]);

        // Username : valeur saisie ou auto-génération via le hook booted()
        if (!empty($data['username'])) {
            $user->username = strtolower($data['username']);
        }

        // Champs sensibles assignés explicitement (hors $fillable)
        $user->profile = $data['profile'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(\Illuminate\Http\Request $request, $user)
    {
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Compte créé avec succès ! Bienvenue ' . $user->first_name . '.',
                'redirect' => $this->redirectPath()
            ]);
        }
    }
}
