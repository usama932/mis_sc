<x-default-layout>
 
    @section('title')
    View Project Detail
    @endsection

    <div class="container p-3" style="width: 100%; background-color: beige;">
       
    
        <h1 class="text-center text-capitalize">National Rural Support Programme</h1>
        <h4 class="text-center text-capitalize">SCI-EU Funded Project "Conflict-sensitive Early Recovery Support to flood-affected communities" District Dadu.</h4>
        <h6 class="text-center text-capitalize">KP & Sindh</h6>
    
        <table class="table table-striped table-bordered nowrap table-responsive" style="width: 100%; background-color: beige;">
            <thead>
                <tr>
                    <th>S.NO</th>
                    <th>Activity</th>
                    <th>Targets</th>
                   
                    @foreach ($quarters as $key =>  $quarter)
                        <th class="mx-2">{{ $quarter['start_month'] }} - {{ $quarter['end_month'] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $dip_activity->activity_number }}</td>
                    <td>{{ $dip_activity->lop_target }}</td> {{-- Add targets here --}}
                    
                    @foreach($dip_activity->months as $month)
                        @foreach ($quarters as $quarter)
                            @if($quarter['start'].'-'.$quarter['end'] == $month->month)
                                <td>{{ $month->target }}</td>
           
                            @endif
                        @endforeach
                    @endforeach
                    
                    
                    
                </tr>
            </tbody>
        </table>
    </div>
    
</x-default-layout>
