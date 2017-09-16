<?php

namespace App\Http\Controllers\Auth;


use Hashids;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use App\User;
use App\Role;
use App\Masjid;
use App\Activation\ActivationService;


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
    protected $redirectTo = '/home';


    // Use activationService
    protected $activationService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest');
        $this->activationService = $activationService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            // 'name' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user   = User::create([
            'name'      => $data['masjid_name'],
            'email'     => $data['account_email'],
            'password'  => bcrypt($data['password']),
            'phone'     => $data['masjid_phone'],
            'api_token' => str_random(60), // Fill with random string, we'll update later
        ]);

        $user->api_token = Hashids::encode($user->id);
        $user->save();

        // Apply role
        $role = Role::where('name', 'masjid')->first();
        $user->attachRole($role);
        $masjid             = new Masjid();
        $masjid->user_id    = $user->id;
        $masjid->contact_name = $data['contact_person_name'];
        $masjid->contact_phone = $data['contact_person_phone'];
        $masjid->save();

        return $user;

    }


    // Override default register function
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        $this->activationService->sendActivationMail($user);

        return redirect('/login')->with('success', __('register.flash_activation_sent'));
    }


    // Activate user
    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
}

}
