<script type="text/javascript">
    $(document).ready(function() {
        var button = document.querySelector("#btn-submit");    
        $('#qb_form').submit(function (event) { 
            
            event.preventDefault(); 
            if (validateForm())
            {
               
                button.setAttribute("data-kt-indicator", "on");
                var qb_form = document.getElementById('qb_form');
                var formData = new FormData(qb_form);
                
                $.ajax({
                    type: 'POST',
                    url: "{{route('quality-benchs.store')}}",
                    dataType: 'json',
                    processData: false, // Don't process the data (already in FormData)
                    contentType: false, // Don't set content type (browser will set automatically)

                    data: formData, // Use FormData directly

                    success:function(response){
                        button.removeAttribute("data-kt-indicator");
                        swal.fire({
                        text: "Quality BenchMark Created Successfull",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-success"
                        }
                        });
                        window.location.href = response.editUrl;
                        
                        
                    },
                    error: function(xhr, status, error) {
                    button.removeAttribute("data-kt-indicator");
                    if (xhr.status == 422) {
                    
                        var errors = xhr.responseJSON.errors;

                        // Loop through the errors and display them
                        $.each(errors, function(key, value) {
                            $(".print-error-msg").find("ul").html('');
                                $(".print-error-msg").css({'display': 'block','margin-top': '3px','color': 'red'});
                                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                                swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                    });
                                KTUtil.scrollTop();
                        });
                    } else {
                        // Handle other types of errors
                    }
                }
            
                });
                
            }
            function validateForm() 
            {
                
                $('.error-message').empty();

                // Example validation (you can customize this)
                var theme                   = $("#theme").val();
                var project_name            = $("#project_name").val();
                var partner                 = $("#partner").val();
                var kt_select2_province     = $("#kt_select2_province").val();
                var kt_select2_district     = $("#kt_select2_district").val();
                var kt_select2_tehsil       = $("#kt_select2_tehsil").val();
                var project_type            = $("#project_type").val();
                var type_of_visit           = $("#type_of_visit").val();
                var activity_description    = $("#activity_description").val();
                var monitoring_type         = $("#monitoring_type").val();
                var accompanied_by          = $("#accompanied_by").val();
                var date_visit              = $("#date_visit").val();
                var total_qbs               = $("#total_qbs").val();
                var qbs_fully_met           = $("#qbs_fully_met").val();
                var qb_not_applicable       = $("#qb_not_applicable").val();
                var visit_staff_name        = $("#visit_staff_name").val();
                var staff_organization      = $("#staff_organization").val();
                var staff_organization      = $("#staff_organization").val();
                var activity_description    = $("#activity_description").val();
                var kt_select2_union_counsil = $("#kt_select2_union_counsil").val();

                var isValid = true;
                
                if (theme === '') {
                    displayError('#themeError', 'Required', 'themeError');
                }

                if (project_name === '') {
                    displayError('#project_nameError', 'Required','project_nameError');
                    isValid = false;
                }
                if (partner === '') {
                    displayError('#partnerError', 'Required','partnerError');
                    isValid = false;
                }
                if (kt_select2_province === '') {
                    displayError('#kt_select2_provinceError', 'Required','kt_select2_provinceError');
                    isValid = false;
                }
                if (kt_select2_district === '') {
                    displayError('#kt_select2_districtError', 'Required','kt_select2_districtError');
                    isValid = false;
                }
                if (kt_select2_tehsil === '') {
                    displayError('#kt_select2_tehsilError', 'Required','kt_select2_tehsilError');
                    isValid = false;
                }
                if (kt_select2_union_counsil === '') {
                    displayError('#kt_select2_union_counsilError', 'Required','kt_select2_union_counsilError');
                    isValid = false;
                }
                if (project_type === '') {
                    displayError('#project_typeError', 'Required','project_typeError');
                    isValid = false;
                }
                if (type_of_visit === '') {
                    displayError('#type_of_visitError', 'Required','type_of_visitError');
                    isValid = false;
                }
                if (activity_description === '') 
                {
                    displayError('#activity_descriptionError', 'Required', 'activity_descriptionError');
                    return false;
                }
                if (monitoring_type === '') {
                    displayError('#monitoring_typeError', 'Required','monitoring_typeError');
                    isValid = false;
                }
            
                if (accompanied_by === "") {
                
                    displayError('#accompanied_byError', 'Required','accompanied_byError');
                    isValid = false;
                }
                if (date_visit === '') {
                    displayError('#date_visitError', 'Required','date_visitError');
                    isValid = false;
                }
                if (total_qbs === '') {
                    displayError('#total_qbsError', 'Required','total_qbsError');
                    isValid = false;
                }
                if (qbs_fully_met === '') {
                    displayError('#qbs_fully_metError', 'Required','qbs_fully_metError');
                    isValid = false;
                }
                if (qb_not_applicable === '') {
                    displayError('#qb_not_applicableError', 'Required','qb_not_applicableError');
                    isValid = false;
                }
                if (visit_staff_name === '') {
                    displayError('#visit_staff_nameError', 'Required','visit_staff_nameError');
                    isValid = false;
                }
                if (staff_organization === '') {
                    displayError('#staff_organizationError', 'Required','staff_organizationError');
                    isValid = false;
                }
                if (staff_organization === '') {
                    displayError('#staff_organizationError', 'Required','staff_organizationError');
                    isValid = false;
                }
                
                if (!isValid) {
                    // Scroll to the first element with an error message
                    $('html, body').animate({
                        scrollTop: $('.error-message:first').prev().offset().top
                    }, 1000);
                }

                return isValid;
            }

            function displayError(fieldId, message, errorId) {
                // Display error message below the specified field
                $(fieldId).html('<span id="' + errorId + '" class="error-message">' + message + '</span>');
                
            }
        });
    });
</script>