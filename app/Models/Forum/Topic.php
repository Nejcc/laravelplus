<?php

declare(strict_types=1);

namespace App\Models\Forum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Topic extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [];
}
