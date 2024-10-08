// Datatables
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Project theme Form Validations
var KTdipActivityValidate = function () {
    // Elements
    var form;
    var submitButton;

    // Handle form ajax
    var handleFormAjax = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation: https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'activity_number': {
                        validators: {
                            notEmpty: {
                                message: 'Activity is required'
                            },
                            regexp: {
                                regexp: /^(?:(?:[1-9]\.\d+)|(?:[1-9](?:\.\d+)+))$/,
                                message: 'Enter decimal like 1.1, 1.2, etc.'
                            }
                        }
                    },
                    'activity': {
                        validators: {
                            notEmpty: {
                                message: 'Activity is required'
                            }
                        }
                    },
                    'theme': {
                        validators: {
                            notEmpty: {
                                message: 'Theme is required'
                            }
                        }
                    },
                    'sub_theme': {
                        validators: {
                            notEmpty: {
                                message: 'Sub-Theme is required'
                            }
                        }
                    },
                    'activity_category': {
                        validators: {
                            notEmpty: {
                                message: 'Activity Category is required'
                            }
                        }
                    },
                    'sub_theme': {
                        validators: {
                            notEmpty: {
                                message: 'Activity Type is required'
                            }
                        }
                    },
                    'lop_target': {
                        validators: {
                            notEmpty: {
                                message: 'LOP Target is required'
                            },
                            numeric: {
                                message: 'LOP Targets must be a number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'LOP Target must be a positive number'
                            }
                        }
                    },
                    'activities[][quarter]': {
                        validators: {
                            notEmpty: {
                                message: 'Activity Target is required'
                            },
                            numeric: {
                                message: 'Activity Target must be a number'
                            }
                        }
                    },
                    'activities[][target_benefit]': {
                        validators: {
                            notEmpty: {
                                message: 'Beneficiaries Target is required'
                            },
                            numeric: {
                                message: 'Beneficiaries Target must be a number'
                            }
                        }
                    }
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
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            var emptyFields = [];
            var isValid = true;

            // Check array fields for validation
            var arrayFields = form.querySelectorAll('input[name^="activities["]');
            arrayFields.forEach(function (field) {
                var fieldValue = field.value.trim();
                if (fieldValue === '') {
                    isValid = false;
                    emptyFields.push(field);
                }
            });

            // If any field is empty, prevent form submission and display errors
            if (!isValid) {
                toastr.error('Please update all highlighted fields', 'Error');

                // Highlight all empty fields
                emptyFields.forEach(function (field) {
                    field.classList.add('highlight-field');
                });

                return;
            }

            validator.validate().then(function (status) {

                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
                        if (response) {
                            if (response.data.error == true) {
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
                                toastr.success("Activity & quarterly targets added successfully", "Success");
                                form.reset();

                                window.location.href = response.data.editUrl;
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

                    toastr.error("Please address the highlighted Errors", "Error");
                }
            });
        });

    };

    // Public functions
    return {
        // Initialization
        init: function () {
            // Elements
            form = document.querySelector('#create_dip_activity');
            submitButton = document.querySelector('#kt_create_dip_activity');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTdipActivityValidate.init();
});
