
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
                                message: 'Thematic Area required'
                            }
                        }
                    },
                    'qb_filledby':{
                        validators: {
                            notEmpty: {
                                message: 'Visitor Name required'
                            }
                        }
                    },
                    'project_name':{
                        validators: {
                            notEmpty: {
                                message: 'Project required'
                            }
                        }
                    },
                    'partner':{
                        validators: {
                            notEmpty: {
                                message: 'Partner Organization required'
                            }
                        }
                    },
                  
                    'province':{
                        validators: {
                            notEmpty: {
                                message: 'Province required'
                            }
                        }
                    },
                    'district':{
                        validators: {
                            notEmpty: {
                                message: 'District required'
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
                                    message: 'Type of visit required'
                                }
                        }
                    },
                  
                    'activity_description':{
                        validators: {
                            notEmpty: {
                                message: 'Description of activity required'
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
                                message: 'only digits allowed'
                            },
							greaterThan:{
								message: 'Must be greater than 0',
								min: 1
							}
                        }
                    },
                    'qbs_fully_met': {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            numeric: {
                                message: 'only digits allowed'
                            },
							callback: {
                                message: 'Must be less or equal to total QBs',
                                callback: function (i) {
                                    var total_qbs = $('#total_qbs').val();
                                    if (parseInt(total_qbs) >= i.value) {
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    'qb_not_applicable':{
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            numeric: {
                                message: 'only digits allowed'
                            },
							callback: {
                                message: 'Met and not applicable QBs must be less then total QBs',
                                callback: function (i) {
                                    var total_qbs = $('#total_qbs').val();
									var qbs_fully_met = $('#qbs_fully_met').val();
									var _qb_count = parseInt(qbs_fully_met) + parseInt(i.value)
									console.log(total_qbs, qbs_fully_met, i.value, _qb_count)
                                    if (parseInt(total_qbs) >= _qb_count) {
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                }
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



