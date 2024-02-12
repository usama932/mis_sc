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
                    @foreach($dip_activity->months as $month)
                        <th class="mx-1 fs-8">{{$month->month}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $dip_activity->lop_target ?? '' }}</td>
                    @foreach($dip_activity->months as $month)
                        <td>{{ $month->target ?? '' }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    
</x-default-layout>
