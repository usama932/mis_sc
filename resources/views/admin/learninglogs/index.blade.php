<x-nform-layout>

    @section('title')
        Learning Logs
    @endsection
    <style>
        .fixed-thumbnail {
            width: 250px; /* Set your desired width */
            height: 200px; /* Set your desired height */
            overflow: hidden; /* Hide overflow content if necessary */
            background-color: grey; /* Replace 'yourColor' with the color you want */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .fixed-thumbnail img {
        width: 100%; /* Make the image fill the container */
        height: 100%; /* Maintain aspect ratio */
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="card-toolbar mb-3 d-flex justify-content-between">
                <h5> Learning Logs: {{$totallogs ?? ''}}</h5>
                <h5> Assesment: {{$totalassesment ?? ''}}</h5>
                <h5> Evaluation: {{$totalEvaluation ?? ''}}</h5>
                <h5> PDM: {{$totalPDM ?? ''}}</h5>
                <h5> Research Study: {{$totalResearch ?? ''}}</h5>
                <h5> Survey: {{$totalSurvey ?? ''}}</h5>
                @can('create learning log')
                    <div class="">
                        <a href="{{ route('learning-logs.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                        New Record {{$project ?? ''}}</a>
                    </div>
                @endcan
            </div>
            <div class="card-toolbar  justify-content-between">
                <div class="row">
                    <div class="col-md-4 ">
                        <select  name="project" id="project" aria-label="Select Project" data-control="select2" data-placeholder="Select Project" class="form-select"  data-allow-clear="true" >
                            <option value="">Select Project </option>
                            @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 ">
                        <select name="research_type" id="research_type" aria-label="Select Research Type" data-control="select2" data-placeholder="Select Research Type" class="form-select form-control"  data-allow-clear="true" >
                            <option value="" >Select Research Type</option>
                            <option value="Assessment" >Assessment</option>
                            <option value="Evaluation">Evalution</option>
                            <option value="PDM">PDM</option>
                            <option value="Research Study">Research Study</option>
                            <option value="Survey Report">Survey Report</option>
                        </select>
                    </div>
                    <div class="col-md-4 ">               
                        <select name="theme" id="theme" class="form-select form-control" data-control="select2" data-placeholder="Select an Theme" data-allow-clear="true">
                            <option value="" >Select Theme</option>
                            @foreach($themes as $theme)
                                <option value="{{$theme->id}}" >{{$theme->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            @include('admin.learninglogs.search')
            {{-- <div class="card-body pt-0 overflow-* rounded">

                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap " id="learninglogs" style="width:100% ">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Project</th>
                            <th>Project Type</th>
                            <th>Research Type</th>
                            <th>Thumbnail</th>
                            <th>Created By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>

            </div>
            --}}
        
          {{ $logs->links('pagination::bootstrap-5') }} 
    </div>
    
    <div class="modal fade" id="quality_benchmark" data-backdrop="static" tabindex="1" role="dialog"
        aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="quality_benchmark">Quality Bench Detail</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold close"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @push("scripts")
    <script>
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
                        "Your Learning Log has been deleted.",
                        "success"
                    );
                    var APP_URL = {!! json_encode(url('/')) !!}
                    window.location.href = APP_URL + "/learninglog/delete/" + id;
                }
            });
        }
 
    
    </script>
    <script>
        $(document).ready(function () {
            $('#research_type, #theme, #project').on('change', function () {
                KTApp.showPageLoading();
                var researchType =  $('#research_type').val();
                var theme = $('#theme').val();
                var project = $('#project').val();
                $.ajax({
                    type: 'post',
                    url: '{{ route("learninglog.search") }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'research_type': researchType,
                        'theme': theme,
                        'project': project
                    },
                    success: function (data) {
                        KTApp.hidePageLoading();
                        $('#researchResults').html(data);
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });
        });

    </script>
    <!--end::Vendors Javascript-->
    @endpush


</x-nform-layout>
