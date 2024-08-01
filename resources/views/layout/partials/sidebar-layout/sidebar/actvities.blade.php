@php
    $user = auth()->user();
    $userId =   $user->id.'';
    $userRole = $user->getRoleNames()->first();
    $dipsQuery = App\Models\ActivityMonths::where('id','!=',0);
    switch ($userRole) {

        case 'focal person':
            $dipsQuery = $dips->whereHas('project', function ($query) use ($userId) {
                $query->whereJsonContains('focal_person', $userId);
            });

        break;	
            
        case 'budget holder':
            $dipsQuery = $dips->whereHas('project', function ($query) use ($user) {
                $query->whereHas('partners', function ($partnersQuery) use ($user) {
                    $partnersQuery->where('email', $user->email);
                });
            });
        break;

        case 'awards':
            $dipsQuery =$dipsQuery->whereHas('project', function ($query) use ($user) {
                $query->where('award_person', $user->id);
            });
        break;

        case 'partner':
            $dipsQuery = $dipsQuery->whereHas('project', function ($query) use ($user) {
                $query->whereHas('partners', function ($partnersQuery) use ($user) {
                    $partnersQuery->where('email', $user->email);
                });
            });
        break;
    
    }
    $overdue = $dipsQuery->doesntHave('progress')->whereDate('completion_date', '<', Carbon\Carbon::now()->toDateString())->count();

@endphp