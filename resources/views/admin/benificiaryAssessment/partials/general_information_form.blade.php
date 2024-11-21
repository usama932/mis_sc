
<style> 
@media (max-width: 768px) {
    .form-label {
        font-size: 0.9rem;
    }
    .form-control {
        font-size: 0.9rem;
    }
}   
</style>
<div >
    <!-- First Row -->
    <div class="row">
        <h5>Bio Info:</h5>
        <div class="col-12 col-md-6 col-lg-4 fv-row">
            <label for="name_of_beneficiary" class="form-label fw-bold required fs-8">Name of Beneficiary:</label>
            <input type="text" id="name_of_beneficiary" class="form-control" name="name_of_beneficiary" required>
        </div>
        <div class="col-12 col-md-6 col-lg-4 fv-row">
            <label for="guardian" class="form-label fw-bold required fs-8">Father/Husband:</label>
            <input type="text" id="guardian" class="form-control" name="guardian" required>
        </div>
        <div class="col-12 col-md-6 col-lg-4 fv-row">
            <label class="form-label fw-bold required fs-8">Gender:</label>
            <div class="d-flex align-items-center">
                <div class="form-check me-3">
                    <input type="radio" id="male" name="gender" value="Male" class="form-check-input" checked>
                    <label for="male" class="form-check-label">Male</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="female" name="gender" value="Female" class="form-check-input">
                    <label for="female" class="form-check-label">Female</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 fv-row">
            <label for="age" class="form-label fw-bold required fs-8">Age:</label>
            <input type="number" id="age" class="form-control" name="age" required min="1" max="99">
        </div>
   
        <div class="col-12 col-md-4 fv-row">
            <label for="beneficiary_contact" class="form-label fw-bold required fs-8">Own Contact Number:</label>
            <input type="text" id="beneficiary_contact" class="form-control" name="beneficiary_contact" placeholder="0000 0000000" minlength="12" maxlength="12" required>
        </div>
       
        <div class="col-12 col-md-4 fv-row">
            <label for="relative_contact_number" class="form-label fw-bold required fs-8">Relative Contact Number:</label>
            <input type="text" id="relative_contact_number" class="form-control" name="relative_contact_number" placeholder="0000 0000000" minlength="12" maxlength="12" required>
        </div>
      
        <div class="col-12 col-md-3 fv-row">
            <label for="cnic_beneficiary" class="form-label fw-bold required fs-8">CNIC.# of Beneficiary:</label>
            <input type="text" id="cnic_beneficiary" class="form-control" name="cnic_beneficiary" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
        </div>
        <div class="col-12 col-md-3 fv-row">
            <label for="cnic_spouse" class="form-label fw-bold required fs-8">CNIC.# of Spouse:</label>
            <input type="text" id="cnic_spouse" class="form-control" name="cnic_spouse" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
        </div>
        <div class="col-12 col-md-3 fv-row">
            <label for="cnic_issuance" class="form-label fw-bold required fs-8">Beneficiary CNIC Issuance:</label>
            <input type="date" id="cnic_issuance" class="form-control" name="cnic_issuance" required placeholder="0000-00-0">
        </div>
        <div class="col-12 col-md-3 fv-row">
            <label for="cnic_expiry" class="form-label fw-bold required fs-8">Beneficiary CNIC Expiry:</label>
            <input type="date" id="cnic_expiry" class="form-control" name="cnic_expiry" required placeholder="0000-00-00">
        </div>
    </div>
    <hr>
    <!-- Numerical Fields -->
    <div class="row mt-3">
        <h6>HH Size</h6>
        <div class="col-12 col-lg-2 fv-row">
            <label class="form-label fw-bold required fs-9">Under 5yrs - Girls:</label>
            <input type="number" id="hh_under5_girls" class="form-control" name="hh_under5_girls" value="0" min="0" max="999">
        </div>
        <div class="col-12 col-lg-2 fv-row">
            <label class="form-label fw-bold required fs-9">Under 5yrs - Boys:</label>
            <input type="number" id="hh_under5_boys" class="form-control" name="hh_under5_boys" value="0" min="0" max="999">
        </div>
        <div class="col-12 col-lg-2 fv-row">
            <label class="form-label fw-bold required fs-9">5-17yrs - Girls:</label>
            <input type="number" id="hh_under5_7_girls" class="form-control" name="hh_under5_7_girls" value="0" min="0" max="999">
        </div>
        <div class="col-12 col-lg-2 fv-row">
            <label class="form-label fw-bold required fs-9">5-17yrs - Boys:</label>
            <input type="number" id="hh_under5_7_boys" class="form-control" name="hh_under5_7_boys" value="0" min="0" max="999">
        </div>
        <div class="col-12 col-lg-2 fv-row">
            <label class="form-label fw-bold required fs-9">Above 18yrs - Girls:</label>
            <input type="number" id="hh_above18_girls" class="form-control" name="hh_above18_girls" value="0" min="0" max="999">
        </div>
        <div class="col-12 col-lg-2 fv-row">
            <label class="form-label fw-bold required fs-9">Above 18yrs - Boys:</label>
            <input type="number" id="hh_above18_boys" class="form-control" name="hh_above18_boys" value="0" min="0" max="999">
        </div>
    </div>
    <hr>
    <!-- Cash Fields -->
    <div class="row mt-3">
        <div class="col-12 col-md-3 fv-row"">
            <label class="form-label fw-bold required fs-8">Do You Receive Any Cash:</label>
            <div class="d-flex align-items-center">
                <div class="form-check me-3">
                    <input type="radio" id="recieve_cash_yes" name="recieve_cash" value="Yes" class="form-check-input" checked onchange="toggleCashFields()">
                    <label for="recieve_cash_yes" class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="recieve_cash_no" name="recieve_cash" value="No" class="form-check-input" onchange="toggleCashFields()">
                    <label for="recieve_cash_no" class="form-check-label">No</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3  fv-row" id="cashAmountField">
            <label for="recieve_cash_amount" class="form-label fw-bold required fs-8">If Yes How much:</label>
            <input type="number" id="recieve_cash_amount" class="form-control" name="recieve_cash_amount" value="0" min="0">
        </div>
        <div class="col-12 col-md-3" id="cashSourceField">
            <label for="recieve_cash_source" class="form-label fw-bold required fs-8">If Yes From whom:</label>
            <select id="recieve_cash_source" class="form-select" name="recieve_cash_source" onchange="toggleOtherSourceField()">
                <option value="BISP">BISP</option>
                <option value="UN Agency">UN Agency</option>
                <option value="NGO">NGO</option>
                <option value="Any Other">Any Other</option>
            </select>
        </div>
        <div class="col-12 col-md-3  fv-row" id="otherSourceField" style="display: none;">
            <label for="recieve_other_source" class="form-label fw-bold required fs-8">Please Specify:</label>
            <input type="text" id="recieve_other_source" class="form-control" name="recieve_other_source">
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleCashFields() 
    {
        const cashYes = document.getElementById('recieve_cash_yes').checked;
        const cashAmountField = document.getElementById('cashAmountField');
        const cashSourceField = document.getElementById('cashSourceField');
        const otherSourceField = document.getElementById('otherSourceField');
        const cashAmountInput = document.getElementById('recieve_cash_amount');
        const cashSourceInput = document.getElementById('recieve_cash_source');
        const otherSourceInput = document.getElementById('recieve_other_source');

        if (cashYes) {
            // Show the amount and cash source fields
            cashAmountField.style.display = 'block';
            cashSourceField.style.display = 'block';
        } else {
            // Hide all fields and reset their values
            cashAmountField.style.display = 'none';
            cashSourceField.style.display = 'none';
            otherSourceField.style.display = 'none';
            cashAmountInput.value = 0;
            cashSourceInput.value = '';
            otherSourceInput.value = '';
        }
    }

    function toggleOtherSourceField() {
        const cashSource = document.getElementById('recieve_cash_source').value;
        const otherSourceField = document.getElementById('otherSourceField');
        const otherSourceInput = document.getElementById('recieve_other_source');

        if (cashSource === 'Any Other') {
            // Show the text input for "Any Other"
            otherSourceField.style.display = 'block';
        } else {
            // Hide the text input and clear its value
            otherSourceField.style.display = 'none';
            otherSourceInput.value = '';
        }
    }

    // Initial state setup (in case "No" or "Any Other" is preselected)
    document.addEventListener('DOMContentLoaded', () => {
        toggleCashFields();
        toggleOtherSourceField();
    });

    // Initial state setup (in case "No" is preselected)
    document.addEventListener('DOMContentLoaded', toggleCashFields);

    document.querySelectorAll('input[type="text"][maxlength="15"]').forEach((input) => {
        input.addEventListener('input', function () {
            let cnic = this.value.replace(/\D/g, ''); // Remove any non-digit characters
            
            // Automatically format based on CNIC length
            if (cnic.length > 5 && cnic.length <= 12) {
                this.value = `${cnic.slice(0, 5)}-${cnic.slice(5, 12)}`;
            } else if (cnic.length > 12) {
                this.value = `${cnic.slice(0, 5)}-${cnic.slice(5, 12)}-${cnic.slice(12, 13)}`;
            } else {
                this.value = cnic;
            }
        });

    });

    $(document).ready(function() {
        $('#cnic_spouse').on('keyup', function() {
            let cnicValue = $(this).val();

            // Validate CNIC format using regex before sending the AJAX request
            if (/^\d{5}-\d{7}-\d{1}$/.test(cnicValue)) {
                // Make AJAX request to check CNIC uniqueness
                $.ajax({
                    url: '/check-spouse-beneficary', // Route in Laravel
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                        cnic: cnicValue
                    },
                    success: function(response) {
                        if (response.unique == true) {
                            $('#cnic_spouse').removeClass('is-invalid').addClass('is-valid');
                            $('#cnic_spouse').next('.invalid-feedback').remove();
                        } else {
                            $('#cnic_spouse').removeClass('is-valid').addClass('is-invalid');
                        
                            $('#cnic_spouse').after('<div class="invalid-feedback">CNIC is already taken.</div>');
                           
                        }
                    },
                    error: function() {
                        alert('Error occurred while checking CNIC.');
                    }
                });
            } else {
                $('#cnic_spouse').removeClass('is-valid').addClass('is-invalid');
                if (!$('#cnic_spouse').next('.invalid-feedback').length) {
                    $('#cnic_spouse').after('<div class="invalid-feedback">Invalid CNIC format.</div>');
                }
            }
        });
        $('#cnic_beneficiary').on('keyup', function() {
            let cnicValue = $(this).val();

            // Validate CNIC format using regex before sending the AJAX request
            if (/^\d{5}-\d{7}-\d{1}$/.test(cnicValue)) {
                // Make AJAX request to check CNIC uniqueness
                $.ajax({
                    url: '/check-cnic-beneficary', // Route in Laravel
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                        cnic: cnicValue
                    },
                    success: function(response) {
                        if (response.unique == true) {
                            $('#cnic_beneficiary').removeClass('is-invalid').addClass('is-valid');
                            $('#cnic_beneficiary').next('.invalid-feedback').remove();
                            
                        } else {
                            $('#cnic_beneficiary').removeClass('is-valid').addClass('is-invalid');
                           
                                $('#cnic_beneficiary').after('<div class="invalid-feedback">CNIC is already taken.</div>');
                            
                        }
                    },
                    error: function() {
                        alert('Error occurred while checking CNIC.');
                    }
                });
            } else {
                $('#cnic_beneficiary').removeClass('is-valid').addClass('is-invalid');
                if (!$('#cnic_beneficiary').next('.invalid-feedback').length) {
                    $('#cnic_beneficiary').after('<div class="invalid-feedback">Invalid CNIC format.</div>');
                }
            }
        });
    
    
      
    });

    // // Format the Beneficiary Contact Number
    // document.getElementById('beneficiary_contact').addEventListener('input', function () {
    //     let contact = this.value.replace(/\D/g, ''); // Remove all non-digit characters

    //     // Format as "XXXX XXXXXXX"
    //     if (contact.length > 4) {
    //         this.value = `${contact.slice(0, 4)} ${contact.slice(4, 11)}`;
    //     } else {
    //         this.value = contact;
    //     }
    // });

    // // Format the Relative Contact Number
    // document.getElementById('relative_contact_number').addEventListener('input', function () {
    //     let contact = this.value.replace(/\D/g, ''); // Remove all non-digit characters

    //     // Format as "XXXX XXXXXXX"
    //     if (contact.length > 4) {
    //         this.value = `${contact.slice(0, 4)} ${contact.slice(4, 11)}`;
    //     } else {
    //         this.value = contact;
    //     }
    // });

    // $('#beneficiary_contact').on('keyup', function() { 
    //     let contactNumber = $(this).val();

    //     // Validate Contact Number format using regex before sending the AJAX request
    //     if (/^\d{4} \d{7}$/.test(contactNumber)) {
    //         // Make AJAX request to check contact number uniqueness
    //         $.ajax({
    //             url: '/check-contact-number', // Route in Laravel
    //             method: 'POST',
    //             data: {
    //                 _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
    //                 contact_number: contactNumber
    //             },
    //             success: function(response) {
    //                 if (response.unique) {
    //                     $('#beneficiary_contact').removeClass('is-invalid').addClass('is-valid');
    //                     $('#beneficiary_contact').next('.invalid-feedback').remove();
    //                 } else {
    //                     $('#beneficiary_contact').removeClass('is-valid').addClass('is-invalid');
    //                     if (!$('#beneficiary_contact').next('.invalid-feedback').length) {
    //                         $('#beneficiary_contact').after('<div class="invalid-feedback">Contact number is already taken.</div>');
    //                     }
    //                 }
    //             },
    //             error: function() {
    //                 alert('Error occurred while checking the contact number.');
    //             }
    //         });
    //     } else {
    //         $('#beneficiary_contact').removeClass('is-valid').addClass('is-invalid');
           
    //         $('#beneficiary_contact').after('<div class="invalid-feedback">Invalid contact number format.</div>');
          
    //     }
    // });

    // $('#relative_contact_number').on('keyup', function() { 
    //     let contactNumber = $(this).val();

    //     // Validate Contact Number format using regex before sending the AJAX request
    //     if (/^\d{4} \d{7}$/.test(contactNumber)) {
    //         // Make AJAX request to check contact number uniqueness
    //         $.ajax({
    //             url: '/check-contact-number', // Route in Laravel
    //             method: 'POST',
    //             data: {
    //                 _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
    //                 contact_number: contactNumber
    //             },
    //             success: function(response) {
    //                 if (response.unique) {
    //                     $('#relative_contact_number').removeClass('is-invalid').addClass('is-valid');
    //                     $('#relative_contact_number').next('.invalid-feedback').remove();
    //                 } else {
    //                     $('#relative_contact_number').removeClass('is-valid').addClass('is-invalid');
    //                     if (!$('#relative_contact_number').next('.invalid-feedback').length) {
    //                         $('#relative_contact_number').after('<div class="invalid-feedback">Contact number is already taken.</div>');
    //                     }
    //                 }
    //             },
    //             error: function() {
    //                 alert('Error occurred while checking the contact number.');
    //             }
    //         });
    //     } else {
    //         $('#relative_contact_number').removeClass('is-valid').addClass('is-invalid');
           
    //         $('#relative_contact_number').after('<div class="invalid-feedback">Invalid contact number format.</div>');
           
    //     }
    // });
    let typingTimer;
