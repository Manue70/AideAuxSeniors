<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reminder extends Model
{
    protected $fillable = ['message', 'type', 'heure', 'est_effectue', 'user_id' , 'is_daily'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class);
        
    }
}

