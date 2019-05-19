<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Bank;

class BankUser extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $table = "bank_user";
   
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function bank()
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');       
    }

}
