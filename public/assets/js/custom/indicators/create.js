document.addEventListener("DOMContentLoaded", function() {
    const actualPeriodicitySelect = document.getElementById("actualPeriodicity");
    const annualTargetField = document.getElementById("annualTargetField");
    const quarterlyTargetField = document.getElementById("quarterlyTargetField");
    const monthlyTargetField = document.getElementById("monthlyTargetField");

    function updateTargetFields() {
        const selectedValue = actualPeriodicitySelect.value;

        // Hide all target fields by default
        annualTargetField.style.display = "none";
        quarterlyTargetField.style.display = "none";
        monthlyTargetField.style.display = "none";

        // Show the appropriate target field based on selection
        if (selectedValue === "Annually") {
            annualTargetField.style.display = "block";
        } else if (selectedValue === "Quarterly") {
            quarterlyTargetField.style.display = "block";
        } else if (selectedValue === "Monthly") {
            monthlyTargetField.style.display = "block";
        }
    }

    // Run on page load and when the selection changes
    actualPeriodicitySelect.addEventListener("change", updateTargetFields);
});

$('#projectId, .select2').select2({
    allowClear: true
});

// Form Validation
var csrfToken = $('meta[name="csrf-token"]').attr('content');
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
                    'project': {
                        validators: {
                            notEmpty: {
                                message: 'Project is required'
                            }
                        }
                    },
                    'theme[]': {
                        validators: {
                            notEmpty: {
                                message: 'Theme is required'
                            }
                        }
                    },
                    'subtheme[]': {
                        validators: {
                            notEmpty: {
                                message: 'Sub-Theme is required'
                            }
                        }
                    },
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
                    'disaggregation': {
                        validators: {
                            notEmpty: {
                                message: 'Disaggregation is required'
                            }
                        }
                    },
                    'baseline': {
                        validators: {
                            notEmpty: {
                                message: 'Baseline is required'
                            },
                            numeric: {
                                message: 'Baseline  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Baseline must be a positive number'
                            }
                        }
                    },
                    'annual_target': {
                        validators: {
                            notEmpty: {
                                message: 'Annual Target is required'
                            },
                            numeric: {
                                message: 'Annual Target  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Annual Target must be a positive number'
                            }
                        }
                    },
                    'quarterly_target': {
                        validators: {
                            notEmpty: {
                                message: 'Annual Target is required'
                            },
                            numeric: {
                                message: 'Annual Target  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Annual Target must be a positive number'
                            }
                        }
                    },
                    'monthly_target': {
                        validators: {
                            notEmpty: {
                                message: 'Annual Target is required'
                            },
                            numeric: {
                                message: 'Annual Target  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'Annual Target must be a positive number'
                            }
                        }
                    },
                    'overall_lop_target': {
                        validators: {
                            notEmpty: {
                                message: 'OverAll Lop Target is required'
                            },
                            numeric: {
                                message: 'OverAll Lop Target  is must number'
                            },
                            regexp: {
                                regexp: /^\d+$/,
                                message: 'OverAll Lop Target must be a positive number'
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
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
        
                    axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form))
                        .then(function (response) {
                            if (response.data.status === 'success') {
                                toastr.success("Indicator Created", "Success");
        
                                // Redirect to the index page or any other page
                                window.location.href = submitButton.getAttribute('data-kt-redirect-url'); //he actual URL where you want to redirect the user
                            } else {
                                toastr.error("Something went wrong", "Error");
                            }
                        })
                        .catch(function (error) {
                            toastr.error("Validation failed", "Error");
                            if (error.response.status === 422) {
                                // Show field errors
                                Object.keys(error.response.data.errors).forEach(function (field) {
                                    handleValidationFailure(field, validator);
                                });
                            }
                        })
                        .then(() => {
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;
                        });
                } else {
                    toastr.error("Please address the highlighted errors ", "Error");
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


//Get theme 
$('#projectId').on('change', function () {
    var project = $(this).val(); // Get selected project ID
    var themeSelect = $('#themeSelect');
    var subthemeSelect = $('#subthemeSelect');
  
    // Clear previous theme options
    themeSelect.empty().append('<option value="">Select theme</option>');
    subthemeSelect.empty().append('<option value="">Select Subtheme</option>');
    // Add CSRF token for Laravel's protection if required
    

    $.ajax({
        url: '/getprojecttheme', // Adjust URL to your actual route
        method: 'POST', // Use 'POST' for sending data
        data: {
            project_id: project // Send selected project to the server
        },
        headers: {
            'X-CSRF-TOKEN': csrfToken // Add CSRF token for Laravel security
        },
        success: function (response) {
            console.log(response.themes);
            if (response.themes && response.themes.length > 0) {
                $.each(response.themes, function (index, theme) {
                    themeSelect.append('<option value="' + theme.id + '">' + theme.name + '</option>');
                });
            } else {
                themeSelect.append('<option value="">No theme available</option>');
            }
            // Re-initialize select2 to refresh the dropdown
            themeSelect.select2();
        },
        error: function (xhr, status, error) {
            console.error(error);
            toastr.error("Error fetching themes", "Error");
        }
    });
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

