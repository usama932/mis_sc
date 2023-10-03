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
        Edit User Form
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
        <form  class="form" method="post" action="{{route('user-management.users.update',$user->id)}}"  enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Full Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="{{$user->name ?? ''}}"/>
                    <!--end::Input-->
                    @error('name')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" value="{{$user->email ?? ''}}"/>
                    <!--end::Input-->
                    @error('email')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                {{-- <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Passowrd</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="password" name="passowrd" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example@domain.com"/>
                    <!--end::Input-->
                    @error('passowrd')
                    <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}
                {{-- <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Province</span>
                    </label>
                    <select   name="province"  id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('province') is-invalid @enderror required>
                        <option value="">Select Province</option>
                        <option @if($user->province == '1') selected @endif value='1'>Punjab</option>

                        <option @if($user->province == '2') selected @endif value='2'>KPK</option>
                        <option @if($user->province == '3') selected @endif value='3'>Balochistan</option>
                        <option @if($user->province == '4') selected @endif value='4'>Sindh</option>
                        <option @if($user->province == '7') selected @endif value='7'>Federal Capital Teritory</option>
                      
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
                </div> --}}
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Permission Level</span>
                    </label>
                    <select   name="permissions_level" data-control="select2" data-placeholder="Select a Permissions level..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('permissions_level') is-invalid @enderror required>
                        <option  @if($user->permissions_level == '') selected @endif value="">Select Permissions Level</option>
                         <option @if($user->permissions_level == 'nation-wide') selected @endif value='nation-wide'>Nation Wide</option>
                         <option @if($user->permissions_level == 'province-wide') selected @endif value='province-wide'>Province Wide</option>
                         <option @if($user->permissions_level == 'district-wide') selected @endif value='district-wide'>District Wide</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">User Type</span>
                    </label>
                    <select   name="user_type" data-control="select2" data-placeholder="Select a User Typel..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('user_type') is-invalid @enderror required>
                        <option value="">Select User Type</option>
                         <option  @if($user->user_type == 'R1') selected @endif  value='R1'>R1</option>
                         <option  @if($user->user_type == 'R2') selected @endif  value='R2'>R2</option>
                         <option  @if($user->user_type == 'R3') selected @endif  value='R3'>R3</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Designation</span>
                    </label>
                    <select   name="designation" data-control="select2" data-placeholder="Select a Permissions level..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('permissions_level') is-invalid @enderror required>
                        <option value="">Select Permissions Level</option>
                        @foreach ($designations as $designation)
                            <option value="{{$designation->id}}" @if($user->designation == $designation->id) selected @endif>{{$designation->designation_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Role  </span>
                    </label>
                    <select   name="role"  data-control="select2" data-placeholder="Select a Permissions level..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('permissions_level') is-invalid @enderror required>
                        <option value="">Select Role</option>
                       
                        @foreach ($roles as $role)
                            <option @if($user->roles->first()?->name == $role->name) selected @endif value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach


                    </select>
                </div>
               
            </div>
            <div class="text-center pt-15">
                <a href=""  class="btn btn-light btn-sm me-4">Discard</button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <span>Submit</span>
                   
                </button>
            </div>
        </form>

    </div>
    @push('scripts')
        <script>
            $("#kt_select2_province").change(function () {


                var value = $(this).val();
                csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '/getuserDistrict',
                    data: {'province': value, _token: csrf_token },
                    dataType: 'json',
                    success: function (data) {

                        $("#kt_select2_district").find('option').remove();
                        $("#kt_select2_district").prepend("<option value='' >Select District</option>");
                        var selected='';
                        $.each(data, function (i, item) {

                            $("#kt_select2_district").append("<option value='" + item.district_id + "' "+selected+" >" +
                            item.district_name.replace(/_/g, ' ') + "</option>");
                        });
                        $('#kt_select2_tehsil').html('<option value="">Select Tehsil</option>');
                        $('#kt_select2_union_counsil').html('<option value=""> Select UC</option>');

                    }

                });

            }).trigger('change');
        </script>
    @endpush
</x-default-layout>
