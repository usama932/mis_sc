//form  Validation
var KTbeneficiaryassessmentValidate = function () {
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

                  
                    'project':{
                        validators: {
                            notEmpty: {
                                message: 'Project Name is required'
                            }
                        }
                    },
                   
                    'date':{
                        validators: {
                            notEmpty: {
                                message: 'Date is required'
                            }
                        }
                    },

                    'province':{
                        validators: {
                            notEmpty: {
                                message: 'Province is required'
                            }
                        }
                    },
                     
                    'district':{
                        validators: {
                            notEmpty: {
                                message: 'District is required'
                            }
                        }
                    },
                     
                    'tehsil':{
                        validators: {
                            notEmpty: {
                                message: 'Tehsil is required'
                            }
                        }
                    },

                    'uc':{
                        validators: {
                            notEmpty: {
                                message: 'UC is required'
                            }
                        }
                    },

                    'village': {
                        validators: {
                            notEmpty: {
                                message: 'Village is required'
                            },
                        }
                    },
                    
                    'name_of_beneficiary': {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },

                    'guardian':{
                        validators: {
                            notEmpty: {
                                message: 'Father/Husband is Required'
                            }
                        }
                    },

                    'gender':{
                        validators: {
                            notEmpty: {
                                message: 'Gender is Required'
                            }
                        }
                    },

                    'age':{
                        validators: {
                            notEmpty: {
                                message: 'Age is Required'
                            }
                        }
                    },

                    'beneficiary_contact':{
                        validators: {
                            notEmpty: {
                                message: 'Age is Required'
                            }
                        }
                    },

                    'contact_number':{
                        validators: {
                            notEmpty: {
                                message: 'Contact Number is Required'
                            },
                            numeric: {
                                message: 'Boys acheivement  is must number'
                            },
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
            
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTbeneficiaryassessmentValidate.init();
});