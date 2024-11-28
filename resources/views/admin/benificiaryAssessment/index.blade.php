<x-nform-layout>
    @section('title', 'Beneficiaries Assessment List')
    <div class="card mb-4">
        @include('admin.benificiaryAssessment.partials.filter')
    </div>
    <div class="card mb-4">
        <div id="kt_app_content" class="app-con-sm ntent flex-column-fluid">
            <div class="d-flex align-items-center ">
                <a class="btn btn-primary bt font-weight-bolder" onclick="del_selected()" href="javascript:void(0)"> <i
                        class="la la-trash-o"></i>Delete All</a>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="beneficary_list" style="width:100%">
                        <thead>
                           
                            <tr>
                                <th><label class="checkbox checkbox-outline checkbox-success"><input
                                    type="checkbox"><span></span></label>
                                </th>
                                <th class="fs-9">Unique No.#</th> 
                                <th class="fs-9">Assessment</th> 
                                <th class="fs-9">Project</th>
                                <th class="fs-9">Beneficiary Name</th>
                                <th class="fs-9">Gender</th>
                                <th class="fs-9">Age</th>
                                <th class="fs-9">Under 5yrs Girls</th>
                                <th class="fs-9">Under 5yrs Boys</th>
                                <th class="fs-9">5-7yrs Girls</th>
                                <th class="fs-9">5-7yrs Boys</th>
                                <th class="fs-9">Above 18yrs Girls</th>
                                <th class="fs-9">Above 18yrs Boys</th>
                                <th class="fs-9">Average Monthly Income</th>
                                <th class="fs-9">House Damage</th>
                                <th class="fs-9">Contact Number</th>
                                <th class="fs-9">Assessment Officer</th>
                                <th class="fs-9">VC Representative Name</th>
                                <th class="fs-9">Status</th>
                                <th class="fs-9">Created By</th>
                                <th class="fs-9">Created At</th>
                                <th class="fs-9">Created By</th>
                                
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-nform-layout>
