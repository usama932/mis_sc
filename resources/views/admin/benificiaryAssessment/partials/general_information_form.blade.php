
{{-- <div class="card-body">
    <div class="row ">
        <!-- Name of Beneficiary -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="name_of_beneficiary" class="form-label fw-bold required fs-8">Name of Beneficiary:</label>
            <input type="text" id="name_of_beneficiary" class="form-control" name="name_of_beneficiary" required>
        </div>

        <!-- Guardian -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="guardian" class="form-label fw-bold required  fs-8">Father/Husband:</label>
            <input type="text" id="guardian" class="form-control" name="guardian" required>
        </div>

        <!-- Gender -->
        <div class="col-sm-4 col-md-3 col-lg-3 fv-row">
            <label class="form-label fw-bold required  fs-8">Gender:</label>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <input type="radio" id="male" name="gender" value="Male" checked>
                    <label for="male" class="form-label  fs-8">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female" class="form-label  fs-8">Female</label>
                </div>
            </div>
        </div>

        <!-- Age -->
        <div class="col-sm-4 col-md-3 col-lg-3 fv-row">
            <label for="age" class="form-label fw-bold required  fs-8">Age:</label>
            <input type="number" id="age" class="form-control" maxlength="2" name="age" required min="1" max="99">
        </div>

        <!-- Beneficiary Contact -->
        <div class="col-sm-4s col-md-3 col-lg-3 fv-row">
            <label class="form-label fw-bold required  fs-8">Beneficiary Contact:</label>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <input type="radio" id="own" name="beneficiary_contact" value="Own" checked>
                    <label for="own" class="form-label  fs-8">Own</label>
                </div>
                <div>
                    <input type="radio" id="relative" name="beneficiary_contact" value="Relative">
                    <label for="relative" class="form-label  fs-8">Relative</label>
                </div>
            </div>
        </div>

        <!-- Contact Number -->
        <div class="col-sm-6 col-md-6 col-lg-4 fv-row">
            <label for="contact_number" class="form-label fw-bold required  fs-8">Contact Number:</label>
            <input type="text" id="contact_number" class="form-control"  name="contact_number" placeholder="0000 0000000" minlength="12" maxlength="12" required>
        </div>
        
    </div>

    <div class="row">
        <!-- Under 5yrs Girls -->
        <div class="col-sm-6 col-md-4 col-lg-2 fv-row">
            <label for="hh_under5_girls" class="form-label fw-bold required  fs-8">Under 5yrs Girls:</label>
            <input type="number" value="0" id="hh_under5_girls" maxlength="7" class="form-control" name="hh_under5_girls" min="0">
        </div>

        <!-- Under 5yrs Boys -->
        <div class="col-sm-6 col-md-4 col-lg-2 fv-row">
            <label for="hh_under5_boys" class="form-label fw-bold required  fs-8">Under 5yrs Boys:</label>
            <input type="number" value="0" id="hh_under5_boys" maxlength="7" class="form-control" name="hh_under5_boys" min="0">
        </div>

        <!-- 5-17yrs Girls -->
        <div class="col-sm-6 col-md-4 col-lg-2 fv-row">
            <label for="hh_under5_7_girls" class="form-label fw-bold required  fs-8">5-17yrs Girls:</label>
            <input type="number" value="0" id="hh_under5_7_girls" maxlength="7" class="form-control" name="hh_under5_7_girls" min="0">
        </div>

        <!-- 5-17yrs Boys -->
        <div class="col-sm-6 col-md-4 col-lg-2 fv-row">
            <label for="hh_under5_7_boys" class="form-label fw-bold required  fs-8">5-17yrs Boys:</label>
            <input type="number" value="0" id="hh_under5_7_boys" maxlength="7" class="form-control" name="hh_under5_7_boys" min="0">
        </div>

        <!-- Above 18yrs Girls -->
        <div class="col-sm-6 col-md-4 col-lg-2 fv-row">
            <label for="hh_above18_girls" class="form-label fw-bold required  fs-8">Above 18yrs Girls:</label>
            <input type="number" value="0" id="hh_above18_girls" maxlength="7" class="form-control" name="hh_above18_girls" min="0">
        </div>

        <!-- Above 18yrs Boys -->
        <div class="col-sm-6 col-md-4 col-lg-2 fv-row">
            <label for="hh_above18_boys" class="form-label fw-bold required  fs-8">Above 18yrs Boys:</label>
            <input type="number" value="0" id="hh_above18_boys" maxlength="7" class="form-control" name="hh_above18_boys" min="0">
        </div>

       

        <!-- CNIC Beneficiary -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="cnic_beneficiary" class="fs-6 fw-bolder form-label mb-2 required  fs-8">CNIC.# of Beneficiary:</label>
            <input type="text" id="cnic_beneficiary" class="form-control" name="cnic_beneficiary" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
            <div id="cnic_beneficiaryError" class="invalid-feedback" style="display: none;"></div>
        </div>

        <!-- CNIC Spouse -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="cnic_spouse" class="fs-6 fw-bolder form-label mb-2 required  fs-9">CNIC.# of Spouse:</label>
            <input type="text" id="cnic_spouse" class="form-control" name="cnic_spouse" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
            <div id="cnic_spouseError" class="invalid-feedback" style="display: none;"></div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="cnic_issuance" class="fs-8 fw-bolder form-label  required  fs-9"> Beneficiary CNIC  Issuance:</label>
            <input type="text" id="cnic_issuance" class="form-control" name="cnic_issuance" required>
            
        </div>

        <!-- CNIC Expiry -->
        <div class="col-sm-6 col-lg-3 fv-row col-md-3 fv-row">
            <label for="cnic_expiry" class="fs-8 fw-bolder form-label mb-2 required  fs-9">Beneficiary CNIC Expiry:</label>
            <input type="text" id="cnic_expiry" class="form-control" name="cnic_expiry" required>
        </div>
    </div>
    <div class="row gy-3 gx-4">
        <!-- Do You Receive Any Cash -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label class="form-label fw-bold required  fs-8">Do You Receive Any Cash:</label>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <input type="radio" id="recieve_cash_yes" name="recieve_cash" value="Yes" checked onchange="toggleCashFields()">
                    <label for="recieve_cash_yes" class="form-label  fs-8">Yes</label>
                </div>
                <div>
                    <input type="radio" id="recieve_cash_no" name="recieve_cash" value="No" onchange="toggleCashFields()">
                    <label for="recieve_cash_no" class="form-label  fs-8">No</label>
                </div>
            </div>
        </div>

        <!-- Cash Amount -->
        <div class="col-12 col-md-6 col-lg-4" id="cashAmountField">
            <label for="recieve_cash_amount" class="form-label fw-bold required  fs-8">If Yes How much:</label>
            <input type="number" id="recieve_cash_amount" class="form-control" name="recieve_cash_amount" value="0" min="0">
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3" id="cashSourceField">
            <label for="recieve_cash_source" class="form-label fw-bold required fs-8">If Yes From whom:</label>
            <select id="recieve_cash_source" class="form-select" data-control="select2" name="recieve_cash_source" onchange="toggleOtherSourceField()">
                <option value="BISP" class=" fs-8">BISP</option>
                <option value="UN Agency" class=" fs-8">UN Agency</option>
                <option value="NGO" class=" fs-8">NGO</option>
                <option value="Any Other" class=" fs-8">Any Other</option>
            </select>
        </div>

        <!-- Other Source (Text Field) -->
        <div class="col-sm-6 col-md-4 col-lg-3" id="otherSourceField" style="display: none;">
            <label for="recieve_other_source" class="form-label fw-bold required fs-8">Please Specify:</label>
            <input type="text" id="recieve_other_source" class="form-control" name="recieve_other_source">
        </div>
    </div>
</div> --}}

