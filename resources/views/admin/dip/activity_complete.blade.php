

<x-nform-layout>
    @section('title')
       Complete Activites
    @endsection
    @can('project filter')
        <div class="card mb-5">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-danger">
                                        <i class="ki-duotone ki-filter-search fs-2x text-danger">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">Apply Filters</a>
                                </div>
                                <!--end::Text-->
                            </div>
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-5">
                                <div class="col-md-4 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span>Project</span>
                                    </label>
                                    <select name="project" id="project" aria-label="Select a Project" data-control="select2" data-placeholder="Select a Project..." class="form-select" data-allow-clear="true">
                                        <option value=''>Select Project</option>
                                        @foreach($projects as $project)
                                            @if(!empty($project->detail))
                                            <option value='{{$project->id}}'>{{ucfirst($project->name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span>Activity Theme</span>
                                    </label>
                                    <select name="subtheme" id="subtheme" aria-label="Select a Activity theme" data-control="select2" data-placeholder="Select a Activity theme..." class="form-select" data-allow-clear="true">
                                        <option value=''>Select Activity theme</option>
                                        @foreach($subthemes as $subtheme)
                                            <option value='{{$subtheme->id}}'>{{ucfirst($subtheme->name)}}</option>                                          
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span>Created By</span>
                                    </label>
                                    <select name="user" id="user" aria-label="Select a Created By" data-control="select2" data-placeholder="Select a Created By..." class="form-select" data-allow-clear="true">
                                        <option value=''>Select Created By</option>
                                        @foreach($users as $user)
                                            <option value='{{$user->id}}'>{{ucfirst($user->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="overlay" onclick="closeImage()" style="display: none;"></div>

    <!-- Enlarged Image -->
    <img src="" alt="Enlarged Image" class="thumbnail enlarged" style="display: none;">
    
    <!-- Close Icon -->
    <span class="close-icon" onclick="closeImage()" style="display: none;">&times;</span>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap table-sm" id="dip_complete_activity" style="width:100%">
                    <div class="card mb-3">
                        <ul class="nav nav-tabs" id="statusTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-status="" data-toggle="tab" href="javascript:;" role="tab">
                                    All <span id="all-count" class="badge bg-primary">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="to-be-reviewed-tab" data-status="To be Reviewed" data-toggle="tab" href="javascript:;" role="tab">
                                    To be Reviewed <span id="to-be-reviewed-count" class="badge bg-secondary">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="returned-tab" data-status="Returned" data-toggle="tab" href="javascript:;" role="tab">
                                    Returned <span id="returned-count" class="badge bg-danger">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviewed-tab" data-status="Reviewed" data-toggle="tab" href="javascript:;" role="tab">
                                    Reviewed <span id="reviewed-count" class="badge bg-info">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="posted-tab" data-status="Posted" data-toggle="tab" href="javascript:;" role="tab">
                                    Posted <span id="posted-count" class="badge bg-success">0</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pending-tab" data-status="pending" data-toggle="tab" href="javascript:;" role="tab">
                                    Pending <span id="penting-count" class="badge bg-warning">0</span>
                                </a>
                            </li>
                        </ul>
                        
                    </div>
                    <thead>
                        <tr>
                            <th  class="fs-9">Action</th>
                            <th  class="fs-9">Project</th>
                            <th  class="fs-9">Activity</th>
                            <th  class="fs-9">Activity Target</th>
                            <th  class="fs-9"> Beneficary Target</th>
                            <th  class="fs-9">Due Date</th>
                            <th  class="fs-9">Month</th>
                            <th  class="fs-9">Status</th>
                            <th  class="fs-9">Image</th>
                            <th  class="fs-9">Attachment</th>
                            <th  class="fs-9">Remarks</th>
                           
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    {{-- //Modals --}}
    <div class="modal fade " id="update_status" tabindex="-1" aria-labelledby="update_status" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Update Status</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body" id="update_status_body">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_progress" tabindex="-1" aria-labelledby="edit_progress" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Progress</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body" id="edit_progress_body">
                    
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function openImageInNewTab(imageUrl) {
                // Open the image URL in a new tab
                window.open(imageUrl, '_blank');
             }
        </script>
        
        
        <script>
            function edit_status(id){
                var baseURL = window.location.origin;
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.post(baseURL + '/edit_progress', {
                _token: csrfToken,
                id: id
                }).done(function(response) {
                $('#edit_progress_body').html(response);
                $('#edit_progress').modal('show');

                });
            }


            function update_status(id){
                var baseURL = window.location.origin;
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.post(baseURL + '/update_status', {
                _token: csrfToken,
                id: id
                }).done(function(response) {
                $('#update_status_body').html(response);
                $('#update_status').modal('show');
                });
            }
        </script>
    @endpush
</x-nform-layout>
