
<x-auth-layout>
    <div class="text-center fw-bold">
        <img src="https://opmis.savethechildren.org.np/login//assets/images/Save1.png" height="50px" class="mb-3">
        <h2>MANAGEMENT INFORMATION SYSTEM (MIS) </h2>
    </div>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="border border-5 p-5 border-danger">
        <form class="w-75 mx-auto"   action="{{ route('update_password') }}" method="post" id="myForm"> 
            @csrf

            <input type="hidden" name="token" value="{{ $request->token }}">
            <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

            <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder mb-3">
                    New Password
                </h1>
                <!--end::Title-->

                <!--begin::Link-->
                <h3 class="text-black fw-semibold fs-6">
                    Enter your new password.
                </h3>
                <!--end::Link-->
            </div>
            <!--begin::Heading-->

            <div id="errorList" class=" p-3" style="display: none; color: white;">
                <ul id="errors"></ul>
            </div>
            <div class="fv-row mb-8" data-kt-password-meter="true">
                   
                <input class="form-control bg-white" type="passord" placeholder="Old Password" name="old_password" value="" autocomplete="off"/>
                @error('old_password')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="fv-row mb-8">
                    <div class="input-group mb-3">
                        <input class="form-control bg-white" type="password" id="password" placeholder="Password" name="password" value="" autocomplete="off"/>
                        <div class="btn btn-light text-dark"  id="togglePassword"><i class="fas fa-eye" id="eye"></i></div>
                    </div>
                    @error('password')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                
                <div id="passwordMatchError" style="display: none; color: red;">Passwords do not match</div>
                <div id="passwordFormatError" style="display: none; color: red;">Password Must between 6 to 20 characters  & At least one numeric digit, one uppercase and one lowercase letter</div>
            
            </div>
            
            <div class="fv-row mb-8">
                <div class="input-group mb-3">
                    <input placeholder="Repeat Password" id="repeatPassword" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-white"/>
                    <div class="btn btn-light text-dark" id="toggleConfirmPassword"><i class="fas fa-eye" id="confirmEye"></i></div>
                </div>
            </div>
        
            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary btn-sm">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
              
                <a href="{{ route('login') }}" class="btn btn-light btn-sm">Cancel</a>
            </div>
            <!--end::Actions-->
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
          // Clear old password field on page load
            window.addEventListener('load', function() {
                document.getElementById('old_password').value = '';
            });

            // Clear old password field when the input field gains focus
            document.getElementById('old_password').addEventListener('focus', function() {
                this.value = '';
            });
    </script>
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
</x-auth-layout>
