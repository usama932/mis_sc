<x-nform-layout>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
            color: #000;
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
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .error {
            border: 2px solid red; /* Red border for invalid fields */
        }
        /* Error Message */
        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 5px;
        }
        /* Button Styles */
        .btn-custom {
            background-color: #a4262c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #8e1e2a;
        }
        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        /* Progress Bar Container */
        .progress-bar-container {
            height: 8px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        /* Progress Bar */
        .progress-bar {
            height: 100%;
            width: 0;
            background-color: #a4262c;
            transition: width 0.3s ease;
        }
    </style>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container">
            <!-- Step Bar Header -->
            <div class="step-bar">
                <div class="step-bar-item active" data-step="1">Demographic Information</div>
                <div class="step-bar-item" data-step="2">General Information</div>
                <div class="step-bar-item" data-step="3">Economic Information</div>
                <div class="step-bar-item" data-step="4">Vulnerabilities & Losses</div>
                <div class="step-bar-item" data-step="5">Observation/Comments</div>
                <div class="step-bar-item" data-step="6">Review & Submit</div>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar" id="progress-bar"></div>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form id="kt_beneficiary_assessment" action="{{ route('submit-beneficiary-assessment-form') }}" enctype="multipart/form-data" method="post">
                @csrf

                <!-- Step 1: Demographic Information -->
                <div class="step active" data-step="1">
                    <div class="card">
                        @include("admin.benificiaryAssessment.partials.demographic_information")
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn-custom next-step" id="nextStep1">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2: General Information -->
                <div class="step" data-step="2">
                    <div class="card">
                        @include("admin.benificiaryAssessment.partials.general_information_form")
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn-custom next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Economic Information -->
                <div class="step" data-step="3">
                    <div class="card">
                        @include("admin.benificiaryAssessment.partials.economic_information_form")
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn-custom next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Vulnerabilities & Losses -->
                <div class="step" data-step="4">
                    <div class="card">
                        @include("admin.benificiaryAssessment.partials.vulnerability")
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn-custom next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Observation/Comments -->
                <div class="step" data-step="5">
                    <div class="card">
                        @include("admin.benificiaryAssessment.partials.observation_form")
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn-custom next-step" id="nextStep5">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Review & Submit -->
                <div class="step" data-step="6">
                    <div class="card">
                        <div class="card-body">
                            <div id="reviewData" class="row"></div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn-custom prev-step" id="prevStep6">Previous</button>
                            <button type="submit" class="btn-custom" id="submitForm">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push("scripts")
    <script>
        // Handle the steps and progress bar
        document.addEventListener("DOMContentLoaded", function() {
            const steps = document.querySelectorAll(".step");
            const nextSteps = document.querySelectorAll(".next-step");
            const prevSteps = document.querySelectorAll(".previous-step");
            const progressBar = document.getElementById("progress-bar");
            const reviewData = document.getElementById("reviewData");
    
            let currentStep = 0;

            function showStep(step) {
                steps.forEach((s, index) => {
                    s.classList.toggle("active", index === step);
                });

                const stepBarItems = document.querySelectorAll(".step-bar-item");
                stepBarItems.forEach((item, index) => {
                    item.classList.toggle("active", index <= step);
                });

                const progressPercent = ((step + 1) / steps.length) * 100;
                progressBar.style.width = progressPercent + "%";
            }

            function validateStep(step) {
                let valid = true;
                const inputs = steps[step].querySelectorAll("input, select, textarea");
                inputs.forEach((input) => {
                    if (!input.checkValidity()) {
                        input.classList.add("error");
                        valid = false;
                        const errorDiv = document.getElementById(input.name + "Error");
                        if (errorDiv) {
                            errorDiv.textContent = input.validationMessage;
                            errorDiv.style.display = "block";
                        }
                    } else {
                        input.classList.remove("error");
                        const errorDiv = document.getElementById(input.name + "Error");
                        if (errorDiv) {
                            errorDiv.style.display = "none";
                        }
                    }
                });
                return valid;
            }

            nextSteps.forEach((btn, index) => {
                btn.addEventListener("click", function() {
                    if (validateStep(currentStep)) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            prevSteps.forEach((btn) => {
                btn.addEventListener("click", function() {
                    currentStep--;
                    showStep(currentStep);
                });
            });

            // Review Data Display Logic
            document.querySelectorAll(".step").forEach((step, index) => {
                const inputs = step.querySelectorAll("input, select, textarea");
                inputs.forEach((input) => {
                    input.addEventListener("change", () => {
                        const dataRow = document.createElement("div");
                        dataRow.innerHTML = `<strong>${input.name}:</strong> ${input.value}`;
                        reviewData.appendChild(dataRow);
                    });
                });
            });

            // Show the first step on page load
            showStep(currentStep);
        });
    </script>
    @endpush --}}
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Stepper-->
                    <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                        <!--begin::Nav-->
                        <div class="stepper-nav mb-5">
                            <!--begin::Step 1-->
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-6">Demographic Information</h6>
                            </div>
                            <!--end::Step 1-->
                            <!--begin::Step 2-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-6">General Information</h6>
                            </div>
                            <!--end::Step 2-->
                            <!--begin::Step 3-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-6 ">Economic Information</h6>
                            </div>
                            <!--end::Step 3-->
                            <!--begin::Step 4-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-6">Vulnerabilities & Losses</h6>
                            </div>
                            <!--end::Step 4-->
                            <!--begin::Step 5-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-6">Observation/Comments</h6>
                            </div>
                            <!--end::Step 5-->
                            <!--begin::Step 6-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-6">Review/Submit</h6>
                            </div>
                            <!--end::Step 6-->
                        </div>
                        <!--end::Nav-->
                        <!--begin::Form-->
                        <form class="mx-auto w-100 pt-4" novalidate="novalidate" id="kt_create_account_form">
                            <!--begin::Step 1-->
                            <div class="current" data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    @include("admin.benificiaryAssessment.partials.demographic_information")
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 1-->
                            <!--begin::Step 2-->
                            <div data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    @include("admin.benificiaryAssessment.partials.general_information_form")
                                    <!--end::Input group-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 2-->
                            <!--begin::Step 3-->
                            <div data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    @include("admin.benificiaryAssessment.partials.economic_information_form")
                                    <!--end::Input group-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 3-->
                            <!--begin::Step 4-->
                            <div data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    <!--begin::Heading-->
                                    @include("admin.benificiaryAssessment.partials.vulnerability")
                                    <!--end::Input group-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 4-->
                            <!--begin::Step 5-->
                            <div data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    @include("admin.benificiaryAssessment.partials.observation_form")
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 5-->
                              <!--begin::Step 5-->
                              <div data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Step 5-->
                            <!--begin::Actions-->
                            <div class="d-flex flex-stack pt-15">
                                <!--begin::Wrapper-->
                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                    <i class="ki-duotone ki-arrow-left fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Back</button>
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Wrapper-->
                                <div>
                                    <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                        <span class="indicator-label">Submit
                                        <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i></span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
                                    <i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i></button>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
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
