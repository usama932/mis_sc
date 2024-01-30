<div>
    <div class="">
        <div class="d-flex justify-content-end hover-elevate-up my-3 mx-5">
            <button class="btn btn-sm btn-primary mx-5" id="addprojectthemeBtn"> <i class="ki-duotone ki-abstract-10">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>Add Project Theme</button>
        </div>
    </div>
    <form id="create_projecttheme" action="{{route('projectthemes.store')}}" method="post">   
        @csrf
        <input type="hidden" name="project" value="{{$project->id}}">
        <div class="px-5">
            <h3>Add Project Theme</h3>
            <div class="row ">
                <div class="fv-row col-md-3">
                    <select name="theme" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                        <option  value=''>Select Theme</option>
                        @foreach($themes as $theme)
                            <option value="{{$theme->id}}">{{$theme->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fv-row col-md-3">
                    <input type="text" name="house_hold_target" class="form-control  mx-1" placeholder="Enter House Hold Target" autocomplete="off">
                </div>
                <div class="fv-row col-md-3">
                    <input type="text" name="individual_target" id="individual_target" class="form-control  mx-1" placeholder="Enter Individual Target" autocomplete="off">
                </div>
                <div class="fv-row col-md-3">
                    <input type="text" name="women_target" id="women_target" class="form-control  mx-1" placeholder="Enter Women Target" autocomplete="off">
                </div>
                <div class="fv-row col-md-3">
                    <input type="text" name="men_target" id="men_target" class="form-control mt-3 mx-1" placeholder="Enter Men target" autocomplete="off">
                </div>
                <div class="fv-row col-md-3">
                    <input type="text" name="girls_target" id="girls_target" class="form-control mt-3 mx-1" placeholder="Enter Girls target" autocomplete="off">
                </div>
                <div class="fv-row col-md-3">
                    <input type="text" name="boys_target" id="boys_target" class="form-control mt-3 mx-1" placeholder="Enter Boys target" autocomplete="off">
                </div>
                <div class="fv-row col-md-3">
                    <input type="text" name="pwd_target" id="pwd_target" class="form-control mt-3 mx-1" placeholder="Enter PWD target" autocomplete="off" value="">
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
                        <th>#S.No</th>
                        <th>Theme</th>
                        <th>Project</th>
                        <th>House-Hold Target</th>
                        <th>Individual Target</th>
                        <th>Women Target</th>
                        <th>Men Target</th>
                        <th>Girls Target</th>
                        <th>Boys Target</th>
                        <th>PWD Target</th>
                        {{-- <th>Created At</th>
                        <th>Created By</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                </table>
            </div>
        </div>
    </div>
</div>