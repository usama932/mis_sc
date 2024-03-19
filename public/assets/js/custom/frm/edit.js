$(function () {
    $('[name="date_feedback_referred"]').change(function(){

        var date_recieved_id =  document.getElementById("date").innerHTML;
        var originalDateString = $("#date_feedback_referred").val();
     
       
        if(originalDateString >= date_recieved_id) {
            //Do something..
        }
        else{
            swal.fire({
                    text: "Sorry, Date Reffered Must be Greater Than Date Recieved.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                }).then(function () {
                    KTUtil.scrollTop();

                // $('#exampleModal').modal('hide');
                // console.log("invalid");
                });
        }

    });
});
var KTFRMValidate = function () {
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
                    'name_of_registrar':{
                        validators: {
                            notEmpty: {
                                message: 'Name Registrar is required'
                            }
                        }
                    },
                    'date_received':{
                        validators: {
                            notEmpty: {
                                message: 'date recieved is required'
                            }
                        }
                    },
                    'feedback_channel':{
                        validators: {
                            notEmpty: {
                                message: 'Channel is required'
                            }
                        }
                    },
                    'name_of_client':{
                        validators: {
                            notEmpty: {
                                message: 'nName is required'
                            }
                        }
                    },
                    'type_of_client':{
                        validators: {
                            notEmpty: {
                                message: 'Type of required'
                            }
                        }
                    },
                    'gender':{
                        validators: {
                            notEmpty: {
                                message: 'Gender required'
                            }
                        }
                    },
                    'age':{
                        validators: {
                            notEmpty: {
                                message: 'Age required'
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
                    'tehsil':{
                        validators: {
                            notEmpty: {
                                message: 'Tehsil required'
                            }
                        }
                    },
                    'union_counsil':{
                        validators: {
                            notEmpty: {
                                message: 'union counsil required'
                            }
                        }
                    },
                    'pwd_clwd':{
                        validators: {
                            notEmpty: {
                                message: 'Pwd/Clwd required'
                            }
                        }
                    },

                    'allow_contact':{
                            validators: {
                                notEmpty: {
                                    message: 'allow_contact required'
                                }
                        }
                    },
                    'contact_number': {
                        validators: {
                            callback: {
                                message: 'Contact number is required',
                                callback: function(value, validator, $field) {
                                    // Check if 'Yes' is selected for allow_contact
                                    var allowContactYes = $('input[name="allow_contact"]:checked').val() === 'Yes';
                                    var contact_number = document.getElementById('contact_number').value;
                                    
                                    // Check if allow_contact is 'Yes' and contact_number is empty
                                    if (allowContactYes === true && contact_number === '') {
                                       
                                        return false;
                                        
                                    }
                                    return true;
                                    
                                }
                            }
                        }
                    },
                    
                    'feedback_description':{
                        validators: {
                            notEmpty: {
                                message: 'feedback description required'
                            }
                        }
                    },
                    'feedback_category':{
                        validators: {
                            notEmpty: {
                                message: 'feedback category required'
                            }
                        }
                    },
                    'datix_number': {
                        validators: {
                            callback: {
                                message: 'datix number is required',
                                callback: function(value, validator, $field) {
                                    var categoryValue = $('#feedback_category').val();
                                    var datix_number = $('#datix_number').val();

                                    if ((categoryValue === '6' || categoryValue === '7' ) && datix_number === '') {
                                        return false;
                                    }
                                    
                                    return true;
                                }
                            }
                        }
                    },
                    
                    'theme':{
                        validators: {
                            notEmpty: {
                                message: 'theme required'
                            }
                        }
                    },
                    'feedback_activity':{
                        validators: {
                            notEmpty: {
                                message: 'feedback activity required'
                            }
                        }
                    },
                    'feedback_referredorshared':{
                        validators: {
                            notEmpty: {
                                message: 'feedback_referred  required'
                            }
                        }
                    },
                    'date_feedback_referred': {
                        validators: {
                            callback: {
                              
                                message: 'Date of feedback Referred is required',
                                callback: function(value, validator) {
                                   
                                    var feedbackReferred = document.getElementById('feedback_referredorshared').value;
                                    var date_feedback_referred = document.getElementById('date_feedback_referred').value;
                                    if (feedbackReferred === 'Yes' && date_feedback_referred === '' || date_feedback_referred == null) {
                                        return false;
                                    }
                                    
                                }
                            }
                        }
                    },
                    'refferal_name': {
                        validators: {
                            callback: {
                                message: 'Referred To (Name) is required',
                                callback: function(value, validator) {
                                    var feedbackReferred = document.getElementById('feedback_referredorshared').value;
                                    var refferal_name = document.getElementById('refferal_name').value;
                                    if (feedbackReferred === 'Yes' &&  refferal_name === '' || refferal_name == null) {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    'refferal_position': {
                        validators: {
                            callback: {
                                message: 'Referred To (Position) is required',
                                callback: function(value, validator) {
                                    var feedbackReferred = document.getElementById('feedback_referredorshared').value;
                                    var refferal_position = document.getElementById('refferal_position').value;
                                    if (feedbackReferred === 'Yes' && refferal_position === '' || refferal_position == null) {
                                        return false;                                       
                                    }
                                }
                            }
                        }
                    },
                    'feedback_summary': {
                        validators: {
                            callback: {
                                message: 'Description of actions undertaken is required',
                                callback: function(value, validator) {
                                    var feedbackReferred = document.getElementById('feedback_referredorshared').value;
                                    var feedback_summary = document.getElementById('feedback_summary').value;                                   
                                    if (feedbackReferred === 'Yes' && feedback_summary === '') {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    'status': {
                        validators: {
                            callback: {
                                message: 'Status is required',
                                callback: function(value, validator) {
                                    var feedbackReferred = document.getElementById('feedback_referredorshared').value;
                                    var status = document.getElementById('status').value;
                                    if (feedbackReferred === 'No' && status === '') {
                                        return false;
                                    }
                                    return true;
                                }
                            }
                            
                        }
                    },
                    'actiontaken': {
                        validators: {
                            callback: {
                                message: 'Satisfiction error  is required',
                                callback: function(value, validator) {
                                    var status = document.getElementById('status').value;
                                    var action_id = document.getElementById('action_id').value;
                                    
                                    if (status === 'Close' &&  action_id === '') {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
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
                              
                            toastr.success("Record Updated", "success");
                            const redirectUrl = form.getAttribute('data-kt-redirect-url');

                            if (redirectUrl) {
                                location.href = redirectUrl;
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
            form = document.querySelector('#frm_form');
            submitButton = document.querySelector('#kt_btn_submit');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTFRMValidate.init();
});