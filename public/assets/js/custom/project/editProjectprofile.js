var baseURL = window.location.origin;
document.getElementById('tehsilloader').style.display = 'none';
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
