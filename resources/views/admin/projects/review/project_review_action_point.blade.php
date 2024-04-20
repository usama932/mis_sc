<x-nform-layout>
    @section('title')
        Review Meetings
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card-toolbar m-5 d-flex justify-content-end">
            @can('create projects_review')
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                    Add Review  Action Point
                </button>
                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                    <div class="modal-dialog modal-lg">
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
                                                  <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Responsible Person</span></label>
                                        <select class="form-select form-control" id="responsible_person" name="responsible_person" aria-label="Select a Responsible person" data-control="select2" data-placeholder="Select a  Responsible person..." class="form-select form-control"  data-allow-clear="true" >
                                            <option value="">Select Responsible</option>
                                            {{-- @foreach($persons as $person)
                                                <option value="{{$person->id}}">{{$person->name}}</option>
                                            @endforeach --}}
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Action Agreed</span></label>
                                        <select class="form-select form-control" id="action_agreed" name="action_agreed"  aria-label="Select a Action agreed" data-control="select2" data-placeholder="Select Action Agree..." class="form-select form-control"  data-allow-clear="true" >
                                            <option value="">Select Action</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Deadline</span></label>
                                    <input type="text" class="form-control" id="deadline" name="deadline">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Status</span></label>
                                        <select class="form-select form-control" id="status" name="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select Status..." class="form-select form-control"  data-allow-clear="true" >
                                            <option value="">Select Status</option>
                                            <option value="Initiated">Initiated</option>
                                            <option value="Completed">Completed</option>
                                            <option value="In Process">In Process</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">DIP Identified</span></label>
                                    <textarea class="form-control" rows="1" id="dip_identified" name="dip_identified" rows="3"></textarea>
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
                <table class="table table-striped table-bordered nowrap" id="project_reviews_action_point" style="width:100%">
                <thead>
                    <tr>
                        <th>#S.No</th>
                        <th>Action Point</th>
                        <th>Responsble Person</th>
                        <th>Action Agree</th> 
                        <th>Deadline</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                </table>
            </div>

        </div>
    </div>

   
</x-nform-layout>
