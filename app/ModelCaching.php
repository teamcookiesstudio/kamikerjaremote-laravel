<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ModelCaching as Cachable;

abstract class ModelCaching extends Model
{
    use Cachable;
}
