<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

use App\Models\RoleUser;
use App\Models\Vehicule;
use App\Models\Configuration;
use App\Models\Role;
use App\Models\Auction;
use App\Models\Ticket;
use App\Models\Person;
use App\Models\PhoneUsers;
use App\Models\BankUser;


class User extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function bank_data()
    {
        return $this->belongsTo(BankUser::class, 'id');
    }
    
    public function role_user()
    {
        return $this->hasOne(RoleUser::class, 'user_id', 'id');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'user_id', 'id');
    }

    public function get_vehicles()
    {
        return $this->hasMany(Vehicle::class, 'registered_id', 'id');
    }

    /**
     * Obtengo los datos personales del usuario
     */
    public function to_person()
    {
        return $this->hasOne(Person::class, 'user_id', 'id');
    }

    /**
     * Retorna la lista de conductores para los usuarios empresa
     */
    public function to_drivers() 
    {
        return $this->hasMany('App\User', 'user_id', 'id');
    }

    
    //public function to_gateway()
    //{
    //    return $this->belongsTo('App\Models\Gateway', 'gateway_id', 'id');
    //}
    

    /**
     * Retorna la empresa a la que pertenece un conductor
     */
    public function company()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * 
     */
    public function getAvatarAttribute($value)
    {
        if ($value != NULL) {
            return asset($value);
        }
    }

}
