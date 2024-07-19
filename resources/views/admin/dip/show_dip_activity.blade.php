    <x-default-layout>
        <style>
            /* Custom CSS for enhanced appearance */
            .card {
                border: 1px solid #ccc;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            .card-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid #ccc;
            }
    
            .card-title {
                color: #333;
            }
    
            .table th,
            .table td {
                vertical-align: middle;
            }
    
            .modal-content {
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
    
            .modal-header {
                border-bottom: none;
            }
        </style>
        
        @section('title')
            Activity Progress Detail
        @endsection

        <div class="container-fluid  mt-3">
           
            <input type="hidden" id="dip_activity" value="{{$dip_activity->id}}">
            <div class="card mb-5">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-10px me-5">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="fa fa-info-circle fs-2x text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="javascript:;" class="text-dark text-hover-primary fs-6 fw-bold">Activity Detail</a>
                                        
                                    </div>
                                    
                                </div>
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card-header border-0">
                                    <div class="row mb-5">
                                        <div class="col-md-6">
                                            <label class="fw-bold">Activity Number.#</label>
                                            <p>{{$dip_activity->activity_number ?? ''}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-bold">LOP Target</label>
                                            <p>{{$dip_activity->lop_target ?? ''}}</p>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="fw-bold">Activity Title</label>
                                            <p>{{$dip_activity->activity_title ?? ''}}</p>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="fw-bold">Thematic Area</label>
                                            <p class="fs-8">{{$dip_activity->scisubtheme_name?->maintheme?->name ?? ''}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="fw-bold">Donor</label>
                                            <p>{{$dip_activity->project->donors->name ?? ''}}</p>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="fw-bold">SOF</label>
                                            <p>{{$dip_activity->project->sof ?? ''}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="fw-bold">Provinces</label>
                                            <p class='fs-8'>
                                                @if(!empty($provinces))
                                                    @foreach($provinces as $province)
                                                        {{ $province}}@if(! $loop->last), @endif
                                                    @endforeach
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="fw-bold">Districts</label>
                                            <p class='fs-8'>
                                                @if(!empty($districts))
                                                    @foreach($districts as $district)
                                                        {{ $district}}@if(! $loop->last), @endif
                                                    @endforeach
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="fw-bold">Project Tenure</label>
                                            <p>
                                                @if(!empty($dip_activity->project->start_date) && $dip_activity->project->start_date != null)
                                                    {{ date('M d, Y', strtotime($dip_activity->project->start_date))}} - {{date('M d, Y', strtotime($dip_activity->project->end_date))}}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">Activity Progress Detail @if($dip_activity->activity_type)({{ $dip_activity->activity_type?->activity_type?->name  }} - {{  $dip_activity->activity_type?->name }})@endif</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="activityQuarters">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th colspan="2" class="text-center">Activity</th>
                                <th colspan="7" class="text-center">Beneficiary Target vs Achievement</th>
                                <th colspan="5" class="fs-8"></th>
                               
                            </tr>
                            <tr>
                                <th class="fs-9">Month</th>
                                <th class="fs-9" style="background-color: #f8f9fa">Target</th>
                                <th class="fs-9" >Achievement</th>
                                <th class="fs-9"  style="background-color: #f8f9fa">Target</th>
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
                                <th class="fs-9">Action</th>
                            </tr>
                        </thead>
                    </table>
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
