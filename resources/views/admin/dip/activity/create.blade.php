<x-nform-layout>
    @section('title', 'Add New Activity')
    <style>
        .highlight-field {
            border-color: red;
            /* You can add more styles as needed */
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{ route('activity_dips.store') }}" method="post" id="create_dip_activity">
                @csrf
               
                <div class="card-body">
                    <div class="row">
                        <div class="fv-row col-md-4 col-lg-4 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Project</span>
                            </label>
                            <select name="project_id" id="project_id" aria-label="Select a Project" data-control="select2"
                                data-placeholder="Select a Project" class="form-select" data-allow-clear="true">
                                <option value="">Select a Project</option>
                                @foreach($projects as $project)
                                    @if($project->detail?->count() > 0 && $project->themes?->count() > 0)
                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div id="project_idError" class="error-message"></div>
                        </div>
                    
                    </div>
                    
                 
                </div>
              
                <div class="card-footer justify-content-end d-flex">
                  
                    <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>
  
    
    @push('scripts')
        <script>
      
            $("#project_id").change(function () {
              
                var value = $(this).val();
                csrf_token = $('[name="_token"]').val();
                var baseUrl = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
                var newUrl = baseUrl + '/dip/create/' + value;
            
                window.location.assign(newUrl);
            });
            
      
        </script>
    @endpush
 </x-nform-layout>
 