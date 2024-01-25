<x-nform-layout>
    @section('title')
       Update Project Details
    @endsection
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('project.update')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            
                            <input type="text"  readonly value="{{$project->name}}" class="form-control">
                            <input type="hidden"  name="project" id="project"  value="{{$project->id}}" class="form-control">
                            <div id="projectError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">SOF</span>
                            </label>
                            
                            <input type="text"  readonly value="{{$project->sof ?? ''}}" class="form-control">
                            <div id="projectError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Province</span>
                            </label>
                            <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Multiple Province..." class="form-select "  data-allow-clear="true" >
                                    @foreach($provinces as $province)
                                        <option value="{{$province->province_id}}">{{$province->province_name}}</option>
                                    @endforeach
                            </select>
                            <div id="provinceError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">District</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                            </label>
                            <select id="kt_select2_district" multiple name="district[]" aria-label="Select Multiple District" data-control="select2" data-placeholder="Select Multiple District" class="form-select">
                            </select>
                            <span id="districtError" class="error-message "></span>
                        </div>  
                        <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5">Targets</span></div>
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Households (HH) Target</span>
                            </label>
                            <input type="text" name="hh_targets" id="hh_targets"  placeholder="Enter House Hold Targets" class="form-control">
                            <div id="hh_targetsError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Individuals Beneficiaries Target</span>
                            </label>
                            <input type="text" name="individual_targets" id="individual_targets"  placeholder="Enter House Individual Targets" class="form-control">
                            <div id="individual_targetsError" class="error-message "></div>
                        </div>
                        
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Female Target</span>
                            </label>
                            <input type="text" name="female_targets" id="female_targets"  placeholder="Enter Male Targets" class="form-control">
                            <div id="female_targetsError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Male Target</span>
                            </label>
                            <input type="text" name="male_targets" id="male_targets"  placeholder="Enter Male Targets" class="form-control">
                            <div id="male_targetsError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Girls Target</span>
                            </label>
                            <input type="text" name="girls_targets" id="girls_targets"  placeholder="Enter Girls Targets" class="form-control">
                            <div id="girls_targetsError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Boys Target</span>
                            </label>
                            <input type="text" name="boys_targets" id="boys_targets"  placeholder="Enter Boys Targets" class="form-control">
                            <div id="boys_targetsError" class="error-message "></div>
                        </div>
                        <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5">Theme</span></div>
                        <div class="fv-row col-md-12">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Theme</span>
                            </label>
                            <select   name="theme[]" multiple id="theme" aria-label="Select Multiple Theme" data-control="select2" data-placeholder="Select Multiple Theme" class="form-select"  data-allow-clear="true" >
                                <option value=""></option>
                                @foreach($themes as $theme)
                                    <option value="{{$theme->id}}">{{$theme->name}}</option>
                                @endforeach
                            </select>
                            <div id="projectError" class="error-message "></div>
                        </div>
                        <div id="themeTargetFields" class="row"></div>
                        <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5">Implementing Partner</span></div>
                        <div class="fv-row col-md-12">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Partner</span>
                            </label>
                            <select   multiple name="partner[]" id="partner" aria-label="Select Multiple Partner" data-control="select2" data-placeholder="Select Multiple Partner" class="form-select"  data-allow-clear="true" >
                                @foreach($partners as $partner)
                                    <option value="{{$partner->id}}">{{$partner->slug}}</option>
                                @endforeach
                            </select>
                            <div id="partnerError" class="error-message "></div>
                        </div>
                        <div id="partnerEmailFields" class="row"></div>
                       
                        
                        <div class="fv-row col-md-12 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Project Description</span>
                            </label>
                            <textarea class="form-control" rows="1" name="project_description" id="project_description"></textarea>
                            <div id="project_descriptionError" class="error-message "></div>
                        </div>
                    </div>
                
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="kt_create_dip" class="btn btn-success btn-sm  m-5">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>      
            </form>

        </div>
    </div>
   
    @push("scripts")
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#partner').select2();
    
            // Handle partner selection change
            $('#partner').on('change', function() {
                var selectedPartners = $(this).val();
                var numberOfSelectedPartners = selectedPartners ? selectedPartners.length : 0;
    
                // Remove existing partner email input fields
                $('#partnerEmailFields').empty();
    
                // Create input fields for partner emails
                for (var i = 0; i < numberOfSelectedPartners; i++) {
                    var partnerName = $('#partner option[value="' + selectedPartners[i] + '"]').text();
                    var partnerEmailField = '<div class="fv-row col-md-4">' +
                                                '<label class="fs-6 fw-semibold form-label mb-2">' +
                                                    '<span class="required">Partner ' + partnerName + '  Email</span>' +
                                                '</label>' +
                                                '<input type="email" name="partner_email[' + selectedPartners[i] + ']" class="form-control" placeholder="Enter Email for ' + partnerName + ' required">' +
                                            '</div>';
    
                    $('#partnerEmailFields').append(partnerEmailField);
                }
            });
        });
        $(document).ready(function() {
            // Initialize Select2
            $('#theme').select2();
    
            // Handle partner selection change
            $('#theme').on('change', function() {
                var selectedTheme = $(this).val();
                var numberOfSelectedTheme = selectedTheme ? selectedTheme.length : 0;
    
                // Remove existing partner email input fields
                $('#themeTargetFields').empty();
    
                // Create input fields for partner emails
                for (var i = 0; i < numberOfSelectedTheme; i++) {
                    var themeName = $('#theme option[value="' + selectedTheme[i] + '"]').text();
                    var themeTargetField = '<div class="fv-row col-md-4">' +
                                                '<label class="fs-6 fw-semibold form-label mb-2">' +
                                                    '<span class="required">Theme ' + themeName + ' Targets</span>' +
                                                '</label>' +
                                                '<input type="text" name="theme_targets[' + selectedTheme[i] + ']" class="form-control" placeholder="Enter targets for ' + themeName + ' required">' +
                                            '</div>';
    
                    $('#themeTargetFields').append(themeTargetField);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#project').on('change', function() {
                var projectId = $(this).val();
                
                // Make AJAX request to fetch project details
                $.ajax({
                    url: '/get-project', // Change this to your Laravel route
                    type: 'GET',
                    data: { projectId: projectId },
                    success: function(response) {
                        // Handle the response (update your HTML with project details)
                        console.log(response);
                    
                        $('#project_start_date').val(response.start_date);
                        $('#project_end_date').val(response.end_date);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
    
    @endpush


</x-nform-layout>
