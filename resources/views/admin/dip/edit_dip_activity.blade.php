<x-nform-layout>
    @section('title', 'Edit  Activity')
    <style>
        .highlight-field {
            border-color: red;
            /* You can add more styles as needed */
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('activity_dips.update',$dip->id) }}" method="post" id="create_dip_activity">
                    @csrf
                    @method('put')
                    <input type="hidden" name="project_id" id="project_id" value="{{ $dip->project_id }}">
                    <input type="hidden" name="activity_id" id="activity_id" value="{{ $dip->id }}">
                    
                    <div class="row">
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="">Thematic Area:</span>
                            </label>
                            <br>
                            <label class="fs-6 fw-semibold form-label">
                                <span class="">{{$dip->scisubtheme_name?->maintheme?->name}}</span>
                            </label>
                            <div id="themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Sub-Thematic Area</span> 
                            </label>
                            <br>
                            <label class="fs-6 fw-semibold form-label">
                                <span class="">{{$dip->scisubtheme_name?->name}}</span>
                            </label>
                            <div id="sub_themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-10 col-lg-10 col-sm-12">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity Title</span>
                            </label>
                            <textarea name="activity" id="activity" rows="1" class="form-control">{{$dip->activity_title ?? ''}}</textarea>
                            <div id="activityError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-2 col-lg-2 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">LOP Target</span>
                            </label>
                            <input name="lop_target" class="form-control" id="lop_target" value="{{$dip->lop_target ?? ''}}">
                            <div id="lop_targetError" class="error-message"></div>
                        </div>
                        
                    </div>
                    <div class="separator my-3"></div>
                    <div id="targetRows">
                        <div class="row">
                            @foreach($dip->months as $month)
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Quarter</span>
                                        </label>
                                        <br>
                                       <span class="mt-4"> <strong>{{$month->slug?->slug}}-{{$month->year}}</strong></span>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Activity Target</span>
                                        </label>
                                        <input type="text" name="activities[]['target_quarter']" placeholder="Enter Activity Target"
                                            class="form-control" autocomplete="off" value="{{$month->target}}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="">Beneficiaries Target</span>
                                        </label>
                                        <input type="text" name="activities[]['target_benefit']" placeholder="Enter Beneficiary Target"
                                            class="form-control" autocomplete="off"  value="{{$month->beneficiary_target}}">
                                    </div>
                                    <div class="col-md-3 mt-4">  
                                        <a class="btn btn-sm btn-danger mt-5" title="Delete " onclick="event.preventDefault();del('.$r->id.');" title="Delete Monitor Visit" href="javascript:void(0)">
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach     
                        </div>
                                            <!-- Add New Quarter button -->
                        <div class="row">
                            <div class=" d-flex justify-content-end">
                                <button type="button" class="btn btn-info btn-sm mt-4" onclick="addTargetRow()" id="add_quarter_target">Add New Quarter</button>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer justify-content-end d-flex">
                        @if(!empty($project->id))
                        <a href="{{ route('dips.edit',$project->id) }}" class="btn btn-primary btn-sm mx-3">Cancel</a>
                        @endif
                        <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm">
                            @include('partials/general/_button-indicator', ['label' => 'Submit'])
                        </button>
                    </div>
                </form>
                
                <div class="separator my-3"></div>
              
                
            </div>  
        </div>
    </div>
  
    @push('scripts')
        <script>
          
          
            // function addTargetRow() {
            //     var quarters = @json($project->quarters);
            //     var slugs = @json($slugs);
            //     var selectedQuarters = $('select[name="quarter[]"]').map(function () {
            //         return $(this).val();
            //     }).get(); // Get already selected quarters
            //     var quarterCount = $('select[name="quarter[]"]').length;

            //     if (quarterCount < quarters.length) {
            //         var lastRow = $('#targetRows .row').last();
            //         var html = `
            //             <div class="row mt-3" style="display:none;">
            //                 <div class="col-md-3">
            //                     <select name="quarter[]" aria-label="Select a Quarter Target"
            //                         data-placeholder="Select a Quarter Target" class="form-select"
            //                         data-allow-clear="true">
            //                         <option value=''>Select Quarter Target</option>`;
            //                         quarters.forEach(function (quarter) {
            //                             if (!selectedQuarters.includes(quarter.quarter) && !slugs.includes(quarter.quarter)) {
            //                                 html += `<option value="${quarter.quarter}">${quarter.quarter}</option>`;
            //                             }
            //                         });
            //                         html += `
            //                     </select>
            //                 </div> 
            //                 <div class="col-md-3">
            //                     <input type="text" name="target_quarter[]" placeholder="Enter Activity Target"
            //                         class="form-control" autocomplete="off" required>
            //                 </div>
            //                 <div class="col-md-3">
            //                     <input type="text" name="target_benefit[]" placeholder="Enter Beneficiary Target"
            //                         class="form-control" autocomplete="off" required>
            //                 </div>
            //                 <div class="col-md-3">
            //                     <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)">Remove</button>
            //                 </div>
            //             </div>`;
            //         $('#targetRows').append(html);
            //         lastRow.next().slideDown(); // Show the new row with animation
            //     } else {
            //         toastr.error("All Quarters are already shown.", "Error");
            //     }
            //     // Check quarters validity to enable/disable submit button
            //     checkQuartersValidity();
            // }
            // function removeTargetRow(button) {
            //     $(button).closest('.row').remove();
            //     $('#add_quarter_target').show();
            //     // Check quarters validity to enable/disable submit button
            //     checkQuartersValidity();
            // }

        </script>
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
                            "Your Activity has been deleted.",
                            "success"
                        );
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/delete_month/delete/" + id;
                    }
                });
            }
        </script>
    @endpush
</x-nform-layout>
    