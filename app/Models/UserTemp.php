<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleTemp;

class UserTemp extends Model
{
    protected $table = 'users_temp';
    
    public function get_vehicles()
    {
        return $this->hasMany(VehicleTemp::class, 'user_temp_id', 'id');
    }

}
