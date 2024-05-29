<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MIS - @yield('title', 'MIS-SCP')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/media/logos/favicon.ico') }}">

    @if(Auth::check())
     {!! includeFonts() !!}
    @endif
  
    @foreach(getGlobalAssets('css') as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
 

    @if(Auth::check())
    @foreach(getVendors('css') as $path)
        {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
    @endforeach
    @endif
    <!--end::Vendor Stylesheets-->

    @if(Auth::check())
        @foreach(getCustomCss() as $path)
            {!! sprintf('<link rel="stylesheet" href="%s">', asset($path)) !!}
        @endforeach
    @endif
    <!--end::Custom Stylesheets-->
    @if(Auth::check())
     @livewireStyles
    @endif
    <style>
        .dataTables_length, .dt-buttons {
            display: inline-block;
            vertical-align: middle;
        }
        .dataTables_wrapper .dataTables_length {
            float: left;
        }
        .dataTables_wrapper .dt-buttons {
            float: right;
            margin-left: 20px;
        }
    </style>
</head>
<!--end::Head-->

<!--begin::Body-->

<body class="app-default " id="kt_app_body" data-kt-name="metronic" data-kt-app-layout="light-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true">

@include('partials/theme-mode/_init')

@stack('stylesheets')

@yield('content')


@foreach(getGlobalAssets() as $path)
    {!! sprintf('<script src="%s"></script>', asset($path)) !!}
@endforeach

<!--end::Global Javascript Bundle-->


@foreach(getVendors('js') as $path)

    {!! sprintf('<script src="%s"></script>', asset($path)) !!}
@endforeach


@foreach(getCustomJs() as $path)
    {!! sprintf('<script src="%s"></script>', asset($path)) !!}
@endforeach

@stack('scripts')
<!--end::Javascript-->

@if(Auth::check())
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

@endif
</body>
<!--end::Body-->

</html>
