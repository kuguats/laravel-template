<?php

namespace App\Models\AdminBase;

use App\Models\AdminBase\BaseModel as Model;

class LoginLog extends Model
{
    protected $table = 'login_logs';
    protected $guarded = ['id'];
}
