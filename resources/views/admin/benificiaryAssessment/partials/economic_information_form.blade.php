
<div class="card-body">
    <div class="row">
        <div class="fv-row col-md-3">
            <label for="hh_monthly_income" class="fs-6 fw-bolder form-label mb-2">Average Monthly Income:</label>
            <input type="text" id="hh_monthly_income" class="form-control" name="hh_monthly_income" required maxlength="9" pattern="^\d{1,7}$" placeholder="Enter income">
            <div id="hh_monthly_incomeError" class="invalid-feedback"></div>
        </div>
        <div class="fv-row col-md-3">
            <label for="hh_source_income" class="fs-6 fw-bolder form-label mb-2">Main Source of Income:</label>
            <input type="text" id="hh_source_income" class="form-control" name="hh_source_income" required placeholder="Enter income Source">
            <div id="hh_source_incomeError" class="invalid-feedback"></div>
        </div>
        <div class="fv-row col-md-3">
            <label for="hh_person_earned" class="fs-6 fw-bolder form-label mb-2">Person Earned In Family:</label>
            <input type="text" id="hh_person_earned" class="form-control" name="hh_person_earned" required placeholder="Enter Person Earned In Family" >
            <div id="hh_person_earnedError" class="invalid-feedback"></div>
        </div>
        <div class="fv-row col-md-3">
            <label for="hh_outstanding_debt" class="fs-6 fw-bolder form-label mb-2">Outstanding Debt:</label>
            <input type="text" id="hh_outstanding_debt" class="form-control" name="hh_outstanding_debt" min="0" required placeholder="Enter Outstanding Debt">
            <div id="hh_outstanding_debtError" class="invalid-feedback"></div>
        </div>
    </div>
</div>