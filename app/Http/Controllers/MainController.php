<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UsedPassword;
use Auth;

class MainController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->all();

        $email = $data['email'];
        $rawPassword = $data['password'];
        $user = User::where('email', $email)->first();

        $password = $this->getRealPassword($rawPassword, $user);

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if (! $this->usedBefore($user->id, $rawPassword)) {
                $this->saveRawPassword($user->id, $rawPassword);
                return redirect('/home');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('authentication-issue', true)->with('used-password', true);
            }
        } else {
            return redirect()->route('login')->with('authentication-issue', true);
        }
    }


    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->save();
        return redirect('/');
    }

    public function getPasswordConfig()
    {
        return view('password-config');
    }

    public function postPasswordConfig(Request $request)
    {
        $data = $request->all();
        $password = $data['password'];
        $passwordConfig['position'] = $data['position'];
        $passwordConfig['length'] = $data['length'];

        $user = Auth::user();
        $user->password = Hash::make($password);
        $user->password_config = json_encode($passwordConfig);
        $user->save();
        return redirect('/dashboard');
    }

    public function home()
    {
        $user = Auth::user();
        $name = $user->name;
        return view('home')->with(compact('name'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    private function usedBefore($userId, $password)
    {
        $usedPasswords = UsedPassword::where('user_id', $userId)->get();
        foreach ($usedPasswords as $usedPassword) {
            if (Hash::check($password, $usedPassword->password)) {
                return true;
            }
        }

        return false;
    }

    private function saveRawPassword($userId, $password)
    {
        UsedPassword::create(['user_id' => $userId, 'password' => Hash::make($password)]);
    }

    private function getRealPassword($rawPassword, $user)
    {
        $passwordConfig = json_decode($user->password_config, true);
        $password = substr_replace($rawPassword, '', $passwordConfig['position'], $passwordConfig['length']);

        return $password;
    }
}
