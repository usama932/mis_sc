<div>
    <div class="">
        <div class="d-flex justify-content-end hover-elevate-up my-3 mx-5">
            <button class="btn btn-sm btn-success mx-5" id="addprojectthemeBtn"> <i class="ki-duotone ki-abstract-10">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>Add Project Themes & Targets</button>
        </div>
    </div>
    <form id="create_projecttheme" action="{{route('projectthemes.store')}}" method="post">   
        @csrf
        <input type="hidden" name="project" value="{{$project->id}}">
        <div class="px-5">
        
            <div class="row ">
                <div class="fv-row col-md-4">
                    <label class="fs-8 fw-semibold form-label 2">
                        <span class="required">Thematic Area</span>
                    </label>
                    <select name="theme" id="theme_id" aria-label="Select a Theme" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                        <option  value=''>Select Theme</option>
                        @foreach($ths as $theme)
                            <option value="{{$theme->id}}">{{$theme->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fv-row col-md-4 col-lg-4 col-sm-12">
                    <label class="fs-8 fw-semibold form-label">
                    <span class="required">Sub-Thematic Area</span>
                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="themeloader" style="display="none !important;"></span>
                    </label> 
                    <select   name="sub_theme" id="sub_theme_id" aria-label="Select a Sub Theme" data-control="select2" data-placeholder="Select Sub-Theme" class="form-select"  data-allow-clear="true" > 
                    </select>
                    <div id="sub_themeError" class="error-message "></div>
                </div>
                <div class="fv-row col-md-4">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required"> House Hold target</span>
                    </label>
                    <input type="text" name="house_hold_target" class="form-control  mx-1" placeholder="# of HH Target" autocomplete="off">
                </div>
                <div class="fv-row col-md-2">
                    <label class="fs-9 fw-se9mibold form-label">
                        <span class="required"> Beneficiaries Target</span>
                    </label>
                    <input type="text" name="individual_target" id="individual_target" class="form-control  mx-1" placeholder="# of Beneficiaries" autocomplete="off">
                </div>
            
                <div class="fv-row col-md-2">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Women Target</span>
                    </label>
                    <input type="text" name="women_target" id="women_target" class="form-control  mx-1" placeholder="# of Women" autocomplete="off">
                </div>
                <div class="fv-row col-md-2">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Men Target</span>
                    </label>
                    <input type="text" name="men_target" id="men_target" class="form-control" placeholder="# of Men" autocomplete="off">
                </div>
                <div class="fv-row col-md-2">
                    <label class="fs-9 fw-semibold form-label ">
                        <span class="required">Girls Target</span>
                    </label>
                    <input type="text" name="girls_target" id="girls_target" class="form-control" placeholder="# of Girls" autocomplete="off">
                </div>
                <div class="fv-row col-md-2">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="required">Boys Target</span>
                    </label>
                    <input type="text" name="boys_target" id="boys_target" class="form-control" placeholder="# of Boys" autocomplete="off">
                </div>
                <div class="fv-row col-md-2">
                    <label class="fs-9 fw-semibold form-label">
                        <span class="">PWD/CLWD Target</span>
                    </label>
                    <input type="text" name="pwd_target" id="pwd_target" class="form-control" placeholder="# of PWD" autocomplete="off" value="">
                </div>
            </div>
            <div class="d-flex justify-content-end my-3">
                <button type="button" id="cancelprojectthemeBtn" class="btn btn-primary btn-sm mx-3 ">
                   Cancel
                </button>
                <button type="submit" id="kt_create_projecttheme" class="btn btn-success btn-sm mx-3">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
            </div>      
        </div>
    </form>
    <div class="card"  id="project_theme_table">
        <div class="card-body overflow-*">
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap" id="project_themes" style="width:100%">
                <thead>
                    <tr>
                        <th>Theme</th>
                        <th>Sub Theme</th>
                        <th contenteditable="true">House-Hold Target</th>
                        <th contenteditable="true">Individual Target</th>
                        <th contenteditable="true">Women Target</th>
                        <th contenteditable="true">Men Target</th>
                        <th contenteditable="true">Girls Target</th>
                        <th contenteditable="true">Boys Target</th>
                        <th contenteditable="true">PWD/CLWD Target</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                </table>
            </div>
        </div>
    </div>
</div>