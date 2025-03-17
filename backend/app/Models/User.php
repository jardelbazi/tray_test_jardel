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

    /**
     * Define o valor do atributo `google_id`.
     *
     * Método para definir o valor do campo `google_id` antes de atribuí-lo ao banco de dados.
     *
     * @param mixed $value O valor a ser atribuído ao atributo `google_id`.
     * @return void
     */
    public function setGoogleIdAttribute($value): void
    {
        $this->attributes['google_id'] = $value;
    }

    /**
     * Define o valor do atributo `google_token`.
     *
     * Método para definir o valor do campo `google_token` antes de atribuí-lo ao banco de dados.
     *
     * @param mixed $value O valor a ser atribuído ao atributo `google_token`.
     * @return void
     */
    public function setGoogleTokenAttribute($value): void
    {
        $this->attributes['google_token'] = $value;
    }

    /**
     * Define o valor do atributo `birth_date`.
     *
     * Método para definir o valor do campo `birth_date` antes de atribuí-lo ao banco de dados.
     *
     * @param mixed $value O valor a ser atribuído ao atributo `birth_date`.
     * @return void
     */
    public function setBirthDateAttribute($value): void
    {
        $this->attributes['birth_date'] = $value;
    }
}
