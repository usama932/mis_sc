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
            color: #fff;
            background-color: #D3D3D3; /* Material Design Blue */
            border-radius: 5px 5px 0 0;
            transition: background-color 0.3s ease-in-out;
        }
    
        .tab:hover {
            background-color: #eee; /* Light grey on hover */
            color: #808080; /* Silver text color on hover */
        }
    
        .tab.active {
            background-color: #B4B0A1; /* Material Design Orange for active tab */
            color: #333;
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
            background-color: #C0C0C0.;
        }
    
        .tab-content {
            margin: 20px;
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
        <input type="hidden" id="qb_id" value="{{$qb->id}}" />
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-tabs-line d-flex justify-content-center  mt-3 p-2">
                <ul class="tabs">
                    <li class="tab @if(session('active') == 'basic_info')  active @endif"  onclick="showTab('basic_info')">Basic Information</li>         
                    <li class="tab @if(session('active') == 'monitor_visit') active @else  @endif " onclick="showTab('monitor_visit')">Detail Monitor Visits</li>
                    <li class="tab @if(session('active') == 'action_point') active @else  @endif"  onclick="showTab('action_point')">Action Point Details</li>
                    <li class="tab @if(session('active') == 'qbattachment') active @else  @endif"  onclick="showTab('qbattachment')">Attachments</li>
                </ul>
            </ul>
        </div>

        <div id="basic_info" class="tab-content  @if(session('active') == 'basic_info') active @else  @endif">
            <div>
                @include('admin.quality_bench.basic_information.basic_information')
            </div>
        </div>
    
        <div id="monitor_visit" class="tab-content  @if(session('active') == 'monitor_visit') active @else  @endif">
            <div>
                @include('admin.quality_bench.monitor_visits.monitor_visits')
            </div>
        </div>
    
        <div id="action_point" class="tab-content @if(session('active') == 'action_point') active @else  @endif">
            <div>
                @include('admin.quality_bench.action_point.action_point')
            </div>
        </div>
        <div id="qbattachment" class="tab-content @if(session('active') == 'qbattachment') active @else  @endif">
            <div>
                @include('admin.quality_bench.qb_attachment.attachment')
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
                dateFormat: "Y-m-d",
                maxDate: "today",
                minDate: new Date().fp_incr(-60), 
            });
            
            $('#deadline').flatpickr({
                altInput: true,
                dateFormat: "Y-m-d",
                minDate: "today",
                maxDate: new Date().fp_incr(+60), 
            });
    
        </script>
         @include('admin.frm.scripts_file.frm_script');
         
        @include('admin.quality_bench.qb_scripts');
       
        //Action Point Scripts
    @endpush

</x-default-layout>
