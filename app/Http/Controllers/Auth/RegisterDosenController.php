<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterDosenController extends Controller
{
    
    public function registerdosen()
    {
        return view('auth/register');
    }

    protected function adddosen(Request $data)
    {
        $this->validate($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            // 'name' => $data->name,
            // 'email' => $data->email,
            // 'password' => Hash::make($data->password),
            // 'role' => $data->role,
        ]);
        return redirect('/admin');
    }
    
    
   
    
}
