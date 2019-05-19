<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BankUser;

class Bank extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $table = "banks";

    public function bank_data()
    {
        return $this->belongsTo(BankUser::class, 'id');
    }

}
