//project partner validation
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var KTprojectpartnerValidate = function() {
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
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Email is required'
                            },
                          
                        }
                    },
                    'district': {
                        validators: {
                            notEmpty: {
                                message: 'District is required'
                            }
                        }
                    },
                    'province': {
                        validators: {
                            notEmpty: {
                                message: 'Province is required'
                            }
                        }
                    },
                    'partner': {
                        validators: {
                            notEmpty: {
                                message: 'Partner is required'
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
                                var form = document.getElementById('create_projectpartner');
                                form.reset();
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
                                var form = document.getElementById('create_projectpartner');
                                form.reset();
                                
                                toastr.success("Partner Added Successfully", "Success");
                              
                               
                                project_partners.ajax.reload(null, false).draw(false);
                                $("#create_projectpartner").slideToggle();
                                $("#project_partner_table").slideToggle();
                                $("#addprojectpartnerBtn").show();
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
            form = document.querySelector('#create_projectpartner');
            submitButton = document.querySelector('#kt_create_projectpartner');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function() {

    KTprojectpartnerValidate.init();
});


//Project Partner 

var project_id = document.getElementById("project_id").value ?? '1';
var project_partners = $('#project_partners').DataTable({
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

        "url": "/project_partners",
        "dataType": "json",
        "type": "POST",
        "data": {
            _token: csrfToken,
            'project_id': project_id
        }
    },
    "columns": [
        {
            "data": "themes",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "partner",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "email",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "province",
            "searchable": false,
            "orderable": false
        },
        {
            "data": "district",
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

//delete project partner
function project_parnterdel(id) {
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
                "Your Project Partner  has been deleted.",
                "success"
            );
            var segments = window.location.href.split('/');
            var url = segments[1];
            var APP_URL = url + "/project_partner/delete/" + id;
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


            project_partners.ajax.reload(null, false).draw(false);
            // $("#create_projecttheme").slideToggle();
            // $("#project_theme_table").slideToggle();
            // $("#addprojectthemeBtn").show();
        }
    });
}



/// toggle project theme
$("#addprojectpartnerBtn").click(function() {

    $("#create_projectpartner").slideToggle();
    $("#project_partner_table").slideToggle();
    $("#cancelprojectpartnerBtn").show();
    $(this).hide();
});
$("#cancelprojectpartnerBtn").click(function() {
    $("#project_partner_table").slideToggle();
    $("#create_projectpartner").slideToggle();
    $("#addprojectpartnerBtn").show(); // Show the other buttons
    $(this).hide(); // Hide the cancel button
});