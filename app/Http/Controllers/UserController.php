<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Users\UserService;
use App\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $user;
    protected $role;

    public function __construct()
    {
        $this->user = new UserService;
        $this->role = new Role;
    }

    public function browse()
    {
        $users = $this->user->browse();
        return view('users.browse', compact('users'));
    }

    public function read($id)
    {
        $user = $this->user->read($id);
        return view('users.detail', compact('user'));
    }

    public function add()
    {
        $roles = $this->role->get();
        return view('users.add', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);

        $user = $this->user->store([
            "name" => $request->name,
            "email" => $request->email,
            "email_verified_at" => now(),
            "password" => bcrypt($request->password),
            "remember_token" => Str::random(10),
        ]);
        $user->assignRole($request->role);
        if($user){
            return redirect()->route('user.index')->with('success', 'Data Berhasil Disimpan');
        }
        return redirect()->route('user.index')->with('failed', 'Data Gagal Disimpan');
    }

    public function edit($id)
    {
        $user = $this->user->read($id);
        $roles = $this->role->get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
        ]);
        $user = $this->user->update($id, [
            "name" => $request->name,
            "email" => $request->email,
        ]);
        if($user){
            return redirect()->route('user.index')->with('success', 'Data Berhasil Update');
        }
        return redirect()->route('user.index')->with('failed', 'Data Gagal Update');
    }

    public function delete(Request $request)
    {
        $user = $this->user->delete($request->id);
        if ($user) {
            return response()->json([
                "status" => "success"
            ]);
        }
        return response()->json([
            "status" => "failed"
        ]);
    }
}
