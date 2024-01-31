<x-default-layout>
 
    @section('title')
    View Project Detail
    @endsection
    <div class="card p-3">
        <input type="hidden" id="project_id" value="{{$project->id}}">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit project</a>
            </div>
            <div class="col-md-6">
                <table class="table table-striped m-4">
                    
                    <tr>
                        <td><strong>Project</strong></td>
                        <td>{{$project->name ?? ''}}</td>
                    </tr>
                     
                    <tr>
                        <td><strong>Type</strong></td>
                        <td>{{$project->type ?? ''}}</td>
                    </tr>
                      
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>{{$project->status ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Project Tenure</strong></td>
                        <td>
                            @if(!empty($project->start_date) && $project->start_date != null)
                                {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Project Status </strong></td>
                        <td>
                          {{$project->status ?? ''}}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped m-4">
                    
                    <tr>
                        <td><strong>Project Description</strong></td>
                        <td> {{$project->detail?->project_description ?? 'No Detail'}}
                        </td>
                    </tr>
                    
                    @if(!empty($provinces))
                        <tr>
                            <td><strong>Provinces</strong></td>
                            <td>
                                @foreach($provinces as $province)
                                    {{ $province->province_name}}  @if(! $loop->last) , @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    @if(!empty($districts))
                    <tr>
                        <td><strong>Disticts</strong></td>
                        <td>  @foreach($districts as $district)
                            {{ $district->district_name}}  @if(! $loop->last) , @endif
                            @endforeach
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Focal Person</strong></td>
                        <td>
                          {{$project->focalperson?->name ?? ''}}<br>
                          {{-- {{$project->focalperson?->email ?? ''}} --}}
                        </td>
                    </tr>
                
                    <tr>
                        <td><strong>Project Extended </strong></td>
                        <td>
                            @if($project->project_extended == "0")  
                                No
                            @else
                               Yes 
                            @endif
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>
        <div class="card">
            <div class="container-fluid">
                <ul class="nav nav-tabs mt-1 fs-6">
                   
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'thematic') active @else  @endif" data-bs-toggle="tab" href="#thematic" >Thematic area</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'partner') active @else  @endif" data-bs-toggle="tab" href="#partner">Implementing Partner</a>
                    </li>
                    
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                
                
                <div class="tab-pane fade show @if(session('active') == 'thematic') active @else  @endif" id="thematic" role="tabpanel">
                    <div class="card m-4"  id="project_theme_table">
                        <div class="card-body overflow-*">
                            <div class="table-responsive overflow-*">
                                <table class="table table-striped table-bordered nowrap" id="project_themes" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#S.No</th>
                                        <th>Theme</th>
                                        <th>Project</th>
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
                <div class="tab-pane fade show @if(session('active') == 'partner') active @else  @endif" id="partner" role="tabpanel">
                    <div class="card m-4"  id="project_partner_table">
                        <div class="card-body overflow-*">
                            <div class="table-responsive overflow-*">
                                <table class="table table-striped table-bordered nowrap" id="project_partners" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#S.No</th>
                                        <th>Project</th>
                                        <th>Themes</th>
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
                
            </div>
        </div>
    </div>
</x-default-layout>
