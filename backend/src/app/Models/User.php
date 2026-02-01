<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Medication;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'is_admin',
        'onboarding_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
    'last_login_at',
    'created_at',
    'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function medicaments()
    {
        return $this->hasMany(Medication::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}

