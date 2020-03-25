<?php

namespace App\Models\AdminBase;

use App\Models\AdminBase\BaseModel as Model;

class Option extends Model
{
    protected $table = 'options';
    protected $guarded = ['id'];
}
