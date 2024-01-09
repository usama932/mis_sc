<x-auth-layout>
    
    <div class="text-center fw-bold">
        <img src="https://opmis.savethechildren.org.np/login//assets/images/Save1.png" height="50px" class="mb-3">
        <h2>MANAGEMENT INFORMATION SYSTEM (MIS) </h2>
    </div>
    <div class="border border-5 p-5 border-danger">
        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}">
            @csrf

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
