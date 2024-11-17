<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'sandwich_roles';
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    // Constantes des rôles disponibles
    public const ADMIN = 'Administrateur';
    public const RDC = 'Responsable des commandes';
    public const USER = 'Utilisateur';

    public static function roles(): array
    {
        return [
            self::ADMIN,
            self::RDC,
            self::USER,
        ];
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
