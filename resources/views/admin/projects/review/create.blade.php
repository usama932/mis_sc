<x-nform-layout>
    @section('title')
    Review Meetings
    @endsection
    <ol class="breadcrumb text-muted fs-6 fw-semibold mb-5">
        <li class="breadcrumb-item"><a href="{{route('get_project_index')}}" class="">Project Details</a></li>
        <li class="breadcrumb-item text-muted">Review Meetings</li>
    </ol>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Review Meeting</h3>
            </div>
            <div class="card-body">
                <form action="{{route('projectreviews.store')}}" method="post" id="create_projectreview" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$id}}" id="project_id">
                    <div class="row">
                        <div class=" col-md-6">
                            <div class="mb-3 fv-row">
                                <label for="title" class="form-label">Review Meeting Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 fv-row">
                                <label for="review_date" class="form-label">Review Date</label>
                                <input type="text" class="form-control" id="review_date" name="review_date">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dynamic_field">
                            <thead>
                                <tr>
                                    <th>Identifies Gap</th>
                                    <th>Responsible Person</th>
                                    <th>Action Agreed</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea class="form-control mb-3" rows="3" name="addmore[0][action_point]" ></textarea></td>
                                    <td>
                                        <select class="form-select mb-3" multiple name="addmore[0][responsible_person][]" aria-label="Select a Responsible person" data-control="select2" data-placeholder="Select a Responsible person..." data-allow-clear="true">
                                            <option value="">Select Responsible</option>
                                            @foreach($persons as $person)
                                            <option value="{{$person->id}}">{{$person->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><textarea class="form-control mb-3" rows="3" name="addmore[0][action_agreed]" ="Enter Agreed Actionplaceholder"></textarea></td>
                                    <td><input type="text" name="addmore[0][deadline]" id="deadline" placeholder="Enter Deadline" class="form-control mb-3" /></td>
                                    <td>
                                        <select class="form-select mb-3" name="addmore[0][status]" aria-label="Select a Status" data-control="select2" data-placeholder="Select Status..." data-allow-clear="true">
                                            <option value="">Select Status</option>
                                            <option value="Initiated">Initiated</option>
                                            <option value="Completed">Completed</option>
                                            <option value="In Process">In Process</option>
                                        </select>
                                    </td>
                                     <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" name="add" id="add" class="btn btn-success btn-sm">Add More</button>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" id="kt_create_projectreview" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
            var i = 0;
        
            $('#add').click(function() {
                i++;
                $('#dynamic_field tbody').append(`
                    <tr id="row${i}">
                        <td><textarea class="form-control mb-3" rows="1" name="addmore[${i}][action_point]" placeholder="Enter Action Point ${i}"></textarea></td>
                        <td>
                            <select class="form-select form-control mb-3 smartsearch_keyword" multiple name="addmore[${i}][responsible_person][]" aria-label="Select a Responsible person " data-control="select2" data-placeholder="Select a Responsible person..." data-allow-clear="true">
                                <option value="">Select Responsible</option>
                                @foreach($persons as $person)
                                <option value="{{$person->id}}">{{$person->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><textarea class="form-control mb-3" rows="1" name="addmore[${i}][action_agreed]" placeholder="Enter Agreed Action"></textarea></td>
                        <td><input type="text" name="addmore[${i}][deadline]" placeholder="Enter Deadline" class="form-control mb-3 " id="deadline${i}" /></td>
                        <td>
                            <select class="form-select form-control mb-3 select_status" name="addmore[${i}][status]" aria-label="Select a Status${i}" data-control="select2 " data-placeholder="Select Status ${i}" data-allow-clear="true">
                                <option value="">Select Status</option>
                                <option value="Initiated">Initiated</option>
                                <option value="Completed">Completed</option>
                                <option value="In Process">In Process</option>
                            </select>
                        </td>
                        <td><button type="button" name="remove" id="${i}" class="btn btn-sm btn-danger btn_remove">Remove</button></td>
                    </tr>
                `);
        
                $('.smartsearch_keyword').select2({
                    multiple: true,
                    tags: true,
                });
                flatpickr("#deadline" + i, {
                    dateFormat: "Y-m-d",
                    minDate: "today"
                });
            });
        
            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id).remove();
                // Move the "Add More" button to the end of the new last row
                $('#add').appendTo($('#dynamic_field tbody tr:last-child td:last-child'));
            });
            $(".smartsearch_keyword").select2({
                multiple: true,
                tags: true,
            });
            $(".select_status").select2({
              
                tags: true,
            });
        });
    </script>
        
    @endpush
</x-nform-layout>
