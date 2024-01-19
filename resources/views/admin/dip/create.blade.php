<x-nform-layout>
    @section('title')
       Add DIP
    @endsection
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped m-4">
                        <tr>
                            <td><strong>Project</strong></td>
                            <td>{{$project->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Type</strong></td>
                            <td>{{$project->type ?? ''}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped m-4">
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>{{$project->status ?? ''}}</td>
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
           
            <form action="{{route('dips.store')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="project" class="form-control" value="{{$project->id}}" placeholder="{{$project->name}}">             
                <div class="d-flex justify-content-end">
                    <button type="submit" id="kt_submit_dip" class="btn btn-success btn-sm  m-5">
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
                                                '<input type="text" name="partner_email[' + selectedPartners[i] + ']" class="form-control" placeholder="Enter Email for ' + partnerName + ' required">' +
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
