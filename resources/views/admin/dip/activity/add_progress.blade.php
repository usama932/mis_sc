<style>
    .disabled-blur {
        filter: blur(2px); /* Adjust the blur effect as needed */
        opacity: 0.6; /* Adjust the opacity as needed */
        pointer-events: none; /* Disable pointer events to prevent interaction */
    }
</style>
<form class="add_progress_status_form" method="post" id="add_progress_form" autocomplete="off" action="{{route('updateprogress')}}" enctype="multipart/form-data">   
    @csrf
    <div class="row">
        <div class="fv-row col-md-8 mt-3">
            <label class="fs-6 fw-semibold form-label">
                <span>Activity Title: </span>
            </label>
            <br>
            <label class="fs-5 fw-semibold form-label">
                {{$quarter->activity?->activity_number ?? ''}}-{{$quarter->activity?->activity_title ?? ''}}
            </label>
        </div> 
        <div class="fv-row col-md-3 mt-3">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span class="required">Activity LOP Target</span>
            </label>
            <input type="text" name="lop" value="{{$quarter->activity?->lop_target ?? ''}}" class="form-control form-control-solid" readonly>
        </div> 
        <div class="fv-row col-md-3 mt-3">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span> Month</span>
            </label>
            <input type="hidden" name="quarter" id="quarter" value="{{$quarter->id}}">
            <input type="hidden" name="quarter_month" id="quarter_month" value="{{$quarter->completion_date}}">
            
            {{$quarter->quarter}}-{{$quarter->year}}
        </div> 
        <div class="fv-row col-md-3 mt-3">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span class="required">Monthly Target</span>
            </label>
            <input type="text" name="lop_target" id="lop_target" class="form-control form-control-solid" value="{{$quarter->target}}" readonly>
            <div id="sofError" class="error-message " ></div>
        </div> 
        <div class="fv-row col-md-3 mt-3">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span class="required">Enter Monthly Progress</span>
            </label>
            <input type="text" name="activity_target" id="activity_target" class="form-control" >
            <div id="activity_targetError" class="error-message text-danger" ></div>
        </div> 
      
        <div class="fv-row col-md-3 mt-3">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span class="required">Completion Date</span>
            </label>
            <input type="text" name="complete_date" id="complete_date" placeholder="Select date"  class="form-control " onkeydown="event.preventDefault()" data-provide="datepicker" value="">
            <div id="complete_dateError" class="error-message  text-danger" ></div>
        </div>
    </div>
    <div class="row">
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-8 fw-semibold form-label mb-4 d-flex">
                <span>Beneficiaries Target</span>
            </label>
            <input type="text" name="benefit_target" id="benefit_target" class="form-control form-control-solid"  value="{{$quarter->beneficiary_target}}" readonly>
            <div id="benefit_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Women</span>
            </label>
            <input type="text" name="women_target" id="women_target" value="" class="form-control"  placeholder="Women">
            <div id="women_targetError" class="error-message text-danger"></div>
       
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Men</span>
            </label>
            <input type="text" name="men_target" id="men_target" value="" class="form-control"  placeholder="Men">
            <div id="men_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Girls</span>
            </label>
            <input type="text" name="girls_target" id="girls_target" value="girls_target" class="form-control"  placeholder="Girls">
            <div id="girls_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Boys</span>
            </label>
            <input type="text" name="boys_target" id="boys_target" class="form-control" placeholder="Boys" >
            <div id="boys_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span>PWD/CLWD</span>
            </label>
            <input type="text" name="pwd_target" id="pwd_target" class="form-control" placeholder="PWD/CLWD">
            <div id="pwd_targetError" class="error-message text-danger" ></div>
        </div>
        <div class="fv-row col-md-12 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Remarks</span>
            </label>
            <textarea type="text" name="remarks" rows id="remarks" placeholder="Enter Remarks" class="form-control" value=""></textarea>
            <div id="achieve_targetError" class="error-message text-danger"></div>
        </div> 
        <div class="fv-row col-md-6 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Attachemnt</span>
            </label>
            <input type="file" name="attachment" id="attachment" accept=".pdf, .docx, .doc" class="form-control" value="">
            <div id="attachmentError" class="error-message text-danger"></div>
        </div> 
        <div class="fv-row col-md-6 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Image</span>
            </label>
            <input type="file" name="image" id="image"   accept=".jpg, .jpeg, .png" class="form-control" value="">
            <div id="imageError" class="error-message text-danger"></div>
        </div> 
    </div>  
    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm m-5 " id="kt_add_progress_status_form">
            @include('partials/general/_button-indicator', ['label' => 'Submit'])
        </button>
        <div id="loadingSpinner" class="loadingSpinner" style="display: none;">Loading...</div>
    </div>      
   
