<x-default-layout>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form class="w-50 mx-auto" action="{{ route('update_password') }}" method="post" id="myForm" autocomplete="off">
        @csrf

        <!-- Password Reset Token -->
        {{-- <input type="hidden" name="token" value="{{ $request->token }}">
        <input type="hidden" name="email" value="{{ old('email', $request->email) }}"> --}}

        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">
                New Password
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-500 fw-semibold fs-6">
                Enter your new password.
            </div>
            <!--end::Link-->
        </div>
        <!--end::Heading-->

        <div id="errorList" class="p-3" style="display: none; color: red;">
            <ul id="errors"></ul>
        </div>
        
        <div class="fv-row mb-8" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control bg-transparent" type="text" placeholder="Old Password" name="old_password" value="" autocomplete="off"/>
                    @error('old_password')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input wrapper-->
            </div>

            <div class="mb-1">
                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <div class="input-group mb-3">
                        <input class="form-control bg-transparent" type="password" id="password" placeholder="Password" name="password" value="" autocomplete="new-password"/>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye" id="eye"></i></button>
                    </div>
                    @error('password')
                        <div class="error text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Input wrapper-->
                <div id="passwordMatchError" style="display: none; color: red;">Passwords do not match</div>
                <div id="passwordFormatError" style="display: none; color: red;">Password must be between 6 to 20 characters and include at least one numeric digit, one uppercase, and one lowercase letter</div>
            </div>
        </div>
        <!--end::Input group--->

        <!--end::Input group--->
        <div class="fv-row mb-8">
            <div class="input-group mb-3">
                <input placeholder="Repeat Password" id="repeatPassword" name="password_confirmation" type="password" value="" autocomplete="new-password" class="form-control bg-transparent"/>
                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"><i class="fas fa-eye" id="confirmEye"></i></button>
            </div>
        </div>

        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" class="btn btn-primary btn-sm me-4">
                Submit
            </button>
            <a href="{{ route('login') }}" class="btn btn-light btn-sm">Cancel</a>
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->

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
</x-default-layout>
