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
                        <td>{{$project->name ?? ''}} ({{$project->type}})</td>
                    </tr>
                    <tr>
                        <td><strong>Donor</strong></td>
                        <td> {{$project->donors?->name ?? ''}}</td>
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
                <div class="modal fade" tabindex="-1" id="edittheme">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Thematic Area</h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                </div>
                                <!--end::Close-->
                            </div>
                            <div class="modal-body">
                                <!-- Add your form or content for editing thematic area here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($project_partners as $part)
        <div class="modal fade partner_modal" tabindex="-1" id="editpartner_{{$part->id}}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Implementing Partner</h3>
        
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
        
                    <div class="modal-body">
                        <form id="update_projectpartner" class="update_projectpartner_form" method="post" autocomplete="off" action="{{route('projectpartners.update',$part->id)}}">   
                            @csrf
                            <input type="hidden" name="project_id" value="{{$project->id}}">
                            <input type="hidden" name="partner_id" value="{{$part->partner_id}}">
                            <div class="px-5">
                                
                                <div class="row ">
                                    <div class="fv-row col-md-6">
                                        <select name="project_partner" id="project_partner" class="form-control m-input" data-control="select2" data-placeholder="Select Partner" class="form-select" data-allow-clear="true">
                                            <option  value=''>Select Partner</option>
                                            @foreach($partners as $partner)
                                                <option value="{{$partner->id}}" @if($partner->id == $part->partner_id) selected @endif>{{$partner->slug}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row col-md-6">
                                        <input type="email" name="email" class="form-control  mx-1" placeholder="Enter Partner Email" value="{{$part->email}}" autocomplete="off">
                                    </div>
                                    <div class="fv-row col-md-4 mt-4">
                                        <select   name="province"  id="partner_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Partner Province" class="form-select project_province"  data-allow-clear="true" >
                                            <option value="">Select Partner Province</option>
                                            @foreach($provinces as $province)
                                                <option value="{{ $province->province_id }}" @if($province->province_id == $part->province) selected @endif>{{ $province->province_name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                    <div class="fv-row col-md-4 mt-4">
                                        <select id="partner_district" name="partner_district" aria-label="Select a district" data-control="select2" data-placeholder="Select Partner District" class="form-select partner_district" data-allow-clear="true">
                                        </select>
                                    </div>
                                    <div class="fv-row col-md-4 mt-4">
                                        <select name="partner_theme" id="partner_theme" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                                            <option  value=''>Select Theme</option>
                                            @foreach($themes as $theme)
                                                <option value="{{$theme->scitheme_name?->id}}" @if($theme->scitheme_name?->id == $part->themes) selected @endif>{{$theme->scitheme_name?->name}} - {{$theme->scisubtheme_name?->name}}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" id="kt_update_project_partner" class="btn btn-success btn-sm  m-5">
                                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                                    </button>
                                    <div id="loadingSpinner" style="display: none;">Loading...</div>
                                </div>      
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @push("scripts")
        
    @endpush
</x-nform-layout>
