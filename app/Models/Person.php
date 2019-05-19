<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Person extends Model
{
    protected $table = 'persons';
    
    public function persons()
    {
        // return $this->hasOne(Person::class, 'user_id', 'id');
        return $this->belongsTo(User::class, 'id');
    }

}
