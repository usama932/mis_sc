<x-nform-layout>
    <style>
        .radio-card-group {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .radio-card {
            width: 150px;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .radio-card:hover {
            border-color: #007BFF;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
            transform: scale(1.05);
        }

        .radio-card input[type="radio"] {
            display: none;
        }

        .radio-card i {
            font-size: 30px;
            color: #555;
            margin-bottom: 10px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        .radio-card label {
            display: block;
            font-size: 16px;
            font-weight: 500;
            color: #555;
            margin-top: 10px;
            transition: color 0.3s ease, font-weight 0.3s ease;
        }

        .radio-card input[type="radio"]:checked + label {
            color: #007BFF;
            font-weight: bold;
        }

        .radio-card input[type="radio"]:checked + label i {
            color: #007BFF;
        }

    </style>
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
                                <h6 class="stepper-title fs-7">Assessment Form</h6>
                            </div>
                            <!--begin::Step 1-->
                            <div class="stepper-item " data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-7">Demographic Information</h6>
                            </div>
                            <!--end::Step 1-->
                            <!--begin::Step 2-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-7">General Information</h6>
                            </div>
                            <!--end::Step 2-->
                            <!--begin::Step 3-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-7 ">Economic Information</h6>
                            </div>
                            <!--end::Step 3-->
                            <!--begin::Step 4-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-7">Vulnerabilities & Losses</h6>
                            </div>
                            <!--end::Step 4-->
                            <!--begin::Step 5-->
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-7">Observation/Comments</h6>
                            </div>
                            <!--end::Step 5-->
                            <!--begin::Step 6-->
                            {{-- <div class="stepper-item" data-kt-stepper-element="nav">
                                <h6 class="stepper-title fs-7">Review/Submit</h6>
                            </div> --}}
                            <!--end::Step 6-->
                        </div>
                        <!--end::Nav-->
                        <!--begin::Form-->
                        <form class="mx-auto w-100 pt-2" novalidate="novalidate" id="kt_create_account_form" action="{{ route('submit-beneficiary-assessment-form') }}" method="post" data-kt-redirect-url="{{ route('beneficiary-assessment-list') }}">
                            <div class="current" data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    @include("admin.benificiaryAssessment.partials.assessment_form")
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--begin::Step 1-->
                            <div  data-kt-stepper-element="content">
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
                            <!--begin::Step 6-->
                            {{-- <div data-kt-stepper-element="content">
                                <!--begin::Wrapper-->
                                <div class="w-100">
                                    
                                </div>
                                <!--end::Wrapper-->
                            </div> --}}
                            <!--end::Step 6-->
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
