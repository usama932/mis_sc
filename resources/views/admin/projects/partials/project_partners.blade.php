<div>
    <div class="">
        <div class="d-flex justify-content-end hover-elevate-up my-3 mx-5">
            <button class="btn btn-sm btn-success mx-5" id="addprojectpartnerBtn"> <i class="ki-duotone ki-abstract-10">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>Add Project Partner</button>
        </div>
    </div>
    <form id="create_projectpartner" action="{{route('projectpartners.store')}}" method="post" autocomplete="off">   
        @csrf
        <input type="hidden" name="project" value="{{$project->id}}">
        <div class="px-5">
            <h3>Add Project Partner</h3>
            <div class="row ">
                <div class="fv-row col-md-3">
                    <select name="partner" id="partner" class="form-control partner partner-part" data-control="select2" data-placeholder="Select Partner" class="form-select" data-allow-clear="true">
                        <option  value="">Select Partner</option>
                        @foreach($partners as $partner)
                            <option value="{{$partner->id}}">{{$partner->slug}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fv-row col-md-3 ">
                    <select name="province[]" multiple id="project_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select Partner Province" class="form-select "  data-allow-clear="true" >
                        <option value="">Select Partner Province</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->province_id }}" >{{ $province->province_name }}                          </option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="fv-row col-md-3 ">
                    <span class="spinner-border spinner-border-sm align-middle ms-2" id="districtload"></span>
                    <select id="project_district" name="district[]" multiple  aria-label="Select a district" data-control="select2" data-placeholder="Select Partner District" class="form-select "  data-allow-clear="true">    
                    </select>
                </div>
                <div class="fv-row col-md-3 ">
                    <select name="theme[]" multiple id="partner_themes" class="form-control m-input" data-control="select2" data-placeholder="Select Theme" class="form-select" data-allow-clear="true">
                      
                    </select> 
                </div>
                <div class="table-responsive">  
                    <table class="table table-bordered" id="dynamic_field">  
                        <tr>
                            <th>Email</th>
                            <th>Desig.#</th>
                            <th> <div class="d-flex justify-content-end">
                                <span type="button" name="add" id="add" class="badge badge-primary">Add More</span>
                            </div></th>
                        </tr>
                        <tr>  
                            <td class="fv-row"><input type="email" name="addmore[0][email]" placeholder="Enter your Email" class="form-control name_list" id="email-input"/>
                                <div id="email-recommendations"> </div>
                            </td>  
                            <td class="fv-row"><input type="text" name="addmore[0][desig]" placeholder="Enter your Designation" class="form-control name_list" /></td>  
                            <td></td>  
                        </tr>  
                        
                    </table>  
                   
                </div>
               
            </div>
            <div class="d-flex justify-content-end my-3">
                <button type="button" id="cancelprojectpartnerBtn" class="btn btn-primary btn-sm mx-3 ">
                   Cancel
                </button>
                <button type="submit" id="kt_create_projectpartner" class="btn btn-success btn-sm mx-3">
                    @include('partials/general/_button-indicator', ['label' => 'Submit'])
                </button>
            </div>      
        </div>
    </form>
    <div class="card"  id="project_partner_table">
        <div class="card-body overflow-*">
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap" id="project_partners" style="width:100%">
                <thead>
                    <tr>
                        <th>Theme</th>
                        <th>Sub Theme</th>
                        <th>Partner</th>
                        <th>Email</th>
                        <th>Province</th>
                        <th>District</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                </table>
            </div>
        </div>
    </div>
</div>
