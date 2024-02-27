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
            <div class="modal fade" id="editpartner_{{$part->id}}" tabindex="-1" role="dialog" aria-labelledby="editpartner_{{$part->id}}" aria-hidden="true">
                <div class="modal-dialog  modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Implementing Partner </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="update_projectpartner" method="post" autocomplete="off">   
                                @csrf
                                <input type="hidden" name="partner_id" value="{{$part->id}}">
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
                                            <select name="theme" id="theme" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                                                <option  value=''>Select Theme</option>
                                                @foreach($themes as $theme)
                                                    <option value="{{$theme->scitheme_name?->id}}" @if($theme->scitheme_name?->id == $part->themes) selected @endif>{{$theme->scitheme_name?->name}} - {{$theme->scisubtheme_name?->name}}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelprojectpartnerBtn" class="btn btn-primary btn-sm mx-3 ">
                                        Cancel
                                        </button>
                                        <button type="submit" id="submits" class="btn btn-success btn-sm mx-3">
                                            @include('partials/general/_button-indicator', ['label' => 'Submit'])
                                        </button>
                                    </div>      
                                </div>
                            </form>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        @endforeach
    @push("scripts")
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            function edittheme(id) {
            var CSRF_TOKEN = '{{ csrf_token() }}';
            $.post("{{ route('edit_project_theme') }}", {
                _token: CSRF_TOKEN,
                id: id
                }).done(function(response) {
                $('.modal-body').html(response);
                $('#edittheme').modal('show');
                });
            }
            $(document).ready(function() {
                $('#update_projectpartner').submit(function(event) {
                console.log('sad');
                    event.preventDefault(); // Prevent default form submission

                    // Serialize form data
                    var formData = $(this).serialize();

                    // AJAX request
                    $.ajax({
                        url: '/',
                        method: 'POST',
                        data: formData, // Pass serialized form data
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                        },
                        success: function(response) {
                            // Handle success response
                            console.log(response);
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-nform-layout>
