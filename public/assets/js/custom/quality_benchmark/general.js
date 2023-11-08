$('#date_visit').flatpickr({
    altInput: true,
    dateFormat: "Y-m-d",
    maxDate: new Date().fp_incr(+4),
    minDate: new Date().fp_incr(-30),
});
"use strict";


//Create QB Data
// ----------------Start Create Qbs date------------------
var KTQBValidate = function () {
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
                    'theme':{
                        validators: {
                            notEmpty: {
                                message: 'theme required'
                            }
                        }
                    },
                    'qb_filledby':{
                        validators: {
                            notEmpty: {
                                message: 'Filled By required'
                            }
                        }
                    },
                    'sub_theme':{
                        validators: {
                            notEmpty: {
                                message: 'Sub Theme By required'
                            }
                        }
                    },
                    'project_name':{
                        validators: {
                            notEmpty: {
                                message: 'Project Name is required'
                            }
                        }
                    },
                    'partner':{
                        validators: {
                            notEmpty: {
                                message: 'Partner is required'
                            }
                        }
                    },
                  
                    'province':{
                        validators: {
                            notEmpty: {
                                message: 'Province Name required'
                            }
                        }
                    },
                    'district':{
                        validators: {
                            notEmpty: {
                                message: 'District Name required'
                            }
                        }
                    },
                    'tehsil':{
                        validators: {
                            notEmpty: {
                                message: 'Tehsil required'
                            }
                        }
                    },
                    'union_counsil':{
                        validators: {
                            notEmpty: {
                                message: 'Union Counsil required'
                            }
                        }
                    },
                    'project_type':{
                        validators: {
                            notEmpty: {
                                message: 'Project Type required'
                            }
                        }
                    },

                    'type_of_visit':{
                            validators: {
                                notEmpty: {
                                    message: 'Visit Type required'
                                }
                        }
                    },
                  
                    'activity_description':{
                        validators: {
                            notEmpty: {
                                message: 'Description  required'
                            }
                        }
                    },
                    'monitoring_type':{
                        validators: {
                            notEmpty: {
                                message: 'Monitoring Type required'
                            }
                        }
                    },
                    'accompanied_by':{
                        validators: {
                            notEmpty: {
                                message: 'Accompanied by required'
                            }
                        }
                    },
                    'date_visit':{
                        validators: {
                            notEmpty: {
                                message: 'Date Visit required'
                            }
                        }
                    },
                    'total_qbs':{
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            numeric: {
                                message: 'Must be a number'
                            }
                        }
                    },
                    'qbs_fully_met':{
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            numeric: {
                                message: 'Must be a number'
                            }
                        }
                    },
                    'qb_not_applicable':{
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            numeric: {
                                message: 'Must be a number'
                            }
                        }
                    },
                    'visit_staff_name':{
                        validators: {
                            notEmpty: {
                                message: 'Staff Name required'
                            }
                        }
                    },
                    'staff_organization':{
                        validators: {
                            notEmpty: {
                                message: 'Staff Organization required'
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
                            toastr.success("QB  Created", "success");
                            window.location.href = response.data.editUrl;
                            
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
            form = document.querySelector('#qb_form');
            submitButton = document.querySelector('#kt_qb_submit');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    
    KTQBValidate.init();
});


// ----------------End Create Qbs date------------------



