<div>
    
    <div class="card-toolbar  d-flex justify-content-end">   
        @can('create dip')
            <a href="{{route("dip.create",$project->id)}}" target="_blank" class="btn btn-primary btn-sm font-weight-bolder" >
                <span class="svg-icon svg-icon-primary svg-icon-1x ">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                            <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                        </g>
                    </svg>
                </span>Add Activity
            </a>
        @endcan
    </div>
    <div class="card-body">
        <div class="table-responsive overflow-*">
            <table class="table table-striped table-bordered nowrap" id="dip_activity" style="width:100%">
                <thead>
                    <tr>
                        <th>Activity Number</th>
                        <th>Detail</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
</div>