
<x-default-layout>
    @section('title', 'Activity progress details')
    <div class="container-fluid  mt-3">
        <div class="row mb-5">
            <div class="col-lg-6 d-flex">
                <div class="card bg-danger w-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="text-white">{{ $dip_activity->months->count() }}</h1>
                                <h6 class="text-white">Total Months</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <div class="font-weight-boldest">
                                <h5 class="text-white">{{ $monthsWithoutProgressCount }} Overdue</h5>
                            </div>
                            <div class="font-weight-boldest">
                                <h5 class="text-white">{{ $monthsWithpostedCount }} Completed</h5>
                            </div>
                        </div>
                        <div class="progress" style="height:5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <h5 class="text-white">{{ number_format($progress, 2) }}%</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex">
                <div class="card bg-primary w-100">
                    <div class="card-body">
                        <div>
                            <h3 class="text-white">{{ $monthstobreviewCount }}</h3>
                            <h3 class="text-white">To Be Reviewed</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 d-flex">
                <div class="card bg-warning w-100">
                    <div class="card-body">
                        <div>
                        <h3 class="text-white">{{ $monthspending }}</h3 >
                            <h3 class="text-white">Pending</h3>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
        
        
        <div class="d-flex justify-content-between mb-4 text-white">
            <div class="justify-content-start font-weight-boldest">
                Returned : {{ $monthsWithreturnCount }}
            </div>
            <div class="justify-content-end font-weight-boldest">
                Pending : {{ $monthspending }}
            </div>
        </div>

        <div class="card">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                {{-- <div class="symbol symbol-10px me-5">
                                    <span class="symbol-label bg-light-danger">
                                        <i class="fa fa-info-circle fs-2x text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </div> --}}
                                <div class="d-flex flex-column">
                                    <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">#{{$dip_activity->activity_number ?? '--'}} - {{$dip_activity->activity_title  ?? ''}}</a>
                                </div>
                                
                            </div>
                        </button>
                    </h3>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           
                                @php
                                    $provinces = [];
                                    $districts = [];
                                    if($dip_activity->project?->detail?->district != null) {
                                        $district_project = json_decode($dip_activity->project->detail?->district , true);
                                        $districts = App\Models\District::whereIn('district_id', $district_project)->get();
                                    }
                                
                                    if($dip_activity->project?->detail?->province != null) {
                                        $province_project = json_decode($dip_activity->project->detail->province , true);
                                        $provinces =  App\Models\Province::whereIn('province_id', $province_project)->get();
                                    }
                                                
                                @endphp
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width='10%'><strong>Project</strong></th>
                                            <td width='25%'>{{$dip_activity->project?->name ?? '--'}}</td>
                                            <th  width='10%'><strong>SOF</strong></th>
                                            <td width='20%'>{{$dip_activity->project?->sof ?? '--'}}</td>
                                            <th  width='10%'><strong>Donor</strong></strong></th>
                                            <td width='25%'>{{$dip_activity->project?->donors?->name ?? '--'}}</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Province</th>
                                            <td>
                                                @foreach($provinces as $province)
                                                    {{ $province->province_name ?? '--' }}@if(! $loop->last), @endif
                                                @endforeach
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <th><strong>Tenure</strong></th>
                                            <td>
                                                @if(!empty($dip_activity->project->start_date) && $dip_activity->project->start_date != null)
                                                    {{ date('M d, Y', strtotime($dip_activity->project->start_date))}} - {{date('M d, Y', strtotime($dip_activity->project->end_date))}}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                           
                                        </tr>
                                        <tr>
                                            <th><strong>District</strong></th>
                                            <td colspan="2">
                                                @foreach($districts as $district)
                                                    {{ $district->district_name }}@if(! $loop->last), @endif
                                                @endforeach
                                            </td>
                                            <th><strong>Theme and sub theme</strong</th>
                                        <td colspan="3">{{$dip_activity->scisubtheme_name?->maintheme?->name ?? 'N/A'}} - {{$dip_activity->scisubtheme_name?->name ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"><div class="separator separator-dashed separator-border-4"></div></td>
                                        </tr>
                                        <tr>
                                            <th><strong>Activity Details</strong></th>
                                            <td colspan="5">#{{$dip_activity->activity_number ?? '--'}} - {{$dip_activity->activity_title  ?? ''}}</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Actvity type & sub-type</strong></th>
                                            <td colspan="3">{{$dip_activity->activity_type?->activity_type?->name ?? ''}} -> {{$dip_activity->activity_type?->name ?? ''}}</td>
                                            <th><strong>LOP Target</strong></th>
                                            <td>{{$dip_activity->lop_target ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" id="activityQuarters">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th></th>
                                <th colspan="2" class="text-center">Activity</th>
                                <th colspan="7" class="text-center">Beneficiary Target vs Achievement</th>
                                <th colspan="5" class="fs-8"></th>
                                
                            </tr>
                            <tr>
                                <th class="fs-9"></th>
                                <th class="fs-9">Month</th>
                                <th class="fs-9" style="background-color: #f7d6d6fd">Target</th>
                                <th class="fs-9" >Achievement</th>
                                <th class="fs-9"  style="background-color: #f7d6d6fd">Target</th>
                                <th class="fs-9" >Women</th>
                                <th class="fs-9">Men</th>
                                <th class="fs-9">Girls</th>
                                <th class="fs-9">Boys</th>
                                <th class="fs-9">PWD/CLWD</th>
                                <th class="fs-9">Status</th>
                                <th class="fs-9">Expected Completion Date</th>
                                <th class="fs-9">Completed Date</th>
                                <th class="fs-9">Image</th>
                                <th class="fs-9">Attachemnt</th>
                                <th class="fs-9">Remarks</th>
                                <th class="fs-9">Created At</th>
                                <th class="fs-9">Created By</th>
                                <th class="fs-9">Updated At</th>
                                <th class="fs-9">Updated By</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_progress" tabindex="-1" aria-labelledby="add_progress" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Progress</h3>
                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>
                    <div class="modal-body" id="add_progress_body">
                        
                    </div>
                </div>
            </div>
        </div>
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
        <input type="hidden" id="dip_activity" value="{{$dip_activity->id}}">
    </div>
    @push('scripts')
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

        function previewImage(image) {
            // Create a modal overlay
            var modal = document.createElement("div");
            modal.style.position = "fixed";
            modal.style.top = "0";
            modal.style.left = "0";
            modal.style.width = "100%";
            modal.style.height = "100%";
            modal.style.backgroundColor = "rgba(0, 0, 0, 0.7)";
            modal.style.display = "flex";
            modal.style.alignItems = "center";
            modal.style.justifyContent = "center";
            modal.style.zIndex = "9999"; // Ensure the modal appears on top
            
            // Create a container for the image and download button
            var content = document.createElement("div");
            content.style.textAlign = "center";
            
            // Create the larger image element
            var largeImage = document.createElement("img");
            largeImage.src = image.src; // Use the same source as the clicked image
            largeImage.style.maxWidth = "80%";
            largeImage.style.maxHeight = "80%";
            
            // Add the image to the container
            content.appendChild(largeImage);
            
            // Create a link to download the image
            var downloadLink = document.createElement("a");
            downloadLink.href = image.src; // Set the image source as the download link
            downloadLink.download = "image"; // Specify the default filename for download
            downloadLink.textContent = "Download Image";
            downloadLink.style.display = "block";
            downloadLink.style.marginTop = "10px"; // Add some margin between image and button
            
            // Add the download button to the container
            content.appendChild(downloadLink);
            
            // Add the container to the modal
            modal.appendChild(content);
            
            // Append the modal to the body
            document.body.appendChild(modal);
            
            // Close the modal when clicked outside the image
            modal.onclick = function(event) {
                if (event.target === modal) {
                    document.body.removeChild(modal);
                }
            };
        }

        function add_progress(id) {
            var baseURL = window.location.origin;
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.post(baseURL + '/add_progress', {
            _token: csrfToken,
            id: id
            }).done(function(response) {
            $('#add_progress_body').html(response);
            $('#add_progress').modal('show');

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
</x-default-layout>
