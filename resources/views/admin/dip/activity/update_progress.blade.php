<style>
    .disabled-blur {
        filter: blur(2px); /* Adjust the blur effect as needed */
        opacity: 0.6; /* Adjust the opacity as needed */
        pointer-events: none; /* Disable pointer events to prevent interaction */
    }
</style>
<form id="update_quarter_status_form" method="POST" autocomplete="off" action="{{ route('quarterstatus.update', $progress->quarter_id) }}">   
    @csrf
   
    <input type="hidden" name="project_id" value="{{ $progress->project_id }}">
    <input type="hidden" name="activity_id" value="{{ $progress->activity_id }}">
    <div class="fv-row col-md-12">
        <label class="fs-6 fw-semibold form-label mb-2">
            <span class="required">Status</span>
        </label> 
        <select name="status" class="form-select form-control donor" id="status" aria-label="Select Status" data-control="select2" data-placeholder="Select a Status" required> 
            <option value="">Select Status</option>
            <option value='Posted'>Posted</option>
            <option value='Returned'>Returned</option>
        </select>
        <div id="statusError" class="error-message text-danger"></div>
    </div>  
    <div class="fv-row col-md-12">
        <label class="fs-6 fw-semibold form-label mb-2">
            <span class="">Remarks</span>
        </label>  
        <textarea name="remarks" id="remarks" rows="2" class="form-control" > </textarea>
        <div id="remarksError" class="error-message text-danger"></div>
    </div> 
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm m-5 submitButton" id="kt_update_quarter_status_form">Update</button> 
        <button type="submit" class="btn btn-primary btn-sm m-5 submitButton" id="loadingSpinner" style="display:none;">Loading...</button>
    </div>      
</form>

<script>
$(document).ready(function() {
    $('#kt_update_quarter_status_form').click(function(e) {
        e.preventDefault();
       
        // Perform validation
        var status = $('#status').val();
       
     
        if (!status && status === "") {
            var remarks = $('#remarks').val();
            
            $('#statusError').text('Please select a status');
            if (!remarks && status === "Returned") {
                $('#remarksError').text('Please enter a Remarks');
                return;
            }else{
                $('#remarksError').text('');
            }
            return;
        } else {
            $('#statusError').text('');
        }
       
        $.ajax({
            url: $('#update_quarter_status_form').attr('action'),
            type: 'post',
            data: $('#update_quarter_status_form').serialize(),
            beforeSend: function() {
                $('#loadingSpinner').show();
                $('#kt_update_quarter_status_form').hide();
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
                    $('#update_status').modal('hide');
                    $('#loadingSpinner').hide();
                    $('#kt_update_quarter_status_form').show();
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
                $('#kt_update_quarter_status_form').show();
            }
        });
    });
});
</script>
    