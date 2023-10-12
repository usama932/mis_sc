<x-default-layout>
    @push('stylesheets')
        <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
        <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
       
    @endpush
    @section('title')
        Edit Monitoring Quality Benchmarks
    @endsection
    <style>
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: #F1C40F;
            color: Black !important;
        }
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
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="container mt-5">
            <ul class="nav nav-pills rounded-pill d-flex justify-content-center p-1" style="background-color: red">
                <li class="nav-item ">
                    <a class="nav-link active rounded-pill" id="basic-info-tab" data-toggle="pill" href="#basic-info" style="color: white">Basic Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill" id="monitoring-visit-tab" data-toggle="pill" href="#monitoring-visit" style="color: white">Details of Monitoring Visit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill" id="action_point-tab" data-toggle="pill" href="#action_point" style="color: white">Action Point Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-pill" id="attachments-tab" data-toggle="pill" href="#attachments" style="color: white">Attachments</a>
                </li>
            </ul>
        
            <div class="tab-content mt-2">
                
                <div class="tab-pane fade show active" id="basic-info">
                    @include('admin.quality_bench.basic_information')
                    
                </div>
                <div class="tab-pane fade" id="monitoring-visit">
                   @include('admin.quality_bench.monitor_visits')
                    
                </div>
                <div class="tab-pane fade" id="action_point">
                    @include('admin.quality_bench.action_point')
                </div>
                <div class="tab-pane fade" id="attachments">
                    @include('admin.quality_bench.attachment')
                </div>
            </div>
        </div>
        
    </div>
    @push('scripts')
 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
            $('.nav-pills a').tab(); 
        });
    </script>
    
    <script>
        $('#date_visit').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today",
            minDate: new Date().fp_incr(-60), 
        });
    </script>
    @include('admin.frm.frm_script');


    @endpush

</x-default-layout>
