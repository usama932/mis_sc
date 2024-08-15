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

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h3 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="d-flex align-items-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-success">
                                <i class="ki-duotone ki-filter-search fs-2x text-danger">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column">
                            <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">{{ $project->name ?? '' }} Info</a>
                        </div>
                        <!--end::Text-->
                    </div>
                </button>
            </h3>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="card-header border-0">
                        @include('admin.projects.partials.project_basic_info')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-3">
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
                        <thead class="bg-success">
                            <tr>
                                <th class="fs-9 col-1">Activity .#</th>
                                <th class="fs-7 col-4" style="min-width: 300px;">Activity Title</th>
                                <th class="fs-9" style="width:60px;">LOP Target</th>
                                @foreach($months as $month)
                                    <th colspan="2" class="fs-7 text-center col-2">{{ $month }}</th>
                                @endforeach
                                <th class="fs-7" style="width:60px;">Cumulative LOP %</th>
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
                                <th class="fs-7" style="width:60px;"></th>
                                <th class="fs-9" style="min-width: 300px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($project->activities->groupBy('scisubtheme_name.id') as $theme => $activities)
                                @php
                                    $subtheme = \App\Models\SciSubTheme::with('maintheme')->find($theme);
                                @endphp 
                                <tr>
                                    <th colspan="{{count($months) }}" class="fs-6 bg-primary">{{ $subtheme->maintheme?->name }} ({{ $subtheme->name }})</th>
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
                                    @php
                                        // Calculate the cumulative percentage
                                        $totalAchieved = $item->months->sum('progress.activity_target') ?? 1;
                                        $lopTarget = $item->lop_target ?? 1; // Avoid division by zero
                                        $cumulativePercentage = 0;
                                        if($lopTarget > 0 ){
                                            $cumulativePercentage =round(($totalAchieved / $lopTarget) * 100);
                                        }
                                    @endphp

                                    <tr>
                                        <td class="fs-8">{{ $item->activity_number ?? '' }}</td>
                                        <td class="fs-8">{{ $item->activity_title ?? '' }}
                                            @if($item->activity_type)
                                                ({{ $item->activity_type?->activity_type?->name }} - {{ $item->activity_type?->name }})
                                            @endif
                                        </td>
                                        <td class="fs-8 bg-success">{{ $item->lop_target ?? '' }}</td>
                                        
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
                                        <td class="fs-9">
                                            {{ number_format($cumulativePercentage) }}%
                                        </td>
                                        <td class="fs-9" style="min-width: 300px;"></td>
                                    </tr>
                                @endforeach
                            @empty
                            <tr>
                                <th colspan="20" class="text-center">No Records</th>
                            </tr>
                            @endforelse
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

            // Set the page orientation to portrait
            worksheet.pageSetup.orientation = 'portrait';

            var table = document.querySelector("#activityTable");
            var rows = table.querySelectorAll("tr");
            var headerRowCount = 2; // Adjust this if you have more header rows

            rows.forEach((row, rowIndex) => {
                let excelRow = worksheet.getRow(rowIndex + 1);
                let cells = row.querySelectorAll("th, td");
                let cellIndexOffset = 0;

                cells.forEach((cell, cellIndex) => {
                    let excelCell = excelRow.getCell(cellIndex + 1 + cellIndexOffset);
                    excelCell.value = cell.innerText;

                    if (rowIndex < headerRowCount) { // Apply bold formatting and color to header rows
                        excelCell.font = { bold: true };
                        excelCell.fill = {
                            type: 'pattern',
                            pattern: 'solid',
                            fgColor: { argb: 'FFB0E57C' } // Light green background
                        };
                        excelCell.border = {
                            top: { style: 'thin', color: { argb: 'FF000000' } }, // Black borders
                            left: { style: 'thin', color: { argb: 'FF000000' } },
                            bottom: { style: 'thin', color: { argb: 'FF000000' } },
                            right: { style: 'thin', color: { argb: 'FF000000' } }
                        };
                    } else { // Apply different formatting and color to data rows
                        excelCell.fill = {
                            type: 'pattern',
                            pattern: 'solid',
                            fgColor: { argb: 'FFCCE5FF' } // Light blue background for data rows
                        };
                        excelCell.border = {
                            top: { style: 'thin', color: { argb: 'FF000000' } },
                            left: { style: 'thin', color: { argb: 'FF000000' } },
                            bottom: { style: 'thin', color: { argb: 'FF000000' } },
                            right: { style: 'thin', color: { argb: 'FF000000' } }
                        };
                    }

                    // Check for colspan attribute
                    if (cell.hasAttribute('colspan')) {
                        let colspan = parseInt(cell.getAttribute('colspan'));
                        if (colspan > 1) {
                            worksheet.mergeCells(rowIndex + 1, cellIndex + 1 + cellIndexOffset, rowIndex + 1, cellIndex + colspan + cellIndexOffset);
                            cellIndexOffset += colspan - 1;
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

        function printPage() {
            window.print();
        }
    </script>
    @endpush

</x-nform-layout>
