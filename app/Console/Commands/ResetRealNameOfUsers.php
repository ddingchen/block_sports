<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ResetRealNameOfUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:reset_invalid_name_in_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清空无效的真实姓名（users:name）';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = 0;
        User::all()->each(function ($user) use (&$count) {
            if ($user->tickets->isEmpty()) {
                if ($user->name == $user->nickname) {
                    $user->name = '';
                    $user->save();
                    $count++;
                }
            }
        });
        $this->info("共清理了{$count}个无效的姓名");
    }
}
