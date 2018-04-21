<?php

namespace App\Http\Traits;

use Cache;

trait TraitController
{
    public function findImage($opt = null)
    {
        return $this->triggerFindImage($opt);
    }

    public function triggerFindImage($image = null)
    {
        return strpos($image, 'http') !== false ? $image :
        ($image != null ? asset('storage/profile/'.$image) : asset('images/no_avatar.jpg'));
    }
}
