<div class="card-body">
    <div class="row">
        <div class="col-md-6 mb-4">
            <label class="fs-6 fw-semibold form-label required">Initial Recommendation for Cash Assistance</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cash_assistance" id="cashAssistanceYes" value="yes" required>
                <label class="form-check-label" for="cashAssistanceYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="cash_assistance" id="cashAssistanceNo" value="no" required>
                <label class="form-check-label" for="cashAssistanceNo">No</label>
            </div>
        </div>

        <!-- Assessment Officer Name -->
        <div class=" col-md-6 mb-4">
            <label class="form-label required">Assessment Officer Name</label>
            <input type="text" name="assessment_officer" class="form-control" required>
            <div id="assessmentOfficerError" class="invalid-feedback"></div>
        </div>

        <!-- Beneficiary Name -->
        <div class=" col-md-6 mb-4">
            <label class="form-label required">Beneficiary Name</label>
            <input type="text" name="beneficiary_name" class="form-control" required>
            <div id="beneficiaryNameError" class="invalid-feedback"></div>
        </div>

        <!-- Endorsement from VC Representative -->
        <div class="col-md-6 mb-4">
            <label class="form-label required">Endorsement from VC Representative (Name & Signature)</label>
            <input type="text" name="vc_representative" class="form-control" required>
            <div id="vcRepresentativeError" class="invalid-feedback"></div>
        </div>
    </div>  
</div>