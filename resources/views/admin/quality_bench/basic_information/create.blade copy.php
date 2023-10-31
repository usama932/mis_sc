<x-default-layout>
    @push('stylesheets')
        <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
    @endpush
    @section('title')
        Create Monitoring Quality Benchmarks
    @endsection
   

    <div class="card">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form class="form" action="{{route('quality-benchs.store')}}" method="post">
            @csrf
            <div class="card-body py-4">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Basic Information::</h5>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Visit Staff Name</span>
                        </label>
                        <select name="visit_staff_name" aria-label="Select a Visit Staff Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select form-select-solid" required  @error('visit_staff_name') is-invalid @enderror>
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
                            <span class="required">Date of monitoring visit </span>
                        </label>
                        <input type="text"  @error('date_visit') is-invalid @enderror name="date_visit" id="date_visit" placeholder="Select date"  class="form-control" onkeydown="event.preventDefault()" data-provide="datepicker" value="" required>
                        @error('date_visit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Accompanied By</span>
                        </label>
                        <select name="accompanied_by" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Accompanied By..." class="form-select form-select-solid" required  @error('accompanied_by') is-invalid @enderror>
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
                            <span class="required">Type of visit</span>
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
                            <span class="required">Province</span>
                        </label>
                        <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid"   @error('province') is-invalid @enderror required>
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
                            <span class="required">District</span>
                        </label>
                        <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid"  @error('district') is-invalid @enderror required>

                        </select>
                        @error('district')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Tehsil</span>
                        </label>
                        <select id="kt_select2_tehsil"  @error('tehsil') is-invalid @enderror name="tehsil" aria-label="Select a Tehsil" data-control="select2" data-placeholder="Select a Tehsil..." class="form-select form-select-solid" required>

                        </select>
                        @error('tehsil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Union Counsil</span>
                        </label>
                        <select id="kt_select2_union_counsil"  @error('union_counsil') is-invalid @enderror name="union_counsil" aria-label="Select a UC" data-control="select2" data-placeholder="Select a Uc..." class="form-select form-select-solid" required>

                        </select>
                        @error('union_counsil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Village</span>
                        </label>
                        <input class="form-control "  @error('village') is-invalid @enderror placeholder="Enter Village" name="village" value="" / required>
                        @error('village')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Project Type</span>
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
                            <span class="required">Project</span>
                        </label>
                        <select   name="project_name"  @error('project_name') is-invalid @enderror aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid">
                            <option>Select Project</option>
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
                    {{-- <div class="col-md-4 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Theme</span>
                        </label>
                        <select   name="theme"  @error('theme') is-invalid @enderror aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select form-select-solid" required>
                            <option>Select Theme</option>
                            @foreach($themes as $theme)
                                <option value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach
                        </select>
                        @error('theme')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                  
             
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Monitoring Type</span>
                        </label>
                        <select   name="monitoring_type"  @error('monitoring_type') is-invalid @enderror aria-label="Select a Type of Visit " data-control="select2" data-placeholder="Select a Monitoring Type" class="form-select form-select-solid">
                            <option value="">Select Monitoring Type</option>
                            <option value="Process and output monitoring">Process and output monitoring</option>
                            <option value="Distribution">Distribution</option>
                            <option value="Joint outcome monitoring">Joint outcome monitoring</option>
                        </select>
                        @error('monitoring_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">QBs not applicable .#</span>
                        </label>
                        <input type="number" class="form-control"  @error('qb_not_applicable') is-invalid @enderror placeholder="Enter QBs not applicable" name="qb_not_applicable" value="" / required>
                        @error('qb_not_applicable')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">QBs Fully Met .#</span>
                        </label>
                        <input type="number" class="form-control"  @error('qbs_fully_met') is-invalid @enderror placeholder="Enter QBs Fully Met" name="qbs_fully_met" value="" / required>
                        @error('qbs_fully_met')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">QBs Not Fully Met .#</span>
                        </label>
                        <input type="number" class="form-control"  @error('qbs_not_fully_met') is-invalid @enderror placeholder="Enter QBs Not Fuuly Met" name="qbs_not_fully_met" value="" / required>
                        @error('qbs_not_fully_met')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Score out of 100%
                               
                            </span>
                        </label>
                        <input type="number" class="form-control"  @error('score_out') is-invalid @enderror placeholder="Enter Score Out of 100%" name="score_out" value="" / required>
                        <small>Total fully met/Total not fully met</small>
                        @error('score_out')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-9 mt-3">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Activities visited during the monitoring visit </span>
                        </label>
                        <textarea type="number"  @error('activity_description') is-invalid @enderror class="form-control "  name="activity_description" / required></textarea>
                        @error('activity_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
              
                
              
                </div>
                <div class="text-center pt-15">
                    <button type="reset" class="btn btn-light me-3" >Discard</button>
                    <button type="submit" class="btn btn-primary" >
                        Submit
                    </button>
                </div>
            </div>
        </form>

    </div>


    @push('scripts')
    <script>
        $('#date_visit').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today",
            minDate: new Date().fp_incr(-60), 
        });
    </script>
      @include('admin.frm.scripts_file.frm_script');
    



    @endpush

</x-default-layout>
