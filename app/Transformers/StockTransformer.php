<?php

namespace App\Transformers;

use App\Models\Producte;
use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class StockTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'quantity' => $model->quantity,
            'product' => ProductTransformer::transform($model->products),
            'price' => $model->price,
            'type' => $model->type,
        ];
        return $data;
    }
}
