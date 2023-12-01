<x-nform-layout>

    @section('title')
        Learning Logs
    @endsection
    <style>
        .fixed-thumbnail {
            width: 250px; /* Set your desired width */
            height: 200px; /* Set your desired height */
            overflow: hidden; /* Hide overflow content if necessary */
        }

        .fixed-thumbnail img {
        width: 100%; /* Make the image fill the container */
        height: 100%; /* Maintain aspect ratio */
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
       
            <div class="card-toolbar m-5 d-flex justify-content-end">

                <!--begin::Button-->
                <a href="{{ route('learning-logs.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                New Record</a>
                <!--end::Button-->
            </div>
            
            <div class="row">
                    @forelse($logs as $log)
                        <div class="col-md-4 col-sm-4 col-lg-4 my-5">
                            <div class="card shadow-sm">
                                <div class="card-header bg-secondary ">
                                    <h3 class="card-title ">{{$log->title ?? ''}}</h3> 
                                    <div class="card-toolbar">
                                        <a href="{{route('download.log_file',$log->id)}}">
                                            <i class="fa fa-download text-primary mx-1" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('learning-logs.edit',$log->id)}}">
                                            <i class="fa fa-pencil text-info mx-1" aria-hidden="true"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="del('{{ $log->id }}')">
                                            <i class="fa fa-trash text-danger mx-1" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="fixed-thumbnail">
                                        <img src="{{ asset('storage/learninglog/thumbnail/'.$log->thumbnail) }}" class="img-thumbnail " alt="..." style="">
                                    </div>
                                </div>
                                <div class="card-footer">
                                  
                                    <div class="d-flex justify-content-between">
                                        <span>Lesson ID: {{$log->id ?? ""}}</span>
                                        <div>{{ $log->created_at->format('d/m/Y')}}</div>
                                    </div>
                                    <p>{{ substr($log->theme_name->name ?? '', 0, 50)}} ... 
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{route('learning-logs.show',$log->id)}}" class="btn btn-primary btn-sm"> View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h1 class="text-danger text-center mt-5">No Record Found</h1>
                    @endforelse
                    
            </div>
           
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
        
        
    </div>
    {{ $logs->links('pagination::bootstrap-4') }}
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
    <!--end::Vendors Javascript-->
    @endpush


</x-nform-layout>
