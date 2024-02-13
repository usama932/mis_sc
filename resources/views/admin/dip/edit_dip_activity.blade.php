<x-nform-layout>
   
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    @section('title', 'Edit Activity')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5">Project Info</span></div>
                    <div class="col-md-6">
                        <table class="table table-striped m-4">
                            <tr>
                                <td><strong>Project</strong></td>
                                <td>{{$project->name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>House Hold Target</strong></td>
                                <td>{{$project->detail?->hh_targets ?? ''}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped m-4">
                            <tr>
                                <td><strong>Individual Target</strong></td>
                                <td>{{$project->detail?->individual_targets ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>Project Tenure</strong></td>
                                <td>{{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        
            <form action="{{route('activity_dips.update',$dip->id)}}" method="post" id="create_dip_activity">
                @csrf
                @method('put')
                <input name="project_id" id="project_id" value="{{$project->id}}" type="hidden">
                <div class="card-body">
                    <div class="row">
                        <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5"> Activity</span></div>
                        <input name="project_id" value="{{$project->id}}" type="hidden">
                        <input name="activity_id" value="{{$dip->id}}" type="hidden">
                        <div class="row">
                            <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                                <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                    <span class="required">Activity Title</span>
                                </label>
                                <textarea name="activity" id="activity" rows="1" class="form-control">{{$dip->activity_number}}</textarea>
                                <div id="activityError" class="error-message "></div>
                            </div>  
                            <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                                <label class="fs-6 fw-semibold form-label">
                                    <span class="required">LOP Target</span>
                                </label> 
                                <input name="lop_target" class="form-control" id="lop_target" value="{{$dip->lop_target}}">
                                <div id="lop_targetError" class="error-message "></div>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dotted separator-content border-dark my-15"><span class="h5"> Activity Target</span></div>
                    <div id="targetRows">
                        <div class="row">
                            @foreach($dip->months as $month )

                                <div class="col-md-6 my-1">

                                    
                                    <input type="text" name="quarter[]" placeholder="Enter Target" class="form-control" autocomplete="off" value="{{$month->month}}" readonly >
                                </div>
                                <div class="col-md-4 my-1">
                                    <input type="text" name="target_quarter[]" placeholder="Enter Target" class="form-control" autocomplete="off" value="{{$month->target}}" required>
                                </div>
                                <div class="col-md-2 my-1">
                                    <a class="btn-icon mx-1" onclick="event.preventDefault();del('{{$month->id}}');" title="Delete Activity" href="javascript:void(0)">
                                        <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                    </a>    
                                </div>
                            @endforeach
                            <div class="col-md-6">

                                <select name="quarter[]" aria-label="Select a Quarter Target" data-control="select2" data-placeholder="Select a Quarter Target" class="form-select" data-allow-clear="true">
                                    <option value=''>Select Quarter Target</option>
                                    @foreach($project->quarters as $quarter)
                                        <option value='{{$quarter->id}}'>{{$quarter->quarter_start}} - {{$quarter->quarter_end}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="target_quarter[]" placeholder="Enter Target" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info btn-sm" onclick="addTargetRow()">Add Target</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer justify-content-end">
                    <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm">        
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script>
         
        function addTargetRow() {
            var quarters = @json($project->quarters);
            var html = `
                <div class="row mt-3">
                    <div class="col-md-6">
                        <select name="quarter[]" aria-label="Select a Quarter Target" data-control="select2" data-placeholder="Select a Quarter Target" class="form-select select2" data-allow-clear="true">
                            <option value=''>Select Quarter Target</option>`;
            quarters.forEach(function(quarter) {
                html += `<option value="${quarter.start_month}-${quarter.end_month}">${quarter.start_month}-${quarter.end_month}</option>`;
            });
            html += `
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="target_quarter[]" placeholder="Enter Target" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)">Remove</button>
                    </div>
                </div>`;
            $('#targetRows').append(html);
            
        }

        function removeTargetRow(btn) {
            $(btn).closest('.row').remove();
        }
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
                            "Your Activity has been deleted.",
                            "success"
                        );
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/delete_month/delete/" + id;
                    }
                });
            }
           
    </script>   
</x-nform-layout>
