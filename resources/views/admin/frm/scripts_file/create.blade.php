<script type="text/javascript">
    $(document).ready(function() {
        var button = document.querySelector("#btn-submit");    
        $('#frm_form').submit(function (event) { 
            
            event.preventDefault(); 
            if (validateForm())
            {
                button.setAttribute("data-kt-indicator", "on");
                var frm_form = document.getElementById('frm_form');
                var formData = new FormData(frm_form);
                
                $.ajax({
                    type: 'POST',
                    url: "{{ route('frm-managements.store') }}",
                    dataType: 'json',
                    processData: false, // Don't process the data (already in FormData)
                    contentType: false, // Don't set content type (browser will set automatically)

                    data: formData, // Use FormData directly

                    success:function(data){
                        button.removeAttribute("data-kt-indicator");
                        if(!$.isEmptyObject(data.success)){
                        
                            swal.fire({
                            text: "FRM Created Successfull",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light-success"
                            }
                            });
                            KTUtil.scrollTop();
                        
                        }else{
                            button.removeAttribute("data-kt-indicator");
                            $.each(data, function (i, item) {
                                $(".print-error-msg").find("ul").html('');
                                $(".print-error-msg").css({'display': 'block','margin-top': '3px','color': 'red'});
                                $(".print-error-msg").find("ul").append('<li>'+item+'</li>');
                                KTUtil.scrollTop();
                            });
                        }
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
                var name_of_registrar   = $("#name_of_registrar").val();
                var date_recieved_id    = $("#date_recieved_id").val();
                var feedback_channel    = $("#feedback_channel").val();
                var name_of_client      = $("#name_of_client").val();
                var type_of_client      = $("#type_of_client").val();
                var gender              = $("#gender").val();
                var age                 = $("#age_id").val();
                var kt_select2_province = $("#kt_select2_province").val();
                var kt_select2_district = $("#kt_select2_district").val();
                var kt_select2_tehsil   = $("#kt_select2_tehsil").val();
                var kt_select2_union_counsil = $("#kt_select2_union_counsil").val();
                var pwd_clwd            = $('input[name="pwd_clwd"]:checked').val();
                var allow_contact       = $('input[name="allow_contact"]:checked').val();  
                var contact_number      = $("#contact_number").val();
                var feedback_category   = $("#feedback_category").val();
                var theme               = $("#theme").val();
                var feedback_activity   = $("#feedback_activity").val();
                var feedback_referredorshared   = $("#feedback_referredorshared").val();
                var date_feedback_referred      = $("#date_feedback_referred").val();
                var feedback_description        = $("#feedback_description").val();
                var refferal_name       = $("#refferal_name").val();
                var refferal_position   = $("#refferal_position").val();
                var feedback_summary    = $("#feedback_summary").val();
                var status              = $("#status").val();
                var action_id           = $("#action_id").val();
                var isValid = true;
                
                if (name_of_registrar === '') {
                    displayError('#name_of_registrarError', 'Required', 'name_of_registrarError');
                }

                if (date_recieved_id === '') {
                    displayError('#date_recievedError', 'Required','date_recievedError');
                    isValid = false;
                }
                if (feedback_channel === '') {
                    displayError('#feedback_channelError', 'Required','feedback_channelError');
                    isValid = false;
                }
                if (name_of_client === '') {
                    displayError('#name_of_clientError', 'Required','name_of_clientError');
                    isValid = false;
                }
                if (type_of_client === '') {
                    displayError('#type_of_clientError', 'Required','type_of_clientError');
                    isValid = false;
                }
                if (gender === '') {
                    displayError('#genderError', 'Required','genderError');
                    isValid = false;
                }
                if (age === '') {
                    displayError('#ageError', 'Required','ageError');
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
                if (!pwd_clwd) {
                    displayError('#pwd_clwdError', 'Required','pwd_clwdError');
                    isValid = false;
                }
                if (!allow_contact) {
                    displayError('#allow_contactError', 'Required','allow_contactError');
                    isValid = false;
                }
                if (allow_contact === 'Yes') {
                    
                    if (contact_number === '') {
                        displayError('#contact_numberError', 'Contact number is required', 'contact_numberError');
                        return false;
                    }
                }
                if (feedback_description === '') {
                    displayError('#feedback_descriptionError', 'Required','feedback_descriptionError');
                    isValid = false;
                }
            
                if (feedback_category === "") {
                
                    displayError('#feedback_categoryError', 'Required','feedback_categoryError');
                    isValid = false;
                }
                if (theme === '') {
                    displayError('#themeError', 'Required','themeError');
                    isValid = false;
                }
                if (feedback_activity === '') {
                    displayError('#feedback_activityError', 'Required','feedback_activityError');
                    isValid = false;
                }
                if (feedback_referredorshared === '') {
                    displayError('#feedback_referredorsharedError', 'Required','feedback_referredorsharedError');
                    isValid = false;
                }
                if (feedback_referredorshared === 'Yes') {
                    
                    if (date_feedback_referred === '') {
                        displayError('#date_feedback_referredError', 'Required', 'date_feedback_referredError');
                        return false;
                    }
                    if (refferal_name === '') {
                        displayError('#refferal_nameError', 'Required', 'refferal_nameError');
                        return false;
                    }
                    if (refferal_position === '') {
                        displayError('#refferal_positionError', 'Required', 'refferal_positionError');
                        return false;
                    }
                    if (feedback_summary === '') {
                        displayError('#feedback_summaryError', 'Required', 'feedback_summaryError');
                        return false;
                    }
                }
                if (feedback_referredorshared === 'No') {
                    if (status === '') {
                        displayError('#statusError', 'Required', 'statusError');
                        return false;
                    }
                    if (status === 'Close') {
                        if (action_id === '') {
                        displayError('#actiontakenError', 'Required', 'actiontakenError');
                        return false;
                    }
                    }
                
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