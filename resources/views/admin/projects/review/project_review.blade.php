    <x-nform-layout>
        @section('title')
            Review Meetings
        @endsection
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="card-toolbar m-5 d-flex justify-content-end">
                @can('create projects_review')
                    <a href="{{ route('project_review.create',$id) }}" class="btn btn-primary btn-sm font-weight-bolder">
                        <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>Add Review Meeting
                    </a>
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
                            <th>Responsible Person</th>
                            <th>Action Agreed</th>
                            <th>Deadline</th>
                            <th>Status</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>

            </div>
        </div>
        <div class="modal fade" id="view_review" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="view_monitor_visit">Review Meeting Details</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold close"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        @push("scripts")
       
            
        <script>
           
        </script>
       
        @endpush
    </x-nform-layout>
