//Datatable
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var project_id = document.getElementById("project_id").value ?? '1';
var project_theme = $('#project_themes').DataTable({
    "order": [
        [1, 'desc']
    ],
    "dom": 'lfBrtip',
    buttons: [
        'csv', 'excel'
    ],
    "responsive": true, // Enable responsive mode
    "processing": true,
    "serverSide": true,
    "searching": false,
    "bLengthChange": false,
    "bInfo": false,
    "responsive": false,
    "info": true,
    "ajax": {

        "url": "/project_themes",
        "dataType": "json",
        "type": "POST",
        "data": {
            _token: csrfToken,
            'project_id': project_id
        }
    },
    "columns": [{
            "data": "id",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "theme",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "project",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "house_hold_target",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "individual_target",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "women_target",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "men_target",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "boys_target",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "girls_target",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "pwd_target",
            "searchable": false,
            "orderable": false
        },
        // {
        //     "data": "created_at",
        //     "searchable": false,
        //     "orderable": false
        // },
        // {
        //     "data": "created_by",
        //     "searchable": false,
        //     "orderable": false
        // },
        {
            "data": "action",
            "searchable": false,
            "orderable": false
        },
    ]
});




//project theme Form Validations

var KTprojectthemeValidate = function() {
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
                    'house_hold_target': {
                        validators: {
                            notEmpty: {
                                message: 'House Hold Targets is required'
                            },
                            numeric: {
                                message: 'House Hold Targets must be a number'
                            }
                        }
                    },
                    'individual_target': {
                        validators: {
                            notEmpty: {
                                message: 'Individual Target is required'
                            },
                            numeric: {
                                message: 'Individual Target must be a number'
                            }
                        }
                    },
                    'women_target': {
                        validators: {
                            notEmpty: {
                                message: 'Men Target is required'
                            },
                            numeric: {
                                message: 'Men Target must be a number'
                            },

                        }
                    },
                    'men_target': {
                        validators: {
                            notEmpty: {
                                message: 'Men Target is required'
                            },
                            numeric: {
                                message: 'Men Target must be a number'
                            }
                        }
                    },
                    'girls_target': {
                        validators: {
                            notEmpty: {
                                message: 'Girls Target is required'
                            },
                            numeric: {
                                message: 'Girls Target must be a number'
                            }
                        }
                    },
                    'boys_target': {
                        validators: {
                            notEmpty: {
                                message: 'Boys Target is required'
                            },
                            numeric: {
                                message: 'Boys Target must be a number'
                            }
                        }
                    },
                    'pwd_target': {
                        validators: {

                            numeric: {
                                message: 'PWD Target must be a number'
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

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;


                    // Check axios library docs: https://axios-http.com/docs/intro
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
                                toastr.error(response.data.message, "Error");
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
                                toastr.success("Theme Added Successfully", "Success");
                                form.reset();

                                project_theme.ajax.reload(null, false).draw(false);
                                $("#create_projecttheme").slideToggle();
                                $("#project_theme_table").slideToggle();
                                $("#addprojectthemeBtn").show();
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
            form = document.querySelector('#create_projecttheme');
            submitButton = document.querySelector('#kt_create_projecttheme');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function() {

    KTprojectthemeValidate.init();
});



//delete project theme
function project_themedel(id) {
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
                "Your Project Theme  has been deleted.",
                "success"
            );
            var segments = window.location.href.split('/');
            var url = segments[1];
            var APP_URL = url + "/project_theme/delete/" + id;
            var apiUrl = APP_URL;
            fetch(apiUrl, {
                    method: 'GET', // You can use 'GET', 'POST', 'PUT', 'DELETE', etc.
                    headers: {
                        'Content-Type': 'application/json', // Set the content type based on your API requirements
                        // Add any other headers if needed
                    },
                    // Add any additional options such as body, credentials, etc.
                })
                .then(response => {
                    // Handle the response as needed
                    console.log(response);
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error:', error);
                });


            project_theme.ajax.reload(null, false).draw(false);
            // $("#create_projecttheme").slideToggle();
            // $("#project_theme_table").slideToggle();
            // $("#addprojectthemeBtn").show();
        }
    });
}


/// toggle project theme
$("#addprojectthemeBtn").click(function() {

    $("#create_projecttheme").slideToggle();
    $("#project_theme_table").slideToggle();
    $("#cancelprojectthemeBtn").show();
    $(this).hide();
});
$("#cancelprojectthemeBtn").click(function() {
    $("#project_theme_table").slideToggle();
    $("#create_projecttheme").slideToggle();
    $("#addprojectthemeBtn").show(); // Show the other buttons
    $(this).hide(); // Hide the cancel button
});