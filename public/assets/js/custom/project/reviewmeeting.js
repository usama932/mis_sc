var baseURL = window.location.origin;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var project_id = document.getElementById("project_id").value ?? '1';
var reviews = $('#project_reviews').DataTable( {
               
    "dom": 'lfBrtip',
    buttons: [
        'csv', 'excel'
    ],
    "responsive": true, // Enable responsive mode
    "processing": true,
    "serverSide": true,
    "searching": false,
    "bLengthChange": true,
    "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
    "bInfo" : true,
    "responsive": false,
    "info": true,
    "ajax": {
        "url":"/project_reviews",
        "dataType":"json",
        "type":"POST",
        "data":{"_token":csrfToken,
        'project_id':project_id}
    },
    "columns":[
                    {"data":"id","searchable":false,"orderable":false},
                    {"data":"meeting_title","searchable":false,"orderable":false},
                    {"data":"review_date","searchable":false,"orderable":false},
                    {"data":"project" ,"searchable":false,"orderable":false},
                    {"data":"action","searchable":false,"orderable":false},
                ]
});

function del(id) {
    
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
                "Your Review has been deleted.",
                "success"
            );
            var segments = window.location.href.split('/');
            var url = segments[1];
            var APP_URL = url + "/project_review/delete/" + id;
            var apiUrl = APP_URL;
            fetch(apiUrl, {
                method: 'GET', // You can use 'GET', 'POST', 'PUT', 'DELETE', etc.
                headers: {
                    'Content-Type': 'application/json', // Set the content type based on your API requirements
                    // Add any other headers if needed
                },
                
            })
            .then(response => {
                // Handle the response as needed
                console.log(response);
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });


            reviews.ajax.reload(null, false).draw(false);
        }
    });
}

function view(id) {
    
    $.post(baseURL + '/view_review', {
    _token: csrfToken,
    id: id
    }).done(function(response) {
    $('.modal-body').html(response);
    $('#view_review').modal('show');

    });
}
$('.close').click(function() {
    $('#view_review').modal('hide');
});



flatpickr("#deadline", {

    dateFormat: "Y-m-d",
    minDate: "today",
});
flatpickr("#review_date", {

    dateFormat: "Y-m-d",
    
});

var KTreviewValidate = function () {
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
                    'title':{
                        validators: {
                            notEmpty: {
                                message: 'Review Meeting Title is required'
                            }
                        }
                    },
                    'review_date':{
                        validators: {
                            notEmpty: {
                                message: 'Review Date is required'
                            }
                        }
                    },
                    'addmore[0][action_point]':{
                        validators: {
                            notEmpty: {
                                message: 'Action Point is required'
                            }
                        }
                    },
                    'addmore[0][action_agreed]':{
                        validators: {
                            notEmpty: {
                                message: 'Action  is required'
                            }
                        }
                    },
                    'addmore[0][deadline]':{
                        validators: {
                            notEmpty: {
                                message: 'Deadline is required'
                            }
                        }
                    },
                    'addmore[0][status]':{
                        validators: {
                            notEmpty: {
                                message: 'Status is required'
                            }
                        }
                    },
                    'addmore[0][responsible_person][]':{
                        validators: {
                            notEmpty: {
                                message: 'Responsible Person is required'
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
                            if(response.data.error == true){
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
                                toastr.error("Review has some error", "Please address the empty fields");
                        
                            }
                            else{
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
                                toastr.success("Review Submitted",response.data.message);
                                window.location.assign(response.data.editUrl);
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
            form = document.querySelector('#create_projectreview');
            submitButton = document.querySelector('#kt_create_projectreview');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function () {

    KTreviewValidate.init();
    });