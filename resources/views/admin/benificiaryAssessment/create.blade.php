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
            <form id="kt_beneficiary_assessment" action="{{ route('submit-beneficiary-assessment-form') }}" enctype="multipart/form-data">
                @csrf
                <div class="step active" data-step="1">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.demographic_information')
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 2 Card -->
                <div class="step" data-step="2">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.general_information_form')
                        <div class="button-group">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 3 Card -->
                <div class="step" data-step="3">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.economic_information_form')
                        <div class="button-group">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 4 Card -->
                <div class="step" data-step="4">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.vulnerability')
                        <div class="button-group">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn btn-primary btn-sm next-step">Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 5 Card -->
                <div class="step" data-step="5">
                    <div class="card">
                        @include('admin.benificiaryAssessment.partials.observation_form')
                        <div class="button-group">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="button" class="btn btn-primary btn-sm next-step" id="finishStep">Finish</button>
                        </div>
                    </div>
                </div>

                <!-- Step 6 Card - Review & Submit -->
                <div class="step" data-step="6">
                    <div class="card">
                        <h4>Review Your Information</h4>
                        <div id="review-data" class="row"></div>
                        <div class="button-group">
                            <button type="button" class="btn btn-secondary btn-sm previous-step">Previous</button>
                            <button type="submit" class="btn btn-primary " id="kt_submit_beneficiary_assessment">
                                Submit
                            </button>
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
                    reviewData.innerHTML = ''; // Clear existing review data
                    const formData = new FormData(document.getElementById('kt_beneficiary_assessment'));
                    
                    // Create a table for the review data
                    const table = document.createElement('table');
                    table.classList.add('table', 'table-bordered', 'table-striped', 'mt-3');

                    // Create table header
                    const thead = document.createElement('thead');
                    thead.innerHTML = `
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    `;
                    table.appendChild(thead);

                    // Create table body
                    const tbody = document.createElement('tbody');

                    for (let [key, value] of formData.entries()) {
                        // Create a row for each field
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${key.replace(/_/g, ' ').toUpperCase()}</td>
                            <td>${value}</td>
                        `;
                        tbody.appendChild(row);
                    }

                    // Append tbody to the table
                    table.appendChild(tbody);

                    // Append the table to the reviewData container
                    reviewData.appendChild(table);
                }


            });
        </script>
    @endpush
</x-nform-layout>
