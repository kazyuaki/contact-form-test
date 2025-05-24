<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;


class AdminRegisterController extends Controller
{
    public function show()
    {
        return view('admin.register');
    }

    public function register(AdminRegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login');
        // ->with('status', '登録が完了しました。ログインしてください。');
    }

    public function login()
    {
        return view('admin.login'); 
    }

    public function admin()
    {
        $contacts = Contact::paginate(7);
        return view('admin.admin', compact('contacts'));
    }
}
