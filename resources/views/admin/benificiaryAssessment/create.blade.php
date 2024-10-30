<x-nform-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
            <form id="kt_beneficary_assessment"  action="" enctype="multipart/form-data">
                @csrf
                <div class="step active" data-step="1">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.demographic_information')
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2 Card -->
                <div class="step" data-step="2">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.general_information_form')
                        <div class="button-group">
                            <button class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3 Card -->
                <div class="step" data-step="3">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.economic_information_form')
                        <div class="button-group">
                            <button class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 4 Card -->
                <div class="step" data-step="4">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.vulnerability')
                        <div class="button-group">
                            <button class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 5 Card -->
                <div class="step" data-step="5">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.observation_form')
                        <div class="button-group">
                            <button class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 6 Card - Review & Submit -->
                <div class="step" data-step="6">
                    <div class="card">
                        <h4>Review Your Information</h4>
                        <div id="review-data" class="row">
                            <div class="col-md-12">
                                <div class="row mb-3">
                                    <div class="col-md-6 font-weight-bold">Demographic Information:</div>
                                    <div class="col-md-6" id="demo-info"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 font-weight-bold">General Information:</div>
                                    <div class="col-md-6" id="general-info"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 font-weight-bold">Economic Information:</div>
                                    <div class="col-md-6" id="economic-info"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 font-weight-bold">Vulnerabilities & Losses:</div>
                                    <div class="col-md-6" id="vulnerabilities-info"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 font-weight-bold">Observation/Comments:</div>
                                    <div class="col-md-6" id="observation-info"></div>
                                </div>
                            </div>
                        </div>
                        <div class="button-group">
                            <button class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button class="btn btn-primary btn-sm submit-form">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const steps = document.querySelectorAll('.step');
            const nextButtons = document.querySelectorAll('.next-step');
            const previousButtons = document.querySelectorAll('.previous-step');
            const progressBar = document.getElementById('progress-bar');
            const reviewData = document.getElementById('review-data');
            const totalSteps = steps.length;
            const stepItems = document.querySelectorAll('.step-bar-item');
    
            showStep(1); // Show the first step
    
            // Step Navigation
            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const currentStep = getActiveStep();
                    if (validateStep(currentStep)) {
                        if (currentStep === totalSteps - 1) {
                            populateReviewData();
                        }
                        showStep(currentStep + 1);
                    } else {
                        toastr.error("Please fill all required fields.");
                    }
                });
            });
    
            previousButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const currentStep = getActiveStep();
                    showStep(currentStep - 1);
                });
            });
    
            function showStep(step) {
                steps.forEach((el, index) => {
                    el.classList.toggle('active', index === step - 1);
                });
                updateProgressBar(step);
                updateStepBar(step);
            }
    
            function getActiveStep() {
                return Array.from(steps).findIndex(step => step.classList.contains('active')) + 1;
            }
    
            function validateStep(step) {
                let valid = true;
                const inputs = steps[step - 1].querySelectorAll('input[required], textarea[required]');
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('error');
                        valid = false;
                    } else {
                        input.classList.remove('error');
                    }
                });
                return valid;
            }
    
            function updateProgressBar(step) {
                const percentage = ((step - 1) / (totalSteps - 1)) * 100;
                progressBar.style.width = `${percentage}%`;
            }
    
            function updateStepBar(step) {
                stepItems.forEach((item, index) => {
                    item.classList.toggle('active', index < step);
                });
            }
    
            function populateReviewData() {
                // Collect data from previous steps and populate the review section
                const demoInfo = document.querySelectorAll('input[name^="demographic_"], textarea[name^="demographic_"]');
                const generalInfo = document.querySelectorAll('input[name^="general_"], textarea[name^="general_"]');
                const economicInfo = document.querySelectorAll('input[name^="economic_"], textarea[name^="economic_"]');
                const vulnerabilitiesInfo = document.querySelectorAll('input[name^="vulnerability_"], textarea[name^="vulnerability_"]');
                const observationInfo = document.querySelectorAll('input[name^="observation_"], textarea[name^="observation_"]');

                // Populate Demographic Information
                document.getElementById('demo-info').innerHTML = Array.from(demoInfo).map(input => `<div>${input.name}: ${input.value}</div>`).join('');

                // Populate General Information
                document.getElementById('general-info').innerHTML = Array.from(generalInfo).map(input => `<div>${input.name}: ${input.value}</div>`).join('');

                // Populate Economic Information
                document.getElementById('economic-info').innerHTML = Array.from(economicInfo).map(input => `<div>${input.name}: ${input.value}</div>`).join('');

                // Populate Vulnerabilities & Losses
                document.getElementById('vulnerabilities-info').innerHTML = Array.from(vulnerabilitiesInfo).map(input => `<div>${input.name}: ${input.value}</div>`).join('');

                // Populate Observation/Comments
                document.getElementById('observation-info').innerHTML = Array.from(observationInfo).map(input => `<div>${input.name}: ${input.value}</div>`).join('');
            }
                
            document.querySelector('.submit-form').addEventListener('click', function() {
                toastr.success("Form submitted successfully!");
            });
        });
    </script>
    @endpush
</x-nform-layout>
