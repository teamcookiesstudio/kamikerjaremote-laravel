<?php 

namespace App;

use ModelCaching as Cachable;
use Illuminate\Database\Eloquent\Model;

abstract class ModelCaching extends Model
{
    use Cachable;
}
