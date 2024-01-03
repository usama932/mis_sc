<x-default-layout>
 
    @section('title')
    View Project Detail
    @endsection
    <div class="card p-3">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit project</a>
            </div>
            <div class="col-md-6">
                
                <table class="table table-striped m-4">
                    
                    <tr>
                        <td><strong>Project</strong></td>
                        <td>{{$project->name ?? ''}}</td>
                    </tr>
                     
                    <tr>
                        <td><strong>Type</strong></td>
                        <td>{{$project->type ?? ''}}</td>
                    </tr>
                      
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>{{$project->status ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Project Tenure</strong></td>
                        <td>
                           {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                        </td>
                    </tr>
                   
                </table>
                
            </div>
            <div class="col-md-6">
            
                <table class="table table-striped m-4">
                    
                    <tr>
                        <td><strong>Created By</strong></td>
                        <td>{{$project->user->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At</strong></td>
                        <td>   {{ date('d-M-Y', strtotime($project->created_at))}} </td>
                    </tr>
                    <tr>
                        <td><strong>Updated By</strong></td>
                        <td>{{$project->user1->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated At</strong></td>
                        <td>{{ date('d-M-Y', strtotime($project->updated_at))}} </td>
                    </tr>
                </table>
                
            </div>
    
        </div>
       
        
    </div>
</x-default-layout>
