<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'description',
        'user_id',
        'resolve_approach',
        'resolved_by',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
