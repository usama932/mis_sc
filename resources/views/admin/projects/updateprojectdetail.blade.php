<x-nform-layout>
    @section('title')
       Update Project Details
    @endsection
    <input type="hidden" id="project_id" value="{{$project->id}}" />
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row">
           
            <div class="col-md-6">
                <table class="table table-striped m-4 table-responsive">
                    
                    <tr>
                        <td><strong>Project</strong></td>
                        <td>{{$project->name ?? ''}}</td>
                    </tr>
                     
                    <tr>
                        <td><strong>Type</strong></td>
                        <td>{{$project->type ?? ''}}</td>
                    </tr>
                      
              
                    <tr>
                        <td><strong>Project Tenure</strong></td>
                        <td>
                            @if(!empty($project->start_date) && $project->start_date != null)
                                {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                            @endif
                        </td>
                    </tr>
                   
                 
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped m-4 table-responsive">
                    
                    <tr>
                        <td><strong>SOF.#</strong></td>
                        <td> {{$project->sof ?? ''}}</td>
                    </tr>
                   
                    <tr>
                        <td><strong>Focal Person</strong></td>
                        <td>
                          {{$project->focalperson?->name ?? ''}}<br>
                       
                        </td>
                    </tr>
                   
                    <tr>
                        <td><strong>Created At</strong></td>
                        <td>   {{ date('M d, Y', strtotime($project->created_at))}} </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="container-fluid">
                <ul class="nav nav-tabs mt-1 fs-6">
                    <li class="nav-item">
                        
                        <a class="nav-link @if(session('project') == 'detail')  active @endif" data-bs-toggle="tab" href="#detail">Project Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('project') == 'thematic') active @else  @endif" data-bs-toggle="tab" href="#thematic" @if(empty($project->detail)) disabled @endif >Thematic area</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('project') == 'partner') active @else  @endif" data-bs-toggle="tab" href="#partner" @if(empty($project->detail)) disabled @endif >Implementing Partner</a>
                    </li>
                    
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show @if(session('project') == 'detail') active @else  @endif" id="detail" role="tabpanel">
                   
                        @include('admin.projects.partials.detail_form')
                </div>
                <div class="tab-pane fade show @if(session('project') == 'thematic') active @else  @endif" id="thematic" role="tabpanel" @if(empty($project->detail)) disabled @endif >
                    @include('admin.projects.partials.project_theme')
                </div>
                <div class="tab-pane fade show @if(session('project') == 'partner') active @else  @endif" id="partner" role="tabpanel" @if(empty($project->detail)) disabled @endif >
                    @include('admin.projects.partials.project_partners')
                </div>
                
            </div>
        </div>
    </div>
   
    @push("scripts")
    @endpush


</x-nform-layout>
