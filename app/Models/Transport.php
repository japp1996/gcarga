<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Vehicle;

class Transport extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "transports";

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id');
    }
}
