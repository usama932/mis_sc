<div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Implementation Plan Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('activity_dips.store')}}" method="post" id="create_dip_activity">
                    @csrf
                    <input name="dip_id" value="{{$dip->id}}" type="hidden">
                    <div class="modal-body">
                            <div class="row">
                            
                                <div class="fv-row col-md-3 ">
                                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                        <span class="required">Activity Number</span>
                                    </label>
                                    <input type="text" name="activity_number" id="activity_number"  class="form-control" value="">
                                    <div id="pactivity_numberError" class="error-message "></div>
                                </div>
                                <div class="fv-row col-md-9">
                                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                        <span class="required">Activity Detail</span>
                                    </label>
                                    <textarea name="detail" id="detail" rows="1" class="form-control"></textarea>
                                    <div id="detailError" class="error-message "></div>
                                </div>
                                <div class="fv-row col-md-4 mt-2">
                                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                        <span class="required">Start Date</span>
                                    </label>
                                    <input type="text" name="start_date" id="start_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                                    <div id="start_dateError" class="error-message "></div>
                                </div>
                                <div class="fv-row col-md-4 mt-2">
                                    <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                        <span class="required"> End Date</span>
                                    </label>
                                    <input type="text" name="end_date" id="end_date" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                                    <div id="end_dateError" class="error-message "></div>
                                </div>
                                <div class="fv-row col-md-4 mt-2">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Status</span>
                                    </label>
                                    <select   name="status" id="status" aria-label="Select Status" data-control="select2" data-placeholder="Select Status" class="form-select"  data-allow-clear="true" >
                                    
                                            <option value="" selected>Select Status</option>
                                            <option value="Initiative" >Intiative</option>
                                            <option value="Not Started" >Not Started</option>
                                            <option value="In-Process" >In-Process</option>
                                            <option value="Completed" >Completed</option>
                                    
                                    </select>
                                    <div id="statusError" class="error-message "></div>
                                </div>   
                            
                            
                            </div>       
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm 5">        
                            @include('partials/general/_button-indicator', ['label' => 'Update'])
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm   " data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-toolbar m-5 d-flex justify-content-end">   
        @can('create dip')
            <a href="{{ route('dips.create') }}" class="btn btn-primary btn-sm font-weight-bolder"  data-toggle="modal" data-target=".bd-example-modal-lg">
                <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                            <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                        </g>
                    </svg>
                </span>Add DIP Activity
            </a>
         
        @endcan
    </div>
    <div class="card-body pt-3">
        <div class="table-responsive overflow-*">
            <table class="table table-striped table-bordered nowrap" id="dip_activity" style="width:100%">
                <thead>
                    <tr>
                        <th>Activity Number</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>attachment</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>