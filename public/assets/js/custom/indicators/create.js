// Form Validation
var KTdipValidate = function () {
    // Elements
    var form;
    var submitButton;

    // Handle form ajax
    var handleFormAjax = function (e) {
        // Init form validation rules
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'log_frame_level': {
                        validators: {
                            notEmpty: {
                                message: 'Log Frame Level is required'
                            }
                        }
                    },
                    'log_frame_result_statement': {
                        validators: {
                            notEmpty: {
                                message: 'Log Frame Result Statement is required'
                            }
                        }
                    },
                    'indicator_name': {
                        validators: {
                            notEmpty: {
                                message: 'Indicator Name is required'
                            }
                        }
                    },
                    'indicator_context_type': {
                        validators: {
                            notEmpty: {
                                message: 'Indicator Context Type is required'
                            }
                        }
                    },
                    'unit_of_measure': {
                        validators: {
                            notEmpty: {
                                message: 'Unit of Measure is required'
                            }
                        }
                    },
                    'actual_periodicity': {
                        validators: {
                            notEmpty: {
                                message: 'Actual Periodicity is required'
                            }
                        }
                    },
                    'nature': {
                        validators: {
                            notEmpty: {
                                message: 'Nature is required'
                            }
                        }
                    },
                    'data_format': {
                        validators: {
                            notEmpty: {
                                message: 'Data Format is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
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

                    // Use axios to submit the form
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
                        .then(function (response) {
                            if (response) {
                                if (response.data.error) {
                                    form.reset();
                                    toastr.error("Project already exists", "Error");
                                } else {
                                    form.reset();
                                    toastr.success("Project Created", "Success");
                                    window.location.assign(response.data.editUrl);
                                }
                            } else {
                                toastr.error("Something went wrong", "Error");
                            }
                        })
                        .catch(function (error) {
                            toastr.error("Something went wrong", "Error");
                        })
                        .then(() => {
                            // Hide loading indication
                            submitButton.removeAttribute('data-kt-indicator');
                            // Enable button
                            submitButton.disabled = false;
                        });
                } else {
                    toastr.error("Please fix the errors in the form", "Error");
                }
            });
        });
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            // Elements
            form = document.querySelector('#create_indicator'); // Update selector if needed
            submitButton = document.querySelector('#kt_create_indicator'); // Update selector if needed
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTdipValidate.init();
});

//Get Sub theme 
$('#themeSelect').on('change', function () {
  
    var selectedThemes = $(this).val(); // Get selected theme IDs
    var subthemeSelect = $('#subthemeSelect');

    // Clear previous subtheme options
    subthemeSelect.empty().append('<option value="">Select Subtheme</option>');
    
    if (selectedThemes.length > 0) {
     
        $.ajax({
            url: '/get-subthemes', // Adjust URL as needed
            method: 'GET',
            data: {
                themes: selectedThemes // Send selected themes to the server
            },
            success: function (response) {
                // Populate the subtheme select with received data
                if (response.subthemes.length > 0) {
                    $.each(response.subthemes, function (index, subtheme) {
                        subthemeSelect.append('<option value="' + subtheme.id + '">' + subtheme.name + '</option>');
                    });
                } else {
                    subthemeSelect.append('<option value="">No Subthemes Available</option>');
                }
                subthemeSelect.select2(); // Re-initialize select2 to update the dropdown
            },
            error: function (xhr, status, error) {
                console.error(error);
                toastr.error("Error fetching subthemes", "Error");
            }
        });
    }
});

