<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RoleUser;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public function role_user()
    {
        return $this->hasOne(RoleUser::class, 'role_id', 'id');
    }

}
