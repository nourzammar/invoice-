<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class AccountsTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'name' => $model->name,
            'address' => $model->address,
            'phone' => $model->phone,
            'type' => $model->type == true ? "تاجر" : "مفرق",
        ];

        return $data;
    }
}
