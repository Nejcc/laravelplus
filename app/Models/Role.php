<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

final class Role extends SpatieRole
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guard_name',
        'slug',
        'description',
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($role): void {
            if (empty($role->slug)) {
                $role->slug = str()->slug($role->name);
            }
        });

        self::updating(function ($role): void {
            if ($role->isDirty('name') && empty($role->slug)) {
                $role->slug = str()->slug($role->name);
            }
        });
    }
}
