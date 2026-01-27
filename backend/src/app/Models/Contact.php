<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'user_id',
    ];

    // Relation inverse
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
