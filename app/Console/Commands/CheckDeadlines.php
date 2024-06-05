<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DipActivity;
use App\Models\User;
use App\Models\ActivityMonths;
use App\Models\Project;
use App\Notifications\ActivityDeadlineNotification;
use Carbon\Carbon;

class CheckDeadlines extends Command
{
    protected $signature = 'check:deadlines';
    protected $description = 'Check for activities with deadlines the day after tomorrow and notify users';

    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $activities = DipActivity::whereHas('months', function ($query) {
            $query->where('completion_date', '>', Carbon::tomorrow());
        })->with('months')->get();
        
        foreach ($activities as $activity) {
            foreach ($activity->months as $month) {
                $project = Project::find($month->project_id);
                if (!$project) continue;

                $focalPersons = User::whereIn('id', json_decode($project->focal_person))->get();
                $budgetHolders = User::whereIn('id', json_decode($project->budget_holder))->get();
                
                foreach ($focalPersons as $focalPerson) {
                    $focalPerson->notify(new ActivityDeadlineNotification($month));
                }
                foreach ($budgetHolders as $budgetHolder) {
                    $budgetHolder->notify(new ActivityDeadlineNotification($month));
                }
            }
        }
       
        return 0;
    }
}
