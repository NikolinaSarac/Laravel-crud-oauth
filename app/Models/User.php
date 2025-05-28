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
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    public const ROLE_GUEST = 'guest';
    public const ROLE_READER = 'reader';
    public const ROLE_AUTHOR = 'author';
    public const ROLE_ADMIN = 'admin';

    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function hasRolePermission(string $permission): bool
    {
        $permissions = [
            self::ROLE_GUEST => [
                'product.read',
                'category.read',
            ],
            self::ROLE_READER => [
                'product.read',
                'category.read',
                'color.read',
                'customers.read',
            ],
            self::ROLE_AUTHOR => [
                'product.read', 'product.create', 'product.update',
                'category.read', 'category.create', 'category.update',
                'color.read', 'color.create', 'color.update',
                'customers.read', 'customers.create', 'customers.update',
            ],
            self::ROLE_ADMIN => [
                'product.read', 'product.create', 'product.update', 'product.delete',
                'category.read', 'category.create', 'category.update', 'category.delete',
                'color.read', 'color.create', 'color.update', 'color.delete',
                'customers.read', 'customers.create', 'customers.update', 'customers.delete',
            ],
        ];

        return in_array($permission, $permissions[$this->role] ?? []);
    }

}
