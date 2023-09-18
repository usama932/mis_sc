<x-default-layout>
    @push('stylesheets')
    <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
    @endpush
    <style>
        .loader {
            display: none;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
    @section('title')
        Add Feedback Registry Form
    @endsection
    <div id="loader" class="loader"></div>

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
        <form  class="form" action="{{route('user-management.users.store')}}"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Full name"/>
                    <!--end::Input-->
                    @error('name')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com"/>
                    <!--end::Input-->
                    @error('email')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Province</span>
                    </label>
                    <select   name="province"  id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('province') is-invalid @enderror required>
                        <option value="">Select Province</option>
                        {{-- <option value='1'>Punjab</option> --}}
                        <option value='4'>Sindh</option>
                        <option value='2'>KPK</option>
                        {{-- <option value='4'>Balochistan</option> --}}
                    </select>
                    @error('province')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">District</span>
                    </label>
                    <select id="kt_select2_district" name="district"  aria-label="Select a District" data-control="select2" data-placeholder="Select a District..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('district') is-invalid @enderror required>

                    </select>
                    @error('district')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Permission Level</span>
                    </label>
                    <select   name="permissions_level" data-control="select2" data-placeholder="Select a Permissions level..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('permissions_level') is-invalid @enderror required>
                        <option value="">Select Permissions Level</option>
                         <option value='nation-wide'>Nation Wide</option>
                         <option value='province-wide'>Province Wide</option>
                         <option value='district-wide'>District Wide</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Designation</span>
                    </label>
                    <select   name="designation" data-control="select2" data-placeholder="Select a Permissions level..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('permissions_level') is-invalid @enderror required>
                        <option value="">Select Permissions Level</option>
                        @foreach ($designations as $designation)
                            <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                        @endforeach


                    </select>
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Role</span>
                    </label>
                    <select   name="designation"  data-control="select2" data-placeholder="Select a Permissions level..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('permissions_level') is-invalid @enderror required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach


                    </select>
                </div>
               
            </div>
            <div class="text-center pt-15">
                <a href=""  class="btn btn-light me-3">Discard</button>
                <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                    <span>Submit</span>
                   
                </button>
            </div>
        </form>

    </div>

</x-default-layout>
