<x-default-layout>
    @section('title')
        Quality Benchmark Exports:
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">
           <!--begin::Card-->
            <div class="card">
                <div class="card-title m-5">
                    <form id="exportqb">
                        @csrf
                        <div class="card-body py-4">
                            <div class="card-title  border-0 my-4"">
                                <div class="card-title">
                                    <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                        <h5 class="fw-bold m-3">Select Filters (Optional)::</h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Visit Staff Name</span>
                                    </label>
                                    <select name="visit_staff_name" id="visit_staff_name" aria-label="Select a Visit Staff Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select form-select-solid">
                                        <option  value="">Select Option</option>
                                        @foreach($users as $user)
                                            <option  value="{{$user->name}}" >{{$user->name}}</option>
                                        @endforeach
                                        <option  value="Ruqaiya Bibi" >Ruqaiya Bibi</option>
                                        <option  value="Dr. Kashmala" >Dr. Kashmala</option>
                                        <option  value="Mehnaz" >Mehnaz</option>
                                        <option  value="Musarrat Bibi" >Musarrat Bibi</option>
                                        <option  value="Shaista Mir" >Shaista Mir</option>
                                        <option  value="Shama" >Shama</option>
                                        <option  value="Zahid Ali Khan" >Zahid Ali Khan</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="">Date of monitoring visit </span>
                                    </label>
                                    <input class="form-control form-control-solid" aria-label="Pick date range"  placeholder="Pick date range" id="date_visit" name="date_visit" value=""  class="form-control">
                                    
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Accompanied By</span>
                                    </label>
                                    <select name="accompanied_by" id="accompanied_by" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Accompanied By..." class="form-select form-select-solid">
                                        <option  value="">Select Option</option>
                                        <option  value="Project Staff">Project Staff</option>
                                        <option  value="Govt Officials">Govt Officials</option>
                                        <option  value="Donor">Donor</option>
                                        <option  value="NA">NA</option>
                                      
                                        
                                        
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Type of visit</span>
                                    </label>
                                    <select   name="type_of_visit" id="type_of_visit" aria-label="Select a Type of Visit " data-control="select2" data-placeholder="Select a Type of Visit" class="form-select form-select-solid">
                                        <option value="">Select Project Type</option>
                                        <option value="Independent">Independent</option>
                                        <option value="Joint">Joint</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Province</span>
                                    </label>
                                    <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid"   @error('province') is-invalid @enderror  >
                                        @if(auth()->user()->permissions_level == 'province-wide' || auth()->user()->permissions_level == 'district-wide')
                                            <option value="">Select Province</option>
                                            {{-- <option value='1'>Punjab</option> --}}
                                            <option @if(auth()->user()->province == '4') selected @endif value='4'>Sindh</option>
                                            <option  @if(auth()->user()->province == '2') selected @endif value='2'>KPK</option>
                                            <option   @if(auth()->user()->province == '3') selected @endif value='3'>Balochistan</option>
                                        @else
                                            <option value="">Select Province</option>
                                            {{-- <option value='1'>Punjab</option> --}}
                                            <option value='4'>Sindh</option>
                                            <option  value='2'>KPK</option>
                                            <option value='3'>Balochistan</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">District</span>
                                    </label>
                                    <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid"  @error('district') is-invalid @enderror  >
            
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Project Type</span>
                                    </label>
                                    <select   name="project_type" id="project_type" aria-label="Select a Project Type" data-control="select2" data-placeholder="Select a Project Type" class="form-select form-select-solid">
                                        <option value="">Select Project Type</option>
                                        <option value="Humanitarian">Humanitarian</option>
                                        <option value="Development">Development</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Project</span>
                                    </label>
                                    <select   name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid">
                                        <option  value="">Select Project</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    </select>
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

    </div>
</x-default-layout>
