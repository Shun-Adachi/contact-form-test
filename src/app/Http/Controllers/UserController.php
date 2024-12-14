<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    // ログインページ表示
    public function login()
    {
        return view('auth.login');
    }
/*
    // 登録ページ表示
    public function register()
    {
        return view('auth.register');
    }

    // 保存処理
    public function store(UserRequest $request)
    {
        return redirect('/login');
    }
*/
}
