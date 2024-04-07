<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class OrderTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'cartId' => $model->card_id,
            'cart' => CardTransformer::transform($model->card),
        ];

        return $data;
    }
}