const doneTypingInterval = 500; // Wait 500ms after the user finishes typing before sending the AJAX request

// Format the Beneficiary Contact Number
document.getElementById('beneficiary_contact').addEventListener('input', function () {
    let contact = this.value.replace(/\D/g, ''); // Remove all non-digit characters

    // Format as "XXXX XXXXXXX"
    if (contact.length > 4) {
        this.value = `${contact.slice(0, 4)} ${contact.slice(4, 11)}`;
    } else {
        this.value = contact;
    }

    // Clear the previous typing timer and set a new one
    clearTimeout(typingTimer);
    typingTimer = setTimeout(function() {
        validateAndCheckContactNumber('#beneficiary_contact');
    }, doneTypingInterval); 
});

// Format the Relative Contact Number
document.getElementById('relative_contact_number').addEventListener('input', function () {
    let contact = this.value.replace(/\D/g, ''); // Remove all non-digit characters

    // Format as "XXXX XXXXXXX"
    if (contact.length > 4) {
        this.value = `${contact.slice(0, 4)} ${contact.slice(4, 12)}`;
    } else {
        this.value = contact;
    }

    // Clear the previous typing timer and set a new one
    clearTimeout(typingTimer);
    typingTimer = setTimeout(function() {
        validateAndCheckContactNumber('#relative_contact_number');
    }, doneTypingInterval); 
});

