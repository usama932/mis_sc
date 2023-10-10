<x-default-layout>
    @push('stylesheets')
        <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
        <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js" type="text/javascript"></script>
    @endpush
    @section('title')
        Edit Monitoring Quality Benchmarks
    @endsection
    <style>
        .nav.nav-pills .nav-link
        {
        color:black!important;
        }
        td{font-size:12px;}
     </style>

    <div class="card">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <ul class="nav nav-success nav-pills">
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#kt_tab_basic_info">Basic Information</a>
            </li>
           
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_tab_visited_sites" tabindex="-1" aria-disabled="true">Details of Monitoring visit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#kt_tab_action_points" tabindex="-1" aria-disabled="true">Action Point Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#kt_tab_attachments" tabindex="-1" aria-disabled="true">Attachments</a>
            </li>
        </ul>
        <div class="card card-custom">
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show " id="kt_tab_basic_info" role="tabpanel" aria-labelledby="kt_tab_basic_info">
                        <h1>basic test</h1>
                </div>
                <div class="tab-pane fade" id="kt_tab_visited_sites" role="tabpanel" aria-labelledby="kt_tab_visited_sites">
                    <div class="card-body">
                        <h1>monitor test</h1>
                    </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_action_points" role="tabpanel" aria-labelledby="kt_tab_visited_sites">
                    <div class="card-body">
                        <h1>monitor test</h1>
                    </div>
                </div>
                <div class="tab-pane fade" id="kt_tab_attachments" role="tabpanel" aria-labelledby="kt_tab_visited_sites">
                    <div class="card-body">
                        <h1>monitor test</h1>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    @push('scripts')
    <script>
        $('#date_visit').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today",
            minDate: new Date().fp_incr(-60), 
        });
        
    </script>
    <script type="text/javascript"> 
        jQuery(document).ready(function ($) { 
            $('#tabs').tab(); 
        }); 
    </script>
    @include('admin.frm.frm_script');



    @endpush

</x-default-layout>
