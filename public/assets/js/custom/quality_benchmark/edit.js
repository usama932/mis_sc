

// ----------------Start update Qbs date------------------
$('#date_visit').flatpickr({
    altInput: true,
    dateFormat: "Y-m-d",
    maxDate: "today",
    minDate: new Date().fp_incr(-60),
});
"use strict";


//Update QB data
var KTupdateValidate = function () {
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
                    'theme':{
                        validators: {
                            notEmpty: {
                                message: 'theme required'
                            }
                        }
                    },
                    'project_name':{
                        validators: {
                            notEmpty: {
                                message: 'Project Name is required'
                            }
                        }
                    },
                    'partner':{
                        validators: {
                            notEmpty: {
                                message: 'Partner is required'
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
                                message: 'Union Counsil required'
                            }
                        }
                    },
                    'project_type':{
                        validators: {
                            notEmpty: {
                                message: 'Project Type required'
                            }
                        }
                    },

                    'type_of_visit':{
                            validators: {
                                notEmpty: {
                                    message: 'Visit Type required'
                                }
                        }
                    },
                  
                    'activity_description':{
                        validators: {
                            notEmpty: {
                                message: 'Description  required'
                            }
                        }
                    },
                    'monitoring_type':{
                        validators: {
                            notEmpty: {
                                message: 'Monitoring Type required'
                            }
                        }
                    },
                    'accompanied_by':{
                        validators: {
                            notEmpty: {
                                message: 'Accompanied by required'
                            }
                        }
                    },
                    'date_visit':{
                        validators: {
                            notEmpty: {
                                message: 'Date Visit required'
                            }
                        }
                    },
                    'total_qbs':{
                        validators: {
                            notEmpty: {
                                message: 'Total QBs  required'
                            }
                        }
                    },
                    'qbs_fully_met':{
                        validators: {
                            notEmpty: {
                                message: 'QBs Fully Met required'
                            }
                        }
                    },
                    'qb_not_applicable':{
                        validators: {
                            notEmpty: {
                                message: 'QBs Not Applicable required'
                            }
                        }
                    },
                    'visit_staff_name':{
                        validators: {
                            notEmpty: {
                                message: 'Staff Name required'
                            }
                        }
                    },
                    'staff_organization':{
                        validators: {
                            notEmpty: {
                                message: 'Staff Organization required'
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
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success("QB  Updated", "success");
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
                                "timeOut": "3000",
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
                            "timeOut": "3000",
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
                        "timeOut": "3000",
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
            form = document.querySelector('#qb_update_form');
            submitButton = document.querySelector('#kt_qb_update_submit');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTupdateValidate.init();
});
// ----------------End update Qbs data------------------

// ----------------Start Monitor Qbs data------------------

"use strict";


//Monitor   QB data
var KTqbmonitorValidate = function () {
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
                    'activity_number':{
                        validators: {
                            notEmpty: {
                                message: 'Activity Number required'
                            }
                        }
                    },
                    'qbs_description':{
                        validators: {
                            notEmpty: {
                                message: 'QB Description is required'
                            }
                        }
                    },
                    'qb_met':{
                        validators: {
                            notEmpty: {
                                message: 'QB Met is required'
                            }
                        }
                    },
                    'gap_issue': {
                        validators: {
                            callback: {
                                message: 'Gap Issue  is required',
                                callback: function(value, validator) {
                                    var qb_met = document.getElementById('qb_met').value;
                                    var gap_issue = document.getElementById('gap_issue').value;
                                    
                                    if (qb_met === 'Not Fully Met' &&  gap_issue === '') {
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
                            toastr.success("QB  Created", "success");
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
            form = document.querySelector('#qb_monitor_form');
            submitButton = document.querySelector('#kt_qb_monitor_submit');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTqbmonitorValidate.init();
});
// ----------------End Monitor   Qbs date------------------

//Action Point   QB data
var KTqbactionpointValidate = function () {
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
                    'activity_number':{
                        validators: {
                            notEmpty: {
                                message: 'Activity Number required'
                            }
                        }
                    },
                    'db_note':{
                        validators: {
                            notEmpty: {
                                message: 'brief Description is required'
                            }
                        }
                    },
                    'action_agree':{
                        validators: {
                            notEmpty: {
                                message: 'QB Met is required'
                            }
                        }
                    },
                    'qb_recommendation': {
                        validators: {
                            callback: {
                                message: 'Qb Recommendation  is required',
                                callback: function(value, validator) {
                                    var action_agree = document.getElementById('action_agree').value;
                                    var qb_recommendation = document.getElementById('qb_recommendation').value;
                                    
                                    if (action_agree === 'Yes' &&  qb_recommendation === '') {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    'action_type': {
                        validators: {
                            callback: {
                                message: 'Action Type is required',
                                callback: function(value, validator) {
                                    var action_agree = document.getElementById('action_agree').value;
                                    var action_type = document.getElementById('action_type').value;
                                    
                                    if (action_agree === 'Yes' &&  action_type === '') {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    'responsible_person': {
                        validators: {
                            callback: {
                                message: 'Responsible Person is required',
                                callback: function(value, validator) {
                                    var action_agree = document.getElementById('action_agree').value;
                                    var responsible_person = document.getElementById('responsible_person').value;
                                    
                                    if (action_agree === 'Yes' &&  responsible_person === '') {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    'deadline': {
                        validators: {
                            callback: {
                                message: 'Deadline is required',
                                callback: function(value, validator) {
                                    var action_agree = document.getElementById('action_agree').value;
                                    var deadline = document.getElementById('deadline').value;
                                    
                                    if (action_agree === 'Yes' &&  deadline === '') {
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
                            toastr.success("QB  Created", "success");
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
            form = document.querySelector('#qb_action_point_form');
            submitButton = document.querySelector('#kt_action_point_submit');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTqbactionpointValidate.init();
});
// ----------------End Monitor   Qbs date------------------



// ----------------start  attachment   Qbs date------------------

//attachment validations   QB data
var KTqbattachmentValidate = function () {
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
                    // 'document':{
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'Document is required'
                    //         }
                    //     }
                    // },
                    'comments':{
                        validators: {
                            notEmpty: {
                                message: 'Comments is required'
                            }
                        }
                    },
                    'generating_observation':{
                        validators: {
                            notEmpty: {
                                message: 'General Observation is required'
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
                            toastr.success("QB  Created", "success");
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
            form = document.querySelector('#qb_attachment_form');
            submitButton = document.querySelector('#kt_attachment_submit');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
  
    KTqbattachmentValidate.init();
});
// ----------------End Monitor   Qbs date------------------

// DataTables
//Monitor Visits
var baseURL = window.location.origin;
var qb_id = document.getElementById("qb_id").value;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var clients = $('#monitor_visits').DataTable({
    "order": [
        [1, 'asc']
    ],
    
    "processing": true,
    "serverSide": true,
    "searchDelay": 500,
    "responsive": true,
    "ajax": {
        "url": "/get_monitor_visits",
        "dataType": "json",
        "type": "POST",
        "data": {
            "_token": csrfToken,
            "qb_id":qb_id
        }
    },
    "columns": [{
            "data": "activity_number",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "gap_issue",
            "searchable": false,
            "orderable": false
        },
    
        {
            "data": "created_at",
        },
        {
            "data": "action",
            "searchable": false,
            "orderable": false
        }
    ]
});
function monitorviewInfo(id) {
    
     var CSRF_TOKEN = csrfToken;
     $.post(baseURL + '/view_monitor_visit', {
         _token: csrfToken,
         id: id
     }).done(function(response) {
         $('.modal-body').html(response);
         $('#view_monitor_visit').modal('show');

     });
 }
function monitordel(id) {
     Swal.fire({
         title: "Are you sure?",
         text: "You won't be able to revert this!",
         icon: "warning",
         showCancelButton: true,
         confirmButtonText: "Yes, delete it!"
     }).then(function(result) {
         if (result.value) {
             Swal.fire(
                 "Deleted!",
                 "Your monitor visit has been deleted.",
                 "success"
             );
            
             var segments = window.location.href.split('/');
             var url = segments[1];
             var APP_URL = url + "/monitor_visit/delete/" + id;
             window.location.href = APP_URL;
         }
     });
}
$('.close').click(function() {
    $('#view_monitor_visit').modal('hide');
});

//Action Points

$("#activity_id").change(function () {
        
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
   
    $.ajax({
        type: 'POST',
        url: '/getactivity',
        data: {'activity_id': value, _token:csrfToken  },
        dataType: 'json',
        success: function (data) {
            document.getElementById('db_note').value = data.qbs_description;
        }

    });

}).trigger('change');

var clients = $('#action_points').DataTable({
    "order": [
        [1, 'asc']
    ],
    "processing": true,
    "serverSide": true,
    "searchDelay": 500,
    "responsive": true,
    "ajax": {
        "url": "/get_action_points",
        "dataType": "json",
        "type": "POST",
        "data": {
            "_token": csrfToken,
            "qb_id":qb_id
        }
    },
    "columns": [
        {
            "data": "site",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "db_note",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "action_agree",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "qb_recommendation",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "action_type",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "responsible_person",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "deadline",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "created_by",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "created_at",
        },
       
        {
            "data": "action",
            "searchable": false,
            "orderable": false
        }
    ]
});
function actionviewInfo(id) {
    
    $.post(baseURL + '/view_action_point', {
        _token: csrfToken,
        id: id
    }).done(function(response) {
        $('.modal-body').html(response);
        $('#view_action_point').modal('show');

    });
}
function actiondel(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function(result) {
     
        if (result.value) {
            Swal.fire(
                "Deleted!",
                "Your action point has been deleted.",
                "success"
            );
            
            var segments = window.location.href.split('/');
            var url = segments[1];
            var APP_URL = url + "/action_point/delete/" + id;
            window.location.href = APP_URL;
        }
    });
}
$('.close').click(function() {
    $('#view_monitor_visit,#view_action_point').modal('hide');
});


//Attachemnts

var qb_id = document.getElementById("qb_id").value;
var clients = $('#qbattachments').DataTable({
    "order": [
        [1, 'asc']
    ],
    "processing": true,
    "serverSide": true,
    "searchDelay": 500,
    "responsive": true,
    "ajax": {
        "url": "/get_qb_attachments",
        "dataType": "json",
        "type": "POST",
        "data": {
            "_token": csrfToken,
            "qb_id":qb_id
        }
    },
    "columns": [{
            "data": "id",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "comments"
        },
        {
            "data": "document"
        },
        {
            "data": "created_by"
        },
       
        {
            "data": "action",
            "searchable": false,
            "orderable": false
        }
    ]
});
function qb_attachmentviewInfo(id) {

     $.post(baseURL + '/view_qb_attachments', {
        _token: csrfToken,
        id: id
    }).done(function(response) {
        $('.modal-body').html(response);
        $('#view_qbattachment').modal('show');

    });
}
function qb_attachmentdel(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function(result) {
        if (result.value) {
            Swal.fire(
                "Deleted!",
                "Your QB Attachment has been deleted.",
                "success"
            );
            var segments = window.location.href.split('/');
            var url = segments[1];
            var APP_URL = url + "/qb_attachments/delete/" + id;
            window.location.href = APP_URL;
        }
    });
}
$('.close').click(function() {
    $('#view_monitor_visit,#view_action_point,#view_qbattachment').modal('hide');
});


