
var KTupdateProgressValidate = function () {
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

                  
                   
                    'quarter':{
                        validators: {
                            notEmpty: {
                                message: 'Quarter  is required'
                            }
                        }
                    },
                    'pwd_target': {
                        validators: {
                            notEmpty: {
                                message: 'Pwd Target is required'
                            },
                            numeric: {
                                message: 'Pwd Target must be a number'
                            },
                        }
                    },
                    'activity_target':{
                        validators: {
                            notEmpty: {
                                message: 'Activity Target  is required'
                            },
                            numeric:{
                                message: 'Activity Target  is must number'
                            },
                          
                        }
                    },
                    'women_target':{
                        validators: {
                            notEmpty: {
                                message: 'Women Target  is required'
                            },
                            numeric:{
                                message: 'Women Target  is must number'
                            },
                        
                        }
                    },
                    'men_target':{
                        validators: {
                            notEmpty: {
                                message: 'Men Target is required'
                            },
                            numeric:{
                                message: 'Men Target  is must number'
                            },
                            
                        }
                    },
                    'girls_target':{
                        validators: {
                            notEmpty: {
                                message: 'Girls Target is required'
                            },
                            numeric:{
                                message: 'Girls Target  is must number'
                            },
                           
                        }
                    },
                    'boys_target':{
                        validators: {
                            notEmpty: {
                                message: 'Boys Target is required'
                            },
                            numeric:{
                                message: 'Boys Target  is must number'
                            },
                            
                        }
                    },
                    'attachment':{
                        validators: {
                            notEmpty: {
                                message: 'Attachment is required'
                            }
                        }
                    },
                    'image':{
                        validators: {
                            notEmpty: {
                                message: 'Image is requried'
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
                            toastr.success("Account Created", "success");
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
            form = document.querySelector('#update_progress');
            submitButton = document.querySelector('#kt_update_progress');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTupdateProgressValidate.init();
});