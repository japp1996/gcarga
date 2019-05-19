<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Vehicle;

class Weight extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];    

    protected $table = "weights";

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'registered_by', 'updated_by'];

    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id');
    }

}
