<x-default-layout>
    @section('title')
    Add/Edit Project Details
    @endsection 

    <style>
    .spacer::after {
        content: "\2002"; /* Unicode character for en space */
    }
    </style>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card mb-4">
            @role('administrator')
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-5">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="ki-duotone ki-filter-search fs-2x text-danger"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">Apply Filters</a>
                                    </div>
                                </div>
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row mb-5">
                                    <div class="col-md-4 mt-3">
                                        <label class=" form-label mb-2">
                                            <span>Project</span>
                                        </label>
                                        <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select" data-allow-clear="true">
                                            <option value="">Select Project</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endrole
        </div>

        <div class="card"> 
            <div class="card-body">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="project_details">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Type</th>
                                <th>SOF</th>
                                <th>Provinces</th>
                                <th>Districts</th>
                                <th>Project Tenure</th>
                                <th>Actions</th>
                                <th>Extract DIP</th>
                                <th>Review Meeting</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        var projectReviewsUrl   = "{{ route('projectreviews.show', ':id') }}";
        var userType            = "{{ auth()->user()->user_type }}";
        var projectDetail       = "{{ route('project.detail', ':id') }}";
        var projectView         = "{{ route('project.view', ':id') }}";
        var APP_URL = @json(url('/'));
    </script>
    @endpush
</x-default-layout>
