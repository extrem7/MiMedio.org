<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\View\View;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        showLoginForm as show;
    }

    protected string $redirectTo = '/';

    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(): View
    {
        $this->meta->prependTitle('Login');
        return $this->show();
    }

    public function join(): View
    {
        $this->meta->prependTitle('Join With Us');
        return view('auth.join');
    }
}
