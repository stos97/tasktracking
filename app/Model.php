<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Mtvs\EloquentHashids\HasHashid;
use Mtvs\EloquentHashids\HashidRouting;

/**
 * Class Model
 *
 * @package App
 */
class Model extends BaseModel
{
    use HasHashid;
    use HashidRouting;
}
