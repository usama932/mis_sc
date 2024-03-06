<x-nform-layout>
    @section('title', 'Add New Activity')
    <style>
        .highlight-field {
            border-color: red;
            /* You can add more styles as needed */
        }
    </style>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{ route('activity_dips.store') }}" class="create_dip_activity" method="post" id="create_dip_activity">
                @csrf
                <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Thematic Area</span>
                            </label>
                            <select name="theme" id="theme_id" aria-label="Select a Theme" data-control="select2"
                                    data-placeholder="Select a Theme" class="form-select" data-allow-clear="true">
                                <option value=''>Select Thematic Area</option>
                                @foreach($themes as $theme)
                               
                                    <option value='{{ $theme->theme_id}}'>{{ $theme->scitheme_name->name }}</option>
                                @endforeach
                            </select>
                            <div id="themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-6 col-lg-6 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Sub-Thematic Area</span>
                                <span class="spinner-border spinner-border-sm align-middle ms-2" id="themeloader"
                                    style="display: none !important;"></span>
                            </label>
                            <select name="sub_theme" id="sub_theme_id" aria-label="Select a Theme"
                                data-control="select2" data-placeholder="Select a Theme" class="form-select"
                                data-allow-clear="true">
                            </select>
                            <div id="sub_themeError" class="error-message"></div>
                        </div>
                        <div class="fv-row col-md-10 col-lg-10 col-sm-12">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">Activity Title</span>
                            </label>
                            <textarea name="activity" id="activity" rows="1" class="form-control"></textarea>
                            <div id="activityError" class="error-message"></div>
                        </div>
                   
                       
                        <div class="fv-row col-md-2 col-lg-2 col-sm-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">LOP Target</span>
                            </label>
                            <input name="lop_target" class="form-control" id="lop_target">
                            <div id="lop_targetError" class="error-message"></div>
                        </div>
                    </div>
                    <div class="separator my-3"></div>
                    <div id="targetRows">
                               
                        <div class="row">
                            <div class="col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Quarter</span>
                                </label>
                                <select name="activities[0][quarter]" aria-label="Select a Quarter Target"
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
                                <input type="text" name="activities[0][target_quarter]" placeholder="Enter Activity Target"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="">Beneficiaries Target</span>
                                </label>
                                <input type="text" name="activities[0][target_benefit]" placeholder="Enter Beneficiary Target"
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
        var i = 0;
        function addTargetRow() {
            var isValid = true;
            $('#targetRows .row').each(function () {
                $(this).find('input, select').each(function () {
                    if ($(this).val().trim() === '') {
                        isValid = false;
                        $(this).addClass('highlight-field');
                        toastr.error('Please fill all fields in all existing rows before submitting the form.', 'Error');
                        event.preventDefault(); // Prevent form submission
                        return false; // Exit the loop early
                    } else {
                        $(this).removeClass('highlight-field');
                    }
                });
            });

            if (!isValid) {
                return;
            }
            ++i;
            var quarters = @json($project->quarters);
            var selectedQuarters = $('select[name^="activities["]').map(function () {
                return $(this).val();
            }).get(); // Get all selected quarters
            
            var quarterCount = $('select[name^="activities["]').length;
            
            var availableQuarters = quarters.filter(function(quarter) {
                return !selectedQuarters.includes(quarter.quarter);
            });

            if (quarterCount < quarters.length) {
                var html = `
                    <div class="row mt-3" style="display:none;">
                        <div class="col-md-3">
                            <select name="activities[${i}][quarter]" aria-label="Select a Quarter Target"
                                data-placeholder="Select a Quarter Target" class="form-select"
                                data-allow-clear="true">
                                <option value=''>Select Quarter Target</option>`;
                                availableQuarters.forEach(function (quarter) {
                                    html += `<option value="${quarter.quarter}">${quarter.quarter}</option>`;
                                });
                                html += `
                            </select>
                        </div> 
                        <div class="col-md-3">
                            <input type="text" name="activities[${i}][target_quarter]" placeholder="Enter Activity Target"
                                class="form-control" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="activities[${i}][target_benefit]" placeholder="Enter Beneficiary Target"
                                class="form-control" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)">Remove</button>
                        </div>
                    </div>`;
                $('#targetRows').append(html);
                $('#targetRows .row').last().slideDown(); // Show the new row with animation
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
        </script>
    @endpush
 </x-nform-layout>
 