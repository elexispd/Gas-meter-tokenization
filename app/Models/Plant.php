<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Plant extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'country',
        'state',
        'address',
        'tenant_id',
    ];



    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'plant_user', 'plant_id', 'user_id');
    }

    public function consumers()
    {
        return $this->belongsToMany(User::class, 'plant_user', 'plant_id', 'user_id');
    }



    public function my_consumers_for_tenant(User $tenant)
{
    return $this->belongsToMany(User::class, 'plant_user', 'plant_id', 'user_id')
                ->wherePivot('status', true)
                ->whereHas('tenant', function ($query) use ($tenant) {
                    $query->where('id', $tenant->id);
                })
                ->select('id', 'first_name', 'last_name', 'country', 'state', 'address');
}



}
