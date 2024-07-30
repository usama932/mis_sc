<x-nform-layout>
    @section('title')
         Project Activity Detail
    @endsection

    <style>
        table, th, td, tr {
          border: 1px solid black;
        }
        .fs-6 { font-size: 14px; }
        .fs-7 { font-size: 12px; }
        .fs-8 { font-size: 10px; }
        .fs-9 { font-size: 8px; }
    </style>

    <ol class="breadcrumb text-muted fs-6 fw-semibold">
        <li class="breadcrumb-item"><a href="{{ route('get_project_index') }}" class="">Project Details</a></li>
        <li class="breadcrumb-item text-muted">Activities</li>
    </ol>

    <div class="container-fluid py-3">
        <div class="card">
            <div class="card-header bg-light border-bottom">
                <h5 class="card-title">{{ $project->name ?? '' }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
        
                    <div class="col-md-6">
                        <table class="table table-striped m-4 p-4">
                            
                            <tr>
                                <td><strong>Project Name</strong></td>
                                <td>{{$project->name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>Donor</strong></td>
                                <td>
                                    {{$project->donors?->name ?? ''}} 
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Awards  FP</strong></td>
                                <td>
                                    {{$project->awardfp?->name ?? ''}} -  {{$project->awardfp?->desig?->designation_name ?? ''}}<br>
                                
                                </td>
                            </tr>
                            <tr>
                                <td><strong>SOF.#</strong></td>
                                <td>{{$project->sof ?? ''}}</td>
                            </tr>
                            
                            @if(!empty($provinces))
                                <tr>
                                    <td><strong>Provinces</strong></td>
                                    <td>
                                        @foreach($provinces as $province)
                                            {{ $province->province_name}}  @if(! $loop->last)<br> @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            {{-- <tr>
                                <td><strong>Status</strong></td>
                                <td>{{$project->status ?? ''}}</td>
                            </tr> --}}
                            
                            {{-- <tr>
                                <td><strong>Project Status </strong></td>
                                <td>
                                    @if($project->active == 1)
                                        Active
                                    @else
                                        InActive
                                    @endif
                                    {{$project->atic ?? ''}}
                                </td>
                            </tr> --}}
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped m-4 p-4">
                            <tr>
                                <td><strong>Type</strong></td>
                                <td>{{$project->type ?? ''}}</td>
                            </tr>
                            <tr>
                                <td class="fs-8"><strong>Operational Focal Person</strong></td>
                                <td>
                                    {{$focal_person ?? ''}}
                                    {{-- {{$project->focalperson?->email ?? ''}} --}}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Budget Holder FP</strong></td>
                                <td>
                                    {{$budgetholder ?? ''}}
                                
                                </td>
                            </tr>
                            <tr>
                                <td class="fs-8"><strong>Project Tenure</strong></td>
                                <td>
                                    @if(!empty($project->start_date) && $project->start_date != null)
                                        {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                                    @endif
                                </td>
                            </tr>
                            
                            
                            
                            @if(!empty($districts))
                            <tr>
                                <td><strong>Disticts</strong></td>
                                <td>  @foreach($districts as $district)
                                    {{ $district->district_name}}  @if(! $loop->last)<br> @endif
                                    @endforeach
                                </td>
                            </tr>
                            @endif
                            
                            
                            {{-- <tr>
                                <td><strong>Project Extended </strong></td>
                                <td>
                                    @if($project->project_extended == "0")  
                                        No
                                    @else
                                        Yes 
                                    @endif
                                </td>
                            </tr> --}}
                            
                        </table>
                    </div>
                    <div class="col-md-12"> 
                        <table class="table table-striped px-4 mx-4">
                            <tr>
                                <td><strong>Project Description</strong></td>
                                <td>{{$project->detail?->project_description ??  ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header border-bottom">
                <h5 class="card-title">Activity Progress Detail</h5>
                <input type="hidden" id="project_id" value="{{ $project->name }}" />
            </div>
            <div class="card-body">
                <div class="justify-content-end d-flex m-5">
                    <button onclick="exportToExcel()" class="btn btn-primary btn-sm">Export to Excel</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm nowrap table-striped table-bordered" id="activityTable">
                        <thead>
                            <tr>
                                <th class="fs-9 col-1">Activity .#</th>
                                <th class="fs-7 col-4" style="min-width: 300px;">Activity Title</th>
                                <th class="fs-9" style="width:60px;">LOP Target</th>
                                @foreach($months as $month)
                                    <th colspan="2" class="fs-7 text-center col-2">{{ $month }}</th>
                                @endforeach
                                <th class="fs-7" style="min-width: 300px;">Remarks</th>
                            </tr>
                            <tr>
                                <th class="fs-7 col-1"></th>
                                <th class="fs-7 col-4" style="min-width: 300px;"></th>
                                <th class="fs-7" style="min-width:60px;"></th>
                                @foreach($months as $month)
                                    <th class="fs-9 text-center col-2">Target</th>
                                    <th class="fs-9 text-center col-2">Achieve</th>
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
                                    <th colspan="90" class="fs-6">{{ $subtheme->maintheme?->name }} ({{ $subtheme->name }})</th>
                                </tr>
                                @php
                                    $sortedActivities = $activities->sort(function ($a, $b) {
                                        $a_parts = explode('.', $a->activity_number);
                                        $b_parts = explode('.', $b->activity_number);

                                        for ($i = 0; $i < max(count($a_parts), count($b_parts)); $i++) {
                                            $a_part = isset($a_parts[$i]) ? (int)$a_parts[$i] : 0;
                                            $b_part = isset($b_parts[$i]) ? (int)$b_parts[$i] : 0;

                                            if ($a_part < $b_part) {
                                                return -1;
                                            } elseif ($a_part > $b_part) {
                                                return 1;
                                            }
                                        }

                                        return 0;
                                    });
                                @endphp

                                @foreach($sortedActivities as $item)
                                    <tr>
                                        <td class="fs-8">{{ $item->activity_number ?? '' }}</td>
                                        <td class="fs-8">{{ $item->activity_title ?? '' }}
                                            @if($item->activity_type)
                                                ({{ $item->activity_type?->activity_type?->name }} - {{ $item->activity_type?->name }})
                                            @endif
                                        </td>
                                        <td class="fs-8">{{ $item->lop_target ?? '' }}</td>
                                        @foreach($months as $monthed)
                                            <td class="text-center fs-8">
                                                @foreach($item->months as $month)
                                                    @if($monthed == $month->quarter.' '.$month->year)
                                                        {{ $month->target }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center fs-8">
                                                @foreach($item->months as $month)
                                                    @if($monthed == $month->quarter.' '.$month->year)
                                                        {{ $month->progress?->activity_target ?? 0 }}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script>
        function exportToExcel() {
            var workbook = new ExcelJS.Workbook();
            var worksheet = workbook.addWorksheet("Activity Progress");
    
            var table = document.querySelector("#activityTable");
            var rows = table.querySelectorAll("tr");
            var headerRowCount = 2; // Adjust this if you have more header rows
    
            rows.forEach((row, rowIndex) => {
                let excelRow = worksheet.getRow(rowIndex + 1);
                let cells = row.querySelectorAll("th, td");
    
                cells.forEach((cell, cellIndex) => {
                    let excelCell = excelRow.getCell(cellIndex + 1);
                    excelCell.value = cell.innerText;
    
                    if (rowIndex < headerRowCount) { // Apply bold formatting to header rows
                        excelCell.font = { bold: true };
                        excelCell.fill = {
                            type: 'pattern',
                            pattern: 'solid',
                            fgColor: { argb: 'FFFFE0B2' }
                        };
                    }
    
                    excelCell.border = {
                        top: { style: 'thin' },
                        left: { style: 'thin' },
                        bottom: { style: 'thin' },
                        right: { style: 'thin' }
                    };
    
                    // Check for colspan attribute
                    if (cell.hasAttribute('colspan')) {
                        let colspan = parseInt(cell.getAttribute('colspan'));
                        for (let i = 1; i < colspan; i++) {
                            excelRow.getCell(cellIndex + 1 + i).value = ''; // Clear value for spanned cells
                        }
                    }
                });
            });
    
            var sheetName = document.getElementById('project_id').value;
            worksheet.name = sheetName;
            workbook.xlsx.writeBuffer().then(function(buffer) {
                var excelFileName = sheetName + ".xlsx";
                saveAs(new Blob([buffer]), excelFileName);
            });
        }
    </script>
    
    @endpush
</x-nform-layout>
