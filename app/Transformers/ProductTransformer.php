<?php

namespace App\Transformers;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class ProductTransformer extends AbstractTransformer
{


    public function transformModel(Model $model): array
    {
        $setting = Setting::where('key', 'dollar')->first();
        $data = [
            'id' => $model->id,
            'name' => $model->name,
            'price' => $model->price,
            'secondPrice' => $model->price * $setting->value,
            'category' => CategoriesTransformer::transform($model->categories),
        ];
        return $data;
    }
}
