<x-nform-layout>
    @section('title')
       Update Activity Progress
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('updateprogress')}}" method="post" id="update_progress" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-12 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity</span>
                            </label>
                            <p>{{$activity->activity_number ?? ''}}</p>
                        </div> 
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Quarter</span>
                            </label>
                            <select name="quarter" id="quarter" aria-label="Select a Quarter Target" data-control="select2" data-placeholder="Select a Quarter Target" class="form-select" data-allow-clear="true">
                                <option value=''>Select Quarter Target</option>
                                @if(!empty($activity->months))
                                    @foreach($activity->months as $months)
                                        <option value='{{$months->id}}'>{{$months->month}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div> 
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">LOP target</span>
                            </label>
                            <input type="text"  class="form-control form-control-solid" value="{{$activity->lop_target ?? ''}}" readonly>
                            <div id="sofError" class="error-message "></div>
                        </div> 
                     
                        <div class="fv-row col-md-12 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Progress</span>
                            </label>
                            <textarea type="text" name="achieve_target" rows id="sof" placeholder="Enter Target" class="form-control" value=""></textarea>
                            <div id="achieve_targetError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Attachemnt</span>
                            </label>
                            <input type="file" name="attachment" id="attachment" class="form-control" value="">
                            <div id="attachmentError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Image</span>
                            </label>
                            <input type="file" name="image" id="image"  class="form-control" value="">
                            <div id="imageError" class="error-message "></div>
                        </div> 
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="kt_update_progress" class="btn btn-success btn-sm  m-5">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
    @push("scripts")
    <scripts>
        $(document).ready(function() {
            // Function to handle quarter change event
            $('#quarter').change(function() {
               
                var selectedQuarterId = $(this).val(); // Get the selected quarter value

                $.ajax({
                    url: "{{ route('fetchquartertarget') }}", // Change this route to your actual route
                    method: 'POST',
                    data: {
                        quarter_id: selectedQuarterId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert
                        $('input[name="lop_target"]').val(response.lop_target);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log any errors to the console
                    }
                });
            });
        });
    </scripts>
    @endpush
</x-nform-layout>
