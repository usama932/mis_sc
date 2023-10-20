<x-default-layout>

    @section("stylesheets")
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    @endsection
    @section('title')
        Quality Benchmark Management
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">
           <!--begin::Card-->
            <div class="card">
                <div class="card-title m-5">
                    <h1>Quality Benchmark Action Points Exports:</h1>
                    <form class="form" action="{{route('getqb-export')}}" method="post">
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
                                        <span class=" ">Visit Staff Name</span>
                                    </label>
                                    <select name="visit_staff_name" aria-label="Select a Visit Staff Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select form-select-solid"    @error('visit_staff_name') is-invalid @enderror>
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
                                    @error('visit_staff_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Date of monitoring visit </span>
                                    </label>
                                    <input type="text"  @error('date_visit') is-invalid @enderror name="date_visit" id="date_visit" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value=""  >
                                    @error('date_visit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Accompanied By</span>
                                    </label>
                                    <select name="accompanied_by" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Accompanied By..." class="form-select form-select-solid"    @error('accompanied_by') is-invalid @enderror>
                                        <option  value="">Select Option</option>
                                        <option  value="Project Staff">Project Staff</option>
                                        <option  value="Govt Officials">Govt Officials</option>
                                        <option  value="Donor">Donor</option>
                                        <option  value="NA">NA</option>
                                      
                                        
                                        
                                    </select>
                                    @error('name_of_registrar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Type of visit</span>
                                    </label>
                                    <select   name="type_of_visit"  @error('type_of_visit') is-invalid @enderror aria-label="Select a Type of Visit " data-control="select2" data-placeholder="Select a Type of Visit" class="form-select form-select-solid">
                                        <option value="">Select Project Type</option>
                                        <option value="Independent">Independent</option>
                                        <option value="Joint">Joint</option>
                                    </select>
                                    @error('type_of_visit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    @error('province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">District</span>
                                    </label>
                                    <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid"  @error('district') is-invalid @enderror  >
            
                                    </select>
                                    @error('district')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Project Type</span>
                                    </label>
                                    <select   name="project_type"  @error('project_type') is-invalid @enderror aria-label="Select a Project Type" data-control="select2" data-placeholder="Select a Project Type" class="form-select form-select-solid">
                                        <option value="">Select Project Type</option>
                                        <option value="Humanitarian">Humanitarian</option>
                                        <option value="Development">Development</option>
                                    </select>
                                    @error('project_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class=" ">Project</span>
                                    </label>
                                    <select   name="project_name"  @error('project_name') is-invalid @enderror aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid">
                                        <option  value="">Select Project</option>
                                        @foreach($projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('project_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center pt-15">
                                <button type="reset" class="btn btn-light me-3" >Discard</button>
                                <button type="submit" class="btn btn-primary" >
                                    Export
                                </button>
                            </div>
                        </div>
                    </form>
            
                </div>
            </div>
        </div>

    </div>

    @push("scripts")
    <script>
        $('#date_visit').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today",
            minDate: new Date().fp_incr(-60), 
        });
    </script>
    @include('admin.frm.frm_script');
    @endpush


</x-default-layout>
