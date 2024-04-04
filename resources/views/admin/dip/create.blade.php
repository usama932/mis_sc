@push('stylesheets')


<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css" rel="stylesheet" type="text/css"/>

@endpush
<x-nform-layout>
    @section('title', 'Add New Activity')
    <style>
        .highlight-field {
            border-color: red;
            /* You can add more styles as needed */
        }
        .selected-month {
        background-color: #f0f0f0; /* Grey color */
        color: #333; /* Dark text color for better contrast */
    }
    </style>
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{ route('activity_dips.store') }}" class="create_dip_activity" method="post" id="create_dip_activity">
                @csrf
                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Thematic Area</span>
                            </label>
                            <select name="theme" id="theme_id" aria-label="Select a Theme" data-control="select2"
                                    data-placeholder="Select a Theme" class="form-select" data-allow-clear="true">
                                <option value=''>Select Thematic Area</option>
                                @foreach($themes as $theme)
                                    <option value='{{ $theme->theme_id}}'>{{ $theme->scitheme_name->name }}</option>
                                @endforeach
                            </select>
                            <div id="themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label d-flex">
                                <span class="required">Sub-Thematic Area</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="themeloader"
                                    style="display: none !important;"></span>
                            </label>
                            <select name="sub_theme" id="sub_theme_id" aria-label="Select a Theme"
                                data-control="select2" data-placeholder="Select a Theme" class="form-select"
                                data-allow-clear="true">
                            </select>
                            <div id="sub_themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-2 col-lg-2 col-sm-12">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity Number</span>
                            </label>
                            <input class="form-control" id="activity_number" name="activity_number" id="activity_number" >
                            <div id="activity_numberError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-8 col-lg-8 col-sm-12">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity Title</span>
                            </label>
                            <textarea name="activity" id="activity" rows="1" class="form-control"></textarea>
                            <div id="activityError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-2 col-lg-2 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">LOP Target</span>
                            </label>
                            <input name="lop_target" class="form-control" id="lop_target">
                            <div id="lop_targetError" class="error-message"></div>
                        </div>
                    </div>
                    <div class="separator my-3"></div>
                    <div id="targetRows">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="fs-7 fw-semibold form-label mb-2">
                                    <span class="required">Month</span>
                                </label>
                                <input type="text"  name="activities[0][quarter]" placeholder="Select Month"  class="form-control monthpick" >

                                {{-- <select name="activities[0][quarter]" aria-label="Select a Month Target"
                                    data-placeholder="Select a Month Target" class="form-select"
                                    data-allow-clear="true">
                                    <option value=" ">Select Quarter Target</option>
                                    @foreach($quarters as $key => $quarter)
                                        <option value='{{ $quarter }}'>{{ $quarter }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="col-md-2">
                                <label class="fs-8 fw-semibold form-label mb-2">
                                    <span class="required">Activity LOP Target</span>
                                </label>
                                <input type="text"  name="activities[0][target_quarter]" 
                                pattern="[0-9]*" 
                                placeholder="Activity Target (only numbers)" 
                                class="form-control numeric-input" 
                                autocomplete="off"  required>
                            </div>
                            <div class="col-md-2">
                                <label class="fs-8 fw-semibold form-label mb-2">
                                    <span class="">Beneficiaries Target</span>
                                </label>
                                <input type="text" pattern="[0-9]*"  name="activities[0][target_benefit]" placeholder="Beneficiary Target (only numbers)"
                                class="form-control numeric-input" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Expected Completion Date</span>
                                </label>
                                <input type="text" name="activities[0][complete_date]" id="start_date" placeholder="Select date"  class="form-control start_date" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                            
                            </div>
                            <div class="col-md-2 mt-5 text-end fs-9">
                                <button type="button" class="btn btn-info btn-sm mx-2 fs-9" onclick="addTargetRow()"
                                    id="add_quarter_target">Add Month Target</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer justify-content-end d-flex">
                    <a href="{{ route('dips.edit',$project->id) }}" class="btn btn-primary btn-sm mx-3">Cancel</a>
                    <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>
  
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    <script src="https://flatpickr.js.org/themer.js"></script>
  
    
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
        
       
        flatpickr(".start_date", {
            dateFormat: "Y-m-d",
        });
        initFlatpickr(); // Initialize Flatpickr for existing monthpick inputs
    
        // Add new row function
        function addTargetRow() {
            var isValid = true;
            $('#targetRows .row').each(function() {
                $(this).find('input, select').each(function() {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        $(this).addClass('highlight-field');
                        toastr.error('Please address the highlighted Errors.', 'Error');
                        event.preventDefault(); // Prevent form submission
                        return false; // Exit the loop early
                    } else {
                        $(this).removeClass('highlight-field');
                    }
                });
            });

            if (!isValid) {
                return;
            }
            var i = $('#targetRows .row').length;
            var quarters = @json($quarters);
            var selectedQuarters = $('input[name^="activities["][name$="[quarter]"]').map(function() {
                return $(this).val();
            }).get(); // Get all selected quarters

            var availableQuarters = quarters.filter(function(quarter) {
                return !selectedQuarters.includes(quarter);
            });

            if (availableQuarters.length > 0) {
                var html = `
                    <div class="row mt-3" style="display:none;">
                        <div class="col-md-3">
                            <input type="text" name="activities[${i}][quarter]" placeholder="Select Month" class="form-control monthpick">
                        </div>
                        <div class="col-md-2">
                            <input type="text" pattern="[0-9]*" name="activities[${i}][target_quarter]" placeholder="Enter Activity Target" class="form-control numeric-input" autocomplete="off" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" pattern="[0-9]*" name="activities[${i}][target_benefit]" placeholder="Enter Beneficiary Target" class="form-control numeric-input" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="activities[${i}][complete_date]" id="start_date" placeholder="Select date" class="form-control start_date${i} required" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>`;
                $('#targetRows').append(html);
                $('#targetRows .row').last().slideDown(); // Show the new row with animation
                flatpickr(".start_date" + i, {
                    dateFormat: "Y-m-d",
                });
                if ($('#targetRows .row').length === 1) {
                    $('#add_quarter_target').hide();
                }
                initFlatpickr(); // Re-initialize Flatpickr for new monthpick input
            } else {
                toastr.error("All Month are already shown.", "Error");
            }
        }
    
        // Remove row function
        function removeTargetRow(button) {
            $(button).closest('.row').remove();
            $('#add_quarter_target').show();
        }
    
        // Delegate event handling to the parent element to remove non-numeric characters
        document.getElementById('targetRows').addEventListener('input', function(event) {
            var target = event.target;
            if (target.classList.contains('numeric-input')) {
                target.value = target.value.replace(/[^0-9]/g, '');
            }
        });
    
        // AJAX call on theme change
        document.getElementById('themeloader').style.display = 'none';
        $("#theme_id").change(function() {
            document.getElementById('themeloader').style.display = 'block';
            var value = $(this).val();
            csrf_token = $('[name="_token"]').val();
            project_id = $('#project_id').val();
            $.ajax({
                type: 'POST',
                url: '/getactivitySubTheme',
                data: {
                    'theme_id': value,
                    _token: csrf_token,
                    'project_id': project_id
                },
                dataType: 'json',
                success: function(data) {
                    document.getElementById('themeloader').style.display = 'none';
                    $("#sub_theme_id").find('option').remove();
                    $("#sub_theme_id").prepend("<option value=''>Select Sub-Theme</option>");
                    var selected = '';
                    $.each(data, function(i, item) {
    
                        $("#sub_theme_id").append("<option value='" + item.id + "' " + selected + " >" +
                            item.name.replace(/_/g, ' ') + "</option>");
                    });
                }
            });
        });
    </script>
    
    @endpush
</x-nform-layout>
