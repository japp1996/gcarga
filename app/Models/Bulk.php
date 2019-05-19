<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Vehicle;


class Bulk extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = "bulks";

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = [];
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id');
    }

}
