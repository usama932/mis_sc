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
            @if(auth()->user()->hasRole('administrator'))
                <option value='Posted'>Posted</option>
                <option value='Reviewed'>Reviewed</option>
                <option value='Returned'>Returned</option>
            @elseif(auth()->user()->hasAnyRole(['partner', 'focal person']))
                <option value='Reviewed'>Reviewed</option>
                <option value='Returned'>Returned</option>
            @elseif(auth()->user()->hasRole('Meal Manager'))
                <option value='Posted'>Posted</option>
                <option value='Returned'>Returned</option>
            @endif
        </select>
        <div id="statusError" class="error-message text-danger"></div>
    </div>  
    <div class="fv-row col-md-12">
        <label class="fs-6 fw-semibold form-label mb-2">
            <span class="">Remarks</span>
        </label>  
        <textarea name="remarks" id="remarks" rows="2" class="form-control"></textarea>
        <div id="remarksError" class="error-message text-danger"></div>
    </div> 
    <div class="modal-footer">
        <button type="button" class="btn btn-light  btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm  submitButton" id="kt_update_quarter_status_form">Update</button> 
        <button type="submit" class="btn btn-primary btn-sm  submitButton" id="loadingSpinner" style="display:none;">Loading...</button>
    </div>      
</form>

<script>
    $(document).ready(function() {
        $('#kt_update_quarter_status_form').click(function(e) {
            e.preventDefault();
        
            // Perform validation
            var status = $('#status').val();
            var remarks = $('#remarks').val();
            var statusError = $('#statusError');
            var remarksError = $('#remarksError');

            if (!status || status === "") {
                statusError.text('Please select a status');
                return; // Prevent form submission if validation fails
            } else {
                statusError.text('');
                
                if (status === "Returned") {
                    if (!remarks || remarks.trim() === "") {
                        remarksError.text('Please enter Remarks');
                        return; // Prevent form submission if validation fails
                    } else {
                        remarksError.text('');
                    }
                } else {
                    remarksError.text('');
                }
            }

            // Disable form and show loading spinner
            $('#update_quarter_status_form').addClass('disabled-blur');
            $('#loadingSpinner').show();
            $('#kt_update_quarter_status_form').hide();

            $.ajax({
                url: $('#update_quarter_status_form').attr('action'),
                type: 'post',
                data: $('#update_quarter_status_form').serialize(),
                success: function(response) {
                    console.log(response);
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

                        $('table').each(function() {
                        if($.fn.DataTable.isDataTable(this)) {
                                $(this).DataTable().ajax.reload(null, false);  // Reload without resetting pagination
                            }
                        });
                        $('#update_status').modal('hide');
                        toastr.success("Activity Quarter Status Updated", "Success");
                    }
                },
                error: function(xhr) {
                    // Handle errors
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
                },
                complete: function() {
                    // Enable form and hide loading spinner
                    $('#update_quarter_status_form').removeClass('disabled-blur');
                    $('#loadingSpinner').hide();
                    $('#kt_update_quarter_status_form').show();
                }
            });
        });
    });
</script>
  