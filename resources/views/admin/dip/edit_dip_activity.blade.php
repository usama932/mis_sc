@push('stylesheets')


<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css" rel="stylesheet" type="text/css"/>

@endpush
<x-nform-layout>
    @section('title', 'Edit Activity')
    <style>
        .highlight-field {
            border-color: red;
            /* You can add more styles as needed */
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('activity_dips.update',$dip->id) }}" method="post" id="create_dip_activity">
                    @csrf
                    @method('put')
                    <input type="hidden" name="project_id" id="project_id" value="{{$dip->project_id}}">
                    <input type="hidden" name="activity_id" id="activity_id" value="{{ $dip->id }}">
                    
                    <div class="row">
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="">Thematic Area:</span>
                            </label>
                            <br>
                            <label class="fs-6 fw-semibold form-label">
                                <span class="">{{$dip->scisubtheme_name?->maintheme?->name}}</span>
                            </label>
                            <div id="themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Sub-Thematic Area</span> 
                            </label>
                            <br>
                            <label class="fs-6 fw-semibold form-label">
                                <span class="">{{$dip->scisubtheme_name?->name}}</span>
                            </label>
                            <div id="sub_themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-2 col-lg-2 col-sm-12">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity Number</span>
                            </label>
                            <input class="form-control" id="activity_number" name="activity_number" id="activity_number" value="{{$dip->activity_number}}">
                            <div id="activity_numberError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-8 col-lg-8 col-sm-12">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity Title</span>
                            </label>
                            <textarea name="activity" id="activity" rows="1" class="form-control">{{$dip->activity_title ?? ''}}</textarea>
                            <div id="activityError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-2 col-lg-2 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">LOP Target</span>
                            </label>
                            <input name="lop_target" class="form-control" id="lop_target" value="{{$dip->lop_target ?? ''}}">
                            <div id="lop_targetError" class="error-message"></div>
                        </div>
                    </div>
                    <div class="separator my-3"></div>
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-info btn-sm mt-4" onclick="addTargetRow()" id="add_quarter_target">Add New Monthly Target</button>
                        </div>
                    </div>
                    <div id="targetRows">
                        @foreach($dip->months as $month)
                        <div class="row mb-3">
                            <input type="hidden" name="activities[{{$loop->iteration -1}}][id]" placeholder="Enter Activity Target"
                            class="form-control" autocomplete="off" value="{{$month->id}}">
                            <div class="col-md-2">
                                <label class="fs-7 fw-semibold form-label mb-2">
                                    <span class="required">Monthly Target</span>
                                </label>
                                <br>
                                <input type="hidden"  name="activities[{{$loop->iteration -1}}][quarter]" value="{{$month->quarter}}-{{$month->year}}" >                         
                               <span class="mt-4"> <strong class="mt-4">{{$month->quarter}}-{{$month->year}}</strong></span>
                            </div>
                            <div class="col-md-2">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Activity LOP Target</span>
                                </label>
                                <input type="text" name="activities[{{$loop->iteration -1}}][target_quarter]" placeholder="Enter Activity Target"
                                    class="form-control numeric-input" autocomplete="off" value="{{$month->target}}">
                            </div>
                            <div class="col-md-2">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="">Beneficiaries Target</span>
                                </label>
                                <input type="text" name="activities[{{$loop->iteration -1}}][target_benefit]" placeholder="Enter Beneficiary Target"
                                    class="form-control numeric-input" autocomplete="off"  value="{{$month->beneficiary_target}}">
                            </div>
                            <div class="col-md-4">
                                <label class="fs-7 fw-semibold form-label mb-2">
                                    <span class="">Expected Completion Date</span>
                                </label>
                                <br>
                                <strong class="mt-4">{{date('M d,Y', strtotime($month->completion_date))}}</strong>
                                <input type="hidden" name="activities[{{$loop->iteration -1}}][complete_date]" id="start_date" placeholder="Select date"  class="form-control required start_date" onkeydown="event.preventDefault()" data-provide="datepicker"  value="{{$month->completion_date}}">
                            </div>
                            <div class="col-md-2 mt-4">  
                                <a class="btn btn-sm btn-danger mt-5" title="Delete " onclick="event.preventDefault();del({{$month->id}});" title="Delete Monitor Visit" href="javascript:void(0)">
                                    Delete
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Add New Quarter button -->
                 
                    <div class="card-footer justify-content-end d-flex">
                        @if(!empty($project->id))
                        <a href="{{ route('dips.edit',$project->id) }}" class="btn btn-primary btn-sm mx-3">Cancel</a>
                        @endif
                        <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm">
                            @include('partials/general/_button-indicator', ['label' => 'Update Activity'])
                        </button>
                    </div>
                </form>
                <div class="separator my-3"></div>
            </div>  
        </div>
    </div>
    @php
        // Construct quarters array
        $qs = [];
        $projectquarters = []; // Remove unnecessary initialization
        foreach ($dip->months as $month) {
            $qs[] = $month->quarter;
        }
        foreach ($quarters as $key =>  $quarter) {
            $projectquarters[] = $quarter;
        }
        $complementQuarters = array_diff( $projectquarters,$qs);
    @endphp
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    <script src="https://flatpickr.js.org/themer.js"></script>

    //Add Target Row
    <script>
        var minDate = "{{ date('Y-m', strtotime($project->start_date)) }}";
        var maxDate = "{{ date('Y-m', strtotime($project->end_date)) }}";
        var selectedMonths = [];
        function initFlatpickr() {
                $(".monthpick").flatpickr({
                    plugins: [
                        new monthSelectPlugin({
                            dateFormat: "M-Y",
                            altFormat: "M-Y"
                        })
                    ],
                    defaultDate: minDate,
                    minDate: minDate,
                    maxDate: maxDate,
                });
            }

        initFlatpickr();

        var i = {{ $dip->months->count() }};

        function addTargetRow() {
            var isValid = true;
            $('#targetRows .row').each(function () {
                $(this).find('input, select').each(function () {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        $(this).addClass('highlight-field');
                        toastr.error('Please address the highlighted Errors.', 'Error');
                        return false; // Exit the loop early
                    } else {
                        $(this).removeClass('highlight-field');
                    }
                });
                if (!isValid) {
                    return false; // Exit the loop early
                }
            });

            if (!isValid) {
                return;
            }
            ++i;
            var quarters = {!! json_encode(array_values($complementQuarters)) !!};
            var selectedQuarters = $('select[name^="activities["]').map(function () {
                return $(this).val();
            }).get();
            var quarterCount = $('select[name^="activities["]').length;

            var selectedQuarters = $('select[name^="activities["]').map(function () {
                return $(this).val();
            }).get();

            var availableQuarters = quarters.filter(function(quarter) {
                return !selectedQuarters.includes(quarter);
            });

            if ( quarters.length > quarterCount) {
                var html = `
                    <div class="row mt-3" style="display:none;">
                        <div class="col-md-2">
                            <input type="text" name="activities[${i}][quarter]" placeholder="Select Month" class="form-control monthpick" id="monthpick${i}">
                        </div> 
                        <div class="col-md-2">
                            <input type="text" name="activities[${i}][target_quarter]" placeholder="Enter Activity Target"
                                class="form-control numeric-input" autocomplete="off" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="activities[${i}][target_benefit]" placeholder="Enter Beneficiary Target"
                                class="form-control numeric-input" autocomplete="off" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="activities[${i}][complete_date]" id="start_date${i}" placeholder="Select date" class="form-control required" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>`;
                $('#targetRows').append(html);
                $('#targetRows .row').last().slideDown(); // Show the new row with animation
                initFlatpickr();
                if ($('#targetRows .row').length === 1) {
                    $('#add_quarter_target').hide();
                }
            } else {
                toastr.error("All Month are already shown.", "Error");
            }

            // Update inputElement assignment here after new elements are added to the DOM
            var inputElement = document.getElementById(`monthpick${i}`);

            if (inputElement) {
                inputElement.addEventListener("change", function() {
                    var inputValue = inputElement.value;
                
                    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

                    var selectedMonthYear = inputValue.split("-");
                    var selectedMonth = selectedMonthYear[0];
                    var selectedYear = parseInt(selectedMonthYear[1]);

                    var startDate = new Date(selectedYear, monthNames.indexOf(selectedMonth), 1);
                    var endDate = new Date(selectedYear, monthNames.indexOf(selectedMonth) + 1, 0);

                    var flatpickrInstance = flatpickr("#start_date" + i,{
                        disable: [
                            function(date) {
                                // Disable Saturdays and Sundays
                                return (date.getDay() === 6 || date.getDay() === 0); // 6 is Saturday, 0 is Sunday
                            }
                        ]
                    });

                    flatpickrInstance.setDate(startDate);
                    flatpickrInstance.set("minDate", startDate);
                    flatpickrInstance.set("maxDate", endDate);
                });
            }
        }
        function removeTargetRow(button) {
            $(button).closest('.row').remove();
            $('#add_quarter_target').show();
        }
        
    </script>

    // add numerice input
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var numericInputs = document.querySelectorAll('.numeric-input');

            numericInputs.forEach(function(input) {
                input.addEventListener('input', function(event) {
                    // Remove non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Delegate event handling to the parent element
            document.getElementById('targetRows').addEventListener('input', function(event) {
                var target = event.target;
                // Check if the input belongs to the numeric-input class
                if (target.classList.contains('numeric-input')) {
                    // Remove non-numeric characters
                    target.value = target.value.replace(/[^0-9]/g, '');
                }
            });
        });
    </script>

    //del target
    <script>
        function del(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Deleted!",
                        "Your Activity Quarter has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/delete_month/delete/" + id;
                }
            });
        }
    </script>
    @endpush
</x-nform-layout>
