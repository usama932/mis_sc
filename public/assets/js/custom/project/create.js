
flatpickr("#start_date", {
   
    dateFormat: "Y-m-d",
    maxDate: "today",
});
flatpickr("#end_date", {
  
    dateFormat: "Y-m-d",
   
});
 

var startDateInput = document.getElementById('start_date');
var endDateInput = document.getElementById('end_date');

// Check if both start date and end date inputs exist
if (startDateInput && endDateInput) {
    endDateInput.addEventListener('change', function () {
        var startDate = new Date(startDateInput.value);
        var endDate = new Date(endDateInput.value);

        // Compare start and end dates
        if (startDate.getTime() >= endDate.getTime()) {
           
              
             
              endDateInput.value = '';
              end_dateError.textContent = "End Date must be greater than Start Date";
              
              end_dateError.style.color = 'red';
              end_date.style.borderColor = "red";
              end_date.style.borderWidth = "2px";
        }else{
                end_dateError.textContent = "";
                end_date.style.borderColor = "#4b5675";
                end_date.style.borderWidth = "1px";
        }
    });
}
var KTdipValidate = function () {
    // Elements
    var form;
    var submitButton;


    // Handle form ajax
    var handleFormAjax = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {

                  
                    'name':{
                        validators: {
                            notEmpty: {
                                message: 'Project Name is required'
                            }
                        }
                    },
                   
                    'focal_person':{
                        validators: {
                            notEmpty: {
                                message: 'Focal Person is required'
                            }
                        }
                    },
                     
                    'award_person':{
                        validators: {
                            notEmpty: {
                                message: 'Award Person is required'
                            }
                        }
                    },
                     
                    'budget_holder':{
                        validators: {
                            notEmpty: {
                                message: 'Budget holder Person is required'
                            }
                        }
                    },
                    'donor':{
                        validators: {
                            notEmpty: {
                                message: 'Project Donor is required'
                            }
                        }
                    },
                    'sof': {
                        validators: {
                            notEmpty: {
                                message: 'SOF Name is required'
                            },
                            regexp: {
                                regexp: /^[0-9]{8}$/,
                                message: 'SOF must be exactly 8 digits'
                            }
                        }
                    },
                    
                    
                    'type': {
                        validators: {
                            notEmpty: {
                                message: 'Type is required'
                            }
                        }
                    },
                    'start_date':{
                        validators: {
                            notEmpty: {
                                message: 'Project Start Date Required'
                            }
                        }
                    },
                    'end_date':{
                        validators: {
                            notEmpty: {
                                message: 'Project End Date Required'
                            },
                            callback: {
                                message: 'End Date must be greater than Start Date',
                                callback: function(value, validator, $field) {
                                    // Retrieve the start date value
                                    var startDate = validator.getFieldElements('start_date').val();
                    
                                    // Compare start and end dates
                                    if (startDate && value <= startDate) {
                                        return false;
                                    }
                    
                                    return true;
                                }
                            }
                        }
                    },
                },
              
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );
            
        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;


                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                        if (response) {
                            if(response.data.error == true){
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
                                toastr.error("Project already exist", "Error");
                         
                            }
                            else{
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
                                toastr.success("Project Created", "Success");
                                window.location.assign(response.data.editUrl);
                            }
                          
                            
                        } else {
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
                              
                              toastr.error("Some thing Went Wrong", "Error");
                        }
                    }).catch(function (error) {
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
                          
                          toastr.error("Some thing Went Wrong", "Error");   
                    }).then(() => {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;
                    });

                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
                      
                      toastr.error("Some thing Went Wrong", "Error");
                }
            });
        });

    }

    // Public functions
    return {
        // Initialization
        init: function () {
            // Elements
            form = document.querySelector('#create_project');
            submitButton = document.querySelector('#kt_create_project');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTdipValidate.init();
});