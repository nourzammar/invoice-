<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class SettingTransformer extends AbstractTransformer
{
    public function transformModel(Model $model): array
    {
        
        $data = [
            'id' => $model->id,
            'key' => $model->key,
            'value' => $model->value,
            
        ];
        return $data;
    }
}
