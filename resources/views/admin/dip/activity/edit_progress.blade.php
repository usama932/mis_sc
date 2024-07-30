<form id="edit_quarter_status_form" method="post" autocomplete="off" action="{{ route('quarterstatus.edit',$progress->id) }}" enctype="multipart/form-data">   
    @csrf
    @method('post') <!-- Assuming you are using PUT method for updating -->
    <input type="hidden" name="project_id" value="{{ $progress->project_id }}">
    <input type="hidden" name="activity_id" value="{{ $progress->activity_id }}">
    <div class="row">
        <div class="fv-row col-md-4 ">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span>Activity Target</span>
            </label>
            <input type="text" name="benefit_target" id="benefit_target" class="form-control form-control-solid" value="{{$progress->activity?->target ?? '0'}}" readonly>
            <div id="benefit_targetError" class="error-message  text-danger " ></div>
        </div> 
        <div class="fv-row col-md-4 ">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span class="required">Enter Quarterly Progress</span>
            </label>
            <input type="text" name="activity_target" id="activity_target" value="{{$progress->activity_target ?? ""}}" class="form-control activity_target" >
            <div id="activity_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-4 ">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span>Beneficiaries Target</span>
            </label>
            <input type="text" name="benefit_target" id="benefit_target" class="form-control form-control-solid" value="{{$progress->activity?->beneficiary_target ?? '0'}}" readonly>
            <div id="benefit_targetError" class="error-message  text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 ">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Women</span>
            </label>
            <input type="text" name="women_target" id="women_target" value="{{$progress->women_target ?? ""}}" class="form-control women_target"  placeholder="Women">
            <div id="women_targetError" class="error-message  text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 ">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Men</span>
            </label>
            <input type="text" name="men_target" id="men_target"  value="{{$progress->men_target ?? ""}}"  class="form-control men_target"  placeholder="Men">
            <div id="men_targetError" class="error-message  text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 ">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Girls</span>
            </label>
            <input type="text" name="girls_target" id="girls_target" value="{{$progress->girls_target ?? ""}}"  class="form-control girls_target"  placeholder="Girls">
            <div id="girls_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 ">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Boys</span>
            </label>
            <input type="text" name="boys_target" id="boys_target"  value="{{$progress->boys_target ?? ""}}" class="form-control boys_target" placeholder="Boys" >
            <div id="boys_targetError" class="error-message text-danger " ></div>
        </div> 
        <div class="fv-row col-md-2 ">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span>PWD/CLWD </span>
            </label>
            <input type="text" name="pwd_target" id="pwd_target"  value="{{$progress->pwd_target ?? ""}}"  class="form-control pwd_target" >
            
        </div>
        <div class="fv-row col-md-2 mt-5">
            <div class="form-check form-switch mt-5">
                <input class="form-check-input" type="checkbox" id="double_count" name="double_count"  {{$progress->double_count ? 'checked' : ''}}>
                <label class="form-check-label fs-8" for="double_count">Double Count</label>
            </div>
        </div>
        <div class="fv-row col-md-12 ">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="">Remarks</span>
            </label>
            <textarea type="text" name="remarks" rows id="remarks" placeholder="Enter Remarks" class="form-control" value="">{{$progress->remarks ?? ""}}</textarea>
            <div id="remarksError" class="error-message text-danger"></div>
        </div> 
        @if($progress->attachment)
            <div class="fv-row col-md-6">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span>Current Attachment</span>
                </label>
                <div>
                    <a href="{{ route('download_progress_attachment',$progress?->attachment ) }}" target="_blank">View Current Attachment</a>
                </div>
            </div>
        @endif
        <div class="fv-row col-md-6">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Attachemnt</span>
            </label>
            <input type="file" name="attachment" id="attachment" accept=".pdf, .docx, .doc" class="form-control" value="">
            <div id="attachmentError" class="error-message "></div>
        </div> 
        @if($progress->image)
            <div class="fv-row col-md-6">
                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                    <span>Current Image</span>
                </label>
                <div>
                    <img src="{{ asset("storage/activity_progress/image/{$project_sof->sof}/{$progress->image}") }}" alt="Current Image" style="max-width: 100px;">
                </div>
            </div>
        @endif
        <div class="fv-row col-md-6 ">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Image</span>
            </label>
            <input type="file" name="image" id="image"   accept=".jpg, .jpeg, .png" class="form-control" value="">
            <div id="imageError" class="error-message "></div>
        </div> 
    </div>
    
    <div class="modal-footer mt-2">
        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm m-5 " id="kt_edit_quarter_status_form">
            @include('partials/general/_button-indicator', ['label' => 'Update'])
        </button>
    
    </div>         
</form>

<script>
$(document).ready(function() {
    $('#kt_edit_quarter_status_form').click(function(e) {
        e.preventDefault();
        
        // Perform validation
        var activityTarget = $('#activity_target').val();
        var womenTarget = $('#women_target').val();
        var menTarget = $('#men_target').val();
        var girlsTarget = $('#girls_target').val();
        var boysTarget = $('#boys_target').val();
        var remarks = $('#remarks').val();
        var attachment = $('#attachment').prop('files')[0];
        var image = $('#image').prop('files')[0];
        
        if (!activityTarget || activityTarget === "") {
            $('#activity_targetError').text('Please enter Monthly Target');
            return;
        } else {
            $('#activity_targetError').text('');
        }

        if (!womenTarget || womenTarget === "") {
            $('#women_targetError').text('Please enter Women Progress');
            return;
        } else {
            $('#women_targetError').text('');
        }
        
        if (!menTarget || menTarget === "") {
            $('#men_targetError').text('Please enter Men Progress');
            return;
        } else {
            $('#men_targetError').text('');
        }
        
        if (!girlsTarget || girlsTarget === "") {
            $('#girls_targetError').text('Please enter Girls Progress');
            return;
        } else {
            $('#girls_targetError').text('');
        }
        
        if (!boysTarget || boysTarget === "") {
            $('#boys_targetError').text('Please enter boys Progress');
            return;
        } else {
            $('#boys_targetError').text('');
        }
        
        if (!remarks || remarks === "") {
            $('#remarksError').text('Please enter Remarks');
            return;
        } else {
            $('#remarksError').text('');
        }

        // Create FormData object
        var formData = new FormData($('#edit_quarter_status_form')[0]);
        
        $.ajax({
            url: $('#edit_quarter_status_form').attr('action'),
            type: 'post',
            data: formData,
            processData: false,  // Prevent jQuery from automatically transforming the data into a query string
            contentType: false,  // Prevent jQuery from setting Content-Type
            beforeSend: function() {
                $('#loadingSpinner').show();
                $('#kt_edit_quarter_status_form').hide();
            },
            success: function(response) {
                if(response){
                    toastr.options = {
                        "closeButton": false,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    activityQuarters.ajax.reload(null, false).draw(false);
                    $('#loadingSpinners').hide();
                    $('#edit_progress').modal('hide');
                    $('#loadingSpinner').hide();
                    $('#kt_edit_quarter_status_form').show();
                    toastr.success("Activity Quarter Status Updated", "Success");
                }
            },
            error: function(xhr) {
                // Handle errors
                if(xhr){
                    toastr.options = {
                        "closeButton": false,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error(xhr.responseText, "Error occurred");
                }
            },
            complete: function() {
                $('#loadingSpinner').hide();
                $('#kt_edit_quarter_status_form').show();
            }
        });
    });
});


</script>
