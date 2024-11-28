<style>
    table, th, td ,tr{
      border: 1px solid black;
    }
    </style>
<table border="1">
    <thead>
        <tr>
            <th class="fs-7" style="min-width: 300px;">Activities</th>
            <th  class="fs-7" style="min-width: 100px;">LOP Target</th>
            @foreach($project->quarters as $tenure)
                <?php
                    $dateString = $tenure->quarter;
                    $parts = explode("-", $dateString);
                    $year = $parts[1];
                    $quarter = $parts[0]; 
                ?>
                <th colspan="6" class=" fs-7 text-center">{{ $quarter }} - {{$year}}</th>
            @endforeach
            <th class="fs-7" style="min-width: 300px;">Remarks</th>
        </tr>
    </thead>
    {{-- <thead>
        <tr>
            <th></th>
            <th></th>
            @foreach($project->quarters as $tenure)
                <?php
                    $dateString = $tenure->quarter;
                    $parts = explode("-", $dateString);
                    $quarter = $parts[0]; // This will give you "Q2"
                   
                ?>
                @if($quarter == 'Q1')
                    <th colspan="2 class="fs-8 text-center">Jan</th>
                    <th   colspan="2 class="fs-8 text-center">Feb</th>
                    <th  colspan="2  class="fs-8 text-center">Mar</th>
                @endif
                @if($quarter == 'Q2')
                    <th  colspan="2  class="fs-8 text-center">Apr</th>
                    <th  colspan="2  class="fs-8 text-center">May</th>
                    <th  colspan="2  class="fs-8 text-center">June</th>
                @endif
                @if($quarter == 'Q3')
                    <th  colspan="2  class="fs-8 text-center">Jul</th>
                    <th   colspan="2  class="fs-8 text-center">Aug</th>
                    <th  colspan="2 class="fs-8 text-center">Sep</th>
                @endif
                @if($quarter == 'Q4')
                    <th  colspan="2  class="fs-8 text-center">Oct</th>
                    <th  colspan="2  class="fs-8 text-center">Nov</th>
                    <th   colspan="2 class="fs-8 text-center">Dec</th>
                
                @endif
            @endforeach
            <th class="fs-8" style="min-width: 300px;"></th>
        </tr>
    </thead> --}}
    <thead>
        <tr>
            <th></th>
            <th></th>
            @foreach($project->quarters as $tenure)
                <?php
                    $dateString = $tenure->quarter;
                    $parts = explode("-", $dateString);
                    $quarter = $parts[0]; // This will give you "Q2"
                   
                ?>
                  <th colspan="3" class="fs-9 text-center"> Target</th>
                  <th colspan="3"  class="fs-9 text-center">Acheive</th>
            @endforeach
            <th class="fs-9" style="min-width: 300px;"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($project->activities->groupBy('scisubtheme_name.id') as $theme => $activities)
            @php
                $subtheme = \App\Models\SciSubTheme::with('maintheme')->find($theme);

            @endphp
            <tr>
                <th colspan="{{$project->quarters->count() * 90}} " class="fs-6">{{$subtheme->maintheme?->name}} ({{$subtheme->name}})</th> 
            </tr>
            @foreach($activities as $item)
                <tr>
                    <td style="min-width: 150px;" class="fs-8">{{$item->activity_number ?? ''}}</td>
                    <td class="fs-8">{{$item->lop_target ?? ''}}</td>
                    @foreach($project->quarters as $tenure)
                        <td colspan="3" class="text-center fs-8">
                            @foreach($item->months as $month)
                                @if($tenure->quarter == $month->slug->slug.'-'.$month->year)
                                    {{$month->target}}
                                @endif
                            @endforeach
                        </td>
                        <td colspan="3" class="text-center fs-8">
                            @foreach($item->months as $month)
                                @if($tenure->quarter == $month->slug->slug.'-'.$month->year)
                                    {{$month->progress?->activity_target ?? 0}}
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                    <td class="fs-9" style="min-width: 300px;"></td>
                </tr>
            @endforeach
           
        @endforeach
    </tbody>
</table>