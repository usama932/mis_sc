<x-default-layout>
 
    @section('title')
    View Project Detail
    @endsection

    <div class="container p-3" style="width: 100%; background-color: beige;">
        @php
            $startDate = \Carbon\Carbon::parse($dip_activity->project->start_date);
            $endDate = \Carbon\Carbon::parse($dip_activity->project->end_date);
        @endphp 
    
        <h1 class="text-center text-capitalize">National Rural Support Programme</h1>
        <h4 class="text-center text-capitalize">SCI-EU Funded Project "Conflict-sensitive Early Recovery Support to flood-affected communities" District Dadu.</h4>
        <h6 class="text-center text-capitalize">KP & Sindh</h6>
    
        <table class="table table-striped table-bordered nowrap table-responsive" style="width: 100%; background-color: beige;">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Activity</th>
                    <th>Targets</th>
                    @php
                        $startDate = \Carbon\Carbon::parse($dip_activity->project->start_date); // Reset start date
                    @endphp
                    @while ($startDate <= $endDate)
                        <th class="mx-2">{{ $startDate->format('M-y') }}</th>
                        @php
                            $startDate->addMonth();
                        @endphp
                    @endwhile
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $dip_activity->activity_detail }}</td>
                    <td></td> {{-- Add targets here --}}
                    @php
                        $startDate = \Carbon\Carbon::parse($dip_activity->project->start_date); // Reset start date
                    @endphp
                    
                    @while ($startDate <= $endDate)
                        @php
                            $found = false; // Flag to check if target for the month is found
                        @endphp
                        @foreach($dip_activity->months as $activity)
                            @if(\Carbon\Carbon::parse($activity->month)->format('m-y') == $startDate->format('m-y'))
                                <td>{{$activity->target ?? ''}}</td>
                                @php
                                    $found = true;
                                    break; // Break the loop once target is found for the month
                                @endphp
                            @endif
                        @endforeach
                        {{-- If target is not found for the month, display default --}}
                        @if (!$found)
                            <td>--</td>
                        @endif
                        @php
                            $startDate->addMonth();
                        @endphp
                    @endwhile
                </tr>
            </tbody>
        </table>
    </div>
    
</x-default-layout>
