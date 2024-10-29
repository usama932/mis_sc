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
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="container">
            <!-- Step Bar Header -->
            <div class="step-bar">
                <div class="step-bar-item active" data-step="1">Demographic Information</div>
                <div class="step-bar-item" data-step="2">General Information</div>
                <div class="step-bar-item" data-step="3">Economic Information</div>
                <div class="step-bar-item " data-step="4">Vulnerabilities & Losses</div>
                <div class="step-bar-item" data-step="5">Observation/Comments</div>
            </div>

            <!-- Step 1 Card -->
            <div class="step active" data-step="1">
                <div class="card">
                    @include('admin.benificiaryAssessment.partials.demographic_information')
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-custom btn-sm next-step">Next</button>
                    </div>
                </div>
            </div>

            <!-- Step 2 Card -->
            <div class="step" data-step="2">
                <div class="card">
                    @include('admin.benificiaryAssessment.partials.general_information_from')
                    <div class="button-group">
                        <button class="btn btn-custom btn-sm previous-step">Previous</button>
                        <button class="btn btn-custom btn-sm next-step">Next</button>
                    </div>
                </div>
            </div>

            <!-- Step 3 Card -->
            <div class="step" data-step="3">
                <div class="card">
                    @include('admin.benificiaryAssessment.partials.economic_information_form')
                    <div class="button-group">
                        <button class="btn btn-custom btn-sm previous-step">Previous</button>
                        <button class="btn btn-custom btn-sm next-step">Next</button>
                    </div>
                </div>
            </div>

            <!-- Step 4 Card -->
            <div class="step" data-step="4">
                <div class="card">
                    @include('admin.benificiaryAssessment.partials.vulnerability')
                    <div class="button-group">
                        <button class="btn btn-custom btn-sm previous-step">Previous</button>
                        <button class="btn btn-custom btn-sm next-step">Next</button>
                    </div>
                </div>
            </div>

            <!-- Step 5 Card -->
            <div class="step" data-step="5">
                <div class="card">
                    @include('admin.benificiaryAssessment.partials.observation_form')
                    <div class="button-group">
                        <button class="btn btn-custom btn-sm previous-step">Previous</button>
                        <button class="btn btn-custom btn-sm submit-form">Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

@push("scripts")
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const steps = document.querySelectorAll('.step');
        const nextButtons = document.querySelectorAll('.next-step');
        const previousButtons = document.querySelectorAll('.previous-step');

        showStep(1); // Show the first step

        // Step Navigation
        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                const currentStep = getActiveStep();
                if (validateStep(currentStep)) {
                    showStep(currentStep + 1);
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
            updateStepBar(step);
        }

        function getActiveStep() {
            return Array.from(steps).findIndex(step => step.classList.contains('active')) + 1;
        }

        function validateStep(step) {
            let valid = true;
            const inputs = steps[step - 1].querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                if (input.required && !input.value) {
                    input.classList.add('error');
                    const errorMessage = document.getElementById(input.name + 'Error');
                    if (errorMessage) {
                        errorMessage.innerText = 'This field is required.';
                        errorMessage.style.display = 'block';
                    }
                    valid = false;
                } else {
                    input.classList.remove('error');
                    const errorMessage = document.getElementById(input.name + 'Error');
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                }
            });

            return valid;
        }

        function updateStepBar(activeStep) {
            document.querySelectorAll('.step-bar-item').forEach((item, index) => {
                item.classList.toggle('active', index === activeStep - 1);
            });
        }
    });
</script>
@endpush
</x-nform-layout>
