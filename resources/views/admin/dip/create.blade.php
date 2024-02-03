<x-nform-layout>
    @push('stylesheets')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    @endpush

    @section('title', 'Add DIP')

    <style>
            .flatpickr-monthSelect-month {
            
            width: 25% !important; /* Adjusted width for 4 columns */
            }
        </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class=" separator separator-dotted separator-content border-dark my-15"><span class="h5">Project Info</span></div>
                    <div class="col-md-6">
                        <table class="table table-striped m-4">
                            <tr>
                                <td><strong>Project</strong></td>
                                <td>{{$project->name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>House Hold Target </strong></td>
                                <td>{{$project->detail?->hh_targets ?? ''}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped m-4">
                            <tr>
                                <td><strong>Individual Target</strong></td>
                                <td>{{$project->detail?->individual_targets ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>Project Tenure</strong></td>
                                <td>
                                {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        
       
            <form action="{{route('activity_dips.store')}}" method="post" id="create_dip_activity">
                @csrf
                <input name="project_id" value="{{$project->id}}" type="hidden">
                <div class="card-body">
                        <div class="row">
                            <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5"> Activity</span></div>
                            
                            <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5"> Activity Target</span></div>
                                @php
                                    $startDate = \Carbon\Carbon::parse($project->start_date);
                                    $endDate = \Carbon\Carbon::parse($project->end_date);
                                @endphp                           
                                <div class="fv-row col-md-12">
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                         
                                            <input type="text" name="start_month[]"  id="start_month" placeholder="Select Month"  class="start_month form-control m-input mx-2" onkeydown="event.preventDefault()" data-provide="datepicker" value=""  autocomplete="off">
                                            <input type="text" name="end_month[]"  id="end_month" placeholder="Select Month"  class="end_month form-control m-input mx-2" onkeydown="event.preventDefault()" data-provide="datepicker" value=""  autocomplete="off">
                                            <div id="monthError" class="error-message "></div>
                                            <input type="text" name="target_month[]" id="target_month" placeholder="Enter Target"  class="mx-2  form-control m-input value=""  autocomplete="off" required>
                                            <div id="target_monthError" class="error-message "></div>
                                            <div class="input-group-append">
                                                {{-- <button id="removeRow" type="button" class="btn btn-danger btn-sm">Remove</button> --}}
                                                <button id="addRow" type="button" class="btn btn-info btn-sm">
                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Navigation/Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>
                                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1"/>
                                                        </g>
                                                        </svg><!--end::Svg Icon-->
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div id="newRow"></div>
                                  
                                
                                </div>
                            </div>
                          
                           
                </div>
                <div class="card-footer justify-content-end">
                    <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm 5">        
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>
   
    @push("scripts")
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
        <script type="text/javascript">
            flatpickr(".start_month", {
                dateFormat: "M-Y",
                minDate: "{{ $startDate->format('M-Y') }}",
                maxDate: "{{ $endDate->format('M-Y') }}",
                monthSelectorType: "static",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true,
                        dateFormat: "M-Y",
                        altFormat: "F Y",
                        theme: "light"
                    })
                ]
            });
            flatpickr(".end_month", {
                dateFormat: "M-Y",
                minDate: "{{ $startDate->format('M-Y') }}",
                maxDate: "{{ $endDate->format('M-Y') }}",
                monthSelectorType: "static",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true,
                        dateFormat: "M-Y",
                        altFormat: "F Y",
                        theme: "light"
                    })
                ]
            });

            $("#addRow").click(function () { 
                var html = '';
                html += '<div id="inputFormRow">';
                html += '<div class="input-group mb-3">';
                html += '<input type="text" name="start_month[]" placeholder="Select Target start Month" class="month form-control m-input mx-2" onkeydown="event.preventDefault()" data-provide="datepicker" value="" autocomplete="off">';
                html += '<input type="text" name="end_month[]" placeholder="Select Target end Month" class="month form-control m-input mx-2" onkeydown="event.preventDefault()" data-provide="datepicker" value="" autocomplete="off">';
                html += '  <input type="text" name="target_month[]" id="target_month" placeholder="Enter Target" class="mx-2 form-control m-input value="" autocomplete="off" required>'
                html += '<div class="input-group-append">';
                html += '<button id="removeRow" type="button" class="btn btn-danger btn-sm">Remove</button>';
                html += '</div>';
                html += '</div>';
                html += '</div>';

                $('#newRow').append(html);

                // Call flatpickr for the new datepicker element
                flatpickr(".start_month", {
                    dateFormat: "M-Y",
                    minDate: "{{ $startDate->format('M-Y') }}",
                    maxDate: "{{ $endDate->format('M-Y') }}",
                    monthSelectorType: "static",
                    plugins: [
                        new monthSelectPlugin({
                            shorthand: true,
                            dateFormat: "M-Y",
                            altFormat: "F Y",
                            theme: "light"
                        })
                    ]
                });
                flatpickr(".end_month", {
                    dateFormat: "M-Y",
                    minDate: "{{ $startDate->format('M-Y') }}",
                    maxDate: "{{ $endDate->format('M-Y') }}",
                    monthSelectorType: "static",
                    plugins: [
                        new monthSelectPlugin({
                            shorthand: true,
                            dateFormat: "M-Y",
                            altFormat: "F Y",
                            theme: "light"
                        })
                    ]
                });
            });

            // remove row
            $(document).on('click', '#removeRow', function () {
                $(this).closest('#inputFormRow').remove();
            });
        </script>

    @endpush
</x-nform-layout>
