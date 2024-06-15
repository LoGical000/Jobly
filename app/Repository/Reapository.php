<?php

namespace App\Repository;

use App\Repository\Base;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class Reapository implements Base
{
    private $model;
    public function __construct($model)
    {
        return $this->model = $model;
    }
    public function index(): Collection
    {
        return $this->model->get();
    }

    public function show(int $id): Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Response
    {
        // dd($data);
        $createdUser = $this->model->create($data);

        if (!$createdUser) {
            return response()->json([
                'message' => 'Failed to create user',
            ], 400);
        }

        return response()->json([
            'data' => $createdUser,
        ]);
    }

    public function update(array $data, int $id): Response
    {
        $user = $this->model->find($id);

        $new_user = $user->update($data);
        return $new_user;
    }

    public function delete($id): bool
    {
        return $this->model->delete($id);
    }
}
