<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;
use App\Notifications\ActivityDeadlineNotification;
use Carbon\Carbon;
use App\Models\User;

class CheckActivityDeadlines extends Command
{
   
    protected $description = 'Check activity deadlines and send notifications if they are within 2 days.';
    protected $signature = 'app:check-activity-deadlines';


    public function handle()
    {
        // $activities = Activity::whereHas('targets', function ($query) {
        //     $query->whereDate('deadline', '=', Carbon::now()->addDays(2)->toDateString());
        // })->get();

        // foreach ($activities as $activity) {
        //     $user = $activity->user; // Assuming each activity has a user associated with it
        //     $user->notify(new ActivityDeadlineNotification($activity));
        // }

        // $this->info('Activity deadlines checked and notifications sent.');
        $user =User::find(1);
        $user->notify(new ActivityDeadlineNotification($activity));
    }
}
