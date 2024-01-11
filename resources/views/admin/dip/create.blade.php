<x-nform-layout>
    @section('title')
       Update Project Details
    @endsection
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('dips.store')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <select   name="project" id="project" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select"  data-allow-clear="true" >
                                <option value=""></option>
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                            <div id="projectError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Theme</span>
                            </label>
                            <select   name="theme" id="theme" aria-label="Select Theme" data-control="select2" data-placeholder="Select Theme" class="form-select"  data-allow-clear="true" >
                                <option value=""></option>
                                @foreach($themes as $theme)
                                    <option value="{{$theme->id}}">{{$theme->name}}</option>
                                @endforeach
                            </select>
                            <div id="projectError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Province</span>
                            </label>
                            <select   name="province[]" multiple id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select "  data-allow-clear="true" >
                            
                                <option value="">Select Province</option>
                                {{-- <option value='1'>Punjab</option> --}}
                                <option value='4' >Sindh</option>
                                <option  value='2'>KPK</option>
                                <option value='3'>Balochistan</option>
                             
                            </select>
                            <div id="kt_select2_provinceError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-3 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">District</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtloader"></span>
                            </label>
                            <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select  District" class="form-select form-select-solid">
                            </select>
                            <span id="kt_select2_districtError" class="error-message "></span>
                        </div>  
                        <div class="fv-row col-md-3">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Partner</span>
                            </label>
                            <select   multiple name="partner[]" id="partner" aria-label="Select Partner" data-control="select2" data-placeholder="Select Partner" class="form-select"  data-allow-clear="true" >
                                @foreach($partners as $partner)
                                    <option value="{{$partner->id}}">{{$partner->slug}}</option>
                                @endforeach
                            </select>
                            <div id="partnerError" class="error-message "></div>
                        </div>  
                     
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Attachment</span>
                            </label>
                            <input type="file" name="attachment" id="attachment" class="form-control">
                            <div id="attachmentError" class="error-message "></div>
                        </div>
                    </div>
                    <div id="partnerEmailFields" class="row"></div>
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
                                                    '<span class="required">Partner ' + partnerName + ' Email</span>' +
                                                '</label>' +
                                                '<input type="text" name="partner_email[' + selectedPartners[i] + ']" class="form-control" placeholder="Enter Email for ' + partnerName + '">' +
                                            '</div>';
    
                    $('#partnerEmailFields').append(partnerEmailField);
                }
            });
        });
    </script>
    
        <script>
            $(document).ready(function() {
                // Initialize Select2
            
        
                // Handle selection change
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
