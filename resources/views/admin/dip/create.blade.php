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
                        <div class="fv-row col-md-3 col-lg-3 col-sm-12">
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
                        <div class="fv-row col-md-3 col-lg-3 col-sm-12">
                            <label class="fs-6 fw-semibold form-label d-flex">
                                <span class="required">Sub-Thematic Area</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="themeloader"
                                    style="display: none !important;"></span>
                            </label>
                            <select name="sub_theme" id="sub_theme_id" aria-label="Select a Sub-Theme"
                                data-control="select2" data-placeholder="Select a Sub-Theme" class="form-select"
                                data-allow-clear="true">
                            </select>
                            <div id="sub_themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-3 col-lg-3 col-sm-12">
                            <label class="fs-6 fw-semibold form-label d-flex">
                                <span class="required">Project Activity Type</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="avtivityloader"
                                    style="display: none !important;"></span>
                            </label>
                            <select name="activity_type" id="activity_type_id" aria-label="Select a Activity Type"
                                data-control="select2" data-placeholder="Select a Activity Type" class="form-select"
                                data-allow-clear="true">    
                                <option value="">Select Activity Type </option>
                                @foreach ($ProjectActivityType as $projectactivity)
                                    <option value="{{ $projectactivity->id }}">{{ $projectactivity->name }}</option>
                                @endforeach
                            </select>
                            <div id="activity_typeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-3 col-lg-3 col-sm-12">
                            <label class="fs-6 fw-semibold form-label d-flex">
                                <span class="required">Project Activity Type</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="avtivityloader"
                                    style="display: none !important;"></span>
                            </label>
                            <select name="activity_category" id="activity_category_id" aria-label="Select a Activity Category"
                                data-control="select2" data-placeholder="Select a Activity Category" class="form-select"
                                data-allow-clear="true">
                                
                            </select>
                            <div id="activity_categorysError" class="error-message"></div>
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
                                <input type="text"  name="activities[0][quarter]" placeholder="Select Month"  class="form-control monthpick" id="monthpick{{0}}">                          
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
                                <input type="text" name="activities[0][complete_date]" id="start_date0" placeholder="Select date"  class="form-control start_date" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                            
                            </div>
                            <div class="col-md-2 mt-7 text-end fs-9">
                                <h1> <button class="btn btn-info btn-sm fs-9" onclick="addTargetRow()" id="add_quarter_target">
                               <i class="fa fa-plus  aria-hidden="true"></i>Add Another Month Target</button></h1>
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
        
        var inputElement = document.getElementById("monthpick0");
        inputElement.addEventListener("change", function() {
            var inputValue = inputElement.value;
         
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            var selectedMonthYear = inputValue.split("-");
            var selectedMonth = selectedMonthYear[0];
            var selectedYear = parseInt(selectedMonthYear[1]);

            var startDate = new Date(selectedYear, monthNames.indexOf(selectedMonth), 1);
            var endDate = new Date(selectedYear, monthNames.indexOf(selectedMonth) + 1, 0);

            var flatpickrInstance = flatpickr("#start_date0",{
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
     
        initFlatpickr();
    
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
                            <input type="text" name="activities[${i}][quarter]" placeholder="Select Month" class="form-control monthpick" id="monthpick${i}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" pattern="[0-9]*" name="activities[${i}][target_quarter]" placeholder="Enter Activity Target" class="form-control numeric-input" autocomplete="off" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" pattern="[0-9]*" name="activities[${i}][target_benefit]" placeholder="Enter Beneficiary Target" class="form-control numeric-input" autocomplete="off">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="activities[${i}][complete_date]" id="start_date${i}" placeholder="Select date" class="form-control required" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                        </div>
                        <div class="col-md-1">
                            <span type="button" id="bitton" class="badge badge-danger text-white mx-2" onclick="removeTargetRow(this)"><i class="fa fa-trash"></i>Remove</button>
                        </div>
                    </div>`;
                $('#targetRows').append(html);
                $('#targetRows .row').last().slideDown(); // Show the new row with animation
             
                if ($('#targetRows .row').length === 1) {
                    $('#add_quarter_target').hide();
                }
                initFlatpickr();
               
            } else {
                toastr.error("All Month are already shown.", "Error");
            }
            var inputElement = document.querySelectorAll(".monthpick")[i];
                
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


        // activity type 
        document.getElementById('avtivityloader').style.display = 'none';
        $("#activity_type_id").change(function() {
            document.getElementById('avtivityloader').style.display = 'block';
            var value = $(this).val();
            csrf_token = $('[name="_token"]').val();
            
            $.ajax({
                type: 'POST',
                url: '/getactivity_categories',
                data: {
                    'activity_type_id': value,
                    _token: csrf_token,
                    
                },
                dataType: 'json',
                success: function(data) {
                    document.getElementById('avtivityloader').style.display = 'none';
                    $("#activity_category_id").find('option').remove();
                    $("#activity_category_id").prepend("<option value=''>Select Activity Category</option>");
                    var selected = '';
                    $.each(data, function(i, item) {
    
                        $("#activity_category_id").append("<option value='" + item.id + "' " + selected + " >" +
                            item.name.replace(/_/g, ' ') + "</option>");
                    });
                }
            });
        });
        
    </script>
    
    @endpush
</x-nform-layout>
