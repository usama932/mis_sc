var baseURL = window.location.origin;
document.getElementById('tehsilloader').style.display = 'none';
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$("#select2_profile_district").change(function () {
    var value = $(this).val();
    var project = document.getElementById('project_id').value || '';
    csrf_token = $('[name="_token"]').val();
    document.getElementById('tehsilloader').style.display = 'block';
  
    $.ajax({
        type: 'POST',
        url: '/getprofiletehsil',
        data: {'district': value, _token: csrf_token,'project': project },
        dataType: 'json',
        success: function (data) {
            document.getElementById('tehsilloader').style.display = 'none';
            $("#kt_select2_tehsil").empty();
            $("#kt_select2_tehsil").prepend("<option value=''>Select Tehsil</option>");
            $.each(data, function (i, item) {
                $("#kt_select2_tehsil").append("<option value='" + item.id + "'>" +
                    item.tehsil_name.replace(/_/g, ' ') + "</option>");
            });
        }
    });
});
document.getElementById('ucloader').style.display = 'none';
$("#kt_select2_tehsil").change(function () {
    var value = $(this).val();
    var project = document.getElementById('project_id').value || '';
    csrf_token = $('[name="_token"]').val();
    document.getElementById('ucloader').style.display = 'block';
  
    $.ajax({
        type: 'POST',
        url: '/getprofileuc',
        data: {'tehsil': value, _token: csrf_token,'project': project },
        dataType: 'json',
        success: function (data) {
           
            document.getElementById('ucloader').style.display = 'none';
            $("#kt_select2_uc").empty();
            $("#kt_select2_uc").prepend("<option value=''>Select UC</option>");
            $.each(data, function (i, item) {
               
                $("#kt_select2_uc").append("<option value='" + item.union_id + "'>" +
                    item.uc_name.replace(/_/g, ' ') + "</option>");
            });
        }
    });
});

var KTprojectprofileValidate = function() {
    // Elements
    var form;
    var submitButton;


    // Handle form ajax
    var handleFormAjax = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    'theme': {
                        validators: {
                            notEmpty: {
                                message: 'Theme is required'
                            },
                        }
                    },
                    'district[]': {
                        validators: {
                            notEmpty: {
                                message: 'district is required'
                            },
                         
                          
                        }
                    },
                    'tehsil[]': {
                        validators: {
                            notEmpty: {
                                message: 'Tehsil is required'
                            }
                        }
                    },
                    'uc[]': {
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
                    submitButton.disabled = true;
                    
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
                                toastr.error(response.data.message, "Duplicate Entry");
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
                                toastr.success("Profile updated Successfully", "Success");
                           
                               
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
            form = document.querySelector('#edit_projectprofile');
            submitButton = document.querySelector('#kt_edit_profile');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {

    KTprojectprofileValidate.init();
});
