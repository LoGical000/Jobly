<?php

namespace App\Repository;

use App\Repository\Base;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class Reapository implements Base
{
    use ResponseTrait;
    private $model;
    public function __construct($model)
    {
        return $this->model = app($model);
    }
    public function index(): Response
    {
        return response()->json([
            'data' => $this->model->all()
        ]);
    }

    public function show(int $id): Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Response
    {
        $createdUser = $this->model->create($data);

        if (!$createdUser) {
//            return response()->json([
//                'message' => 'Failed to create user',
//            ], 400);
          return $this->apiResponse('Failed to create',null,false);

        }

//        return response()->json([
//            'message'=>'success',
//            'data' => $createdUser,
//        ]);
        return $this->apiResponse('Success',$createdUser);

    }

    public function update(array $data, int $id): Response
    {
        $model = $this->model->find($id);
        if (!$model) {
//            return response()->json([
//                'message' => 'Failed to find model',
//            ], 400);
            return $this->apiResponse('Failed to find model',null,false);

        }
        if ($model->update($data)) {
//            return response()->json([
//                'data' => $model,
//            ]);
            return $this->apiResponse('success',$model);

        } else {
//            return response()->json([
//                'message' => 'Failed to update model',
//            ], 400);
            return $this->apiResponse('Failed to update model',null,false);

        }
    }

    public function delete($id): bool
    {
        $model = $this->model->find($id);
        if (!$model) {
            return false;
        }
        // dd($model);
        $model->delete($model);
        return true;
    }
}
