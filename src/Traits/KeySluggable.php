<?php

namespace SaltQuotation\Traits;

use Illuminate\Support\Str;

trait KeySluggable
{
    /**
     * Boot function from Laravel.
     */
    public static function bootKeySluggable() {
        static::creating(function ($model) {
            if(empty($model->key) && is_null($model->key)) {
                $model->key = Str::slug($model->value, '-');
            }
        });
    }
}
