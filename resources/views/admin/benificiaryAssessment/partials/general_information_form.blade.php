
<div class="card-body">
    <div class="row">
        <!-- Name of Beneficiary -->
        <div class="fv-row col-md-3">
            <label for="name_of_beneficiary" class="fs-6 fw-bolder form-label mb-2 required">Name of Beneficiary:</label>
            <input type="text" id="name_of_beneficiary" class="form-control" name="name_of_beneficiary" required>
        </div>

        <!-- Guardian -->
        <div class="fv-row col-md-3">
            <label for="guardian" class="fs-6 fw-bolder form-label mb-2 required">Father/Husband:</label>
            <input type="text" id="guardian" class="form-control" name="guardian" required>
        </div>

        <!-- Gender -->
        <div class="fv-row col-md-2">
            <label class="fs-6 fw-bolder form-label mb-2 required">Gender:</label>
            <input type="radio" id="male" name="gender" value="Male" checked> <label for="male" class="fs-9">Male</label>
            <input type="radio" id="female" name="gender" value="Female"> <label for="female" class="fs-9">Female</label>
        </div>

        <!-- Age -->
        <div class="fv-row col-md-2">
            <label for="age" class="fs-6 fw-bolder form-label mb-2 required">Age:</label>
            <input type="text" id="age" class="form-control" name="age" required oninput="this.value = this.value.slice(0, 2);" min="1" max="99">
        </div>

        <!-- Beneficiary Contact -->
        <div class="fv-row col-md-2">
            <label class="fs-6 fw-bolder form-label mb-2 required">Beneficiary Contact:</label>
            <input type="radio" id="own" name="beneficiary_contact" value="Own" checked> <label for="own" class="fs-6">Own</label>
            <input type="radio" id="relative" name="beneficiary_contact" value="Relative"> <label for="relative" class="fs-6">Relative</label>
        </div>

        <!-- Under 5yrs Girls -->
        <div class="fv-row col-md-2">
            <label for="hh_under5_girls" class="fs-6 fw-bolder form-label mb-2 required">Under 5yrs Girls:</label>
            <input type="text" value="0" id="hh_under5_girls" class="form-control" maxlength="7" name="hh_under5_girls" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <!-- Under 5yrs Boys -->
        <div class="fv-row col-md-2">
            <label for="hh_under5_boys" class="fs-6 fw-bolder form-label mb-2 required">Under 5yrs Boys:</label>
            <input type="text" value="0" id="hh_under5_boys" class="form-control" name="hh_under5_boys" maxlength="7" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <!-- 5-17yrs Girls -->
        <div class="fv-row col-md-2">
            <label for="hh_under5_7_girls" class="fs-6 fw-bolder form-label mb-2 required">5-17yrs Girls:</label>
            <input type="text" value="0" id="hh_under5_7_girls" class="form-control" maxlength="7" name="hh_under5_7_girls" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <!-- 5-17yrs Boys -->
        <div class="fv-row col-md-2">
            <label for="hh_under5_7_boys" class="fs-6 fw-bolder form-label mb-2 required">5-17yrs Boys:</label>
            <input type="text" value="0" id="hh_under5_7_boys" class="form-control" maxlength="7" name="hh_under5_7_boys" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <!-- Above 18yrs Girls -->
        <div class="fv-row col-md-2">
            <label for="hh_above18_girls" class="fs-8 fw-bolder form-label mb-2 required">Above 18yrs Girls:</label>
            <input type="text" value="0" id="hh_above18_girls" class="form-control" maxlength="7" name="hh_above18_girls" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <!-- Above 18yrs Boys -->
        <div class="fv-row col-md-2">
            <label for="hh_above18_boys" class="fs-8 fw-bolder form-label mb-2 required">Above 18yrs Boys:</label>
            <input type="text" value="0" id="hh_above18_boys" class="form-control" maxlength="7" name="hh_above18_boys" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <!-- Contact Number -->
        <div class="fv-row col-md-2">
            <label for="contact_number" class="fs-6 fw-bolder form-label mb-2 required">Contact Number:</label>
            <input type="text" id="contact_number" class="form-control" maxlength="12" minlength="12" name="contact_number" placeholder="0000 0000000" required>
        </div>

        <!-- CNIC Beneficiary -->
        <div class="fv-row col-md-2">
            <label for="cnic_beneficiary" class="fs-6 fw-bolder form-label mb-2 required">CNIC Beneficiary:</label>
            <input type="text" id="cnic_beneficiary" class="form-control" name="cnic_beneficiary" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
            <div id="cnic_beneficiaryError" class="invalid-feedback" style="display: none;"></div>
        </div>

        <!-- CNIC Spouse -->
        <div class="fv-row col-md-2">
            <label for="cnic_spouse" class="fs-6 fw-bolder form-label mb-2 required">CNIC Spouse:</label>
            <input type="text" id="cnic_spouse" class="form-control" name="cnic_spouse" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
            <div id="cnic_spouseError" class="invalid-feedback" style="display: none;"></div>
        </div>

        <!-- CNIC Issuance -->
        <div class="fv-row col-md-2">
            <label for="cnic_issuance" class="fs-8 fw-bolder form-label mb-2 required">CNIC Beneficiary Issue:</label>
            <input type="text" id="cnic_issuance" class="form-control" name="cnic_issuance" required>
            
        </div>

        <!-- CNIC Expiry -->
        <div class="fv-row col-md-2">
            <label for="cnic_expiry" class="fs-8 fw-bolder form-label mb-2 required">CNIC Beneficiary Expiry:</label>
            <input type="text" id="cnic_expiry" class="form-control" name="cnic_expiry" required>
        </div>

        <!-- Cash Receipt -->
        <div class="fv-row col-md-2 mt-2">
            <label class="fs-8 fw-bolder form-label required">Do You Receive Any Cash:</label>
            <input type="radio" id="recieve_cash" name="recieve_cash" value="Yes" checked> <label for="Yes" class="fs-6">Yes</label>
            <input type="radio" id="recieve_cash" name="recieve_cash" value="No"> <label for="No" class="fs-6">No</label>
        </div>

        <!-- Cash Amount -->
        <div class="fv-row col-md-2 mt-2">
            <label for="recieve_cash_amount" class="fs-8 fw-bolder form-label mb-2 required">Amount:</label>
            <input type="text" id="recieve_cash_amount" class="form-control" name="recieve_cash_amount" value="0" maxlength="7" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <!-- Cash Source -->
        <div class="fv-row col-md-2 mt-2">
            <label for="recieve_cash_source" class="fs-8 fw-bolder form-label mb-2 required">Cash Source:</label>
            <input type="text" id="recieve_cash_source" class="form-control" name="recieve_cash_source">
        </div>

        <!-- Remarks -->
        <div class="fv-row col-md-12 mt-2">
            <label for="remarks" class="fs-8 fw-bolder form-label mb-2">Remarks:</label>
            <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
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
    document.getElementById('contact_number').addEventListener('input', function () {
        // Remove non-digit characters
        let contact = this.value.replace(/\D/g, '');

        // Format as "XXXX XXXXXXX"
        if (contact.length > 4) {
            this.value = `${contact.slice(0, 4)} ${contact.slice(4, 11)}`;
        } else {
            this.value = contact;
        }
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
                        if (response.unique) {
                            $('#cnic_spouse').removeClass('is-invalid').addClass('is-valid');
                            $('#cnic_spouse').next('.invalid-feedback').remove();
                        } else {
                            $('#cnic_spouse').removeClass('is-valid').addClass('is-invalid');
                            if (!$('#cnic_spouse').next('.invalid-feedback').length) {
                                $('#cnic_spouse').after('<div class="invalid-feedback">CNIC is already taken.</div>');
                            }
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
                        if (response.unique) {
                            $('#cnic_beneficiary').removeClass('is-invalid').addClass('is-valid');
                            $('#cnic_beneficiary').next('.invalid-feedback').remove();
                        } else {
                            $('#cnic_beneficiary').removeClass('is-valid').addClass('is-invalid');
                            if (!$('#cnic_beneficiary').next('.invalid-feedback').length) {
                                $('#cnic_beneficiary').after('<div class="invalid-feedback">CNIC is already taken.</div>');
                            }
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
      
       
        $('#contact_number').on('keyup', function() { 
            let contactNumber = $(this).val();

            // Validate Contact Number format using regex before sending the AJAX request
            if (/^\d{4} \d{7}$/.test(contactNumber)) {
                // Make AJAX request to check contact number uniqueness
                $.ajax({
                    url: '/check-contact-number', // Route in Laravel
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token for security
                        contact_number: contactNumber
                    },
                    success: function(response) {
                        if (response.unique) {
                            
                            $('#contact_number').removeClass('is-invalid').addClass('is-valid');
                            $('#contact_number').next('.invalid-feedback').remove();
                        } else {
                            $('#contact_number').removeClass('is-valid').addClass('is-invalid');
                            if (!$('#contact_number').next('.invalid-feedback').length) {
                                $('#contact_number').after('<div class="invalid-feedback">Contact number is already taken.</div>');
                            }
                        }
                    },
                    error: function() {
                        alert('Error occurred while checking the contact number.');
                    }
                });
            } else {
                $('#contact_number').removeClass('is-valid').addClass('is-invalid');
                if (!$('#contact_number').next('.invalid-feedback').length) {
                    $('#contact_number').after('<div class="invalid-feedback">Invalid contact number format.</div>');
                }
            }
        });

    });
</script>