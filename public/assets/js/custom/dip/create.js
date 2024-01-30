

document.getElementById('districtloader').style.display = 'none';
$("#create_projecttheme").hide();
$("#create_projectpartner").hide();
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
var KTdipValidate = function () {
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

                 
                    
                 
                    // 'individual_targets': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Individual Targets is required'
                    //         },
                    //         numeric: {
                    //             message: 'Individual Target must be a number'
                    //         }
                    //     }
                    // },
                    // 'pwd_targets': {
                    //     validators: {
                            
                    //         numeric: {
                    //             message: 'PWD Target must be a number'
                    //         }
                    //     }
                    // },
                    // 'male_targets': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Male Target is required'
                    //         },
                    //         numeric: {
                    //             message: 'Male Target must be a number'
                    //         }
                    //     }
                    // },
                    // 'female_targets': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Female Target is required'
                    //         },
                    //         numeric: {
                    //             message: 'Female Target must be a number'
                    //         }
                    //     }
                    // },
                    // 'girls_targets': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Girls Target is required'
                    //         },
                    //         numeric: {
                    //             message: 'Girls Target must be a number'
                    //         }
                    //     }
                    // },
                    // 'boys_targets': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Boys Target is required'
                    //         },
                    //         numeric: {
                    //             message: 'Boys Target must be a number'
                    //         }
                    //     }
                    // },
                    'project_description': {
                        validators: {
                            notEmpty: {
                                message: 'Project Description is required'
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
                            if (response.data.error != 'true') {
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
                            }
                            else{
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
                                toastr.success("Project Detail Updated  Successfully", "Success");
                                form.reset();
                         
                                frm.ajax.reload(null, false).draw(false);
                               
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
            // Elements
            form = document.querySelector('#create_dip');
            submitButton = document.querySelector('#kt_create_dip');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTdipValidate.init();
});






