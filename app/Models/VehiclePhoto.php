<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;

class VehiclePhoto extends Model
{
    protected $table = "vehicle_photo";

    public function vehicule()
    {
        return $this->belongsTo(Vehicle::class, 'id');
    }

}
