@extends('layout.master')

@section('content')
<style>
    .view_parent_image1{
      
        background: url({{ URL::asset('assets/media/logos/image.jpg') }});
        background-size: 100% 100%;
        background-repeat: no-repeat;
        }
</style>
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root view_parent_image1" id="kt_app_root">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
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

@endsection
