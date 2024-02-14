<x-default-layout>
 
    @section('title')
         Project Activity Detail
    @endsection

    <div class="container p-3" style="width: 100%; background-color: beige;">
       
    
        <h1 class="text-center text-capitalize">{{$project->name ?? ''}}</h1>
        <h6 class="text-center text-capitalize"></h6>
    
        <table class="table table-striped table-bordered nowrap table-responsive" style="width: 100%; background-color: beige;">
            <thead>
                <tr>
                    <th class=" fs-7">Activity</th>
                    <th class=" fs-7">LOP Targets</th>
                    @foreach($project->quarters as $tenure)
                        <th class="mx-1 fs-9">{{ $tenure->quarter }}</th>
                    @endforeach
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($project->activities as $item)
                <tr>
                   
                        <td>{{$item->activity_number ?? ''}}</td>
                        <td>{{$item->lop_target ?? ''}}</td>
                        @foreach($project->quarters->sortbyDesc('id') as $quarter)
                        @php
                            $found = false;
                        @endphp
                        @foreach($project->activity_months as $month)
                            @if($month->month == $quarter->quarter)
                                <td>{{ $month->target ?? '' }}</td>
                                @php
                                    $found = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if(!$found)
                            <td></td>
                        @endif
                    @endforeach
                  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</x-default-layout>
