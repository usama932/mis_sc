<div>
    
    <div class="card-toolbar  d-flex justify-content-end">   
        @can('create dip')
            <button href="#" target="_blank" class="btn btn-primary btn-sm font-weight-bolder" data-toggle="modal" data-target="#activityModal" >
                <span class="svg-icon svg-icon-primary svg-icon-1x ">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                            <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                        </g>
                    </svg>
                </span>Add Activity
            </button>
            <div class="modal fade" id="activityModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Activity</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="fa fa-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                            <form action="{{route('activity_dips.store')}}" method="post" id="create_dip_activity">
                                @csrf
                                <input name="project_id" value="{{$project->id}}" type="hidden">
                                <div class="row">
                                    <div class="fv-row col-md-12 col-lg-12   col-sm-12">
                                        <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                            <span class="required">Activity Title</span>
                                        </label>
                                        <textarea name="activity" id="activity" rows="1" class="form-control"></textarea>
                                        <div id="detailError" class="error-message "></div>
                                    </div>  
                                    <div class="fv-row col-md-12 col-lg-12 col-sm-12">
                                        <label class="fs-6 fw-semibold form-label my    -2 d-flex">
                                            <span class="required">LOP Target</span>
                                        </label> 
                                        <input name="lop_target" class="form-control" id="lop_target" >
                                        <div id="lop_targetError" class="error-message "></div>
                                    </div>
                                </div>
                            </form
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary font-weight-bold" id="kt_create_dip_activity">
                                @include('partials/general/_button-indicator', ['label' => 'Submit'])
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive overflow-*">
            <table class="table table-striped table-bordered nowrap" id="dip_activity" style="width:100%">
                <thead>
                    <tr>
                        <th>Activity Number</th>
                        <th>Title</th>
                        <th>LOP Target</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
</div>