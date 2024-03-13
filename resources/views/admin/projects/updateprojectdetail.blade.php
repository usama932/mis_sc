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
                          {{ucfirst($project->focalperson?->name ?? '')}} -  {{$project->focalperson?->desig?->designation_name ?? ''}}<br>
                       
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
    @push("scripts")
    <script>
        function project_themedel(id) {
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
                        "Your Project Theme  has been deleted.",
                        "success"
                    );
                    var segments = window.location.href.split('/');
                    var url = segments[1];
                    var APP_URL = url + "/project_theme/delete/" + id;
                    var apiUrl = APP_URL;
                    fetch(apiUrl, {
                            method: 'GET', // You can use 'GET', 'POST', 'PUT', 'DELETE', etc.
                            headers: {
                                'Content-Type': 'application/json', // Set the content type based on your API requirements
                                // Add any other headers if needed
                            },
                            // Add any additional options such as body, credentials, etc.
                        })
                        .then(response => {
                            // Handle the response as needed
                            console.log(response);
                        })
                        .catch(error => {
                            // Handle errors
                            console.error('Error:', error);
                        });


                    project_theme.ajax.reload(null, false).draw(false);
                    project_partners.ajax.reload(null, false).draw(false);
                    // $("#create_projecttheme").slideToggle();
                    // $("#project_theme_table").slideToggle();
                    // $("#addprojectthemeBtn").show();
                }
                });
        }
        function edittheme(id) {
            $.post("/edit_project_theme", {
                _token: csrfToken,
                id: id
            }).done(function(response) {
                $('.modal-body').html(response);
                $('#edittheme').modal('show');
            });
        }
        document.getElementById('addprojectpartnerBtn').addEventListener('click', function() {
            console.log('Implementing Partner tab clicked');
            const project_id = $('#project_id').val(); // Get the project ID from the hidden input
            fetchThemes(project_id);
        }, false);
      
        function fetchThemes(project_id) {
          
                fetch('/getprojecttheme', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({_token: csrfToken,project_id: project_id }),
                })
                .then(response => response.json())
                .then(data => {
                    // Clear existing options
                    document.getElementById('theme').innerHTML = '<option value="">Select Theme</option>';
                    
                    // Add fetched themes to the select element
                    data.forEach(themes => {
                        const option = document.createElement('option');
                        option.value = themes.id;
                        option.textContent = themes.name; // Adjust this according to your data structure
                        document.getElementById('themes').appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching themes:', error));
        }
    </script>
    @endpush
</x-nform-layout>
