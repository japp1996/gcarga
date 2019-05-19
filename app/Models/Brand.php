<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use App\Models\Modelo;

class Brand extends Model
{
    public function marca()
    {
        return $this->belongsTo(Vehicle::class, 'brand_id');
    }

    public function modelo()
    {
        return $this->hasOne(Modelo::class, 'id', 'model_id');
    }
}
