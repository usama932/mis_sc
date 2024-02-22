<div>
    <form id="update_projecttheme" action="{{route('projectthemes.update',$theme->id)}}" method="post">   
        @csrf
        @method('put')
        <input type="hidden" name="project" value="{{$theme->id}}">
        <div class="px-5">
        
            <div class="row ">
              
             
                <div class="fv-row col-md-4">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required"> House Hold target</span>
                    </label>
                    <input type="text" name="house_hold_target" class="form-control  mx-1" placeholder="Enter House Hold Target" autocomplete="off"  value="{{$theme->house_hold_target}}">
                </div>
                <div class="fv-row col-md-4">
                    <label class="fs-9 fw-se9mibold form-label">
                        <span class="required"> Beneficiaries Target</span>
                    </label>
                    <input type="text" name="individual_target" id="individual_target" class="form-control  mx-1" placeholder="Enter Individual Target" autocomplete="off"  value="{{$theme->pwd_target}}">
                </div>
                <div class="fv-row col-md-4">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="">PWD Target</span>
                    </label>
                    <input type="text" name="pwd_target" id="pwd_target" class="form-control" placeholder="Enter PWD target" autocomplete="off" value="{{$theme->pwd_target}}">
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Women Target</span>
                    </label>
                    <input type="text" name="women_target" id="women_target" class="form-control  mx-1" placeholder="Enter Women Target" autocomplete="off"  value="{{$theme->women_target}}">
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Men Target</span>
                    </label>
                    <input type="text" name="men_target" id="men_target" class="form-control" placeholder="Enter Men target" autocomplete="off"  value="{{$theme->men_target}}">
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Girls Target</span>
                    </label>
                    <input type="text" name="girls_target" id="girls_target" class="form-control" placeholder="Enter Girls target" autocomplete="off"  value="{{$theme->girls_target}}">
                </div>
                <div class="fv-row col-md-3">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="required">Boys Target</span>
                    </label>
                    <input type="text" name="boys_target" id="boys_target" class="form-control" placeholder="Enter Boys target" autocomplete="off"  value="{{$theme->boys_target}}">
                </div>
            
            </div>
            <div class="d-flex justify-content-end my-3">
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2  mx-3" data-bs-dismiss="modal" aria-label="Close">
                    <button  type="button" class="btn btn-info  btn-sm  "> Close</button>
                </div>
                <button type="submit" id="kt_update_projecttheme" class="btn btn-success btn-sm mx-3 " >
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
            </div>      
        </div>
    </form>
</div>