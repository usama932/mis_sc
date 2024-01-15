<x-auth-layout>
  
    <div class="text-center fw-bold">
        <img src="https://opmis.savethechildren.org.np/login//assets/images/Save1.png" height="50px" class="mb-3">
        <h2>MANAGEMENT INFORMATION SYSTEM (MIS) </h2>
    </div>

    <div class="border border-5 p-5 border-danger">
      
        <form class="form w-100" method="post" novalidate="novalidate" id="kt_otp_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('post_otp') }}">
            @csrf
            <h6 class="text-black"> Your Varfication Code is Sent at  </h6>          
            <input type="hidden"  name="email"  value="{{$email}}"/>
            <div class="fv-row mb-8">
                <!--begin::Email-->
                <input type="text" placeholder="Enter OTP" name="otp" autocomplete="off" class="form-control bg-transparent" value=""/>
                <!--end::Email-->
            </div>
            <div class="d-grid mb-10">
                <button type="submit" id="kt_otp_submit" class="btn btn-primary">
                    @include('partials/general/_button-indicator', ['label' => 'Log In'])
                </button>
            </div>
        </form>
      
    </div>
</x-auth-layout>
