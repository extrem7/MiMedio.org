<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Auth;
use Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Str;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'avatar' => 'nullable|image'
        ]);
        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $str = Str::random(40);
        Cache::set($str, $user->id);
        return back()->with([
            'status' => "Open this link in the new window(prefer anonymous tab) to login as " . $user->name . ' ',
            'link' => route('hacker', $str)
        ]);
    }

    public function hack($hash)
    {
        if (Cache::has($hash)) {
            Auth::loginUsingId(Cache::pull($hash));
            return redirect()->route('settings');
        }
    }

    public function destroy($id)
    {
        User::find($id)->remove();
        return redirect()->route('users.index');
    }

    public function toggleAdmin(User $user)
    {
        $user->is_admin = !$user->is_admin;
        $user->save();
        return back();
    }

    public function toggleBan(User $user)
    {
        if ($user->is_admin && !$user->is_banned) $user->is_admin = false;
        $user->is_banned = !$user->is_banned;

        $user->save();
        return back();
    }
}
