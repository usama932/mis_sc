<div class="row">
    <div class="fv-row col-sm-6 col-md-4 col-lg-3">
        <label for="hh_monthly_income" class="fs-6 fw-bolder form-label mb-2 fs-8">Average monthly income of HH  (PKR):</label>
        <input type="text" id="hh_monthly_income" class="form-control" name="hh_monthly_income" required maxlength="9" pattern="^\d{1,7}$" placeholder="Enter income">
        <div id="hh_monthly_incomeError" class="invalid-feedback"></div>
    </div>
    <div class="fv-row col-sm-6 col-md-4 col-lg-3">
        <label for="hh_source_income" class="fs-6 fw-bolder form-label mb-2 fs-8">Main source of Income:</label>
        <input type="text" id="hh_source_income" class="form-control" name="hh_source_income" required placeholder="Enter income Source">
        <div id="hh_source_incomeError" class="invalid-feedback"></div>
    </div>
    <div class="fv-row col-sm-6 col-md-4 col-lg-3">
        <label for="hh_person_earned" class="fs-6 fw-bolder form-label mb-2 fs-8">How many person earned in family:</label>
        <input type="text" id="hh_person_earned" class="form-control" name="hh_person_earned" required placeholder="Enter Person Earned In Family" >
        <div id="hh_person_earnedError" class="invalid-feedback"></div>
    </div>
    <div class="fv-row col-sm-6 col-md-4 col-lg-3">
        <label for="hh_outstanding_debt" class="fs-6 fw-bolder form-label mb-2 fs-8">Outstanding Debt (PKR):</label>
        <input type="text" id="hh_outstanding_debt" class="form-control" name="hh_outstanding_debt" min="0" required placeholder="Enter Outstanding Debt">
        <div id="hh_outstanding_debtError" class="invalid-feedback"></div>
    </div>
</div>

