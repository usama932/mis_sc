<x-default-layout>
 
    @section('title')
         Project Activity Detail
    @endsection
    <style>
        table, th, td ,tr{
          border: 1px solid black;
        }
        </style>
    <ol class="breadcrumb text-muted fs-6 fw-semibold">
        <li class="breadcrumb-item"><a href="{{route('get_project_index')}}" class="">Project Details</a></li>
     
        <li class="breadcrumb-item text-muted">Activities</li>
    </ol>
    <div class="container py-3">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="card-title">{{$project->name ?? ''}}</h5>
            </div>
            <div class="card-body">
                <div class="row">
            
                    <div class="col-md-8">
                        <label class="fw-bold">Thematic Area:</label>
                        @php
                            $groupedThemes = [];
                            foreach($project->themes as $themes) {
                                $mainThemeName = $themes->scisubtheme_name->maintheme->name ?? '';
                                $subThemeName = $themes->scisubtheme_name->name ?? '';
                                $groupedThemes[$mainThemeName][] = $subThemeName;
                            }
                        @endphp
                        <p class="fs-6">  @foreach($groupedThemes as $mainThemeName => $subThemes)
                            {{$mainThemeName}}(@foreach($subThemes as $index => $subTheme)
                            <u>{{$subTheme}}</u>@unless($loop->last),@endunless
                            @endforeach)@unless($loop->last),@endunless
                        @endforeach</p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Donor:</label>
                        <p> @foreach($project->partners as $partners)
                            {{$partners->partner_name->slug ?? ''}}@if(!$loop->last),@endif
                        @endforeach</p>
                    </div>
                   
                    <div class="col-md-4">
                        <label class="fw-bold">Donor:</label>
                        <p>{{$project->donors->name ?? ''}}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">SOF:</label>
                        <p>{{$project->sof ?? ''}}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Provinces:</label>
                        <p class='fs-6'>
                            @if(!empty($provinces))
                                @foreach($provinces as $province)
                                    {{ $province->province_name}}@if(! $loop->last), @endif
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Districts:</label>
                        <p class='fs-6'>
                            @if(!empty($districts))
                                @foreach($districts as $district)
                                    {{ $district->district_name}}@if(! $loop->last), @endif
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Focal Person:</label>
                        <p class='fs-6'>
                            {{$project->focalperson?->name}} ({{$project->focalperson?->desig?->designation_name}})
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Budget Holder FP:</label>
                        <p class='fs-6'>
                            {{$project->budgetholder?->name ?? ''}} -  {{$project->budgetholder?->desig?->designation_name ?? ''}}
                       
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Awards FP:</label>
                        <p class='fs-6'>
                            {{$project->awardfp?->name ?? ''}} -  {{$project->awardfp?->desig?->designation_name ?? ''}}
                        </p>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold">Project Tenure:</label>
                        <p>
                            @if(!empty($project->start_date) && $project->start_date != null)
                                {{ date('M d, Y', strtotime($project->start_date))}} - {{date('M d, Y', strtotime($project->end_date))}}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header border-bottom">
                <h5 class="card-title">Activity Progress Detail</h5>
            </div>
            <div class="card-body">
                <div class="justify-content-end d-flex m-5">
                    {{-- <button id="export-btn" class="btn btn-primary btn-sm">Export to Excel</button> --}}
                    <a href="{{route('project-export',$project->id)}}" class="btn btn-primary btn-sm">Export to Excel</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm  table-bordered" style="width: auto; overflow-x: auto;">
                        <thead>
                            <tr>
                                <th class="fs-7" style="min-width: 300px;">Activities</th>
                                <th  class="fs-7" style="min-width: 100px;">LOP Target</th>
                                @foreach($months as $month)
                                    <th colspan="6" class=" fs-7 text-center">{{ $month}}</th>
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
                                @foreach($months as $month)
                                    
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
                                        @foreach($months as $monthed)
                                            <td colspan="3" class="text-center fs-8">
                                                @foreach($item->months as $month)
                                                    @if($monthed == $month->quarter.' '.$month->year)
                                                        {{$month->target}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td colspan="3" class="text-center fs-8">
                                                @foreach($item->months as $month)
                                                    @if($monthed == $month->quarter.' '.$month->year)
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
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
<script>
    document.getElementById("export-btn").addEventListener("click", function() {
        const table = document.querySelector("table");
        const filename = "project_activity_detail.xlsx";
        const wb = XLSX.utils.table_to_book(table, { sheet: "Sheet 1" });

        // Write the workbook to binary string
        const wbout = XLSX.write(wb, { bookType: 'xlsx', bookSST: false, type: 'binary' });

        // Convert binary string to ArrayBuffer
        function s2ab(s) {
            const buf = new ArrayBuffer(s.length);
            const view = new Uint8Array(buf);
            for (let i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }

        // Save the Excel file
        saveAs(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), filename);
    });
</script>

@endpush
</x-default-layout>
