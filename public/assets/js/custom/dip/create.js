
$("#create_projecttheme").hide();
$("#create_projectpartner").hide();
document.getElementById('districtloader').style.display = 'none';
document.getElementById('districtload').style.display = 'none';
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
            $("#kt_select2_district").empty();
            $("#kt_select2_district").prepend("<option value=''>Select District</option>");
            $.each(data, function (i, item) {
                $("#kt_select2_district").append("<option value='" + item.district_id + "'>" +
                    item.district_name.replace(/_/g, ' ') + "</option>");
            });
        }
    });
});

// Handle change event for select element with class .project_province
$(".project_province").change(function () {
    var value = $(this).val();
    var csrf_token = $('[name="_token"]').val();
    var project = document.getElementById('project_id').value || '';
    
    $.ajax({
        type: 'POST',
        url: '/getprojectDistrict',
        data: {
            'province': value,
            'project': project,
            '_token': csrf_token
        },
        dataType: 'json',
        success: function (data) {
            $(".partner_district").find('option').remove();
              
            $.each(data, function (i, item) {
                $(".partner_district").append("<option value='" + item.district_id + "'>" + item.district_name + "</option>");
            });
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error
        }
    });
});

// Handle change event for select element with ID #project_province
$("#project_province").change(function () {
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
   
    var project = document.getElementById('project_id').value || '';
    
    $.ajax({
        type: 'POST',
        url: '/getprojectDistrict',
        data: {'province': value, 'project': project, _token: csrf_token },
        dataType: 'json',
        success: function (data) {
         
            $("#project_district").empty();
            $("#project_district").prepend("<option value=''>Select District</option>");
            $.each(data, function (i, item) {
                $("#project_district").append("<option value='" + item.district_id + "'>" +
                    item.district_name.replace(/_/g, ' ') + "</option>");
            });
        }
    });
});

var KTprojectupdateValidate = function() {
    // Elements
    var form;
    var submitButton;


    // Handle form ajax
    var handleFormAjax = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    
                    'province[]': {
                        validators: {
                            notEmpty: {
                                message: 'Province Description is required'
                            }
                        }
                    },
                    'district[]': {
                        validators: {
                            notEmpty: {
                                message: 'District Description is required'
                            }
                        }
                    },
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
                                toastr.success(response.data.message, "Success");
                                sessionStorage.removeItem('project');
                                sessionStorage.setItem('project', 'thematic');
                                window.location.assign(response.data.editUrl);
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
                                toastr.success("Project detail Added Successfully", "Success");
                                sessionStorage.removeItem('project');
                                sessionStorage.setItem('project', 'thematic');
                                form.reset();

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

                    toastr.error("Please address the highlighted Errors", "Error");
                }
            });
        });

    }

    // Public functions
    return {
        // Initialization
        init: function() {
            // Elements
            form = document.querySelector('#create_dip');
            submitButton = document.querySelector('#kt_create_dip');
            handleFormAjax();
        }
    };
}();
// On document ready
KTUtil.onDOMContentLoaded(function() {

    KTprojectupdateValidate.init();
});
//project theme delete
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
            project_partners.ajax.reload(null, false).draw(false);
            // $("#create_projecttheme").slideToggle();
            // $("#project_theme_table").slideToggle();
            // $("#addprojectthemeBtn").show();
        }
        });
}
//Edit theme
function edittheme(id) {
    $.post("/edit_project_theme", {
        _token: csrfToken,
        id: id
    }).done(function(response) {
        $('.modal-body').html(response);
        $('#edittheme').modal('show');
    });
}
//Fetch project Partner Theme
document.getElementById('addprojectpartnerBtn').addEventListener('click', function() {
    console.log('Implementing Partner tab clicked');
    const project_id = $('#project_id').val(); // Get the project ID from the hidden input
    fetchThemes(project_id);
}, false);

function fetchThemes(project_id) {
    $.ajax({
        url : '/getprojecttheme',
        method: 'POST',
        data: {_token: csrfToken,project_id: project_id },
        success: function(response) {
            $("#partner_themes").find('option').remove();
            $("#partner_themes").prepend("<option value='' >Select District</option>");
            var selected='';
          
            $.each(response.partnerThemes, function (i, item) {
                console.log(item.scisubtheme_name.name);
                $("#partner_themes").append("<option value='" + item.scisubtheme_name.id + "' "+selected+" >"+
                    item.scitheme_name.name.replace(/_/g, ' ') +  " - " +
                    item.scisubtheme_name.name.replace(/_/g, ' ') + " </option>");
            });
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          console.log(status);
          
        }
    });
    
}