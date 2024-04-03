<x-nform-layout>
    @section('title')
       Update Activity Progress
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('updateprogress')}}"  id="update_progress" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-8 mt-3">
                            <label class="fs-6 fw-semibold form-label">
                                <span>Activity Name: </span>
                            </label>
                            <br>
                            <label class="fs-5 fw-semibold form-label">
                                {{$activity->activity_number ?? ''}}
                            </label>
                        </div> 
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity LOP Target</span>
                            </label>
                            <input type="text" name="lop" value="{{$activity->lop_target ?? ''}}" class="form-control form-control-solid" readonly>
                        </div> 
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                <span>Select Quarter</span>
                            </label>
                            <select name="quarter" id="quarter" aria-label="Select a Quarter Target" data-control="select2" data-placeholder="Select a Quarter Target" class="form-select" data-allow-clear="true">
                                <option value=''>Choose Quarter</option>
                                @if(!empty($activity->months))
                                    @foreach($activity->months as $months)
                                        @if($months->project_id ==  $activity->project_id && !in_array($months->id, $quarters))
                                            <option value='{{$months->id}}'>{{$months->quarter}} - {{$months->year}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div> 
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Quarterly Target</span>
                            </label>
                            <input type="text" name="lop_target" id="lop_target" class="form-control form-control-solid" readonly>
                            <div id="sofError" class="error-message " ></div>
                        </div> 
                        <div class="fv-row col-md-4 mt-3">
                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Enter Quarterly Progress</span>
                            </label>
                            <input type="text" name="activity_target" id="activity_target" class="form-control" >
                            <div id="activity_targetError" class="error-message " ></div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="fv-row col-md-2 mt-3">
                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                <span>Beneficiaries Target</span>
                            </label>
                            <input type="text" name="benefit_target" id="benefit_target" class="form-control form-control-solid" readonly>
                            <div id="benefit_targetError" class="error-message " ></div>
                        </div> 
                        <div class="fv-row col-md-2 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Women</span>
                            </label>
                            <input type="text" name="women_target" value="" class="form-control"  placeholder="Women">
                        </div> 
                        <div class="fv-row col-md-2 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Men</span>
                            </label>
                            <input type="text" name="men_target" value="" class="form-control"  placeholder="Men">
                        </div> 
                        <div class="fv-row col-md-2 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Girls</span>
                            </label>
                            <input type="text" name="girls_target" value="" class="form-control"  placeholder="Girls">
                        </div> 
                        <div class="fv-row col-md-2 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Boys</span>
                            </label>
                            <input type="text" name="boys_target" value="" class="form-control" placeholder="Boys" >
                        </div> 
                        <div class="fv-row col-md-2 mt-3">
                            <label class="fs-7 fw-semibold form-label mb-2 d-flex">
                                <span>PWD</span>
                            </label>
                            <input type="text" name="pwd_target" id="pwd_target" class="form-control" >
                            <div id="pwd_targetError" class="error-message " ></div>
                        </div>
                        <div class="fv-row col-md-12 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="">Remarks</span>
                            </label>
                            <textarea type="text" name="remarks" rows id="remarks" placeholder="Enter Remarks" class="form-control" value=""></textarea>
                            <div id="achieve_targetError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Attachemnt</span>
                            </label>
                            <input type="file" name="attachment" id="attachment" accept=".pdf, .docx, .doc" class="form-control" value="">
                            <div id="attachmentError" class="error-message "></div>
                        </div> 
                        <div class="fv-row col-md-6 mt-3">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Image</span>
                            </label>
                            <input type="file" name="image" id="image"   accept=".jpg, .jpeg, .png" class="form-control" value="">
                            <div id="imageError" class="error-message "></div>
                        </div> 
                    </div>
                </div>
             
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary btn-sm  my-5" onclick="window.history.back()">Cancel</button>
                    <button type="submit" id="kt_update_progress" class="btn btn-success btn-sm  m-5">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
    @push("scripts")
    <script>
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
                        $('#benefit_target').val(response.benefit_target); 
                        $('#lop_target').val(response.lop_target); 
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log any errors to the console
                    }
                });
            });
        });
       
    </script>
    @endpush
</x-nform-layout>
