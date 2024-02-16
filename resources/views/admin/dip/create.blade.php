<x-nform-layout>
    @section('title', 'Add Activity')
    <div id="kt_app_content" class="app-content flex-column-fluid">
       <div class="card">
          <form action="{{route('activity_dips.store')}}" method="post" id="create_dip_activity">
             @csrf
             <input name="project_id" id="project_id" value="{{$project->id}}" type="hidden">
             <div class="card-body">
                <div class="row">
                   <input name="project_id" value="{{$project->id}}" type="hidden">
                   <div class="row">
                      <div class="fv-row col-md-4 col-lg-4 col-sm-12">
                         <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                         <span class="required">Activity Title</span>
                         </label>
                         <textarea name="activity" id="activity" rows="1" class="form-control"></textarea>
                         <div id="activityError" class="error-message "></div>
                      </div>
                      <div class="fv-row col-md-3 col-lg-3 col-sm-12">
                         <label class="fs-6 fw-semibold form-label">
                         <span class="required">Thematic Area</span>
                         </label> 
                         <select   name="theme" id="theme_id" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select "  data-allow-clear="true" >
                            <option  value=''>Select Thematic Area</option>
                            @foreach($themes as $theme )
                            <option  value='{{ $theme->id }}'>{{ $theme->name }}</option>
                            @endforeach
                         </select>
                         <div id="themeError" class="error-message "></div>
                      </div>
                      <div class="fv-row col-md-3 col-lg-3 col-sm-12">
                         <label class="fs-6 fw-semibold form-label">
                         <span class="required">Sub-Thematic Area</span>
                         <span class="spinner-border spinner-border-sm align-middle ms-2" id="themeloader" style="display="none !important;"></span>
                         </label> 
                         <select   name="sub_theme" id="sub_theme_id" aria-label="Select a Theme" data-control="select2" data-placeholder="Select a Theme" class="form-select "  data-allow-clear="true" > 
                         </select>
                         <div id="sub_themeError" class="error-message "></div>
                      </div>
                      <div class="fv-row col-md-2 col-lg-2 col-sm-12">
                         <label class="fs-6 fw-semibold form-label">
                         <span class="required">LOP Target</span>
                         </label> 
                         <input name="lop_target" class="form-control" id="lop_target">
                         <div id="lop_targetError" class="error-message "></div>
                      </div>
                   </div>
                </div>
                <div class="card mt-5">
                   <div class="card-header">
                      <div class="card-title"> Quarterly Targets</div>
                      <div class="col-md-2 mt-5 justify-content-end d-flex">
                         <button type="button" class="btn btn-info btn-sm" onclick="addTargetRow()" id="add_quarter_target">Add New Quarter </button>
                      </div>
                   </div>
                   <div class="card-body">
                      <div id="targetRows">
                         <div class="row">
                            <div class="col-md-3">
                               <label class="fs-6 fw-semibold form-label mb-2">
                               <span class="">Quarter</span>
                               </label>
                               <select name="quarter[]" aria-label="Select a Quarter Target" data-placeholder="Select a Quarter Target" class="form-select" data-allow-clear="true">
                                  <option value=" ">Select Quarter Target</option>
                                  @foreach($project->quarters as $quarter)
                                  <option value='{{$quarter->quarter}}'>{{$quarter->quarter}}</option>
                                  @endforeach
                               </select>
                            </div>
                            <div class="col-md-3">
                               <label class="fs-6 fw-semibold form-label mb-2">
                               <span class="">Activity  Target</span>
                               </label>
                               <input type="text" name="target_quarter[]" placeholder="Enter Target" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                               <label class="fs-6 fw-semibold form-label mb-2">
                               <span class="">Beneficiaries Target</span>
                               </label>
                               <input type="text" name="target_benefit[]" placeholder="Enter Target" class="form-control" autocomplete="off" required>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="card-footer justify-content-end d-flex">
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
        var selectedQuarters = $('select[name="quarter[]"]').map(function(){return $(this).val();}).get(); // Get already selected quarters
        var quarterCount = $('select[name="quarter[]"]').length;
        
            if (quarterCount < quarters.length) {
                var html = `
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <select name="quarter[]" aria-label="Select a Quarter Target" data-control="select2" data-placeholder="Select a Quarter Target" class="form-select select2" data-allow-clear="true">
                                <option value=''>Select Quarter Target</option>`;
                                quarters.forEach(function(quarter) {
                                    if (!selectedQuarters.includes(quarter.quarter)) { // Check if quarter is not already selected
                                        html += `<option value="${quarter.quarter}">${quarter.quarter}</option>`;
                                    }
                                });
                                html += `
                            </select>
                        </div> 
                        <div class="col-md-3">
                            <input type="text" name="target_quarter[]" placeholder="Enter Target" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="target_benefit[]" placeholder="Enter Target" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTargetRow(this)">Remove</button>
                        </div>
                    </div>`;
                $('#targetRows').append(html);
                if ($('#targetRows.row').length === 1) {
                    $('#add_quarter_target').hide();             "debug": true,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toastr-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
            
                        toastr.error("All Quarter Show Already", "Error");
            }
        }
       
    </script>   
    @push('scripts')
        <script>
        document.getElementById('themeloader').style.display = 'none';
        $("#theme_id").change(function () {
            
            document.getElementById('themeloader').style.display = 'block';
            var value = $(this).val();
            csrf_token = $('[name="_token"]').val();
            
            $.ajax({
                type: 'POST',
                url: '/getSubTheme',
                data: {'theme_id': value, _token: csrf_token },
                dataType: 'json',
                success: function (data) {
                    document.getElementById('themeloader').style.display = 'none';
                    $("#sub_theme_id").find('option').remove();
                    $("#sub_theme_id").prepend("<option value='' >Select Sub-Theme</option>");
                    var selected='';
                    $.each(data, function (i, item) {
        
                        $("#sub_theme_id").append("<option value='" + item.id + "' "+selected+" >" +
                        item.name.replace(/_/g, ' ') + "</option>");
                    });
        
                }
        
            });
        
        });
        </script>
    @endpush
</x-nform-layout>