<div class="card-body">
    <!-- First Row -->
    <div class="row">
        <!-- Name of Beneficiary -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="name_of_beneficiary" class="form-label fw-bold required fs-8">Name of Beneficiary:</label>
            <input type="text" id="name_of_beneficiary" class="form-control" name="name_of_beneficiary" required>
        </div>
        <!-- Guardian -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="guardian" class="form-label fw-bold required fs-8">Father/Husband:</label>
            <input type="text" id="guardian" class="form-control" name="guardian" required>
        </div>
        <!-- Gender -->
        <div class="col-sm-4 col-md-3 col-lg-3 fv-row">
            <label class="form-label fw-bold required fs-8">Gender:</label>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <input type="radio" id="male" name="gender" value="Male" checked>
                    <label for="male" class="form-label fs-8">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="Female">
                    <label for="female" class="form-label fs-8">Female</label>
                </div>
            </div>
        </div>
        <!-- Age -->
        <div class="col-sm-4 col-md-3 col-lg-3 fv-row">
            <label for="age" class="form-label fw-bold required fs-8">Age:</label>
            <input type="number" id="age" class="form-control" name="age" required min="1" max="99">
        </div>
    </div>
    
    <!-- Contact Row -->
    <div class="row">
        <!-- Beneficiary Contact -->
        <div class="col-sm-4 col-md-3 col-lg-3 fv-row">
            <label class="form-label fw-bold required fs-8">Beneficiary Contact:</label>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <input type="radio" id="own" name="beneficiary_contact" value="Own" checked>
                    <label for="own" class="form-label fs-8">Own</label>
                </div>
                <div>
                    <input type="radio" id="relative" name="beneficiary_contact" value="Relative">
                    <label for="relative" class="form-label fs-8">Relative</label>
                </div>
            </div>
        </div>
        <!-- Contact Number -->
        <div class="col-sm-6 col-md-6 col-lg-4 fv-row">
            <label for="contact_number" class="form-label fw-bold required fs-8">Contact Number:</label>
            <input type="text" id="contact_number" class="form-control" name="contact_number" placeholder="0000 0000000" minlength="12" maxlength="12" required>
        </div>
    </div>
    
    <!-- CNIC Fields -->
    <div class="row">
        <!-- CNIC Beneficiary -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="cnic_beneficiary" class="form-label fw-bold required fs-8">CNIC.# of Beneficiary:</label>
            <input type="text" id="cnic_beneficiary" class="form-control" name="cnic_beneficiary" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
        </div>
        <!-- CNIC Spouse -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="cnic_spouse" class="form-label fw-bold required fs-8">CNIC.# of Spouse:</label>
            <input type="text" id="cnic_spouse" class="form-control" name="cnic_spouse" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
        </div>
        <!-- CNIC Issuance -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="cnic_issuance" class="form-label fw-bold required fs-8">Beneficiary CNIC Issuance:</label>
            <input type="text" id="cnic_issuance" class="form-control" name="cnic_issuance" required>
        </div>
        <!-- CNIC Expiry -->
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label for="cnic_expiry" class="form-label fw-bold required fs-8">Beneficiary CNIC Expiry:</label>
            <input type="text" id="cnic_expiry" class="form-control" name="cnic_expiry" required>
        </div>
    </div>

    <!-- Table for Numerical Fields -->
    <div class="row mt-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Girls</th>
                        <th>Boys</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Under 5yrs</td>
                        <td><input type="number" id="hh_under5_girls" class="form-control" name="hh_under5_girls" value="0" min="0"></td>
                        <td><input type="number" id="hh_under5_boys" class="form-control" name="hh_under5_boys" value="0" min="0"></td>
                    </tr>
                    <tr>
                        <td>5-17yrs</td>
                        <td><input type="number" id="hh_5_17_girls" class="form-control" name="hh_5_17_girls" value="0" min="0"></td>
                        <td><input type="number" id="hh_5_17_boys" class="form-control" name="hh_5_17_boys" value="0" min="0"></td>
                    </tr>
                    <tr>
                        <td>Above 18yrs</td>
                        <td><input type="number" id="hh_above18_girls" class="form-control" name="hh_above18_girls" value="0" min="0"></td>
                        <td><input type="number" id="hh_above18_boys" class="form-control" name="hh_above18_boys" value="0" min="0"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Cash Received -->
    <div class="row gy-3 gx-4">
        <div class="col-sm-6 col-md-4 col-lg-3 fv-row">
            <label class="form-label fw-bold required fs-8">Do You Receive Any Cash:</label>
            <div class="d-flex align-items-center gap-3">
                <div>
                    <input type="radio" id="recieve_cash_yes" name="recieve_cash" value="Yes" checked onchange="toggleCashFields()">
                    <label for="recieve_cash_yes" class="form-label fs-8">Yes</label>
                </div>
                <div>
                    <input type="radio" id="recieve_cash_no" name="recieve_cash" value="No" onchange="toggleCashFields()">
                    <label for="recieve_cash_no" class="form-label fs-8">No</label>
                </div>
            </div>
        </div>
        <!-- Cash Amount -->
        <div class="col-12 col-md-6 col-lg-4" id="cashAmountField">
            <label for="recieve_cash_amount" class="form-label fw-bold required fs-8">If Yes How much:</label>
            <input type="number" id="recieve_cash_amount" class="form-control" name="recieve_cash_amount" value="0" min="0">
        </div>
        <!-- Source -->
        <div class="col-sm-6 col-md-4 col-lg-3" id="cashSourceField">
            <label for="recieve_cash_source" class="form-label fw-bold required fs-8">If Yes From whom:</label>
            <select id="recieve_cash_source" class="form-select" name="recieve_cash_source" onchange="toggleOtherSourceField()">
                <option value="BISP">BISP</option>
                <option value="UN Agency">UN Agency</option>
                <option value="NGO">NGO</option>
                <option value="Any Other">Any Other</option>
            </select>
        </div>
        <!-- Other Source -->
        <div class="col-sm-6 col-md-4 col-lg-3" id="otherCashSourceField" style="display:none;">
            <label for="other_cash_source" class="form-label fw-bold fs-8">Other Source:</label>
            <input type="text" id="other_cash_source" class="form-control" name="other_cash_source">
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