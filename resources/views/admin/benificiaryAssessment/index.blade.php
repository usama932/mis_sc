<x-nform-layout>
    @section('title', 'Beneficiaries Assessment List')
    <div class="card mb-4">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="beneficary_list" style="width:100%">
                        <thead>
                            <tr>
                                <th>
                                    <select class="column-operator" data-column="0">
                                        <option value="LIKE">LIKE</option>
                                    </select>
                                    <input type="text" class="column-value" data-column="0" placeholder="Search..." style="display: none;">
                                </th>
                                <th>
                                </th>
                                <!-- Project Filter -->
                                <th> 
                                    <select class="column-operator" data-column="4">
                                        <option value="">All</option>
                                        <option value="=">=</option>
                                        <option value="LIKE">LIKE</option>
                                        <option value="NOT LIKE">NOT LIKE</option>
                                    </select>
                                    <input type="text" class="column-value" data-column="4" placeholder="Search..." style="display: none;">
                                </th>
                                <th>
                                </th>
                                <!-- Gender Filter -->
                                <th>
                                    <select class="column-operator" data-column="1">
                                        <option value="">All</option>
                                        <option value="=">=</option>
                                        <option value="!=">!=</option>
                                        <option value="LIKE">LIKE</option>
                                        <option value="NOT LIKE">NOT LIKE</option>
                                        <option value="IS NULL">IS NULL</option>
                                    </select>
                                    <input type="text" class="column-value" data-column="1" placeholder="Search..." style="display: none;">
                                </th>
                                <!-- Age Filter -->
                                <th>
                                    <select class="column-operator" data-column="2">
                                        <option value="">All</option>
                                        <option value="=">=</option>
                                        <option value=">">&gt;</option>
                                        <option value="<">&lt;</option>
                                        <option value="BETWEEN">BETWEEN</option>
                                        <option value="IS NULL">IS NULL</option>
                                    </select>
                                    <input type="text" class="column-value" data-column="2" placeholder="Search..." style="display: none;">
                                </th>
                                <th>
                                </th>
                                <!-- Cash Assistance Filter -->
                                <th>
                                    <select class="column-operator" data-column="3">
                                        <option value="">All</option>
                                        <option value="=">=</option>
                                        <option value=">">&gt;</option>
                                        <option value="<">&lt;</option>
                                        <option value="BETWEEN">BETWEEN</option>
                                        <option value="IS NULL">IS NULL</option>
                                    </select>
                                    <input type="text" class="column-value" data-column="3" placeholder="Search..." style="display: none;">
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                </th>
                            </tr>
                            <tr>
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
                                <th class="fs-9">Cash Assistance</th>
                                <th class="fs-9">Assessment Officer</th>
                                <th class="fs-9">VC Representative Name</th>
                                <th class="fs-9">Status</th>
                                <th class="fs-9">Created By</th>
                                <th class="fs-9">Created At</th>
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
