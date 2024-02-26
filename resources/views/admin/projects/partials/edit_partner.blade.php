
<div>
    <form id="create_projectpartner" action="{{route('projectpartners.store')}}" method="post" autocomplete="off">   
        @csrf
        <div class="px-5">
            <h3>Add Project Partner</h3>
            <div class="row ">
                <div class="fv-row col-md-6">
                    <select name="partner" id="partner" class="form-control m-input" data-control="select2" data-placeholder="Select Partner" class="form-select" data-allow-clear="true">
                        <option  value=''>Select Partner</option>
                        @foreach($partners as $partner)
                            <option value="{{$partner->id}}">{{$partner->slug}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fv-row col-md-6">
                    <input type="email" name="email" class="form-control  mx-1" placeholder="Enter Partner Email" autocomplete="off">
                </div>
                <div class="fv-row col-md-4 mt-4">
                    <select   name="province"  id="project_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Partner Province" class="form-select "  data-allow-clear="true" >
                        <option value="">Select Partner Province</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->province_id }}" >{{ $province->province_name }}                          </option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="fv-row col-md-4 mt-4">
                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtload"></span>
                    <select id="project_district" name="district" aria-label="Select a district" data-control="select2" data-placeholder="Select Partner District" class="form-select "  data-allow-clear="true">    
                    </select>
                </div>
                <div class="fv-row col-md-4 mt-4">
                    <select name="theme" id="theme" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                        <option  value=''>Select Theme</option>
                        @foreach($themes as $theme)
                            <option value="{{$theme->scitheme_name?->id}}">{{$theme->scitheme_name?->name}} - {{$theme->scisubtheme_name?->name}}</option>
                        @endforeach
                    </select> 
                </div>
            </div>
            <div class="d-flex justify-content-end my-3">
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2  mx-3" data-bs-dismiss="modal" aria-label="Close">
                    <button  type="button" class="btn btn-info  btn-sm  ">Close</button>
                </div>
                <button type="submit" id="update_projecttheme" class="btn btn-success btn-sm mx-3 " >
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
            </div>      
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#projectpartner_update').submit(function(e) {
            e.preventDefault(); // Prevent form submission
            var isValid = true;
            $('.error-message').hide();
            $('input[type="text"]').each(function () {
                if (!$(this).val()) {
                    $(this).next('.error-message').show();
                    isValid = false;
                }
            });
            $.ajax({
                type: 'POST', // Corrected to POST since we are spoofing the method
                url: $(this).attr('action'),
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                   
                    if (response) {
                        if (response.error == true) {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
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
                            toastr.success(response.message, "Success");

                            window.location.assign(response.editUrl);

                        } else {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
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
                            toastr.error(response.message, "Error");
                        }

                    }
                   // Display success response
                },
                error: function(xhr, status, error) {
                    toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
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
                                toastr.error(error, "Error");
                }
            });
            
        });
     
       
    });
</script>
