<x-default-layout>
    @push('stylesheets')
        <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
        <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
       
    @endpush
    @section('title')
        Edit Monitoring Quality Benchmarks
    @endsection
    <style>
      

        .tabs {
            display: flex;
            list-style: none;
            padding: 0;
        }

        .tab {
            margin-right: 10px;
            cursor: pointer;
            padding: 10px;
            color:white;
            background-color: #3f51b5;
            border-radius: 5px 5px 0 0;
        }

        .tab:hover {
            background-color: #7986cb;
           
        }

        .tab.active {
            background-color: #F1C40F;
            color:black;
        }

        .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }

        .tab-content.active {
            display: block;
        }
        .nav {
            background-color:#e65100;
        }
        .tab-content {margin:20px;}
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
        <div class="container-fluid">
            <ul class="nav nav-pills d-flex justify-content-center rounded-pill mt-3 p-2">
                <ul class="tabs">
                    <li class="tab rounded-pill active" onclick="showTab('subscribed')">Basic Information</li>
                   
                    <li class="tab rounded-pill" onclick="showTab('eventPassed')">Detail Monitor Visits</li>
                    <li class="tab rounded-pill" onclick="showTab('eventNow')">Action Point Details</li>
                    <li class="tab rounded-pill" onclick="showTab('eventIncoming')">Attachments</li>
                </ul>
            </ul>
        </div>

        <div id="subscribed" class="tab-content active">
            <div>
                @include('admin.quality_bench.basic_information')
            </div>
        </div>
    
        <div id="eventPassed" class="tab-content">
            <div>
                @include('admin.quality_bench.monitor_visits')
            </div>
        </div>
    
        <div id="eventNow" class="tab-content">
            <div>
                @include('admin.quality_bench.action_point')
            </div>
        </div>
        <div id="eventIncoming" class="tab-content">
            <div>
                @include('admin.quality_bench.attachment')
            </div>
        </div>
        
    </div>
    @push('scripts')
 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showTab(tabId) {
            // Hide all tabs and tab contents
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Show the selected tab and corresponding tab content
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
   
        $('#date_visit').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today",
            minDate: new Date().fp_incr(-60), 
        });
        
        $('#deadline').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            minDate: "today",
            maxDate: new Date().fp_incr(+60), 
        });
   
    </script>
    @include('admin.frm.frm_script');


    @endpush

</x-default-layout>
