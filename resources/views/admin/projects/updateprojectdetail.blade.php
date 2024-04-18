@push('stylesheets')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>
@endpush
<x-nform-layout>
    <style>
          #kt_docs_ckeditor_classic {
        height: 150px; /* Adjust the height as needed */
    }
        </style>
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
                        <td>{{$project->name ?? ''}} ({{$project->type}})</td>
                    </tr>
                    <tr>
                        <td><strong>Donor</strong></td>
                        <td> {{$project->donors?->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td class="fs-8"><strong>Awards FP</strong></td>
                        <td>
                          {{ucfirst($project->awardfp?->name ?? '')}} -  {{$project->awardfp?->desig?->designation_name ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Project Tenure</strong></td>
                        <td>
                            @if(!empty($project->start_date) && $project->start_date != null)
                                {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date))}}
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
                        <td class="fs-8"><strong>Operational Focal Person</strong></td>
                        <td>
                          {{ucfirst($project->focalperson?->name ?? '')}} -  {{$project->focalperson?->desig?->designation_name ?? ''}}<br>
                       
                        </td>
                    </tr>
                    <tr>
                        <td class="fs-8"><strong>Budget holder FP</strong></td>
                        <td>
                          {{ucfirst($project->budgetholder?->name ?? '')}} -  {{$project->budgetholder?->desig?->designation_name ?? ''}}<br>
                       
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Created At</strong></td>
                        <td>   {{ date('M d, Y H:i:s', strtotime($project->created_at))}} </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="container-fluid">
                <ul class="nav nav-tabs mt-1 fs-6">
                    <li class="nav-item" >
                        <a  class="nav-link @if(session('project') == 'detail')  active @endif" data-bs-toggle="tab" href="#detail">Project Detail</a>
                    </li>
                    <li class="nav-item">
                      
                        <a class="nav-link @if(session('project') == 'thematic') active @else  @endif" data-bs-toggle="tab" href="#thematic" @if(empty($project->detail) ) disabled @endif >Thematic area</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(session('project') == 'partner') active @else  @endif" data-bs-toggle="tab" href="#partner" @if(empty($project->detail)  || empty($project->themes)) disabled @endif >Implementing Partner</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link @if(session('project') == 'profiling') active @else  @endif" data-bs-toggle="tab" href="#profiling" @if(empty($project->detail)  || empty($project->themes)) disabled @endif >Project Profile</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show @if(session('project') == 'detail') active @else  @endif" id="detail" role="tabpanel">
                    @include('admin.projects.partials.detail_form')
                </div>
                
                <div class="tab-pane fade show @if(session('project') == 'thematic') active @else  @endif" id="thematic" role="tabpanel" @if(empty($project->detail) ) disabled @endif >
                    @include('admin.projects.partials.project_theme') 
                </div>
                <div class="tab-pane fade show @if(session('project') == 'partner') active @else  @endif" id="partner" role="tabpanel" @if(empty($project->detail)  || empty($project->themes)) disabled @endif >
                    @include('admin.projects.partials.project_partners')
                </div>
                <div class="tab-pane fade show @if(session('project') == 'profiling') active @else  @endif" id="profiling" role="tabpanel" @if(empty($project->detail)  || empty($project->themes)) disabled @endif >
                    @include('admin.projects.partials.project_profile')
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edittheme" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Thematic Area</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body">
                   
                </div>
            </div>
        </div>
    </div>

</x-nform-layout>
@push('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor.create(document.querySelector('#kt_docs_ckeditor_classic'))
            .catch(error => {
                console.error(error);
            });
    });
</script> 
@endpush