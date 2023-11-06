<x-default-layout>

    @section("stylesheets")
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    @endsection
    @section('title')
    Quality Benchmark Action Points Exports
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">
           <!--begin::Card-->
            <div class="card">
                <form id="exportqbactionpoint">
                    @csrf
                    <div class="card-body py-4">
                        <div class="card-title  border-0 my-4"">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                    <h5 class="fw-bold m-3">Select Filter (Optional)::</h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class=" ">Date of monitoring visit </span>
                                </label>
                                <input class="form-control form-control-solid" aria-label="Pick date range"  placeholder="Pick date range" id="date_visit" name="date_visit" value=" ">
                                @error('date_visit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <button type="submit" class="btn btn-primary me-10" id="btn-submit" >
                                <span class="indicator-label">
                                    Export
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @push("scripts")
    <script>
        flatpickr("#date_visit", {
            mode: "range",
            dateFormat: "Y-m-d",
            maxDate: "today",
        });
    </script>
    @endpush


</x-default-layout>
