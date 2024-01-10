<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <base href=""/>
    <title>@yield('title', 'MIS-SCP') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=""/>
    <link rel="canonical" href=""/>

    <link rel="icon" type="image/x-icon" href="https://opmis.savethechildren.org.np/login/login">

    <!--begin::Fonts-->
    {!! includeFonts() !!}
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @foreach(getGlobalAssets('css') as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
    <!--end::Global Stylesheets Bundle-->

    <!--begin::Vendor Stylesheets(used by this page)-->
    @foreach(getVendors('css') as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
    <!--end::Vendor Stylesheets-->

    <!--begin::Custom Stylesheets(optional)-->
    @foreach(getCustomCss() as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
    <!--end::Custom Stylesheets-->

    @livewireStyles
</head>
<!--end::Head-->

<!--begin::Body-->

<body class="app-default " id="kt_app_body" data-kt-name="metronic" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true">

@include('partials/theme-mode/_init')

@stack('stylesheets')

@yield('content')

<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
@foreach(getGlobalAssets() as $path)
    {!! sprintf('<script src="%s"></script>', asset($path)) !!}
@endforeach
<!--end::Global Javascript Bundle-->


@foreach(getVendors('js') as $path)

    {!! sprintf('<script src="%s"></script>', asset($path)) !!}
@endforeach
<!--end::Vendors Javascript-->

<!--begin::Custom Javascript(optional)-->
@foreach(getCustomJs() as $path)
    {!! sprintf('<script src="%s"></script>', asset($path)) !!}
@endforeach
<!--end::Custom Javascript-->
@stack('scripts')
<!--end::Javascript-->
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
<script>
    $(document).ready(function () {
        $('#update_province').change(function () {
            var selectedProvince = $(this).val();

            // Make AJAX request
            $.ajax({
                "url":"{{route('update_province')}}",
                "type":"POST",
                data: {
                    province: selectedProvince,
                    _token: '<?php echo csrf_token() ?>' // Include CSRF token for security
                },
                success: function (response) {
                    location.reload();
                    console.log(response);
                    // Handle success response here
                },
                error: function (error) {
                    console.log(error);
                    // Handle error here
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('livewire:load', () => {
        Livewire.on('success', (message) => {
            toastr.success(message);
        });
        Livewire.on('error', (message) => {
            toastr.error(message);
        });

        Livewire.on('swal', (message, icon, confirmButtonText) => {
            if (typeof icon === 'undefined') {
                icon = 'success';
            }
            if (typeof confirmButtonText === 'undefined') {
                confirmButtonText = 'Ok, got it!';
            }
            Swal.fire({
                text: message,
                icon: icon,
                buttonsStyling: false,
                confirmButtonText: confirmButtonText,
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        });
    });
</script>

@livewireScripts
</body>
<!--end::Body-->

</html>
