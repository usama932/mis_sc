<x-nform-layout>
    @section('title')
       Add DIP
    @endsection
   
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
                            <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5">Add Activity</span></div>
                            <div class="fv-row col-md-12">
                                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                    <span class="required">Activity Detail</span>
                                </label>
                                <textarea name="activity" id="activity" rows="1" class="form-control"></textarea>
                                <div id="detailError" class="error-message "></div>
                            </div>  
                            @php
                                $startDate = \Carbon\Carbon::parse($project->start_date);
                                $endDate = \Carbon\Carbon::parse($project->end_date);
                            @endphp                           
                            <div class="fv-row col-md-12">
                                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                    <span class="required">Targets</span>
                                </label>
                                {{-- <select multiple name="months_target[]" id="months_target" aria-label="Select Multiple Partner" data-control="select2" data-placeholder="Select Multiple Partner" class="form-select" data-allow-clear="true">
                                    @while ($startDate <= $endDate)    
                                        <option value="{{ $startDate->format('F Y') }}">{{ $startDate->format('F Y') }}</option>
                                        @php
                                            $startDate->addMonth();
                                        @endphp
                                    @endwhile
                                </select> --}}
                                <input type="text" name="months_target" id="months_target" placeholder="Select date" class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                                <div id="partnerError" class="error-message "></div>
                            </div>
                            <div id="monthstargetFields" class="row"></div>
                            
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
        <script>
              flatpickr("#months_target", {
                mode: "multiple",
                dateFormat: "F Y",
                monthSelectorType: "dropdown",
                disable: [
                    function(date) {
                        // Disable all dates that are not in the specific months you want
                        return !["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"].includes(date.toLocaleString('en-us', { month: 'long' }));
                    }
                ],        
            });
            $(document).ready(function() {
                // Initialize Select2
            
                // Handle partner selection change
                $('#months_target').on('change', function() {
                    var selectedMonths = $('#months_target').val();
                    alert(selectedMonths);
                    var numberOfSelectedMonths = selectedMonths ? selectedMonths.length : 0;
        
                    // Remove existing partner email input fields
                    $('#monthstargetFields').empty();
        
                    // Create input fields for partner emails
                    for (var i = 0; i < numberOfSelectedMonths; i++) {
                        var monthName = $('#months_target option[value="' + selectedMonths[i] + '"]').text();
                        var monthstargetField = '<div class="fv-row col-md-2">' +
                                                    '<label class="fs-6 fw-semibold form-label mb-2">' +
                                                        '<span class="required">' + monthName + '</span>' +
                                                    '</label>' +
                                                    '<input type="text" name="monthName[' + selectedMonths[i] + ']" class="form-control" placeholder="Enter Target for ' + monthName + ' required">' +
                                                '</div>';
        
                        $('#monthstargetFields').append(monthstargetField);
                    }
                });
            });
        </script>
    @endpush
</x-nform-layout>
