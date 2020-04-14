<?php

namespace App\Services\Users;

use App\User;

class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function browse()
    {
        return $this->user->get();
    }

    public function read($id)
    {
        return $this->user->findOrFail($id);
    }

    public function store($payload)
    {
        return $this->user->create($payload);
    }

    public function update($id, $payload)
    {
        $user = $this->user->find($id);
        return $user->update($payload);
    }

    public function delete($id)
    {
        return $this->user->destroy($id);
    }
}
