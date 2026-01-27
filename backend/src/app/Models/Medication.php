<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medication extends Model
{

    use HasFactory;
    protected $fillable = ['nom', 'dosage', 'user_id', 'is_daily'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}


