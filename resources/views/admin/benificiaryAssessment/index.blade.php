<x-nform-layout>
    @section('title', 'Beneficiaries Assessment List')
    <div class="card mb-4">
        @include('admin.benificiaryAssessment.partials.filter')
    </div>
    <div class="card mb-4">
        <div id="kt_app_content" class="app-con-sm ntent flex-column-fluid">
            <div class="d-flex justify-content-end m-3">
                <button class="btn btn-primary btn-sm mx-2" onclick="handleAction('accepted')">
                    <i class="la la-file-o"></i> Select Accepted
                </button>
                <button class="btn btn-info btn-sm mx-2" onclick="handleAction('verified')">
                    <i class="la la-file-o"></i> Select Verified
                </button>
                <button class="btn btn-secondary btn-sm mx-2" onclick="handleAction('approved')">
                    <i class="la la-file-o"></i> Select Approved
                </button>
                <button class="btn btn-danger btn-sm mx-2" onclick="handleAction('rejected')">
                    <i class="la la-file-o"></i> Select Rejected
                </button>
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <form action="{{ route('action-selected-benficary') }}" method="POST" id="beneficiary_form">
                        @csrf
                        <table class="table table-striped table-bordered nowrap" id="beneficary_list" style="width:100%">
                            <thead>
                                <input type="hidden" name="action_type" id="action_type">
                                <tr>
                                    <th>
                                        <label class="checkbox checkbox-outline checkbox-success">
                                            <input type="checkbox">
                                            <span></span>
                                        </label>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function handleAction(action) {
            const actionMessages = {
                'accepted': {
                    title: "Are you sure to accept these records?",
                    success: "The records have been accepted.",
                },
                'verified': {
                    title: "Are you sure to verify these records?",
                    success: "The records have been verified.",
                },
                'approved': {
                    title: "Are you sure to approve these records?",
                    success: "The records have been approved.",
                },
                'rejected': {
                    title: "Are you sure to reject these records?",
                    success: "The records have been rejected.",
                }
            };

            const { title, success } = actionMessages[action];

            Swal.fire({
                title: title,
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: `Yes, ${action} them!`
            }).then(result => {
                if (result.value) {
                    Swal.fire(action.charAt(0).toUpperCase() + action.slice(1) + "!", success, "success");
                    document.getElementById("action_type").value = action;
                    document.getElementById("beneficiary_form").submit();
                }
            });
        }
    </script>

    
</x-nform-layout>
