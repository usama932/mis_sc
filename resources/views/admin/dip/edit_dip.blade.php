<div>
   
        <div class="card-body py-4">
            <div class="row">
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
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped m-4">
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
            </div>
        </div>
    
</div>