<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\RemindMemberNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class RemindMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //get all members that don't book 
        $members = User::where('role', 'member')
            ->whereDoesntHave('bookings', function ($q) {
                $q->where('date_time', '>', now());
            })->select('name', 'email')->get();

        Notification::send($members, new RemindMemberNotification);
    }
}
