<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DipActivity;
use App\Notifications\ActivityDeadlineNotification;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;

class CheckActivityDeadlines extends Command
{

    protected $description = 'Check activity deadlines and send notifications if they are within 2 days.';
    protected $signature = 'check:activity-deadlines';


    public function handle()
    {

        // $activities = DipActivity::whereHas('months', function ($query) {
        //     $query->whereBetween('completion_date', [
        //         Carbon::now()->toDateString(),
        //         Carbon::now()->addDays(2)->toDateString()
        //     ]);
        // })->get();
        $activities = DipActivity::whereHas('months', function ($query) {
            $query->whereDate('completion_date', '<', Carbon::now()->toDateString());
        })->get();
       
        if(!empty($activities)){
            foreach($activities as $activity) {
                $project_id = $activity->project_id;
                $project = Project::find($project_id);

                $partner_emails = $project->partners()->pluck('email')->toArray();
                $partners = User::whereIn('email', $partner_emails)->get();

                $focal_person_ids = json_decode($project->focal_person, true);
                $focal_person = User::whereIn('id', $focal_person_ids)->get();

                $combined = $partners->merge($focal_person)->unique('id');

                if($combined){
                    foreach ($combined as $user) {
                        $user->notify(new ActivityDeadlineNotification($activity));
                    }
                }
            }
        }
    }
}
