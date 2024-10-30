
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
        <div class="fv-row col-md-3">
            <label class="fs-6 fw-bolder form-label mb-2 required">Gender:</label>
            <br>
            <input type="radio" id="male" name="gender" value="Male" checked>
            <label for="male" class="fs-9">Male</label>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female" class="fs-9">Female</label>
        </div>
        <div class="fv-row col-md-3 ">
            <label for="age" class="fs-6 fw-bolder form-label mb-2 required">Age:</label>
            <input type="number" id="age" class="form-control" name="age" min="1" required>
        </div>
        <div class="fv-row col-md-3 ">
            <label class="fs-6 fw-bolder form-label mb-2 required">Beneficiary Contact:</label>
            <br>
            <input type="radio" id="own" name="beneficiary_contact" value="Own" checked>
            <label for="own" class="fs-9">Own</label>
            <input type="radio" id="relative" name="beneficiary_contact" value="Relative">
            <label for="relative" class="fs-9">Relative</label>
        </div>
        <div class="fv-row col-md-3">
            <label for="contact_number" class="fs-6 fw-bolder form-label mb-2 required">Contact Number:</label>
            <input type="text" id="contact_number" class="form-control" name="contact_number" required>
        </div>
        <div class="fv-row col-md-3 ">
            <label for="hh_girls" class="fs-6 fw-bolder form-label mb-2 required">Household Girls:</label>
            <input type="number" value="0" id="hh_girls" class="form-control" name="hh_girls" min="0">
        </div>
        <div class="fv-row col-md-3 ">
            <label for="hh_boys" class="fs-6 fw-bolder form-label mb-2 required">Household Boys:</label>
            <input type="number" value="0" id="hh_boys" class="form-control" name="hh_boys" min="0">
        </div>
        
    </div>
</div>
