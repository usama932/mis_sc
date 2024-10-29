
<div class="card-body">
    <div class="row">
        <div class="fv-row col-md-3">
            <label for="monthly_income" class="fs-6 fw-bolder form-label mb-2">Average Monthly Income:</label>
            <input type="text" id="monthly_income" class="form-control" name="monthly_income" required>
            <div id="monthly_incomeError" class="invalid-feedback"></div>
        </div>
        <div class="fv-row col-md-3">
            <label for="source_income" class="fs-6 fw-bolder form-label mb-2">MAin Source of Income:</label>
            <input type="text" id="source_income" class="form-control" name="source_income" required>
            <div id="source_incomeError" class="invalid-feedback"></div>
        </div>
        <div class="fv-row col-md-3">
            <label for="person_earned" class="fs-6 fw-bolder form-label mb-2">Person Earned In Family:</label>
            <input type="text" id="person_earned" class="form-control" name="person_earned" required>
            <div id="person_earnedError" class="invalid-feedback"></div>
        </div>
        <div class="fv-row col-md-3">
            <label for="outstanding_debt" class="fs-6 fw-bolder form-label mb-2">Outstanding Debt:</label>
            <input type="text" id="outstanding_debt" class="form-control" name="outstanding_debt" min="0" required>
            <div id="outstanding_debtError" class="invalid-feedback"></div>
        </div>
    </div>
</div>
