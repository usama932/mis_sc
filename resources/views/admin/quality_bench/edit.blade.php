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
        <div class="container-fluid">
            <ul class="nav nav-pills d-flex justify-content-center  mt-3 p-2">
                <ul class="tabs">
                    <li class="tab @if(session('active') == 'basic_info')  active @endif"  onclick="showTab('basic_info')">{{session('active')}}Basic Information</li>         
                    <li class="tab @if(session('active') == 'monitor_visit') active @else  @endif " onclick="showTab('monitor_visit')">Detail Monitor Visits</li>
                    <li class="tab" @if(session('active') == 'action_point') class="active" @else  @endif onclick="showTab('eventNow')">Action Point Details</li>
                    <li class="tab" @if(session('active') == 'qbattachment') class="active" @else  @endif onclick="showTab('eventIncoming')">Attachments</li>
                </ul>
            </ul>
        </div>

        <div id="basic_info" class="tab-content  @if(session('active') == 'basic_info') active @else  @endif">
            <div>
                @include('admin.quality_bench.basic_information')
            </div>
        </div>
    
        <div id="monitor_visit" class="tab-content  @if(session('active') == 'monitor_visit') active @else  @endif">
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
    <script>
        //Monitor Visits
        var clients = $('#monitor_visits').DataTable({
            "order": [
                [1, 'asc']
            ],
            "processing": true,
            "serverSide": true,
            "searchDelay": 500,
            "responsive": true,
            "ajax": {
                "url": "{{ route('get_monitor_visits') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    "_token": "<?php echo csrf_token(); ?>"
                }
            },
            "columns": [{
                    "data": "id",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "data": "activity_number"
                },
                {
                    "data": "qb_met"
                },
               
                {
                    "data": "created_at"
                },
                {
                    "data": "action",
                    "searchable": false,
                    "orderable": false
                }
            ]
        });
        function viewInfo(id) {
    
            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('view_monitor_visit') }}", {
                _token: CSRF_TOKEN,
                id: id
            }).done(function(response) {
                $('.modal-body').html(response);
                $('#view_monitor_visit').modal('show');
    
            });
        }
        function del(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire(
                        "Deleted!",
                        "Your monitor visit has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/monitor_visit/delete/" + id;
                }
            });
        }
    </script>
    @endpush

</x-default-layout>
