@push('stylesheets')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.0/classic/ckeditor.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
@endpush

<x-nform-layout>
    <style>
        #kt_docs_ckeditor_classic {
            height: 150px; /* Adjust the height as needed */
        }
    </style>
      <ol class="breadcrumb text-muted fs-6 fw-semibold">
        <li class="breadcrumb-item"><a href="{{route('get_project_index')}}" class="">Project Details</a></li>
     
        <li class="breadcrumb-item text-muted">Update Project {{$project->name}}</li>
    </ol>
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
                        <a class="nav-link @if(session('project') == 'partner') active @else  @endif" data-bs-toggle="tab" href="#partner" @if(empty($project->detail)   || $project->detail?->implemented_sc == 1) disabled @endif >Implementing Partner</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link @if(session('project') == 'profile') active @else  @endif" data-bs-toggle="tab" href="#profile" @if(empty($project->detail)   || $project->detail?->implemented_sc == 1) disabled @endif >Project Profile</a>
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
                <div class="tab-pane fade show @if(session('project') == 'partner') active @else  @endif" id="partner" role="tabpanel" @if(empty($project->detail)  || $project->detail?->implemented_sc == 1)  disabled @endif >
                    @include('admin.projects.partials.project_partners')
                </div>
                <div class="tab-pane fade show @if(session('project') == 'profile') active @else  @endif" id="profile" role="tabpanel" @if(empty($project->detail) ) disabled @endif >
                    @include('admin.projects.partials.project_profile')
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade close" id="edittheme" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Thematic Area</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <div class="modal-body" >
                   
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade close" id="view_profile" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="view_monitor_visit">Project Profile Details</h4>
            </div>
            <div class="modal-body" id="profilemodal_body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold close"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){ 
            var i = 1; 
            $('#add').click(function(){  
                if(i < 2) {
                    i++;  
                    $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="email" name="addmore['+i+'][email]" placeholder="Enter your Email" class="form-control name_list" required/></td><td><input type="text" name="addmore['+i+'][desig]" placeholder="Enter your Designation" class="form-control name_list" required/></td><td><span type="button" name="remove" id="'+i+'" class="badge badge-danger btn_remove">X</span></td></tr>');  
                } else {
                    toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toastr-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                                toastr.error('You add only two partner', "Oop...");
                }
            });  
    
            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
                i--; // Decrement the row counter when removing a row
            });  
        }); 
    </script>
    @endpush
</x-nform-layout>
