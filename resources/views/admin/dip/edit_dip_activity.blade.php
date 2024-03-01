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
            <form action="{{ route('activity_dips.update',$dip->id) }}" method="post" id="create_dip_activity">
                @csrf
                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                <div class="card-body">
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
                        @foreach($dip->months as $month )
                            <div class="row">
                                <div class="col-md-3 my-1">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Activity Target</span>
                                    </label>
                                    <input type="text" name="quarter[]" class="form-control pe-none" autocomplete="off" value="{{$month->slug->slug}}-{{$month->year}}" readonly >
                                </div>
                                <div class="col-md-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Activity Target</span>
                                    </label>
                                    <input type="text" name="target_quarter[]" placeholder="Enter Activity Target"
                                        class="form-control" autocomplete="off" value="{{$month->target ?? ''}}">
                                </div>
                                <div class="col-md-3">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="">Beneficiaries Target</span>
                                    </label>
                                    <input type="text" name="target_benefit[]" placeholder="Enter Beneficiary Target"
                                        class="form-control" autocomplete="off" value="{{$month->beneficiary_target ?? ''}}" required>
                                </div>
                                <div class="col-md-3   mt-5">
                                    <button class="btn btn-danger btn-sm mt-4" onclick="event.preventDefault();del('{{$month->tenure?->quarter}}');" title="Delete Activity" href="javascript:void(0)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Quarter</span>
                                </label>
                                <select name="quarter[]" aria-label="Select a Quarter Target"
                                    data-placeholder="Select a Quarter Target" class="form-select"
                                    data-allow-clear="true">
                                    <option value=" ">Select Quarter Target</option>
                                    @foreach($project->quarters as $quarter)
                                        <option value='{{ $quarter->quarter }}'>{{ $quarter->quarter }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Activity Target</span>
                                </label>
                                <input type="text" name="target_quarter[]" placeholder="Enter Activity Target"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="">Beneficiaries Target</span>
                                </label>
                                <input type="text" name="target_benefit[]" placeholder="Enter Beneficiary Target"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-3 mt-5 text-end">
                                <button type="button" class="btn btn-info btn-sm mt-4" onclick="addTargetRow()"
                                    id="add_quarter_target">Add New Quarter</button>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="card-footer justify-content-end d-flex">
                   <a href="{{ route('dips.edit',$project->id) }}" class="btn btn-primary btn-sm mx-3">Cancel</a>
                    <button type="submit" id="kt_create_dip_activity" class="btn btn-success btn-sm">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function addTargetRow() {
    var quarters = @json($project->quarters);
    var selectedQuarters = $('select[name="quarter[]"]').map(function () {
        return $(this).val();
    }).get(); // Get already selected quarters
    var quarterCount = $('select[name="quarter[]"]').length;

    if (quarterCount < quarters.length ) {
        var lastRow = $('#targetRows .row').last();
        var isValid = true;

        // Check if the last row is valid
        lastRow.find('input[name="target_quarter[]"]').each(function () {
            if ($(this).val().trim() === '') {
                isValid = false;
                toastr.error('Please fill all fields in the previous row before adding a new one.', 'Error');
                return false; // Exit the loop early
            }
        });

        if (isValid) {
            var selectedQuarterValues = $('select[name="quarter[]"]').map(function () {
                return $(this).val();
            }).get();

            var quarterAlreadyExists = false;

            // Check if the selected quarter value already exists
            $('select[name="quarter[]"]').each(function () {
                if ($(this).val() !== '' && selectedQuarterValues.indexOf($(this).val()) !== -1) {
                    quarterAlreadyExists = true;
                    return false; // Exit the loop early
                }
            });

            if (quarterAlreadyExists) {
                toastr.error('Quarter value already exists in the array.', 'Error');
                return;
            }

            var html = `
                <div class="row mt-3 " style="display:none;">
                    <div class="col-md-3">
                        <select name="quarter[]" aria-label="Select a Quarter Target"
                            data-placeholder="Select a Quarter Target" class="form-select"
                            data-allow-clear="true">
                            <option value=''>Select Quarter Target</option>`;
            quarters.forEach(function (quarter) {
                if (!selectedQuarters.includes(quarter.quarter)) { // Check if quarter is not already selected
                    html += `<option value="${quarter.quarter}">${quarter.quarter}</option>`;
                }
            });
            html += `
                        </select>
                    </div> 
                    <div class="col-md-3 ">
                        <input type="text" name="target_quarter[]" placeholder="Enter Activity Target"
                            class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="target_benefit[]" placeholder="Enter Beneficiary Target"
                            class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)">Remove</button>
                    </div>
                </div>`;
            $('#targetRows').append(html);
            lastRow.next().slideDown(); // Show the new row with animation
            if ($('#targetRows .row').length === 1) {
                $('#add_quarter_target').hide();
            }
        }
    } else {
        toastr.error("All Quarters are already shown.", "Error");
    }
    // Check quarters validity to enable/disable submit button
    checkQuartersValidity();
}

        function removeTargetRow(button) {
            $(button).closest('.row').remove();
            $('#add_quarter_target').show();
            // Check quarters validity to enable/disable submit button
            checkQuartersValidity();
        }
    
      
    </script>
    
    @push('scripts')
        <script>
            document.getElementById('themeloader').style.display = 'none';
            $("#theme_id").change(function () {
                document.getElementById('themeloader').style.display = 'block';
                var value = $(this).val();
                csrf_token = $('[name="_token"]').val();
                project_id = $('#project_id').val();
                $.ajax({
                    type: 'POST',
                    url: '/getactivitySubTheme',
                    data: {'theme_id': value, _token: csrf_token, 'project_id':project_id},
                    dataType: 'json',
                    success: function (data) {
                        document.getElementById('themeloader').style.display = 'none';
                        $("#sub_theme_id").find('option').remove();
                        $("#sub_theme_id").prepend("<option value=''>Select Sub-Theme</option>");
                        var selected = '';
                        $.each(data, function (i, item) {
                         
                            $("#sub_theme_id").append("<option value='" + item.id + "' " + selected + " >" +
                                item.name.replace(/_/g, ' ') + "</option>");
                        });
                    }
                });
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
 