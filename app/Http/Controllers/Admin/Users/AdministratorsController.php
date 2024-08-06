<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdministratorsController extends Controller
{
    public function index()
    {
        return view('admin.user.administrators.index', [
            'users' => User::where('role', 1)->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.user.administrators.form', [
            'user' => new User(),
        ]);
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 1,
        ]);

        // redirect
        return redirect()
            ->route('admin.user.administrators.index')
            ->with('flash.bannerStyle', 'success')
            ->with('flash.banner', 'Administrator created successfully.');
    }

    public function show(User $user)
    {
    }

    public function edit($user)
    {
        return view('admin.user.administrators.form', [
            'user' => (new User())->findOrFail($user),
        ]);
    }

    public function update(Request $request, $user)
    {
        // load the user manually
        $user = (new User())->findOrFail($user);

        // validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable',
        ]);

        // update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // update password if provided
        if ($request->password) {
            $user->update([
                'password' => $request->password
            ]);
        }

        // redirect
        return redirect()
            ->route('admin.user.administrators.index')
            ->with('flash.bannerStyle', 'success')
            ->with('flash.banner', 'Administrator updated successfully.');
    }

    public function destroy($user)
    {
        // load the user manually
        $user = (new User())->findOrFail($user);

        // delete user
        $user->delete();

        // redirect
        return redirect()
            ->route('admin.user.administrators.index')
            ->with('flash.bannerStyle', 'warning')
            ->with('flash.banner', 'Administrator deleted successfully.');
    }
}
