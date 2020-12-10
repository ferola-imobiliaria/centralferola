<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Team;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use TJGazel\Toastr\Facades\Toastr;
use Illuminate\Validation\Rule;

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
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/usuarios';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'can:is-admin-or-supervisor']);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $user = User::find(Auth::id());

        $teams = Team::all();
        $supervisorTeams = [];

        return view('auth.register', [
            'teams' => $teams,
            'supervisorTeams' => $supervisorTeams
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'name_short' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users,username'],
            'cpf' => ['required', 'unique:users'],
            'creci' => ['required', 'unique:users'],
            'profile' => Rule::requiredIf(Auth::user()->profile === 'admin'),
            'realtor_team' => 'required_if:profile,realtor',
            'team_name' => 'required_if:profile,supervisor',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = request();

        //Senha gerada aleatoriamente para enviar por e-mail
        $password = Str::random(10);

        if (Auth::user()->profile === 'supervisor') {
            $data['profile'] = 'realtor';
            $team_id = Auth::user()->team_id;
        }

        // Trata as informações da foto do usuário inserida no formulário de cadastro
        if ($request->file('profile_picture')) {
            $profile_picture = $request->file('profile_picture')
                ->storeAs('profiles_pictures',
                    Str::slug($data['name']) . '-' . str_replace('.', '', microtime(true))
                    . '.' . $request->file('profile_picture')->extension());
        } else {
            $profile_picture = null;
        }

        try {

            // Salva o time do supervisor no banco de dados
            if ($data['profile'] === 'supervisor') {
                $team = Team::create([
                    'name' => $data['team_name'],
                    'store' => $data['team_store']
                ]);

                $team_id = $team->id;
            }


            // Insere os dados do usuário no banco de dados
            $userData = User::create([
                'name' => $data['name'],
                'name_short' => $data['name_short'],
                'email' => $data['email'] . "@ferola.com.br",
                'username' => $data['email'],
                'cpf' => $data['cpf'],
                'creci' => $data['creci'],
                'phone' => $data['phone'],
                'profile' => $data['profile'],
                'team_id' => $team_id ?? $data['realtor_team'],
                'password' => Hash::make($password),
                'photo' => $profile_picture
            ]);


            // Envio dos dados de cadastro por e-mail
            Arr::add($userData, 'password_email', $password);
            Mail::send(new \App\Mail\newAccount($userData));

            return $userData;

        } catch (Throwable $e) {
            report($e);
            return false;
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Foi realizado o override deste método para que após o registro do usuário o login não seja realizado de forma
     * automática.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //comentado para não redirecionar após finalizar o cadastro do usuário
        //$this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

}
