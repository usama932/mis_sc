<x-nform-layout>
    @section('title')
       Update Project Details
    @endsection
    <input type="hidden" id="project_id" value="{{$project->id}}" />
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="container-fluid">
                <ul class="nav nav-tabs mt-1 fs-6">
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'detail')  active @endif" data-bs-toggle="tab" href="#detail">Project Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'thematic') active @else  @endif" data-bs-toggle="tab" href="#thematic" >Thematic area</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('active') == 'partner') active @else  @endif" data-bs-toggle="tab" href="#partner">Implementing Partner</a>
                    </li>
                    
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show @if(session('active') == 'detail') active @else  @endif" id="detail" role="tabpanel">
                   
                        @include('admin.projects.partials.detail_form')
                </div>
                <div class="tab-pane fade show @if(session('active') == 'thematic') active @else  @endif" id="thematic" role="tabpanel">
                    @include('admin.projects.partials.project_theme')
                </div>
                <div class="tab-pane fade show @if(session('active') == 'partner') active @else  @endif" id="partner" role="tabpanel">
                    @include('admin.projects.partials.project_partners')
                </div>
                
            </div>
           
        </div>
    </div>
   
    @push("scripts")
    @endpush


</x-nform-layout>
