<?php

declare(strict_types=1);

namespace App\Enums\User;

enum UserStatusEnum: int
{
    const OFFLINE = 0;
    const ONLINE = 1;
    const AWAY = 2;
}