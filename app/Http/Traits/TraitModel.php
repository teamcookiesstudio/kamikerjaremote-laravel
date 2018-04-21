<?php

namespace App\Http\Traits;

use Uuid as Generator;

/**
 *  
 */
trait TraitModel
{
    protected static function boot()
    {
        parent::boot();

        static::creating( function($model) {
            $model->uuid = Generator::generate(4);
        });
    }
}
