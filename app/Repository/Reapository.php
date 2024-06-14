<?php

namespace App\Repository;

use App\Repository\Base;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements Base
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

    public function create(array $data): Collection
    {
        return $this->model->create($data);
    }

    public function update($data, $id): Model
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
