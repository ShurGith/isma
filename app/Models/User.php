<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    protected $hidden = [
        'password',
        'remember_token',
    ];

    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'postal_code',
        'phone_number',
        'is_active',
    ];
    
    public function id()
    {
    }
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function calendars()
    {
        return $this->belongsToMany(Calendar::class);
    }
    function departaments()
    {
        return $this->belongsToMany(Department::class);
    }
    function holidays()
    {
        return $this->hasMany(Holiday::class);
    }
    function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

}
