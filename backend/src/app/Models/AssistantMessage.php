<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistantMessage extends Model
{

    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'role',
        'content',
        'is_sensitive',
    ];
}
