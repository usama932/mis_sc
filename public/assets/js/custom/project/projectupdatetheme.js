



//project update theme Form Validations

var KTprojectupdateValidate = function() {
    // Elements
    var form;
    var submitButton;


    // Handle form ajax
    var handleFormAjax = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'house_hold_target': {
                        validators: {
                            notEmpty: {
                                message: 'House Hold Targets is required'
                            },
                            numeric: {
                                message: 'House Hold Targets must be a number'
                            }
                        }
                    },
                    'individual_target': {
                        validators: {
                            notEmpty: {
                                message: 'Individual Target is required'
                            },
                            numeric: {
                                message: 'Individual Target must be a number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Individual Target must be a positive number'
                            }
                        }
                    },
                    'women_target': {
                        validators: {
                            notEmpty: {
                                message: 'Men Target is required'
                            },
                            numeric: {
                                message: 'Men Target must be a number'
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
                                message: 'Men Target must be a number'
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
                                message: 'Girls Target must be a number'
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
                                message: 'Boys Target must be a number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Individual Target must be a positive number'
                            }
                        }
                    },
                    'pwd_target': {
                        validators: {

                            numeric: {
                                message: 'PWD Target must be a number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Individual Target must be a positive number'
                            }
                        }
                    },

                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '', // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );

        // Handle form submit
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();
            validator.validate().then(function(status) {

                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;


                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function(response) {
                        if (response) {
                            if (response.data.error == 'true') {
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
                                toastr.error(response.data.message, "Error");
                            } else {
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
                                toastr.success("Theme Added Successfully", "Success");
                                form.reset();
                                window.location.assign(response.data.editUrl);
                                project_theme.ajax.reload(null, false).draw(false);
                                $("#create_projecttheme").slideToggle();
                                $("#project_theme_table").slideToggle();
                                $("#addprojectthemeBtn").show();
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

                            toastr.error(error);
                        }
                    }).catch(function(error) {
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

                        toastr.error(error, "Some  Error");
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
        init: function() {
            // Elements
            form = document.querySelector('#update_projecttheme');
            submitButton = document.querySelector('#kt_update_projecttheme');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function() {

    KTprojectupdateValidate.init();
});


