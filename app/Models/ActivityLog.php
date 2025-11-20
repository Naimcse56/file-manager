<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id', 'action', 'target_type', 'target_id', 'description'
    ];

    // Define the relationship
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    // Optional: If you have polymorphic relation to the loggable entity
    public function loggable()
    {
        return $this->morphTo();
    }
}
