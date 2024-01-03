<x-auth-layout>
    <style>
        .logo-img {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
            margin-bottom: 10px; /* Adjust margin as needed */
        }
    </style>
    
    <div class="container">
        <div class="text-center fw-bold">
            <img src="{{asset('assets/media/logos/logo.png')}}"  class=" logo-img  mb-3">
            <h2>MANAGEMENT INFORMATION SYSTEM (MIS)</h2>
        </div>

        <div class="border border-3 p-5 border-danger">
            <form class="row g-3" method="post" action="{{ route('register') }}" enctype="multipart/form-data" id="kt_sign_up_form">
                @csrf

                <div class="fv-row col-md-6">
                    <label for="name" class="form-label   fw-semibold fs-6 mb-2">Full Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name">
                    <div id="nameError" class="error-message "></div>
                </div>

                <div class="fv-row col-md-6">
                    <label for="email" class="form-label   fw-semibold fs-6 mb-2">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="example@domain.com">
                    <div id="emailError" class="error-message "></div>
                </div>

               

                <div class="fv-row col-md-4">
                    <label for="province" class="form-label fw-semibold fs-6 mb-2  ">Province</label>
                    <select name="province" id="kt_select2_province" class="form-select" style="width: 200px;" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..."  >

                        <option value="">Select Province</option>
                        <option value='1'>Punjab</option>
                        <option value='2'>KPK</option>
                        <option value='3'>Balochistan</option>
                        <option value='4'>Sindh</option>
                        <option value='7'>Federal Capital Territory</option>
                    </select>
                    <div id="provinceError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4">
                    <label for="province" class="form-label fw-semibold fs-6 mb-2 ">District
                    </label>
                    <select id="kt_select2_district" name="district"  aria-label="Select a District" data-control="select2" data-placeholder="Select a District..."  class="form-control form-control-solid mb-3 mb-lg-0"  @error('district') is-invalid @enderror  >

                    </select>
                    <div id="districtError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4">
                    <label for="designation" class="form-label fw-semibold fs-6 mb-2  ">Designation</label>
                    <select name="designation" id="designation" class="form-select" style="width: 200px;" aria-label="Select a Designation" data-control="select2" data-placeholder="Select a Designation..."  >

                        <option value="" selected>Select Designation </option>
                        @foreach ($designations as $designation)
                            <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                        @endforeach
                      
                    </select>
                    <div id="designationError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-6">
                    <label for="password" class="form-label   fw-semibold fs-6 mb-2">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="********">
                    <div id="passwordError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-6">
                    <label for="password" class="form-label   fw-semibold fs-6 mb-2">Confirm Password</label>
                    <input placeholder="Repeat Password" name="confirm_password" type="password" autocomplete="off" class="form-control "/>
                    <div id="confirm_passwordError" class="error-message "></div>
                </div>

                <div class=" col-12 text-center pt-3">
                   
                    <button type="submit" class="btn btn-primary"  id="kt_sign_up_submit">Submit</button>
                </div>
            </form>
            <h3 class="text-center mt-3">
                <p>Already You'r  member..! ? <a href="{{route('login')}}" class="btn btn-info  btn-sm text-white font-weight-bold">login</a></p>
            </h3>
        </div>
    </div>

    @push('scripts')
        <!-- Add your scripts here -->
    @endpush
</x-auth-layout>
    
