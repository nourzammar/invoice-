<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class CartProductTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'cartId' => $model->card_id,
            'productId' => $model->product_id,
            'product' => '',
        ];

        return $data;
    }
}