// Function to validate and send the AJAX request for contact number uniqueness
function validateAndCheckContactNumber(inputSelector) {
    let contactNumber = $(inputSelector).val(); // Keep the formatted number with spaces

    // Remove previous error message before proceeding
    $(inputSelector).removeClass('is-invalid').removeClass('is-valid');
    $(inputSelector).next('.invalid-feedback').remove();

    // Validate Contact Number format using regex before sending the AJAX request
    if (contactNumber.length == 12) { // Only send AJAX request after 11 digits (with spaces)
        if (/^\d{4} \d{7}$/.test(contactNumber)) { // Validate the exact format (XXXX XXXXXXX)
            // Make AJAX request to check contact number uniqueness
            $.ajax({
                url: '/check-contact-number', // Route in Laravel
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                    contact_number: contactNumber // Send the formatted number with spaces
                },
                success: function(response) {
                    // Clear any previous error message
                    $(inputSelector).removeClass('is-invalid').addClass('is-valid');
                    $(inputSelector).next('.invalid-feedback').remove();

                    if (!response.unique) {
                        // If contact number already exists, show error
                        $(inputSelector).removeClass('is-valid').addClass('is-invalid');
                        if (!$(inputSelector).next('.invalid-feedback').length) {
                            $(inputSelector).after('<div class="invalid-feedback">Contact number is already taken.</div>');
                        }
                    }
                },
                error: function() {
                    alert('Error occurred while checking the contact number.');
                }
            });
        } else {
            $(inputSelector).removeClass('is-valid').addClass('is-invalid');
            $(inputSelector).after('<div class="invalid-feedback">Invalid contact number format.</div>');
        }
    } else {
        $(inputSelector).removeClass('is-valid').addClass('is-invalid');
        $(inputSelector).after('<div class="invalid-feedback">Please enter the full 11-digit contact number.</div>');
    }
}

</script>