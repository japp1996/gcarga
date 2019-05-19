<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Vehicle;
use App\Models\Weight;
use App\Models\Bulk;

class TransportWeightBulk extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = "transport_weight_bulk";

    public function vehicule()
    {
        return $this->belongsTo(Vehicle::class, 'transport_weight_bulk_id');
    }

    public function weight()
    {
        return $this->hasOne(Weight::class, 'id', 'weight_id');
        
    }

    public function bulk()
    {
        return $this->hasOne(Bulk::class, 'id', 'bulk_id');
        
    }

}
