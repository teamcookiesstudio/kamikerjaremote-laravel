<?php

namespace App\Http\Traits;

use Cache;
use Uuid;

trait TraitObserver
{
    public function generateUuid(&$model)
    {
        $model->uuid = Uuid::generate(4);
    }

    public function flushCacheTag($tags = [])
    {
        if (is_array($tags)) {
            Cache::tags($tags)->flush();
        }
    }
}
