var baseURL = window.location.origin;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$("#create_projectprofile").hide();
$("#addprojectprofileBtn").click(function() {
    $("#create_projectprofile").slideToggle();
    $("#project_profile_table").slideToggle();
    $("#cancelprojectprofileBtn").show();
    $(this).hide();
});

//Datatable
var project_id = document.getElementById("project_id").value ?? '1';
var project_profiles = $('#project_profile').DataTable({
   
    buttons: [
        {
            extend: 'excelHtml5',
            filename: 'Project Profile Data export_',
            text: '<i class="flaticon2-download"></i> Excel',
            title: 'Themetic area Data export',
            className: 'btn btn-outline-success',
            exportOptions: {
                columns: [0,1,2]
            }
        },
        {
            extend: 'csvHtml5',
            filename: 'Project Profile Data CSV_',
            text: '<i class="flaticon2-download"></i> CSV',
            title: 'Themetic area Data',
            className: 'btn btn-outline-success',
            exportOptions: {
                columns: [0,1,2]
            }
        }
    ],
    "dom": 'lfBrtip',
    "processing": true,
    "serverSide": false,  // Disable server-side processing
    "searching": false,
    "paging": false,      // Disable pagination
    "bLengthChange": true,
    "aLengthMenu": [[10, 50, 100, 150, 200], [10, 50, 100, 150, 200]],
    "bInfo": false,
    "responsive": false,
    "info": true,
    "ajax": {

        "url": "/project_profile",
        "dataType": "json",
        "type": "POST",
        "data": {
            _token: csrfToken,
            'project_id': project_id
        }
    },
    "columns": [
        
        {
            "data": "theme",
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
        //     "data": "tehsil",
        //     "searchable": false,
        //     "orderable": false
        // },
        // {
        //     "data": "uc",
        //     "searchable": false,
        //     "orderable": false
        // },
        // {
        //     "data": "village",
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


//toggle menu
$("#cancelprojectprofileBtn").click(function() {
    $("#project_profile_table").slideToggle();
    $("#create_projectprofile").slideToggle();
    $("#addprojectprofileBtn").show(); // Show the other buttons
    $(this).hide(); // Hide the cancel button
});

$(document).ready(function() {
    // Initialize select2
    $('#select2_profile_district').select2();
    $('#kt_select2_tehsil').select2();
    $('#kt_select2_uc').select2();

    // Flags to prevent recursion
    let isProcessingDistrict = false;
    let isProcessingTehsil = false;
    let isProcessingUC = false;

    // Handle the change event for districts
    $('#select2_profile_district').on('change', function() {
        if (isProcessingDistrict) return;

        var values = $(this).val();

        // Check if 'Select All' was selected
        if (values && values.includes('select_all')) {
            isProcessingDistrict = true; // Set flag to true to prevent recursion

            // Select all options except 'select_all'
            $('#select2_profile_district > option').prop('selected', true);
            $('#select2_profile_district').trigger('change');

            // Remove 'Select All' from the selection
            values = $('#select2_profile_district').val().filter(value => value !== 'select_all');

            $('#select2_profile_district').val(values).trigger('change');

            isProcessingDistrict = false; // Reset flag
            fetchTehsils(values);
            return;
        }

        // Proceed with the selected values
        fetchTehsils(values);
    });

    // Function to fetch tehsils based on selected districts
    function fetchTehsils(districts) {
        // Return if no districts are selected (could happen after 'Select All' handling)
        if (!districts || districts.length === 0) return;

        var project = document.getElementById('project_id').value || '';
        var csrf_token = $('[name="_token"]').val();
        document.getElementById('tehsilloader').style.display = 'block';

        $.ajax({
            type: 'POST',
            url: '/getprofiletehsil',
            data: { 'district': districts, _token: csrf_token, 'project': project },
            dataType: 'json',
            success: function(data) {
                document.getElementById('tehsilloader').style.display = 'none';
                $("#kt_select2_tehsil").empty();
                $("#kt_select2_tehsil").prepend('<option value= "select_all">Select All</option>');
                $.each(data, function(i, item) {
                    $("#kt_select2_tehsil").append("<option value='" + item.id + "'>" +
                        item.tehsil_name.replace(/_/g, ' ') + "</option>");
                });
            }
        });
    }

    // Handle the change event for tehsils
    $("#kt_select2_tehsil").on('change', function() {
        if (isProcessingTehsil) return;

        var values = $(this).val();

        // Check if 'Select All' was selected
        if (values && values.includes('select_all')) {
            isProcessingTehsil = true; // Set flag to true to prevent recursion

            // Select all options except 'select_all'
            $('#kt_select2_tehsil > option').prop('selected', true);
            $('#kt_select2_tehsil').trigger('change');
            
            // Remove 'Select All' from the selection
            values = $('#kt_select2_tehsil').val().filter(value => value !== 'select_all');

            $('#kt_select2_tehsil').val(values).trigger('change');

            isProcessingTehsil = false; // Reset flag
            fetchUCs(values);
            return;
        }

        // Proceed with the selected values
        fetchUCs(values);
    });

    // Function to fetch UCs based on selected tehsils
    function fetchUCs(tehsils) {
        // Return if no tehsils are selected (could happen after 'Select All' handling)
        if (!tehsils || tehsils.length === 0) return;

        var project = document.getElementById('project_id').value || '';
        var csrf_token = $('[name="_token"]').val();
        document.getElementById('ucloader').style.display = 'block';

        $.ajax({
            type: 'POST',
            url: '/getprofileuc',
            data: { 'tehsil': tehsils, _token: csrf_token, 'project': project },
            dataType: 'json',
            success: function(data) {
                document.getElementById('ucloader').style.display = 'none';
                $("#kt_select2_uc").empty();
                $("#kt_select2_uc").prepend('<option value="select_all">Select All</option>');
                $.each(data, function(i, item) {
                    $("#kt_select2_uc").append("<option value='" + item.union_id + "'>" +
                        item.uc_name.replace(/_/g, ' ') + "</option>");
                });
            }
        });
    }

    // Handle the change event for UCs (if needed similar functionality)
    $("#kt_select2_uc").on('change', function() {
        if (isProcessingUC) return;

        var values = $(this).val();

        // Check if 'Select All' was selected
        if (values && values.includes('select_all')) {
            isProcessingUC = true; // Set flag to true to prevent recursion

            // Select all options except 'select_all'
            $('#kt_select2_uc > option').prop('selected', true);
            $('#kt_select2_uc').trigger('change');

            // Remove 'Select All' from the selection
            values = $('#kt_select2_uc').val().filter(value => value !== 'select_all');

            $('#kt_select2_uc').val(values).trigger('change');

            isProcessingUC = false; // Reset flag
            return;
        }

        // Proceed with the selected values
        // Add any further logic if needed when UC changes
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
                    'ptheme': {
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
                                form.reset();
                               
                                // var select2_profile_district = $('#select2_profile_district');
                                // select2_profile_district.val(null).trigger('change');
                        
                                var kt_select2_tehsil = $('#kt_select2_tehsil');
                                kt_select2_tehsil.val(null).trigger('change');

                                var kt_select2_uc = $('#kt_select2_uc');
                                kt_select2_uc.val(null).trigger('change');
                                
                                var village = $('#village');
                                village.val(null).trigger('change');
                        
                                var detail = $('#kt_docs_ckeditor_classic');
                                detail.val(null).trigger('change');
                             
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
                                toastr.success("Profile Added Successfully", "Success");
                                project_profiles.ajax.reload(null, false).draw(false);
                                $("#create_projectprofile").slideToggle();
                                $("#addprojectprofileBtn").show();
                                $("#project_profile_table").slideToggle();
                               
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
            form = document.querySelector('#create_projectprofile');
            submitButton = document.querySelector('#kt_create_profile');
            handleFormAjax();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {

    KTprojectprofileValidate.init();
});

//Project profile
function view(id) {
    
    $.post(baseURL + '/profile_detail', {
    _token: csrfToken,
    id: id
    }).done(function(response) {
    $('#profilemodal_body').html(response);
    $('#view_profile').modal('show');

    });
}

//delete project partner
function project_profiledel(id) {
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
                "Your Project Profile  has been deleted.",
                "success"
            );
            var segments = window.location.href.split('/');
            var url = segments[1];
            var APP_URL = url + "/project_profile/delete/" + id;
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


                project_profiles.ajax.reload(null, false).draw(false);
            // $("#create_projecttheme").slideToggle();
            // $("#project_theme_table").slideToggle();
            // $("#addprojectthemeBtn").show();
        }
    });
}
$('.close').click(function() {
    $('#view_profile').modal('hide');
});