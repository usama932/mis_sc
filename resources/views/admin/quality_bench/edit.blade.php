<x-nform-layout>
 
    @section('title')
        Add QBs Details and Action Points Details
    @endsection
    
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
            <ul class="nav nav-tabs mt-1 fs-6">
                <li class="nav-item">
                    <a class="nav-link @if(session('active') == 'basic_info')  active @endif" data-bs-toggle="tab" href="#basic_info">Summary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(session('active') == 'monitor_visit') active @else  @endif" data-bs-toggle="tab" href="#monitor_visit" >QBs Not Fully Met</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(session('active') == 'action_point') active @else  @endif" data-bs-toggle="tab" href="#action_point">Action Point Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(session('active') == 'qbattachment') active @else  @endif" data-bs-toggle="tab" href="#qbattachment">Comments and Attachment</a>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show @if(session('active') == 'basic_info') active @else  @endif" id="basic_info" role="tabpanel">
                <div>
                    @include('admin.quality_bench.basic_information.basic_information')
                </div>
            </div>
            <div class="tab-pane fade show @if(session('active') == 'monitor_visit') active @else  @endif" id="monitor_visit" role="tabpanel">
                <div>
                    @include('admin.quality_bench.monitor_visits.monitor_visits')
                </div>
            </div>
            <div class="tab-pane fade show @if(session('active') == 'action_point') active @else  @endif" id="action_point" role="tabpanel">
            
                <div>
                    @include('admin.quality_bench.action_point.action_point')
                </div>
            </div>
            <div class="tab-pane fade show @if(session('active') == 'qbattachment') active @else  @endif" id="qbattachment" role="tabpanel">
                <div>
                    @include('admin.quality_bench.qb_attachment.attachment')
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $("#qbformDiv").hide();
            $("#general_obsform").hide();
            $("#qbtableDiv").show();
            $("#qb_action_point_form").hide();
            $("#actionpointtableDiv").show();
          
            $('#date_visit').flatpickr({
                altInput: true,
                dateFormat: "Y-m-d",
                maxDate: new Date().fp_incr(+0),
                minDate: new Date("2023-10-01"),
            });
        </script>
     
    @endpush

</x-nform-layout>
