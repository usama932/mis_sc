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
        th {
            font-size: 12px !important;
        }
        td {
            font-size: 11px !important;
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
<!-- Include Pusher JS library -->

<!-- Include Pusher JS library -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<!-- Include Laravel Echo library -->
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.10.0/dist/echo.iife.js"></script>

<!-- Include Axios library -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Include CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Initialize Echo -->
<script>
    Pusher.logToConsole = true;

    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        encrypted: true,
        forceTLS: true,
        authEndpoint: '/broadcasting/auth', // Default Laravel Broadcasting authentication endpoint
        auth: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    });

    window.Echo = new Echo({
        broadcaster: 'pusher',
        client: pusher,
        encrypted: true
    });
    var baseUrl = '{{ url('/') }}';
    window.Echo.private('App.Models.User.' + '{{ auth()->id() }}')
        .listen('.activity-deadline', (data) => { // Note the dot before the event name
            console.log('Received activity-deadline event:', data);
            const activityUrl = `${baseUrl}/activity_dips/${data.activity.id}`; // Construct the activity URL
            if (data.message) {
                // const notificationItem = `
                //     // <div class="d-flex flex-stack py-4">
                //     //     <div class="d-flex align-items-center">
                            
                //     //         <div class="symbol symbol-35px me-4">
                //     //             <span class="symbol-label bg-light-primary">{!! getIcon('abstract-28', 'fs-2 text-primary') !!}</span>
                //     //         </div>
                //     //         <div class="mb-0 me-2">
                //     //             <a href="${activityUrl}" class="fs-6 text-gray-800 text-hover-primary fw-bold">${data.activity.activity_title || 'Notification'}</a>
                //     //             <div class="text-gray-400 fs-7">${data.message}</div>
                //     //         </div>
                           
                //     //     </div>
                //     //     <span class="badge badge-light fs-8">${data.time || 'Just now'}</span>
                //     // </div>
                    
                // `;
                console.log(data.message);
                // document.getElementById('notification-list').insertAdjacentHTML('afterbegin', notificationItem);
            }
        })
        .error((error) => {
            console.error('Subscription error:', error);
        });
</script>



@livewireScripts

@endif
</body>
<!--end::Body-->

</html>
