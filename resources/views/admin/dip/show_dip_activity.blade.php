<x-default-layout>
 
    @section('title')
         Project Activity Detail
    @endsection

    <div class="container p-3" style="width: 100%; background-color: beige;">
       
    
        <h1 class="text-center text-capitalize">{{$dip_activity->project->name ?? ''}}</h1>
        <h4 class="text-center text-capitalize">{{$dip_activity->activity_number ?? ''}}</h4>
        <h6 class="text-center text-capitalize">@foreach($provinces as $province) {{$province }},  @endforeach</h6>
    
        <table class="table table-striped table-bordered nowrap table-responsive" style="width: 100%; background-color: beige;">
            <thead>
                <tr>
                    <th class=" fs-7">LOP Targets</th>
                    @foreach($dip_activity->months ?? [] as $month)
                        @foreach($dip_activity->project->quarters ?? [] as $tenure)
                            @if(isset($month->month) && isset($tenure->id) && $month->month == $tenure->id)
                                <th class="mx-1 fs-9">{{$tenure->quarter_start}} - {{$tenure->quarter_end}}</th>
                            @endif
                        @endforeach
                    @endforeach
                 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $dip_activity->lop_target ?? '' }}</td>
                    @foreach($dip_activity->months ?? [] as $month)
                        @foreach($dip_activity->project->quarters ?? [] as $tenure)
                            @if(isset($month->month) && isset($tenure->id) && $month->month == $tenure->id)
                                <td>{{ $month->target ?? '' }}</td>
                            @endif
                        @endforeach
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    
</x-default-layout>
