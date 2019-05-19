<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\VehiclePhoto;
use App\Models\TransportWeightBulk;
use App\Models\Transport;
use App\Models\Bulk;
use App\Models\Weight;
use App\Models\Brand;
use App\Models\Vehicle;
use App\User;

class Vehicle extends Model
{
    use SoftDeletes;
    
    protected $table = "vehicles";

    protected $dates = ['deleted_at','created_at','deleted_at'];
    public function fotos()
    {
        return $this->hasOne(VehiclePhoto::class, 'vehicle_id', 'id');
    }

    public function transport_weight_bulk()
    {
        return $this->hasOne(TransportWeightBulk::class, 'id', 'transport_weight_bulk_id');
    }

    public function transport()
    {
        return $this->hasOne(Transport::class, 'id', 'transport_id');
    }

    public function bulk()
    {
        return $this->hasOne(Bulk::class, 'id', 'bulk_id');
    }

    public function weight()
    {
        return $this->hasOne(Weight::class, 'id', 'weight_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'user_id');
    }

    public function marca()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function to_auctions()
    {
        return $this->hasMany('App\Models\Auction', 'vehicle_id', 'id');
    }

    public function to_driver()
    {
        return $this->belongsTo(User::class);
    }

}
