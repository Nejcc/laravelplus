<?php

namespace App\Console\Commands\Users;

use App\Enums\User\UserStatusEnum;
use App\Models\User;
use Illuminate\Console\Command;

final class UpdateUserStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:update-user-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private int $subMinutes = 5;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $threshold = now()->subMinutes($this->subMinutes);
        User::query()->where('last_activity_at', '<', $threshold)->update(['status' => UserStatusEnum::AWAY]);
    }
}
