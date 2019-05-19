<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class Modelo extends Model
{
    protected $table = "models";
    public $timestamps = false;
    
    public function marca()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
