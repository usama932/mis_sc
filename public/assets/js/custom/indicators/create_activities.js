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
    $('#indicatorId').on('change', function() {
        let indicatorId = $(this).val();
       
        // Clear the activities dropdown
        $('#activities').empty().append('<option value="">Select Activities</option>');

        // If no indicator is selected, return early
        if (!indicatorId) return;

        // Make AJAX request to fetch activities based on the selected indicator
        $.ajax({
            url: '/get-activities', // Route to the controller
            type: 'GET',
            data: { indicatorId: indicatorId },
            success: function(response) {
                // Populate activities dropdown with response data
                $.each(response.activities, function(key, activity) {
                    $('#activities').append(
                        `<option value="${activity.id}">${activity.activity_title}</option>`
                    );
                });
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});



