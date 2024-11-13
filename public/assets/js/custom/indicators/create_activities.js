

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
                    'indicatorId': {
                        validators: {
                            notEmpty: {
                                message: 'Indicator is required'
                            }
                        }
                    },
                    'activities[]': {
                        validators: {
                            notEmpty: {
                                message: 'Activities is required'
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
        
                                const redirectUrl = form.getAttribute('data-kt-redirect-url');

                                if (redirectUrl) {
                                    location.href = redirectUrl;
                                }
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
            form = document.querySelector('#create_indicator_activities'); // Update selector if needed
            submitButton = document.querySelector('#kt_create_indicator_activities'); // Update selector if needed
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTdipValidate.init();
});


$(document).ready(function() {
    $('#projectId').on('change', function() {
        let projectId = $(this).val();
       
        // Clear the activities dropdown
        $('#indicatorId').empty().append('<option value="">Select Indicator</option>');
        $('#activities').empty().append('<option value="">Select Activities</option>');

        // If no indicator is selected, return early
        if (!indicatorId) return;

        // Make AJAX request to fetch activities based on the selected indicator
        $.ajax({
            url: '/get-project-activities', // Route to the controller
            type: 'GET',
            data: { projectId: projectId },
            success: function(response) {
                console.log(response.activities);
                $.each(response.activities, function(key, activity) {
                    $('#activities').append(
                        `<option value="${activity.id}">${activity.activity_title}.</option>`
                    );
                });
                $.each(response.indicators, function(key, indicator) {
                    $('#indicatorId').append(
                        `<option value="${indicator.id}">${indicator.indicator_name}</option>`
                    );
                });
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});



