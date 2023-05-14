<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;

final class Role extends SpatieRole
{
    //    use HasFactory;

    protected $guarded = [];

    //    protected $fillable = [];
}
