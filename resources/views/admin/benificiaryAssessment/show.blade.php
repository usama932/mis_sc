<x-nform-layout>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- Title and Status Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                Beneficiary Assessment #{{ $benficiaryAssessment->form_no ?? '' }} 
                <span class="badge badge-success">{{ $benficiaryAssessment->status }}</span>
            </h4>
        </div>

        <!-- Main Card with Shadow -->
        <div class="card shadow-lg p-4 mb-5">
            <div class="row">
                <!-- Demographic Information Section -->
                <div class="col-md-6 mb-4">
                    <div class="section-header bg-primary text-white p-3 rounded-top">
                        <h5 class="mb-0"><i class="fa fa-info-circle"></i>Demographic Information</h5>
                    </div>
                    <div class="p-3 border rounded-bottom">
                        <table class="table table-borderless">
                            <tr><td><strong>Tehsil</strong></td><td>{{ $benficiaryAssessment->tehsils?->tehsil_name ?? '' }}</td></tr>
                            <tr><td><strong>Union Council</strong></td><td>{{ $benficiaryAssessment->ucs?->uc_name ?? '' }}</td></tr>
                            <tr><td><strong>Date</strong></td><td>{{ date('M d, Y', strtotime($benficiaryAssessment->form_date ?? '')) }}</td></tr>
                            <tr><td><strong>Village</strong></td><td>{{ $benficiaryAssessment->village }}</td></tr>
                            <tr><td><strong>Sub Village</strong></td><td>{{ $benficiaryAssessment->sub_village ?? '' }}</td></tr>
                        </table>
                    </div>
                </div>

                <!-- Interview Observation Section -->
                <div class="col-md-6 mb-4">
                    <div class="section-header bg-primary text-white p-3 rounded-top">
                        <h5 class="mb-0"><i class="fa fa-share"></i> Interview Observation</h5>
                    </div>
                    <div class="p-3 border rounded-bottom">
                        <table class="table table-borderless">
                            <tr><td><strong>Cash Assistance</strong></td><td>{{ $benficiaryAssessment->cash_assistance ?? '' }}</td></tr>
                            <tr><td><strong>Assessment Officer</strong></td><td>{{ $benficiaryAssessment->assessment_officer ?? '' }}</td></tr>
                            <tr><td><strong>VC Representative Name</strong></td><td>{{ $benficiaryAssessment->vc_representative_name ?? '' }}</td></tr>
                            <tr><td><strong>Created By</strong></td><td>{{ $benficiaryAssessment->user?->name ?? '' }}</td></tr>
                            <tr><td><strong>Created At</strong></td><td>{{ date('M d, Y', strtotime($benficiaryAssessment->created_at)) }}</td></tr>
                        </table>
                    </div>
                </div>

                <!-- General Information Section -->
                <div class="col-md-6 mb-4">
                    <div class="section-header bg-primary text-white p-3 rounded-top">
                        <h5 class="mb-0"><i class="fa fa-user"></i> General Information</h5>
                    </div>
                    <div class="p-3 border rounded-bottom">
                        <table class="table table-borderless">
                            <tr><td><strong>Name of Beneficiary</strong></td><td>{{ $benficiaryAssessment->name_of_beneficiary ?? '' }}</td></tr>
                            <tr><td><strong>Father/Husband Name</strong></td><td>{{ $benficiaryAssessment->guardian }}</td></tr>
                            <tr><td><strong>Gender</strong></td><td>{{ $benficiaryAssessment->gender }}</td></tr>
                            <tr><td><strong>Age</strong></td><td>{{ $benficiaryAssessment->age }}</td></tr>
                            <tr><td><strong>Beneficiary Contact</strong></td><td>{{ $benficiaryAssessment->beneficiary_contact ?? '' }}</td></tr>
                            <tr><td><strong>Contact Number</strong></td><td>{{ $benficiaryAssessment->contact_number ?? '' }}</td></tr>
                            <tr><td><strong>HH Under 5 Girls</strong></td><td>{{ $benficiaryAssessment->hh_under5_girls }}</td></tr>
                            <tr><td><strong>HH Under 5 Boys</strong></td><td>{{ $benficiaryAssessment->hh_under5_boys }}</td></tr>

                            <tr><td><strong>HH Under 5-17yrs Girls</strong></td><td>{{ $benficiaryAssessment->hh_under5_7_girls }}</td></tr>
                            <tr><td><strong>HH Under 5-17yrs Boys</strong></td><td>{{ $benficiaryAssessment->hh_under5_7_boys }}</td></tr>

                            <tr><td><strong>HH Above 18yrs Girls</strong></td><td>{{ $benficiaryAssessment->hh_above18_girls }}</td></tr>
                            <tr><td><strong>HH Above 18yrs Boys</strong></td><td>{{ $benficiaryAssessment->hh_above18_boys }}</td></tr>

                            <tr><td><strong>Beneficiary CNIC</strong></td><td>{{ $benficiaryAssessment->cnic_beneficiary ?? '' }}</td></tr>
                            <tr><td><strong>CNIC Spouse</strong></td><td>{{ $benficiaryAssessment->cnic_spouse ?? '' }}</td></tr>
                            <tr><td><strong>CNIC Issue Date</strong></td><td>{{ date('M d, Y', strtotime($benficiaryAssessment->cnic_issuance ?? '')) }}</td></tr>
                            <tr><td><strong>CNIC Expiry Date</strong></td><td>{{ date('M d, Y', strtotime($benficiaryAssessment->cnic_expiry ?? '')) }}</td></tr>
                            <tr><td><strong>Receive Cash Assistance</strong></td><td>{{ $benficiaryAssessment->recieve_cash ?? '' }}</td></tr>
                            <tr><td><strong>Received Cash Amount</strong></td><td>{{ $benficiaryAssessment->recieve_cash_amount ?? '' }}</td></tr>
                            <tr><td><strong>Cash Source</strong></td><td>{{ $benficiaryAssessment->recieve_cash_source ?? '' }}</td></tr>
                        </table>
                    </div>
                </div>

                <!-- Economic Information Section -->
                <div class="col-md-6 mb-4">
                    <div class="section-header bg-primary text-white p-3 rounded-top">
                        <h5 class="mb-0"><i class="fa fa-chart-line"></i> Economic Information</h5>
                    </div>
                    <div class="p-3 border rounded-bottom">
                        <table class="table table-borderless">
                            <tr><td><strong>Average Monthly Income</strong></td><td>{{ $benficiaryAssessment->hh_monthly_income ?? '' }}</td></tr>
                            <tr><td><strong>Main Income Source</strong></td><td>{{ $benficiaryAssessment->hh_source_income ?? '' }}</td></tr>
                            <tr><td><strong>Person Earning in Family</strong></td><td>{{ $benficiaryAssessment->hh_person_earned ?? '' }}</td></tr>
                            <tr><td><strong>Outstanding Debt (PKR)</strong></td><td>{{ $benficiaryAssessment->hh_outstanding_debt ?? '' }}</td></tr>
                        </table>
                    </div>
                </div>

                <!-- Vulnerabilities & Losses Section -->
                <div class="col-md-6 mb-4">
                    <div class="section-header bg-primary text-white p-3 rounded-top">
                        <h5 class="mb-0"><i class="fa fa-house-damage"></i>Dwelling Status, Vulnerabilities & Losses</h5>
                    </div>
                    <div class="p-3 border rounded-bottom">
                        <table class="table table-borderless">
                            <tr><td><strong>House Damage</strong></td><td>{{ $benficiaryAssessment->house_damage ?? '' }}</td></tr>
                            <tr><td><strong>Minority Status</strong></td><td>{{ $benficiaryAssessment->hh_minority ?? '' }}</td></tr>
                            <tr><td><strong>Girls Died</strong></td><td>{{ $benficiaryAssessment->hh_died_female ?? '' }}</td></tr>
                            <tr><td><strong>Boys Died</strong></td><td>{{ $benficiaryAssessment->hh_died_male ?? '' }}</td></tr>
                            <tr><td><strong>Girls Injured</strong></td><td>{{ $benficiaryAssessment->hh_injured_female ?? '' }}</td></tr>
                            <tr><td><strong>Boys Injured</strong></td><td>{{ $benficiaryAssessment->hh_injured_male ?? '' }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-nform-layout>
