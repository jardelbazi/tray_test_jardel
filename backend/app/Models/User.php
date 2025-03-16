<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'google_id',
        'google_token',
        'birth_date',
        'cpf',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'google_id' => 'string',
        ];
    }

    public function setGoogleIdAttribute($value)
    {
        $this->attributes['google_id'] = $value;
    }

    public function setGoogleTokenAttribute($value)
    {
        $this->attributes['google_token'] = $value;
    }

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = $value;
    }
}
