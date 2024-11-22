<x-nform-layout>
  
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Stepper-->
                    <form method="post" action="">
                        <div class="row mb-5">
                            <form action="" method="GET">
                                @csrf
                                <div class="row">
                                    <!-- Project Field -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">Project</label>
                                        <select name="project" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select" data-allow-clear="true">
                                            <option value="">Select Project</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Gender Field -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">Gender</label>
                                        <select name="gender" id="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender" class="form-select" data-allow-clear="true">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Transgender">Transgender</option>
                                        </select>
                                    </div>

                                    <!-- Age -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="age_min">Age Min</label>
                                        <input type="number" name="age_min" class="form-control" id="age_min" placeholder="Min Age">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="age_max">Age Max</label>
                                        <input type="number" name="age_max" class="form-control" id="age_max" placeholder="Max Age">
                                    </div>
                            
                                    <!-- hh_under5_girls -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_girls_min">Under 5 Girls Min</label>
                                        <input type="number" name="hh_under5_girls_min" class="form-control" id="hh_under5_girls_min" placeholder="Min Under 5 Girls">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_girls_max">Under 5 Girls Max</label>
                                        <input type="number" name="hh_under5_girls_max" class="form-control" id="hh_under5_girls_max" placeholder="Max Under 5 Girls">
                                    </div>
                            
                                    <!-- hh_under5_boys -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_boys_min">Under 5 Boys Min</label>
                                        <input type="number" name="hh_under5_boys_min" class="form-control" id="hh_under5_boys_min" placeholder="Min Under 5 Boys">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_boys_max">Under 5 Boys Max</label>
                                        <input type="number" name="hh_under5_boys_max" class="form-control" id="hh_under5_boys_max" placeholder="Max Under 5 Boys">
                                    </div>
                            
                                    <!-- hh_under5_7_girls -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_7_girls_min">Under 5-7 Girls Min</label>
                                        <input type="number" name="hh_under5_7_girls_min" class="form-control" id="hh_under5_7_girls_min" placeholder="Min Under 5-7 Girls">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_7_girls_max">Under 5-7 Girls Max</label>
                                        <input type="number" name="hh_under5_7_girls_max" class="form-control" id="hh_under5_7_girls_max" placeholder="Max Under 5-7 Girls">
                                    </div>
                            
                                    <!-- hh_under5_7_boys -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_7_boys_min">Under 5-7 Boys Min</label>
                                        <input type="number" name="hh_under5_7_boys_min" class="form-control" id="hh_under5_7_boys_min" placeholder="Min Under 5-7 Boys">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_under5_7_boys_max">Under 5-7 Boys Max</label>
                                        <input type="number" name="hh_under5_7_boys_max" class="form-control" id="hh_under5_7_boys_max" placeholder="Max Under 5-7 Boys">
                                    </div>
                            
                                    <!-- hh_above18_girls -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_above18_girls_min">Above 18 Girls Min</label>
                                        <input type="number" name="hh_above18_girls_min" class="form-control" id="hh_above18_girls_min" placeholder="Min Above 18 Girls">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_above18_girls_max">Above 18 Girls Max</label>
                                        <input type="number" name="hh_above18_girls_max" class="form-control" id="hh_above18_girls_max" placeholder="Max Above 18 Girls">
                                    </div>
                            
                                    <!-- hh_above18_boys -->
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_above18_boys_min">Above 18 Boys Min</label>
                                        <input type="number" name="hh_above18_boys_min" class="form-control" id="hh_above18_boys_min" placeholder="Min Above 18 Boys">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="hh_above18_boys_max">Above 18 Boys Max</label>
                                        <input type="number" name="hh_above18_boys_max" class="form-control" id="hh_above18_boys_max" placeholder="Max Above 18 Boys">
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold required fs-8">Do You Receive Any Cash:</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input type="radio" id="recieve_cash_yes" name="recieve_cash" value="Yes" class="form-check-input" checked onchange="toggleCashFields()">
                                                <label for="recieve_cash_yes" class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" id="recieve_cash_no" name="recieve_cash" value="No" class="form-check-input" onchange="toggleCashFields()">
                                                <label for="recieve_cash_no" class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- recieve_cash_amount -->
                                    <div class="col-md-3">
                                        <label  class="fs-6 fw-semibold form-label mb-2" for="average_monthly_income_min">Average Monthly Income Max</label>
                                        <input type="number" name="average_monthly_income_min" class="form-control" id="average_monthly_income_min" placeholder="Min Recieve Cash">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2" for="average_monthly_income_max">Average Monthly Income Max</label>
                                        <input type="number" name="average_monthly_income_max" class="form-control" id="average_monthly_income_max" placeholder="Max Recieve Cash">
                                    </div>
                            
                                    <!-- Submit Button -->
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Apply Filters</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </form>
                    <!--end::Stepper-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/custom/utilities/modals/create-account.js') }}"></script>
    @endpush
</x-nform-layout>
