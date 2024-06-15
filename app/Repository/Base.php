<?php

namespace App\Repository;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Base
{
    public function index(): Collection;
    public function show(int $id): Model;
    public function create(Request $request): Response;
    public function update(Request $request, int $id): Response;
    public function delete($id): bool;
}
