// Update Status of action Point
flatpickr("#datepicker", {
    dateFormat: "m Y", // Display format
    minDate: "2023-01", // Minimum allowed date
    maxDate: "2030-12", // Maximum allowed date
    defaultDate: "today", // Default selected date
    mode: "single", // Only allow selecting one date
    showMonths: 1, // Show only one month
  });
document.getElementById('districtloader').style.display = 'none';
$("#kt_select2_province").change(function () {
   
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    document.getElementById('districtloader').style.display = 'block';
    $.ajax({
        type: 'POST',
        url: '/getlearningDistrict',
        data: {'province': value, _token: csrf_token },
        dataType: 'json',
        success: function (data) {
            document.getElementById('districtloader').style.display = 'none';
            $("#kt_select2_district").find('option').remove();
            $("#kt_select2_district").prepend("<option value='' >Select District</option>");
            var selected='';
            $.each(data, function (i, item) {

                $("#kt_select2_district").append("<option value='" + item.district_id + "' "+selected+" >" +
                item.district_name.replace(/_/g, ' ') + "</option>");
            });
            $('#kt_select2_tehsil').html('<option value="">Select Tehsil</option>');
            $('#kt_select2_union_counsil').html('<option value=""> Select UC</option>');

        }

    });

});

document.getElementById('projectloader').style.display = 'none';
$("#project").change(function () {
   
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    document.getElementById('projectloader').style.display = 'block';
    $.ajax({
        type: 'POST',
        url: '/getproject_type',
        data: {'project_name': value, _token: csrf_token },
        dataType: 'json',
        success: function (data) {
            document.getElementById('projectloader').style.display = 'none';

            $("#project_type").val(data.type.replace(/_/g, ' '));
           
        }

    });

});

document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('#learninglog');
    var submitButton = document.querySelector('#kt_learninglog');
    var cliCheckbox = document.querySelector('#cli');
    var fieldsToToggle = [
        '#project-field',
        '#project_type-field',
        '#research_type-field',
        '#theme-field',
        '#province-field',
        '#district-field',
        '#status-field'
    ];

    var validator = FormValidation.formValidation(
        form,
        {
            fields: {
                'title': {
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                'project': {
                    validators: {
                        notEmpty: {
                            message: 'Project is required'
                        }
                    }
                },
                'province[]': {
                    validators: {
                        notEmpty: {
                            message: 'Province Name is required'
                        }
                    }
                },
                'district[]': {
                    validators: {
                        notEmpty: {
                            message: 'District Name is required'
                        }
                    }
                },
                'status': {
                    validators: {
                        notEmpty: {
                            message: 'Status is required'
                        }
                    }
                },
                'project_type': {
                    validators: {
                        notEmpty: {
                            message: 'Project Type is required'
                        }
                    }
                },
                'research_type': {
                    validators: {
                        notEmpty: {
                            message: 'Research Type is required'
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
                'attachment': {
                    validators: {
                        notEmpty: {
                            message: 'Attachment is required'
                        }
                    }
                },
                'description': {
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
                        }
                    }
                },
                'thumbnail': {
                    validators: {
                        notEmpty: {
                            message: 'Thumbnail is required'
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: '.form-group',
                    eleInvalidClass: '',
                    eleValidClass: ''
                })
            }
        }
    );

    function toggleFields() {
        var isCliChecked = cliCheckbox.checked;

        fieldsToToggle.forEach(function (selector) {
            var field = document.querySelector(selector);
            var input = field.querySelector('input, select');
            var errorMessage = document.querySelector(selector + 'Error');

            if (isCliChecked) {
                field.style.display = 'none';
                input.removeAttribute('required');
                if (errorMessage) errorMessage.style.display = 'none';
                
                // Remove validation rules for hidden fields
                validator.removeField(input.name);
            } else {
                field.style.display = 'block';
                input.setAttribute('required', 'required');
                if (errorMessage) errorMessage.style.display = 'block';
                
                // Re-add validation rules for visible fields
                validator.addField(input.name, {
                    validators: {
                        notEmpty: {
                            message: input.getAttribute('name') + ' is required'
                        }
                    }
                });
            }
        });
    }

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        validator.validate().then(function (status) {
            if (status === 'Valid') {
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;

                axios.post(form.getAttribute('action'), new FormData(form))
                    .then(function (response) {
                        toastr.success('Form submitted successfully!');
                        form.reset();
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    })
                    .catch(function (error) {
                        toastr.error('An error occurred while submitting the form.');
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                    });
            } else {
                toastr.error('Please fill in the required fields.');
            }
        });
    });

    cliCheckbox.addEventListener('change', toggleFields);

    // Initialize fields based on initial checkbox state
    toggleFields();
});

