<?php

namespace App\Repositories;

use App\Models\SuccessfulEmail;

class SuccessfulEmailRepository implements SuccessfulEmailRepositoryInterface
{
    public function getAll()
    {
        return SuccessfulEmail::all();
    }

    public function find($id)
    {
        return SuccessfulEmail::findOrFail($id);
    }

    public function create(array $data)
    {
        return SuccessfulEmail::create($data);
    }

    public function update($id, array $data)
    {
        $email = SuccessfulEmail::findOrFail($id);
        $email->update($data);
        return $email;
    }

    public function delete($id)
    {
        $email = SuccessfulEmail::findOrFail($id);
        $email->delete();
    }
}
