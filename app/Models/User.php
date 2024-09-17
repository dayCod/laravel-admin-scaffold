<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

final class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasUuids;

    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates that the `id` column should be guarded from mass assignment.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Indicates that the `id` column should be treated as a string type.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
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
            'password' => 'hashed',
        ];
    }
}
