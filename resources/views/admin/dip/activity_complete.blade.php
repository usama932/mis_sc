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
    
    <div class="card">
        <div class="card-body">
        
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap table-sm" id="dip_complete_activity" style="width:100%">
                    <div class="card mb-3">
                        <ul class="nav nav-tabs" id="statusTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-status="" data-toggle="tab" href="javascript:;" role="tab">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="to-be-reviewed-tab" data-status="To be Reviewed" data-toggle="tab" href="javascript:;" role="tab">To be Reviewed</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="returned-tab" data-status="Returned" data-toggle="tab" href="javascript:;" role="tab">Returned</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviewed-tab" data-status="Reviewed" data-toggle="tab" href="javascript:;" role="tab">Reviewed</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="posted-tab" data-status="Posted" data-toggle="tab" href="javascript:;" role="tab">Posted</a>
                            </li>
                        </ul>
                    </div>
                    <thead>
                        <tr>
                            <th  class="fs-9">Project</th>
                            <th  class="fs-9">Activity</th>
                            <th  class="fs-9">Activity Target</th>
                            <th  class="fs-9"> Beneficary Target</th>
                            <th  class="fs-9">Due Date</th>
                            <th  class="fs-9">Month</th>
                            <th  class="fs-9">Status</th>
                            <th  class="fs-9">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</x-nform-layout>
