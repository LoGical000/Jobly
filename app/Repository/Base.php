<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Base
{
    public function index(): Collection;
    public function show(int $id): Model;
    public function create();
    public function store(array $data): Collection;
    public function update();
    public function edit($data, $id): Model;
    public function delete($id): bool;
}
