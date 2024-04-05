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
        
        @endsection

        <div class="container mt-3">
           
            <input type="hidden" id="dip_activity" value="{{$dip_activity->id}}">
           
            <div class="card">
                <div class="card-header text-center">
                    <h5 class="card-title  text-center">{{$dip_activity->project->name ?? ''}}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
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
               
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">Activity Progress Detail</h5>
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
                                <th class="fs-9">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            @foreach($quarters as $quarter)
                <div class="modal fade add_progress_modal" id="add_progress_{{ $quarter->id }}" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Update Status</h3>
                                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="add_progress_status_form" method="post" autocomplete="off" action="{{route('updateprogress')}}" enctype="multipart/form-data">   
                                    @csrf
                                    <div class="row">
                                        <div class="fv-row col-md-8 mt-3">
                                            <label class="fs-6 fw-semibold form-label">
                                                <span>Activity Name: </span>
                                            </label>
                                            <br>
                                            <label class="fs-5 fw-semibold form-label">
                                                {{$dip_activity->activity_number ?? ''}}
                                            </label>
                                        </div> 
                                        <div class="fv-row col-md-4 mt-3">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Activity LOP Target</span>
                                            </label>
                                            <input type="text" name="lop" value="{{$dip_activity->lop_target ?? ''}}" class="form-control form-control-solid" readonly>
                                        </div> 
                                        <div class="fv-row col-md-4 mt-3">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span> Month</span>
                                            </label>
                                            <input type="hidden" name="quarter" value="{{$quarter->id}}">
                                            {{$quarter->quarter}}-{{$quarter->year}}
                                        </div> 
                                        <div class="fv-row col-md-4 mt-3">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Monthly Target</span>
                                            </label>
                                            <input type="text" name="lop_target" id="lop_target" class="form-control form-control-solid" value="{{$quarter->target}}" readonly>
                                            <div id="sofError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-4 mt-3">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Enter Monthly Progress</span>
                                            </label>
                                            <input type="text" name="activity_target" id="activity_target" class="form-control" >
                                            <div id="activity_targetError" class="error-message " ></div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="fv-row col-md-2 mt-3">
                                            <label class="fs-8 fw-semibold form-label mb-4 d-flex">
                                                <span>Beneficiaries Target</span>
                                            </label>
                                            <input type="text" name="benefit_target" id="benefit_target" class="form-control form-control-solid"  value="{{$quarter->beneficiary_target}}" readonly>
                                            <div id="benefit_targetError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-2 mt-3">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Women</span>
                                            </label>
                                            <input type="text" name="women_target" value="" class="form-control"  placeholder="Women">
                                        </div> 
                                        <div class="fv-row col-md-2 mt-3">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Men</span>
                                            </label>
                                            <input type="text" name="men_target" value="" class="form-control"  placeholder="Men">
                                        </div> 
                                        <div class="fv-row col-md-2 mt-3">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Girls</span>
                                            </label>
                                            <input type="text" name="girls_target" value="" class="form-control"  placeholder="Girls">
                                        </div> 
                                        <div class="fv-row col-md-2 mt-3">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Boys</span>
                                            </label>
                                            <input type="text" name="boys_target" value="" class="form-control" placeholder="Boys" >
                                        </div> 
                                        <div class="fv-row col-md-2 mt-3">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span>PWD</span>
                                            </label>
                                            <input type="text" name="pwd_target" id="pwd_target" class="form-control" >
                                            <div id="pwd_targetError" class="error-message " ></div>
                                        </div>
                                        <div class="fv-row col-md-12 mt-3">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="">Remarks</span>
                                            </label>
                                            <textarea type="text" name="remarks" rows id="remarks" placeholder="Enter Remarks" class="form-control" value=""></textarea>
                                            <div id="achieve_targetError" class="error-message "></div>
                                        </div> 
                                        <div class="fv-row col-md-6 mt-3">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Attachemnt</span>
                                            </label>
                                            <input type="file" name="attachment" id="attachment" accept=".pdf, .docx, .doc" class="form-control" value="">
                                            <div id="attachmentError" class="error-message "></div>
                                        </div> 
                                        <div class="fv-row col-md-6 mt-3">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Image</span>
                                            </label>
                                            <input type="file" name="image" id="image"   accept=".jpg, .jpeg, .png" class="form-control" value="">
                                            <div id="imageError" class="error-message "></div>
                                        </div> 
                                    </div>  
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-sm m-5 kt_add_progress_status_form">
                                            @include('partials/general/_button-indicator', ['label' => 'Submit'])
                                        </button>
                                        <div id="loadingSpinner" class="loadingSpinner" style="display: none;">Loading...</div>
                                    </div>      
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach($months as $month)
                <div class="modal fade project_theme_modal" id="update_status_{{ $month->quarter_id }}" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Update Status</h3>
                                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="update_quarter_status_form" method="post" autocomplete="off" action="{{ route('quarterstatus.update',$month->quarter_id) }}">   
                                    @csrf
                                    @method('post') <!-- Assuming you are using PUT method for updating -->
                                    <input type="hidden" name="project_id" value="{{ $month->project_id }}">
                                    <input type="hidden" name="activity_id" value="{{ $month->activity_id }}">
                                    <div class="fv-row col-md-12">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Status</span>
                                        </label> 
                                        <select   name="status" class="form-select form-control donor" id="donor" aria-label="Select Status" data-control="select2" data-placeholder="Select a Status" class="form-select "  data-allow-clear="true" > 
                                            <option  value=''>Select Donor</option>
                                            <option  value='Posted'>Posted</option>
                                            <option  value='Returned'>Returned</option>
                                        
                                        </select>
                                        <div id="donorError" class="error-message text-danger"></div>
                                    </div>  
                                    {{-- <div class="fv-row col-md-12">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Remarks</span>
                                        </label>
                                        <textarea class="form-control remarks" name="remarks"></textarea>
                                        <div id="remarksError" class="error-message text-danger"></div>
                                    </div>   --}}
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-sm m-5 submitButton" id="">
                                            @include('partials/general/_button-indicator', ['label' => 'Update'])
                                        </button>
                                        <div id="loadingSpinner" class="loadingSpinner" style="display: none;">Loading...</div>
                                    </div>      
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach($months as $month)
                <div class="modal fade project_theme_modal" id="edit_status_{{ $month->quarter_id }}" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h3 class="modal-title">Update Progress ({{$month->activity->quarter}}-{{$month->activity?->year}})</h3>

                        
                                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="edit_quarter_status_form" method="post" autocomplete="off" action="{{ route('quarterstatus.edit',$month->id) }}">   
                                    @csrf
                                    @method('post') <!-- Assuming you are using PUT method for updating -->
                                    <input type="hidden" name="project_id" value="{{ $month->project_id }}">
                                    <input type="hidden" name="activity_id" value="{{ $month->activity_id }}">
                                    <div class="row">
                                        <div class="fv-row col-md-4 ">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span>Activity Target</span>
                                            </label>
                                            <input type="text" name="benefit_target" id="benefit_target" class="form-control form-control-solid" value="{{$month->activity?->target ?? '0'}}" readonly>
                                            <div id="benefit_targetError" class="error-message " ></div>

                                        </div> 
                                        <div class="fv-row col-md-4 ">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Enter Quarterly Progress</span>
                                            </label>
                                            <input type="text" name="activity_target" id="activity_target" value="{{$month->activity_target ?? '0'}}" class="form-control activity_target" >
                                            <div id="activity_targetError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-4 ">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span>Beneficiaries Target</span>
                                            </label>
                                            <input type="text" name="benefit_target" id="benefit_target" class="form-control form-control-solid" value="{{$month->activity?->beneficiary_target ?? '0'}}" readonly>
                                            <div id="benefit_targetError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-2 ">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Women</span>
                                            </label>
                                            <input type="text" name="women_target" value="{{$month->women_target ?? '0'}}" class="form-control women_target"  placeholder="Women">
                                            <div id="women_targetError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-2 ">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Men</span>
                                            </label>
                                            <input type="text" name="men_target"  value="{{$month->men_target ?? '0'}}"  class="form-control men_target"  placeholder="Men">
                                            <div id="men_targetError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-2 ">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Girls</span>
                                            </label>
                                            <input type="text" name="girls_target" value="{{$month->girls_target ?? '0'}}"  class="form-control girls_target"  placeholder="Girls">
                                            <div id="girls_targetError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-2 ">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Boys</span>
                                            </label>
                                            <input type="text" name="boys_target"  value="{{$month->boys_target ?? '0'}}" class="form-control boys_target" placeholder="Boys" >
                                            <div id="boys_targetError" class="error-message " ></div>
                                        </div> 
                                        <div class="fv-row col-md-4 ">
                                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                                <span>PWD/CLWD</span>
                                            </label>
                                            <input type="text" name="pwd_target" id="pwd_target"  value="{{$month->pwd_target ?? '0'}}"  class="form-control pwd_target" >
                                            
                                        </div>
                                        <div class="fv-row col-md-12 ">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="">Remarks</span>
                                            </label>
                                            <textarea type="text" name="remarks" rows id="remarks" placeholder="Enter Remarks" class="form-control" value="">{{$month->remarks ?? ''}}</textarea>
                                            <div id="achieve_targetError" class="error-message "></div>
                                        </div> 
                                        {{-- <div class="fv-row col-md-6 ">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Attachemnt</span>
                                            </label>
                                            <input type="file" name="attachment" id="attachment" accept=".pdf, .docx, .doc" class="form-control" value="">
                                            <div id="attachmentError" class="error-message "></div>
                                        </div> 
                                        <div class="fv-row col-md-6 ">
                                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                                <span class="required">Image</span>
                                            </label>
                                            <input type="file" name="image" id="image"   accept=".jpg, .jpeg, .png" class="form-control" value="">
                                            <div id="imageError" class="error-message "></div>
                                        </div>  --}}
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary btn-sm m-5 submiteditButton" id="">
                                            @include('partials/general/_button-indicator', ['label' => 'Update'])
                                        </button>
                                        <div id="loadingSpinner" class="loadingSpinner" style="display: none;">Loading...</div>
                                    </div>      
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @push('scripts')
        <script>
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
        </script>
        @endpush
    </x-default-layout>
