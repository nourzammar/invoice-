<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class AccountOrderTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        $data = [
            'id' => $model->id,
            'accountId' => $model->account_id,
            'orderId' => $model->order_id,
            'account' => AccountsTransformer::transform($model->account),
            'order' => OrderTransformer::transform($model->order),
        ];

        return $data;
    }
}
