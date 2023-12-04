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
        url: '/getDistrict',
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
var KTlearninglogValidate = function () {
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

                    'title': {
                        validators: {
                            notEmpty: {
                                message: 'Title is required'
                            }
                        }
                    },
                    'project':{
                        validators: {
                            notEmpty: {
                                message: 'Project  is required'
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
                    'status':{
                        validators: {
                            notEmpty: {
                                message: 'Status required'
                            }
                        }
                    },
                    'project_type':{
                        validators: {
                            notEmpty: {
                                message: 'Project Type  is required'
                            }
                        }
                    },
                    'resource_type':{
                        validators: {
                            notEmpty: {
                                message: 'Resource Type  is required'
                            }
                        }
                    },
                    'description':{
                        validators: {
                            notEmpty: {
                                message: 'Description is required'
                            }
                        }
                    },
                   
                    'attachment':{
                        validators: {
                            notEmpty: {
                                message: 'Attachment is required'
                            }
                        }
                    }
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
                            toastr.success("Learning Log  Created", "success");
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
            form = document.querySelector('#learninglog');
            submitButton = document.querySelector('#kt_learninglog');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTlearninglogValidate.init();
});