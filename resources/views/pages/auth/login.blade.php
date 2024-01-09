<x-auth-layout>
   
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <div class="text-center fw-bold">
        <img src="https://opmis.savethechildren.org.np/login//assets/images/Save1.png" height="50px" class="mb-3">
        <h2>MANAGEMENT INFORMATION SYSTEM (MIS) </h2>
    </div>
    <style>
        .form-check {
            background-color: red;
            display: inline-block; /* Ensure the container only takes as much width as needed */
            border-radius: 30%;
        }
    
        .form-check-input {
            width: 20px; /* Adjust the width as needed */
            height: 20px; /* Adjust the height as needed */
        }
    
        .form-check-input:checked {
            background-color: green;
        }
    </style>
    
    <div class="border border-5 p-5 border-danger">
        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}">
            @csrf
            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                <label style="margin-right: 10px;" class="" for="flexSwitchCheckDefault"><strong>Staff</strong></label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="staff" id="flexSwitchCheckDefault">
                </div>
            </div>
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value=""/>
                <!--end::Email-->
            </div>

            <!--end::Input group--->
            <div class="fv-row mb-3">
                <!--begin::Password-->
                <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" value=""/>
                <!--end::Password-->
            </div>
    

            <!--begin::Submit button-->
            <div class="d-grid mb-10">
                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                    @include('partials/general/_button-indicator', ['label' => 'Log In'])
                </button>
                {{-- <h3 class="text-center mt-3">
                    <p>Not a member..! ? <a href="{{route('register')}}" class="btn btn-info  btn-sm text-white font-weight-bold">Register</a></p>
                </h3> --}}
                   
            </div>
            <!--end::Submit button-->
          
        
        </form>
    <!--end::Form-->
    </div>
</x-auth-layout>
