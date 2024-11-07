
<div class="card-body">
    <div class="row">
        <div class="fv-row col-md-3">
            <label for="name_of_beneficiary" class="fs-6 fw-bolder form-label mb-2 required">Name of Beneficiary:</label>
            <input type="text" id="name_of_beneficiary" class="form-control" name="name_of_beneficiary" required>
        </div>

        <div class="fv-row col-md-3">
            <label for="guardian" class="fs-6 fw-bolder form-label mb-2 required">Father/Husband:</label>
            <input type="text" id="guardian" class="form-control" name="guardian" required>
        </div>

        <div class="fv-row col-md-2">
            <label class="fs-6 fw-bolder form-label mb-2 required">Gender:</label>
            <br>
            <input type="radio" id="male" name="gender" value="Male" checked>
            <label for="male" class="fs-9">Male</label>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female" class="fs-9">Female</label>
        </div>

        <div class="fv-row col-md-2">
            <label for="age" class="fs-6 fw-bolder form-label mb-2 required">Age:</label>
            <input type="text" id="age" class="form-control" name="age" required oninput="this.value = this.value.slice(0, 2);" min="1" max="99">
        </div>

        <div class="fv-row col-md-2">
            <label class="fs-6 fw-bolder form-label mb-2 required">Beneficiary Contact:</label>
            <br>
            <input type="radio" id="own" name="beneficiary_contact" value="Own" checked>
            <label for="own" class="fs-9">Own</label>
            <input type="radio" id="relative" name="beneficiary_contact" value="Relative">
            <label for="relative" class="fs-9">Relative</label>
        </div>

        <div class="fv-row col-md-2 ">
            <label for="hh_under5_girls" class="fs-6 fw-bolder form-label mb-2 required">Under 5yrs Girls:</label>
            <input type="text" value="0" id="hh_under5_girls" class="form-control" maxlength="7" name="hh_under5_girls" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <div class="fv-row col-md-2">
            <label for="hh_under5_boys" class="fs-6 fw-bolder form-label mb-2 required">Under 5yrs Boys:</label>
            <input type="text" value="0" id="hh_under5_boys" class="form-control"  name="hh_under5_boys" maxlength="7" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <div class="fv-row col-md-2 ">
            <label for="hh_under5_7_girls" class="fs-6 fw-bolder form-label mb-2 required">5-17yrs Girls:</label>
            <input type="text" value="0" id="hh_under5_7_girls" class="form-control" maxlength="7" name="hh_under5_7_girls" oninput="this.value = this.value.slice(0, 7);">
        </div>
        <div class="fv-row col-md-2">
            <label for="hh_under5_7_boys" class="fs-6 fw-bolder form-label mb-2 required">5-17yrs Boys:</label>
            <input type="text" value="0" id="hh_under5_7_boys" class="form-control"  name="hh_under5_7_boys" maxlength="7" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <div class="fv-row col-md-2 ">
            <label for="hh_above18_girls" class="fs-6 fw-bolder form-label mb-2 required">Above 18yrs Girls:</label>
            <input type="text" value="0" id="hh_above18_girls" class="form-control" maxlength="7" name="hh_above18_girls" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <div class="fv-row col-md-2">
            <label for="hh_above18_boys" class="fs-6 fw-bolder form-label mb-2 required">Above 18yrs Boys:</label>
            <input type="text" value="0" id="hh_above18_boys" class="form-control"  name="hh_above18_boys" maxlength="7" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <div class="fv-row col-md-2 ">
            <label for="contact_number" class="fs-6 fw-bolder form-label mb-2 required">Contact Number:</label>
            <input type="text" id="contact_number" class="form-control" maxlength="12" minlength="12" name="contact_number" placeholder="0000 0000000" required>
        </div>
        
        <div class="fv-row col-md-2">
            <label for="cnic_beneficiary" class="fs-6 fw-bolder form-label mb-2 required">CNIC Beneficiary:</label>
            <input type="text" id="cnic_beneficiary" class="form-control" name="cnic_beneficiary" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
        </div>
        
        <div class="fv-row col-md-2">
            <label for="cnic_spouse" class="fs-6 fw-bolder form-label mb-2 required">CNIC Spouse:</label>
            <input type="text" id="cnic_spouse" class="form-control" name="cnic_spouse" maxlength="15" placeholder="37423-2323232-5" required pattern="^\d{5}-\d{7}-\d{1}$">
        </div>

        <div class="fv-row col-md-2">
            <label for="cnic_issuance" class="fs-8 fw-bolder form-label mb-2 required">CNIC Benficary Issue:</label>
            <input type="text" id="cnic_issuance" class="form-control" name="cnic_issuance" required>
        </div>

        <div class="fv-row col-md-2">
            <label for="cnic_expiry" class="fs-8 fw-bolder form-label mb-2 required">CNIC Benficary Expiry:</label>
            <input type="text" id="cnic_expiry" class="form-control" name="cnic_issuance" required>
        </div>

        <div class="fv-row col-md-2 mt-2">
            <label class="fs-8 fw-bolder form-label  required">Do You Receive Any Cash:</label>
            <br>
            <input type="radio" id="recieve_cash" name="recieve_cash" value="Yes" class="mb-2" checked>
            <label for="Yes" class="fs-9">Yes</label>
            <input type="radio" id="recieve_cash" name="recieve_cash" class="mb-2" value="No">
            <label for="No" class="fs-9">No</label>
        </div>

        <div class="fv-row col-md-2 mt-2">
            <label for="recieve_cash_amount" class="fs-8 fw-bolder form-label mb-2 required">Amount:</label>
            <input type="text" id="recieve_cash_amount" class="form-control" name="recieve_cash_amount" value="0" maxlength="7" oninput="this.value = this.value.slice(0, 7);">
        </div>

        <div class="fv-row col-md-2 mt-2">
            <label for="recieve_cash_source" class="fs-8 fw-bolder form-label mb-2 required">Cash Source:</label>
            <input type="text" id="recieve_cash_source" class="form-control" name="recieve_cash_source" value="">
        </div>
    </div>
</div>
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
</script>