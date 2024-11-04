<div class="card-body">
    <div class="row">
        <div class="fv-row col-md-6">
            <label class="fs-6 fw-bolder form-label mb-2 required">Recommendation for Cash Assistance:</label>
            <br>
            <input type="radio" id="cash_assistance" name="cash_assistance" value="Yes" checked>
            <label for="cash_assistance" class="fs-9">Yes</label>
            <input type="radio" id="cash_assistance" name="cash_assistance" value="No">
            <label for="cash_assistance" class="fs-9">No</label>
        </div>
        <!-- Assessment Officer Name -->
        <div class=" col-md-6 mb-4 fv-row">
            <label class="form-label required">Assessment Officer Name</label>
            <input type="text" name="assessment_officer" class="form-control" required>
            <div id="assessmentOfficerError" class="invalid-feedback"></div>
        </div>

        <!-- Beneficiary Name -->
        <div class=" col-md-4 mb-4 fv-row">
            <label class="form-label required">Beneficiary Name</label>
            <input type="text" name="beneficiary_name" class="form-control" required>
            <div id="beneficiaryNameError" class="invalid-feedback"></div>
        </div>

        <!-- Endorsement from VC Representative -->
        <div class="col-md-4 mb-4 fv-row">
            <label class="form-label required">VC Representative Name</label>
            <input type="text" name="vc_representative" class="form-control" required>
            <div id="vcRepresentativeError" class="invalid-feedback"></div>
        </div>

        <div class="col-md-4 mb-4 fv-row">
            <label class="form-label required">Attachment MOV</label>
            <input type="file" name="attachment" class="form-control" required>
            <div id="attachmentError" class="invalid-feedback"></div>
        </div>
    </div>  
</div>