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
            <input type="text" name="women_target" value="" class="form-control"  placeholder="Women">
            <div id="women_targetError" class="error-message text-danger"></div>
       
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Men</span>
            </label>
            <input type="text" name="men_target" value="" class="form-control"  placeholder="Men">
            <div id="men_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Girls</span>
            </label>
            <input type="text" name="girls_target" value="" class="form-control"  placeholder="Girls">
            <div id="girls_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="required">Boys</span>
            </label>
            <input type="text" name="boys_target" value="" class="form-control" placeholder="Boys" >
            <div id="boys_targetError" class="error-message text-danger" ></div>
        </div> 
        <div class="fv-row col-md-2 mt-3">
            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                <span>PWD</span>
            </label>
            <input type="text" name="pwd_target" id="pwd_target" class="form-control" >
            <div id="pwd_targetError" class="error-message text-danger" ></div>
        </div>
        <div class="fv-row col-md-12 mt-3">
            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                <span class="">Remarks</span>
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
</script>
<script>
   
    document.getElementById('add_progress_form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        var submitButton = $('#kt_add_progress_status_form');
       
        const form = this;
        const formValidationRules = {
            quarter: {
                validators: {
                    notEmpty: {
                        message: 'Quarter is required'
                    }
                }
            },
            activity_target: {
                validators: {
                    notEmpty: {
                        message: 'Activity Target is required'
                    },
                    numeric: {
                        message: 'Activity Target must be a number'
                    },
                    regexp: {
                        regexp: /^\d+$/,
                        message: 'Activity Target must be a positive number'
                    }
                }
            },
            complete_date: {
                validators: {
                    notEmpty: {
                        message: 'Complete date  is required'
                    },
                
                }
            },
            'women_target': {
                validators: {
                    notEmpty: {
                        message: 'Women Target  is required'
                    },
                    numeric: {
                        message: 'Women Target  is must number'
                    },
                    regexp: {
                        regexp: /^\d+$/,
                        message: 'Individual Target must be a positive number'
                    }
                }
            },
            'men_target': {
                validators: {
                    notEmpty: {
                        message: 'Men Target is required'
                    },
                    numeric: {
                        message: 'Men Target  is must number'
                    },
                    regexp: {
                        regexp: /^\d+$/,
                        message: 'Individual Target must be a positive number'
                    }
                }
            },
            'girls_target': {
                validators: {
                    notEmpty: {
                        message: 'Girls Target is required'
                    },
                    numeric: {
                        message: 'Girls Target  is must number'
                    },
                    regexp: {
                        regexp: /^\d+$/,
                        message: 'Individual Target must be a positive number'
                    }
                }
            },
            'boys_target': {
                validators: {
                    notEmpty: {
                        message: 'Boys Target is required'
                    },
                    numeric: {
                        message: 'Boys Target  is must number'
                    },
                    regexp: {
                        regexp: /^\d+$/,
                        message: 'Individual Target must be a positive number'
                    }
                }
            },
            'remarks': {
                validators: {
                    notEmpty: {
                        message: 'Remarks Target is required'
                    },
                }
            },
            'attachment': {
                validators: {
                    notEmpty: {
                        message: 'Attachment is required'
                    }
                },
                
            },
            'image': {
                validators: {
                    notEmpty: {
                        message: 'Image is required'
                    }
                }
            },
        };
        const errorContainers = document.querySelectorAll('.error-message');
        errorContainers.forEach(container => container.textContent = '');
    
        let isValid = true;
        for (const field in formValidationRules) {
            const fieldElement = form.elements[field];
            const fieldRules = formValidationRules[field].validators;
    
            let errorContainer = fieldElement.parentNode ? fieldElement.parentNode.querySelector('.error-message') : null;
            if (errorContainer) {
                // Check for required field
                if (fieldRules.notEmpty && !fieldElement.value.trim()) {
                    errorContainer.textContent = fieldRules.notEmpty.message;
                    isValid = false;
                }
    
                // Check for numeric field
                if (fieldRules.numeric && isNaN(fieldElement.value)) {
                    errorContainer.textContent = fieldRules.numeric.message;
                    isValid = false;
                }
    
                // Check for positive integer (regexp validation)
                if (fieldRules.regexp) {
                    const regex = new RegExp(fieldRules.regexp.regexp);
                    if (!regex.test(fieldElement.value)) {
                        errorContainer.textContent = fieldRules.regexp.message;
                        isValid = false;
                    }
                }
            }
        }
    
        if (isValid) {
            submitButton.prop('disabled', true).addClass('disabled-blur');
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Form submitted successfully:', data);
                // Reset the form
                
                form.reset();
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
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
                
                toastr.success("Quarterly achievement updated succesfully", "Success");
                $('#add_progress').modal('hide');
                window.location.href = window.location.href;
                submitButton.prop('disabled', false).removeClass('disabled-blur');
            })
            .catch(error => {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
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
                submitButton.prop('disabled', false).removeClass('disabled-blur');
                toastr.success("Error submitting progress", "Success");
                console.error('Error submitting form:', error);
                
            });
        }
    });
 
</script>
