


<x-nform-layout>

    @section('title')
       Detail Learning Logs
    @endsection
  
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
           
            <div class="row p-3">
                <div class="col-md-12 p-3">
                    <div class="card-title  border-0 my-4"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Detail Learning Log</h5>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped p-5">
                        <tr>
                            <td><strong>Title </strong></td>
                            <td>{{$log->title ?? ""}}</td>
                        </tr>
                        <tr>
                            <td ><strong>Project</strong></td>
                            <td>{{$log->projects->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Project Type</strong></td>
                            <td>{{$log->project_type ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><strong>Research Type </strong></td>
                            <td>{{$log->research_type ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><strong>Description </strong></td>
                            <td>{{$log->description ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><strong>Thumbnail </strong></td>
                            <td><img src="{{storage_path('/public/thumbnail/'.$log->thumbnail)}}" alt="..." class="img-thumbnail"></td>
                        </tr>
                        <tr>
                            <td><strong>Description </strong></td>
                            <td>{{$log->description ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><strong>Created By </strong></td>
                            <td>{{$log->user?->name ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated By</strong></td>
                            <td>{{$log->user1?->name ?? ""}}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At </strong></td>
                            <td>{{date('d-M-Y', strtotime($log->created_at)) ?? ""}}</td>
                        </tr>
                        
                    </table>
                    
                </div>
        
        
            </div>
            

        </div>
    </div>
   
</x-nform-layout>
