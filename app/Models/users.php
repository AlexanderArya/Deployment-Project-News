<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public function role()
    {
        return $this->hasOne(Role::class);
    }
}
