<x-nform-layout>
    @section('title')
       Add Detail Implementation Plan
    @endsection
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('dips.store')}}" method="post" id="create_dip" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Project</span>
                            </label>
                            <select   name="project" id="project" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select"  data-allow-clear="true" >
                               
                                @foreach($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                            <div id="projectError" class="error-message "></div>
                        </div>   
                        <div class="fv-row col-md-4 ">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Partner </span>
                            </label>
                            <select   multiple name="partner[]" id="partner" aria-label="Select Partner" data-control="select2" data-placeholder="Select Partner" class="form-select"  data-allow-clear="true" >
                              
                                @foreach($partners as $partner)
                                    <option value="{{$partner->id}}">{{$partner->name}}</option>
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