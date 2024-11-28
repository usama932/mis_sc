@extends('layout.master')

@section('content')

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root" style="background-image: linear-gradient(rgba(0, 0, 255, 0.1), rgba(0, 0, 255, 0.1)), url('{{ URL::asset('assets/media/logos/image.jpg') }}'); background-size: 100% 100%;">
 
       
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="" style="margin-left: auto">
                    @if(request()->segment(1) == 'login')
                        <div class="m-3">
                            <button class="btn btn-primary" id="staffTab">Staff Login</button>
                            <button class="btn btn-danger" id="guestTab">Guest Login</button>
                        </div>
                    @endif
                </div>
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class=" p-10">
                        <!--begin::Page-->
                        {{ $slot }}
                        <!--end::Page-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

             
            </div>
            <!--end::Body-->

            {{-- <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ image('misc/auth-bg.png') }}); height:100% !important;">
               
            </div>
            <!--end::Aside--> --}}
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::App-->
    @push('scripts')
    
   
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var staffTab = document.getElementById("staffTab");
            var guestTab = document.getElementById("guestTab");
            var staffTabContent = document.getElementById("staffTabcontent");
            var guestTabContent = document.getElementById("guestTabcontent");
            guestTabContent.style.display = "none";
            staffTab.style.display  = "none";
    
            staffTab.addEventListener("click", function () {
                staffTabContent.style.display = "block";
                guestTabContent.style.display = "none";
                staffTab.style.display  = "none";
                guestTab.style.display  = "block";
            });
    
            guestTab.addEventListener("click", function () {
                guestTabContent.style.display = "block";
                staffTabContent.style.display = "none";
                guestTab.style.display  = "none";
                staffTab.style.display  =  "block";
            });
        });
    </script>
     {{-- <script>
        
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
    </script> --}}
@endpush

@endsection
