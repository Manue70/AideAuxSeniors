<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Medication;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs qui peuvent être remplis en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // pour l'admin
        'onboarding_completed',
    ];

    /**
     * Les attributs à cacher pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs à caster.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ---------------------------
    // Relations Eloquent
    // ---------------------------

    /**
     * Profile (1:1)
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Médicaments (1:N)
     */
    public function medicaments()
    {
        return $this->hasMany(Medication::class);
    }

    /**
     * Rappels (1:N)
     */
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
