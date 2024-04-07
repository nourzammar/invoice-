<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class SetsTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'name' => $model->name,
        ];

        return $data;
    }
}
