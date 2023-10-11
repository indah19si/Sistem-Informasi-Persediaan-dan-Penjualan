<?php

namespace App\Http\Controllers\authentications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostLoginRequest;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login(PostLoginRequest $request)
  {
    $input = $request->only(['username', 'password']);

    $isLoginSuccess = Auth::attempt($input);

    $message = 'Nama Pengguna atau Kata Sandi Salah!';
    $isError = true;

    if (!$isLoginSuccess)
      return redirect()->route('auth-login')
        ->with(compact('message', 'isError'))
        ->withInput();

    return redirect()->route('dashboard');
  }

  public function logout()
  {
    Auth::logout();

    $message = 'berhasil logout!';
    $isError = false;

    return redirect()->route('auth-login');
  }
}
