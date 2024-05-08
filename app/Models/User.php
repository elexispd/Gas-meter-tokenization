<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'state',
        'address',
        'phone_number',
        'meter_number',
        'email',
        'is_tenant',
        'is_admin',
        'is_super_admin',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function plants() {
        return $this->belongsToMany(Plant::class, 'plant_user', 'user_id', 'plant_id');
    }

    public function plantss()
    {
        return $this->hasMany(Plant::class, 'tenant_id');
    }


    public function tenantPlant(){
        return $this->belongsTo(Plant::class, ' plants', 'tenant_id');
    }

    public function tenantPlants()
    {
        return $this->hasMany(Plant::class, 'tenant_id');
    }


    public function endUsers()
    {
        return $this->hasManyThrough(
            User::class, // Target model (end-users)
            Plant::class, // Intermediate model (plants)
            'tenant_id', // Foreign key on the intermediate model (plants)
            'id', // Local key on the source model (users)
            'id', // Local key on the target model (end-users)
            'tenant_id' // Foreign key on the intermediate model (plants)
        );

    }


    public function usersUsingMyPlants()
    {
        return User::whereHas('plants', function ($query) {
            $query->where('tenant_id', $this->id);
        })->get();
    }





    public function purchase() {
        return $this->hasMany(Purchase::class, 'user_id');
    }




















}
