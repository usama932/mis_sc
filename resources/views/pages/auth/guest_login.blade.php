<x-auth-layout>
   
    
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
   
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('postguest.login') }}" method="post">
        @csrf
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value=""/>
            <!--end::Email-->
        </div>

        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Log In'])
            </button>
        </div>
    </form>
<!--end::Form-->
</div>
</x-auth-layout>
