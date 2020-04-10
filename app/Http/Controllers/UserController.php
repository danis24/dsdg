<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Users\UserService;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserService;
    }

    public function browse()
    {
        $users = $this->user->browse();
        return view('users.browse', compact('users'));
    }

    public function read($id)
    {
    }

    public function add()
    {
        return view('users.add');
    }

    public function store(Request $request)
    {
    }

    public function edit($id)
    {
        return view('users.edit');
    }

    public function update($id, Request $request)
    {
    }

    public function delete($id)
    {
    }
}
