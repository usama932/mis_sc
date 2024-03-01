<x-default-layout>
 
    @section('title')
    View Project Detail
    @endsection
    <div class="card p-3">
        <input type="hidden" id="project_id" value="{{$project->id}}">
        <div class="row">
            
            <div class="col-md-6">
                <table class="table table-striped m-4 p-4">
                    
                    <tr>
                        <td><strong>Project Name</strong></td>
                        <td>{{$project->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Donor</strong></td>
                        <td>
                          {{$project->donors?->name ?? ''}} 
                        </td>
                    </tr>
                    <tr>
                        <td><strong>SOF.#</strong></td>
                        <td>{{$project->sof ?? ''}}</td>
                    </tr>
                   
                    @if(!empty($provinces))
                        <tr>
                            <td><strong>Provinces</strong></td>
                            <td>
                                @foreach($provinces as $province)
                                    {{ $province->province_name}}  @if(! $loop->last)<br> @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    {{-- <tr>
                        <td><strong>Status</strong></td>
                        <td>{{$project->status ?? ''}}</td>
                    </tr> --}}
                    
                    {{-- <tr>
                        <td><strong>Project Status </strong></td>
                        <td>
                            @if($project->active == 1)
                                Active
                            @else
                                InActive
                            @endif
                          {{$project->atic ?? ''}}
                        </td>
                    </tr> --}}
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped m-4 p-4">
                    <tr>
                        <td><strong>Type</strong></td>
                        <td>{{$project->type ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Focal Person</strong></td>
                        <td>
                          {{$project->focalperson?->name ?? ''}} -  {{$project->focalperson?->desig?->designation_name ?? ''}}<br>
                          {{-- {{$project->focalperson?->email ?? ''}} --}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Project Tenure</strong></td>
                        <td>
                            @if(!empty($project->start_date) && $project->start_date != null)
                                {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                            @endif
                        </td>
                    </tr>
                   
                    
                 
                    @if(!empty($districts))
                    <tr>
                        <td><strong>Disticts</strong></td>
                        <td>  @foreach($districts as $district)
                            {{ $district->district_name}}  @if(! $loop->last)<br> @endif
                            @endforeach
                        </td>
                    </tr>
                    @endif
                   
                   
                    {{-- <tr>
                        <td><strong>Project Extended </strong></td>
                        <td>
                            @if($project->project_extended == "0")  
                                No
                            @else
                               Yes 
                            @endif
                        </td>
                    </tr> --}}
                    
                </table>
            </div>
            <div class="col-md-12"> 
                <table class="table table-striped px-4 mx-4">
                    <tr>
                        <td><strong>Project Description</strong></td>
                        <td>{{$project->detail?->project_description ??  ''}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="container-fluid">
                <ul class="nav nav-tabs mt-1 fs-6">
                   
                    <li class="nav-item">
                        <a class="nav-link  active " data-bs-toggle="tab" href="#thematic" >Thematic area</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " data-bs-toggle="tab" href="#partner">Implementing Partner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  " data-bs-toggle="tab" href="#activities">Project Activities</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                
                
                <div class="tab-pane fade show  active " id="thematic" role="tabpanel">
                    <div class="card m-4"  id="project_theme_table">
                        <div class="card-body overflow-*">
                            <div class="table-responsive overflow-*">
                                <table class="table table-striped table-bordered nowrap" id="project_themes" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Theme</th>
                                        <th>Sub Theme</th>
                                        <th>House-Hold Target</th>
                                        <th>Individual Target</th>
                                        <th>Women Target</th>
                                        <th>Men Target</th>
                                        <th>Girls Target</th>
                                        <th>Boys Target</th>
                                        <th>PWD Target</th>
                                        {{-- <th>Created At</th>
                                        <th>Created By</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="partner" role="tabpanel">
                    <div class="card m-4"  id="project_partner_table">
                        <div class="card-body overflow-*">
                            <div class="table-responsive overflow-*">
                                <table class="table table-striped table-bordered nowrap" id="project_partners" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Theme</th>
                                        <th>Sub Theme</th>
                                        <th>Partner</th>
                                        <th>Email</th>
                                        <th>Province</th>
                                        <th>District</th>
                                        {{-- <th>Created At</th>
                                        <th>Created By</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="activities" role="tabpanel">
                    <div class="card m-4"  id="project_partner_table">
                        <div class="card-body overflow-*">
                            <div class="table-responsive overflow-*">
                                <table class="table table-striped table-bordered nowrap" id="dip_activity" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Activity</th>
                                            <th>Sub Theme</th>
                                            <th>LOP Target</th>
                                            <th>Quarter  Target</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        var dip_id = document.getElementById("project_id").value ;
        var dip_activity = $('#dip_activity').DataTable( {
            "order": [
            [1, 'desc']
        ],
        "dom": 'lfBrtip',
        buttons: [
            'csv', 'excel'
        ],
        "responsive": true, // Enable responsive mode
        "processing": true,
        "serverSide": true,
        "searching": false,
        "bLengthChange": false,
        "bInfo" : false,
        "responsive": false,
        "info": true,   
        "ajax": {
            "url":"{{route('admin.get_activity_dips')}}",
            "dataType":"json",
            "type":"POST",
            "data":{"_token":"<?php echo csrf_token() ?>",
                    "dip_id":dip_id}
        },
            "columns":[
                
                            {"data":"activity_number","searchable":false,"orderable":false},
                            {"data":"sub_theme","searchable":false,"orderable":false},
                            {"data":"lop_target","searchable":false,"orderable":false},
                            {"data":"quarter_target","searchable":false,"orderable":false},
                            {"data":"created_by","searchable":false,"orderable":false},
                            {"data":"created_at","searchable":false,"orderable":false},
                            {"data":"action","searchable":false,"orderable":false},
                        ]
        });

        
     
    
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
                        "Your DIP has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/activity_dips/delete/" + id;
                }
            });
        }
       
    </script>
    @endpush
</x-default-layout>
