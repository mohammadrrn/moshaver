<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\Controller;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'full_name' => ['required', 'string', 'max:255', 'min:3'],
            'mobile_number' => ['required', 'numeric', 'min:11', 'unique:users', 'regex:/(09)[0-9]{9}/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code' => ['required', 'numeric', 'min:4'],
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function create(array $data)
    {
        if (Request()->cookie('custom-info')) {
            Cookie::queue(Cookie::forget('custom-info'));
        }
        $checkVerifyCode = Verification::where('mobile_number', $data['mobile_number'])->where('code', $data['code'])->first();
        if ($checkVerifyCode) {
            //$checkVerifyCode->delete();
            $user = User::create([
                'full_name' => $data['full_name'],
                'mobile_number' => $data['mobile_number'],
                'mac_address' => AssistantController::getMacAddress(),
                'password' => Hash::make($data['password']),
            ]);
            $user->attachRole('user');
            return $user;
        } else {
            echo 'code not found';
            exit();
        }
    }
}
