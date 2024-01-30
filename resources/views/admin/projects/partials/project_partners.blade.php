<div>
    <div class="">
        <div class="d-flex justify-content-end hover-elevate-up my-10 mx-5">
            <button class="btn btn-sm btn-primary mx-5" id="addprojectthemeBtn"> <i class="ki-duotone ki-abstract-10">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>Add Project Theme</button>
        </div>
    </div>
    <form id="project_theme_form">    
        <div class="px-5">
            <div class="row ">
                {{-- <div class="fv-row col-md-4">
                    <select name="theme[]" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                        <option  value=''>Select Theme</option>
                        @foreach($themes as $theme)
                            <option value="{{$theme->id}}">{{$theme->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
                    {{-- <div class="fv-row col-md-4">
                    <select name="theme[]" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                        <option  value=''>Select Theme</option>
                        @foreach($themes as $theme)
                            <option value="{{$theme->id}}">{{$theme->name}}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="fv-row col-md-4">
                    <input type="text" name="male_target[]" class="form-control  mx-1" placeholder="Enter Men Target" autocomplete="off">
                </div>
                <div class="fv-row col-md-4">
                    <input type="text" name="female_target[]" class="form-control  mx-1" placeholder="Enter Women Target" autocomplete="off">
                </div>
                <div class="fv-row col-md-4">
                    <input type="text" name="girls_target[]" class="form-control mt-3 mx-1" placeholder="Enter Girls target" autocomplete="off">
                </div>
                <div class="fv-row col-md-4">
                    <input type="text" name="boys_target[]" class="form-control mt-3 mx-1" placeholder="Enter Boys target" autocomplete="off">
                </div>
            </div>
            <div class="d-flex justify-content-end my-3">
                <button type="button" id="cancelprojectthemeBtn" class="btn btn-primary btn-sm mx-3 ">
                   Cancel
                </button>
                <button type="submit" id="kt_create_dip" class="btn btn-success btn-sm mx-3">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
            </div>      
        </div>
    </form>
    <div class="card"  id="project_theme_table">
     
        <div class="card-body mt-5 overflow-*">

            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap" id="project_themes" style="width:100%">
                <thead>
                    <tr>
                        <th>#S.No</th>
                        <th>Project</th>
                        <th>Partner</th>
                        <th>Email</th>
                        <th>Province</th>
                        <th>District</th>
                        <th>Created At</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                </table>
            </div>

        </div>
       
    </div>
</div>