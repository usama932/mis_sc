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
        Add User Form
    @endsection
    <div id="loader" class="loader"></div>

    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger  p-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="errorList" class=" p-3" style="display: none; color: red;">
            <ul id="errors"></ul>
        </div>
        <form  class="form p-5" method="post" action="{{route('user-management.users.store')}}"  enctype="multipart/form-data"  id="myForm">
            @csrf
             <!--begin::Input-->
             <input type="hidden" name="status"  value="1"/>
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
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Passowrd</label>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="XXXXXXXX">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye" id="eye"></i></button>
                    </div>
                    @error('passowrd')
                    <span class="text-danger">{{ $message }}</span> @enderror
                    
                    <div id="passwordFormatError" style="display: none; color: red;">Must between 8 to 20 characters & At least one numeric digit, one uppercase and one lowercase letter</div>
                </div>
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Confirm Passowrd</label>
                    <div class="input-group mb-3">
                        <input type="password" name="repeatPassword" id="repeatPassword" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="XXXXXXXX">
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"><i class="fas fa-eye" id="confirmEye"></i></button>
                    </div>
                    <div id="passwordMatchError" style="display: none; color: red;">Passwords do not match</div>
                </div>
                <div class="col-md-6">
                    <label class=" fw-semibold fs-6 mb-2">
                        <span class="required">Province</span>
                    </label>
                    <select   name="province"  id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('province') is-invalid @enderror required>
                        <option value="">Select Province</option>
                        <option value='1'>Punjab</option>

                        <option value='2'>KPK</option>
                        <option value='3'>Balochistan</option>
                        <option value='4'>Sindh</option>
                        <option value='7'>Federal Capital Teritory</option>
                      
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
                        <span class="required">User Type</span>
                    </label>
                    <select   name="user_type" data-control="select2" data-placeholder="Select a User Typel..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('user_type') is-invalid @enderror required>
                        <option value="">Select User Type</option>
                        <option value='admin'>Admin</option>
                        <option value='R1'>R1</option>
                        <option value='R2'>R2</option>
                        <option value='R3'>R3</option>
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
                    <select   name="role"  data-control="select2" data-placeholder="Select a Permissions level..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('permissions_level') is-invalid @enderror required>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
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
            document.getElementById('myForm').addEventListener('submit', function(event) {
                const passwordInput = document.getElementById('password');
                const repeatPasswordInput = document.getElementById('repeatPassword');
                const errorsContainer = document.getElementById('errors');
                const errorList = document.getElementById('errorList');

                var passwordErrors = CheckPassword(passwordInput);
                if (passwordInput.value !== repeatPasswordInput.value) {
                    passwordErrors.push("Passwords do not match.");
                }

                if (passwordErrors.length > 0) {
                    // Clear previous errors
                    errorsContainer.innerHTML = '';
                    // Populate the errors list
                    passwordErrors.forEach(function(error) {
                        var li = document.createElement('li');
                        li.textContent = error;
                        errorsContainer.appendChild(li);
                    });
                    // Show the error list
                    errorList.style.display = 'block';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    event.preventDefault();
                } else {
                    // Hide the error list if there are no errors
                    errorList.style.display = 'none';
                }
            });

            function CheckPassword(inputtxt) {
                var errors = [];
                var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{8,20}$/;
                
                if (!passw.test(inputtxt.value)) {
                    if (inputtxt.value.length < 8 || inputtxt.value.length > 20) {
                        errors.push("Password must be between 8 and 20 characters long.");
                    }
                    if (!/[A-Z]/.test(inputtxt.value)) {
                        errors.push("Password must contain at least one uppercase letter.");
                    }
                    if (!/[a-z]/.test(inputtxt.value)) {
                        errors.push("Password must contain at least one lowercase letter.");
                    }
                    if (!/\d/.test(inputtxt.value)) {
                        errors.push("Password must contain at least one digit.");
                    }
                    if (!/[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]/.test(inputtxt.value)) {
                        errors.push("Password must contain at least one special character.");
                    }
                }
                return errors;
            }
        </script>
        <script>
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('togglePassword');
            const eyeIcon = document.getElementById('eye');
        
            togglePasswordButton.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        </script>
        <script>
            const confirmPasswordInput = document.getElementById('repeatPassword');
            const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');
            const confirmEyeIcon = document.getElementById('confirmEye');
        
            toggleConfirmPasswordButton.addEventListener('click', function() {
                if (confirmPasswordInput.type === 'password') {
                    confirmPasswordInput.type = 'text';
                    confirmEyeIcon.classList.remove('fa-eye');
                    confirmEyeIcon.classList.add('fa-eye-slash');
                } else {
                    confirmPasswordInput.type = 'password';
                    confirmEyeIcon.classList.remove('fa-eye-slash');
                    confirmEyeIcon.classList.add('fa-eye');
                }
            });
        </script>
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
