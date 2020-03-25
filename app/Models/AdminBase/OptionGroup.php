<?php

namespace App\Models\AdminBase;

use App\Models\AdminBase\BaseModel as Model;

class OptionGroup extends Model
{
    protected $table = 'option_groups';
    protected $fillable = ['name', 'sort'];

    //配置项
    public function options()
    {
        return $this->hasMany(Option::class, 'group_id', 'id');
    }
}
