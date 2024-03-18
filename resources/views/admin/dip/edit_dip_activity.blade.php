<x-nform-layout>
    @section('title', 'Edit Activity')
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
                    <input type="hidden" name="project_id" id="project_id" value="{{$dip->project_id}}">
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
                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-info btn-sm mt-4" onclick="addTargetRow()" id="add_quarter_target">Add New Quarter</button>
                        </div>
                    </div>
                    <div id="targetRows">
                        @foreach($dip->months as $month)
                        <div class="row">
                            <input type="hidden" name="activities[{{$loop->iteration -1}}][id]" placeholder="Enter Activity Target"
                            class="form-control" autocomplete="off" value="{{$month->id}}">
                            <div class="col-md-2">
                                <label class="fs-7 fw-semibold form-label mb-2">
                                    <span class="required">Quarter</span>
                                </label>
                                <br>
                               <span class="mt-4"> <strong class="mt-4">{{$month->slug?->slug}}-{{$month->year}}</strong></span>
                            </div>
                            <div class="col-md-2">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="required">Activity LOP Target</span>
                                </label>
                                <input type="text" name="activities[{{$loop->iteration -1}}][target_quarter]" placeholder="Enter Activity Target"
                                    class="form-control numeric-input" autocomplete="off" value="{{$month->target}}">
                            </div>
                            <div class="col-md-2">
                                <label class="fs-9 fw-semibold form-label mb-2">
                                    <span class="">Beneficiaries Target</span>
                                </label>
                                <input type="text" name="activities[{{$loop->iteration -1}}][target_benefit]" placeholder="Enter Beneficiary Target"
                                    class="form-control numeric-input" autocomplete="off"  value="{{$month->beneficiary_target}}">
                            </div>
                            <div class="col-md-4">
                                <label class="fs-7 fw-semibold form-label mb-2">
                                    <span class="">Completion Date</span>
                                </label>
                                <input type="text" name="activities[{{$loop->iteration -1}}][complete_date]" id="start_date" placeholder="Select date"  class="form-control start_date" onkeydown="event.preventDefault()" data-provide="datepicker"  value="{{$month->completion_date}}">
                            </div>
                            <div class="col-md-2 mt-4">  
                                <a class="btn btn-sm btn-danger mt-5" title="Delete " onclick="event.preventDefault();del({{$month->id}});" title="Delete Monitor Visit" href="javascript:void(0)">
                                    Delete
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Add New Quarter button -->
                 
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
    @php
        // Construct quarters array
        $quarters = [];
        $projectquarters = []; // Remove unnecessary initialization
        foreach ($dip->months as $month) {
            $quarters[] = $month->slug?->slug . '-' . $month->year;
        }
        foreach ($project->quarters as $quarter) {
            $projectquarters[] = $quarter->quarter;
        }
        $complementQuarters = array_diff( $projectquarters,$quarters);
        @endphp
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var numericInputs = document.querySelectorAll('.numeric-input');

            numericInputs.forEach(function(input) {
                input.addEventListener('input', function(event) {
                    // Remove non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Delegate event handling to the parent element
            document.getElementById('targetRows').addEventListener('input', function(event) {
                var target = event.target;
                // Check if the input belongs to the numeric-input class
                if (target.classList.contains('numeric-input')) {
                    // Remove non-numeric characters
                    target.value = target.value.replace(/[^0-9]/g, '');
                }
            });
        });
    </script>
    <script>
        var i = {{ $dip->months->count() }};
        function addTargetRow() {
            var isValid = true;
            $('#targetRows .row').each(function () {
                $(this).find('input, select').each(function () {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        $(this).addClass('highlight-field');
                        toastr.error('Please address the highlighted Errors.', 'Error');
                        return false; // Exit the loop early
                    } else {
                        $(this).removeClass('highlight-field');
                    }
                });
                if (!isValid) {
                    return false; // Exit the loop early
                }
            });

            if (!isValid) {
                return;
            }
            ++i;
            var quarters = {!! json_encode(array_values($complementQuarters)) !!};
            var selectedQuarters = $('select[name^="activities["]').map(function () {
                return $(this).val();
            }).get();
            var quarterCount = $('select[name^="activities["]').length;
          
            var selectedQuarters = $('select[name^="activities["]').map(function () {
                return $(this).val();
            }).get();

            var availableQuarters = quarters.filter(function(quarter) {
                return !selectedQuarters.includes(quarter);
            });

            if ( quarters.length > quarterCount) {
                var html = `
                    <div class="row mt-3" style="display:none;">
                        <div class="col-md-2">
                            <select name="activities[${i}][quarter]" aria-label="Select a Quarter "
                                data-placeholder="Select a Quarter Target" class="form-select"
                                data-allow-clear="true">
                                <option value=''>Select Quarter Target</option>`;
                                availableQuarters.forEach(function (quarter) {
                                    html += `<option value="${quarter}">${quarter}</option>`;
                                });
                                html += `
                            </select>
                        </div> 
                        <div class="col-md-2">
                            <input type="text" name="activities[${i}][target_quarter]" placeholder="Enter Activity Target"
                                class="form-control numeric-input" autocomplete="off" required>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="activities[${i}][target_benefit]" placeholder="Enter Beneficiary Target"
                                class="form-control numeric-input" autocomplete="off" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="activities[${i}][complete_date]" id="start_date" placeholder="Select date"  class="form-control start_date${i}" onkeydown="event.preventDefault()" data-provide="datepicker" value="">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>`;
                $('#targetRows').append(html);
                $('#targetRows .row').last().slideDown(); // Show the new row with animation
                flatpickr(".start_date" + i, {
                    dateFormat: "Y-m-d",
                });
                if ($('#targetRows .row').length === 1) {
                    $('#add_quarter_target').hide();
                }
            } else {
                toastr.error("All Quarters are already shown.", "Error");
            }
        }
    
        function removeTargetRow(button) {
            $(button).closest('.row').remove();
            $('#add_quarter_target').show();
        }
    </script>
    <script>
        flatpickr(".start_date" , {
            dateFormat: "Y-m-d",
        });
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
                        "Your Activity Quarter has been deleted.",
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
