<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class CategoriesTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'name' => $model->name,
            'description' => $model->description,
            'set' => SetsTransformer::transform($model->set),
        ];

        return $data;
    }
}
