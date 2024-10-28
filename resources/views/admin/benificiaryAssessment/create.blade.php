<x-nform-layout>
    <style>
        /* General Step and Form Styles */
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        /* Step Bar Styling */
        .step-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        .step-bar .step-bar-item {
            flex: 1;
            padding: 12px;
            text-align: center;
            font-weight: bold;
            font-size: 1rem;
            color: #000; /* Default inactive color */
            background-color: #f8f9fa;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            margin-right: 8px;
        }
        .step-bar .step-bar-item:last-child {
            margin-right: 0;
        }
        .step-bar .step-bar-item.active {
            background-color: #a4262c;
            color: #fff;
            border: 1px solid #a4262c;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        /* Card Styling */
        .card {
            border: 1px solid #a4262c;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #a4262c;
            color: #fff;
            font-weight: bold;
            font-size: 1.2rem;
        }
        /* Form Field Styling */
        .form-control {
            border-radius: 5px;
            border: 1px solid #a4262c;
            box-shadow: inset 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #a4262c;
            box-shadow: 0px 0px 8px rgba(164, 38, 44, 0.2);
        }
        /* Button Styling */
        .btn-primary {
            background-color: #a4262c;
            border: none;
        }
        .btn-primary:hover {
            background-color: #871d20;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
    </style>

    @section('title')
        Beneficiary Assessment Form
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container mt-5">
            <!-- Step Bar Header -->
            <div class="step-bar">
                <div class="step-bar-item active" data-step="1">General Information</div>
                <div class="step-bar-item" data-step="2">Economic Information</div>
                <div class="step-bar-item" data-step="3">Vulnerabilities & Losses</div>
                <div class="step-bar-item" data-step="4">Observation/Comments</div>
            </div>
            
            <!-- Step 1 Card -->
            <div class="step active" data-step="1">
                <div class="card">
                    <div class="card-header mt-4">General Information</div>
                    <div class="card-body"> <div class="card-body py-4">
                        <div class="row">
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">Project</span>
                                </label>
                                <select name="project" id="projectId" class="form-control form-select" data-control="select2" data-placeholder="Select Project"  data-allow-clear="true">
                                    <option value="">Select Project</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                                <div id="logFrameLevelError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">Form Sr.# </span>
                                </label>
                                <input type="text" name="form_number" class="form-control" />
                                <div id="form_numberError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">Form Sr.# </span>
                                </label>
                                <input type="date" name="date" class="form-control" />
                                <div id="dateError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">Province</span>
                                </label>
                                <select name="province" id="provinceId" class="form-select" data-control="select2" data-placeholder="Select Province"  data-allow-clear="true">
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                                    @endforeach
                                </select>
                                <div id="provinceError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">District</span>
                                </label>
                                <select name="district" id="districtId" class="form-control form-select" data-control="select2" data-placeholder="Select District"  data-allow-clear="true">
                                    <option value="">Select District</option>
                                </select>
                                <div id="districtError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">Tehsil</span>
                                </label>
                                <select name="tehsil" id="tehsilId" class=" form-control form-select" data-control="select2" data-placeholder="Select Tehsil"  data-allow-clear="true">
                                    <option value="">Select Teshil</option>
                                </select>
                                <div id="tehsilError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-3">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">UC</span>
                                </label>
                                <select name="uc" id="ucId" class="form-control form-select" data-control="select2" data-placeholder="Select Tehsil"  data-allow-clear="true">
                                    <option value="">Select Teshil</option>
                                </select>
                                <div id="ucError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-6">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">Village</span>
                                </label>
                                <textarea class="form-control"  name="village" id="village"></textarea>
                                <div id="villageError" class="invalid-feedback"></div>
                            </div>
                            <div class="fv-row col-md-6">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="">Sub Village</span>
                                </label>
                                <textarea class="form-control" name="subvillage" id="subvillage"></textarea>
                                <div id="subvillageError" class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary  btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Step 2 Card -->
            <div class="step" data-step="2">
                <div class="card">
                    <div class="card-header">Economic Information</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-secondary  btn-sm prev-step">Previous</button>
                            <button class="btn btn-primary  btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Step 3 Card -->
            <div class="step" data-step="3">
                <div class="card">
                    <div class="card-header">Vulnerabilities & Losses</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-secondary  btn-sm prev-step ">Previous</button>
                            <button class="btn btn-primary  btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Step 4 Card -->
            <div class="step" data-step="4">
                <div class="card">
                    <div class="card-header">Observation/Comments</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" placeholder="Enter your address">
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-secondary btn-sm prev-step">Previous</button>
                            <button class="btn btn-success  btn-sm submit-form">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let currentStep = 1;

                function showStep(step) {
                    document.querySelectorAll('.step').forEach((stepDiv) => {
                        stepDiv.classList.remove('active');
                    });
                    document.querySelector(`.step[data-step="${step}"]`).classList.add('active');

                    document.querySelectorAll('.step-bar-item').forEach((indicator) => {
                        indicator.classList.remove('active');
                    });
                    document.querySelector(`.step-bar-item[data-step="${step}"]`).classList.add('active');
                }

                document.querySelectorAll('.next-step').forEach((button) => {
                    button.addEventListener('click', function() {
                        currentStep++;
                        showStep(currentStep);
                    });
                });

                document.querySelectorAll('.prev-step').forEach((button) => {
                    button.addEventListener('click', function() {
                        currentStep--;
                        showStep(currentStep);
                    });
                });

                document.querySelector('.submit-form').addEventListener('click', function() {
                    alert('Form submitted!');
                });

                showStep(currentStep);
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endpush
</x-nform-layout>
