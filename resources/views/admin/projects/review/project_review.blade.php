    <x-nform-layout>
        @section('title')
            Review Meetings
        @endsection
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="card-toolbar m-5 d-flex justify-content-end">
                @can('create projects_review')
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                        Add Review Meeting
                    </button>
                    <div class="modal fade" tabindex="-1" id="kt_modal_1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Add Review Meeting</h3>
                    
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <form action="{{route('projectreviews.store')}}" method="post" id="create_projectreview" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                    
                                            @csrf
                                            <input type="hidden" name="project_id" value="{{$id}}" id="project_id">
                                            <div class="card-body py-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="fv-row form-group">
                                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                                <span class="required">Review Meeting Title</span></label>
                                                            <input type="text" class="form-control" id="title" name="title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="fv-row form-group">
                                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                                <span class="required">Review Date</span>
                                                            </label>
                                                            <input type="text" class="form-control" id="review_date" name="review_date">
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            
                                            </div>
                                    
                                    </div>
                        
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" id="kt_create_projectreview" class="btn btn-success btn-sm  m-3">
                                            @include('partials/general/_button-indicator', ['label' => 'Submit'])
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="card-body pt-0 overflow-*">
                <input type="hidden"  value="{{$id}}" id="project_id" />
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="project_reviews" style="width:100%">
                    <thead>
                        <tr>
                            <th>#S.No</th>
                            <th>Meeting Title</th>
                            <th>Review Date</th>
                            <th>Project</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>

            </div>
        </div>

       
    </x-nform-layout>
