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
