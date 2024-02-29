
<div>
    <form id="projecttheme_update"  method="post" action="{{route('projectthemes.update',$theme->id)}}">   
        @csrf
        <input type="hidden" name="_method" value="PUT"> <!-- Adding method spoofing for PUT request -->
        <input type="hidden" name="project" value="{{$theme->id}}">
        <div class="px-5">
            <div class="row ">
             
                <div class="fv-row col-md-4">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="required">House Hold target</span>
                    </label>
                    <input type="text" name="house_hold_target" id="house_hold_target" class="form-control mx-1" placeholder="Enter House Hold Target" autocomplete="off" value="{{ $theme->house_hold_target }}">
                    <span class="text-danger error-message" style="display: none;">Please enter House Hold Target</span>
                </div>
                <div class="fv-row col-md-4">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="required"> Beneficiaries Target</span>
                    </label>
                    <input type="text" name="individual_target" id="individual_target" class="form-control" placeholder="Enter Beneficiaries target" autocomplete="off" value="{{$theme->individual_target}}">
                    <span class="text-danger error-message" style="display: none;">Please enter Beneficiaries Target</span>
                </div>
                <div class="fv-row col-md-4">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="">PWD Target</span>
                    </label>
                    <input type="text" name="pwd_target" id="pwd_target" class="form-control" placeholder="Enter PWD target" autocomplete="off" value="{{$theme->pwd_target}}">
                    <span class="text-danger error-message" style="display: none;">Please enter PWD Target</span>
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Women Target</span>
                    </label>
                    <input type="text" name="women_target" id="women_target" class="form-control  mx-1" placeholder="Enter Women Target" autocomplete="off"  value="{{$theme->women_target}}">
                    <span class="text-danger error-message" style="display: none;">Please enter Women Target</span>
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Men Target</span>
                    </label>
                    <input type="text" name="men_target" id="men_target" class="form-control" placeholder="Enter Men target" autocomplete="off"  value="{{$theme->men_target}}">
                    <span class="text-danger error-message" style="display: none;">Please enter Men Target</span>
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Girls Target</span>
                    </label>
                    <input type="text" name="girls_target" id="girls_target" class="form-control" placeholder="Enter Girls target" autocomplete="off"  value="{{$theme->girls_target}}">
                    <span class="text-danger error-message" style="display: none;">Please enter Girls Target</span>
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="required">Boys Target</span>
                    </label>
                    <input type="text" name="boys_target" id="boys_target" class="form-control" placeholder="Enter Boys target" autocomplete="off"  value="{{$theme->boys_target}}">
                    <span class="text-danger error-message" style="display: none;">Please enter Boys Target</span>
                </div>
            
            </div>
            <div class="d-flex justify-content-end my-3">
                {{-- <div class="btn btn-icon btn-sm btn-active-light-primary ms-2  mx-3" data-bs-dismiss="modal" aria-label="Close">
                    <button  type="button" class="btn btn-info  btn-sm  ">Close</button>
                </div> --}}
                <button type="submit" id="update_projecttheme" class="btn btn-success btn-sm mx-3 " >
                    @include('partials/general/_button-indicator', ['label' => 'Update'])
                </button>
            </div>      
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#projecttheme_update').submit(function(e) {
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

