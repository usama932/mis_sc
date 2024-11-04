<x-nform-layout>
    @section('title', 'Beneficiaries Assessment List')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card-body pt-3">
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap" id="beneficary_list" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fs-8">Unique No.#.</th> 
                            <th class="fs-8">Project</th>
                            <th class="fs-8">Beneficary Name</th>
                            <th class="fs-8">Gender</th>
                            <th class="fs-8">Age</th>
                            <th class="fs-8">Contact.#</th>
                            <th class="fs-8">Cash Assistance</th>
                            <th class="fs-8">Assessment Officer</th>
                            <th class="fs-8">VC Representative Name</th>
                            <th class="fs-8">Status</th>
                            <th class="fs-8">Created By</th>
                            <th class="fs-8">Created At</th>
                            <th class="fs-8">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</x-nform-layout>