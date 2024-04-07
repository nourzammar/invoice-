<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class CardTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'active' => $model->active,
            'user' => UserTransformer::transform($model->user),
            'products' => $model->cardProduct,
        ];

        return $data;
    }
}