</form>
<script>
    var quarter_month = document.getElementById("quarter_month").value ?? '1';
  
    var givenDate = new Date(quarter_month);
        
    var oneWeekBefore = new Date(givenDate.getTime() - 0 * 24 * 60 * 60 * 1000);
    var twoWeeksAfter = new Date(givenDate.getTime() + 7 * 24 * 60 * 60 * 1000);

    var flatpickrInstance = flatpickr("#complete_date", {
        minDate: oneWeekBefore,
        maxDate: twoWeeksAfter,
        disable: [
            function(date) {
                // Disable Saturdays and Sundays
                return (date.getDay() === 6 || date.getDay() === 0); // 6 is Saturday, 0 is Sunday
            }
        ]
    });
    flatpickrInstance.setDate(givenDate);
</script>

<script>
 document.getElementById('add_progress_form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    var submitButton = $('#kt_add_progress_status_form');
    const form = this;
    const fileInputs = {
        attachment: document.getElementById('attachment'),
        image: document.getElementById('image')
    };

    const fileValidationRules = {
        attachment: {
            types: ['pdf', 'docx', 'doc'],
            maxSize: 10485760 // 10 MB in bytes
        },
        image: {
            types: ['jpeg', 'jpg', 'png'],
            maxSize: 10485760 // 10 MB in bytes
        }
    };

    let isValid = true;
    const errorContainers = document.querySelectorAll('.error-message');
    errorContainers.forEach(container => container.textContent = '');

    // Validate file inputs
    for (const [key, fileInput] of Object.entries(fileInputs)) {
        if (fileInput && fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const { types, maxSize } = fileValidationRules[key];
            const fileType = file.name.split('.').pop().toLowerCase();
            
            if (!types.includes(fileType)) {
                document.getElementById(`${key}Error`).textContent = `Invalid file type for ${key}. Allowed types: ${types.join(', ')}`;
                isValid = false;
            }
            if (file.size > maxSize) {
                document.getElementById(`${key}Error`).textContent = `The selected file ${key} is not valid or exceeds 10 MB.`;
                isValid = false;
            }
        }
    }

    // Validate required fields and positive numbers
    const requiredFields = {
        activity_target: 'Enter Monthly Progress',
        women_target: 'Women',
        men_target: 'Men',
        boys_target: 'Boys',
        girls_target: 'Girls'
    };

    for (const [id, label] of Object.entries(requiredFields)) {
        const field = document.getElementById(id);
        if (field) {
            if (!field.value.trim()) {
                document.getElementById(`${id}Error`).textContent = `${label} is required.`;
                isValid = false;
            } else if (isNaN(field.value) || parseFloat(field.value) <= 0) {
                document.getElementById(`${id}Error`).textContent = `${label} must be a positive number.`;
                isValid = false;
            }
        } else {
            console.error(`Element with ID '${id}' not found.`);
        }
    }

    // Validate optional fields for numbers
    const optionalFields = {
        pwd_target: 'PWD/CLWD'
    };

    for (const [id, label] of Object.entries(optionalFields)) {
        const field = document.getElementById(id);
        if (field) {
            if (field.value.trim() && (isNaN(field.value) || parseFloat(field.value) < 0)) {
                document.getElementById(`${id}Error`).textContent = `${label} must be a non-negative number if provided.`;
                isValid = false;
            }
        } else {
            console.error(`Element with ID '${id}' not found.`);
        }
    }

    // Validate Completion Date
    const completeDate = document.getElementById('complete_date');
    if (completeDate) {
        if (!completeDate.value.trim()) {
            document.getElementById('complete_dateError').textContent = 'Completion Date is required.';
            isValid = false;
        }
    } else {
        console.error('Element with ID "complete_date" not found.');
    }

    if (isValid) {
        var formData = new FormData($('#add_progress_form')[0]);
        $.ajax({
            url: $('#add_progress_form').attr('action'),
            type: 'post',
            data: formData,
            processData: false,  // Prevent jQuery from automatically transforming the data into a query string
            contentType: false,  // Prevent jQuery from setting Content-Type
            beforeSend: function() {
                $('#loadingSpinner').show();
                $('#kt_add_progress_status_form').hide();
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
                    $('#loadingSpinner').hide();
                    $('#edit_progress').modal('hide');
                    $('#add_progress').modal('hide');
                    $('#kt_add_progress_status_form').show();
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
                $('#kt_add_progress_status_form').show();
            }
        });
    }
});


</script>
