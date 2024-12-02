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
                <button class="btn btn-success btn-sm mx-2" data-bs-toggle="modal" data-bs-target="#uploadSheetModal">
                    <i class="la la-upload"></i> Upload Sheet
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
  
    //modal
    <div class="modal fade" id="uploadSheetModal" tabindex="-1" aria-labelledby="uploadSheetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadSheetModalLabel">Upload Excel Sheet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="uploadSheetForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="excelSheet" class="form-label">Choose Excel File</label>
                            <input type="file" class="form-control" id="excelSheet" name="excel_sheet" accept=".xls,.xlsx" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function handleAction(action) {
            // Get all selected checkboxes
            const checkboxes = document.querySelectorAll('#beneficary_list input[type="checkbox"]:checked');
            if (checkboxes.length === 0) {
                Swal.fire({
                    title: "No Records Selected",
                    text: "Please select at least one record before proceeding.",
                    icon: "warning",
                    confirmButtonText: "OK"
                });
                return;
            }
    
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
    
            if (action === 'rejected') {
                // Handle rejection with remarks
                Swal.fire({
                    title: title,
                    input: 'textarea',
                    inputLabel: 'Rejection Remarks',
                    inputPlaceholder: 'Enter your remarks here...',
                    inputAttributes: {
                        'aria-label': 'Rejection Remarks'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    preConfirm: (remarks) => {
                        if (!remarks) {
                            Swal.showValidationMessage('Remarks are required for rejection.');
                        }
                        return remarks;
                    }
                }).then(result => {
                    if (result.isConfirmed) {
                        const selectedIds = Array.from(checkboxes).map(cb => cb.value);
                        const remarks = result.value;
    
                        // Send AJAX request for rejection with remarks
                        axios.post('{{ route("action-selected-benficary") }}', {
                            _token: '{{ csrf_token() }}',
                            action_type: action,
                            beneficiaries: selectedIds,
                            remarks: remarks
                        })
                        .then(response => {
                            Swal.fire("Success!", success, "success");
                            // Reload the DataTable
                            $('#beneficary_list').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire("Error!", "An error occurred while processing the request.", "error");
                        });
                    }
                });
            } else {
                // Handle other actions without remarks
                Swal.fire({
                    title: title,
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: `Yes, ${action} them!`
                }).then(result => {
                    if (result.isConfirmed) {
                        const selectedIds = Array.from(checkboxes).map(cb => cb.value);
    
                        // Send AJAX request for other actions
                        axios.post('{{ route("action-selected-benficary") }}', {
                            _token: '{{ csrf_token() }}',
                            action_type: action,
                            beneficiaries: selectedIds
                        })
                        .then(response => {
                            Swal.fire("Success!", success, "success");
                            // Reload the DataTable
                            $('#beneficary_list').DataTable().ajax.reload();
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire("Error!", "An error occurred while processing the request.", "error");
                        });
                    }
                });
            }
        }

        document.getElementById('uploadSheetForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission

            const formData = new FormData(this);

            Swal.fire({
                title: "Uploading File...",
                text: "Please wait while the file is being uploaded.",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            axios.post('{{ route("upload-excel-sheet") }}', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                Swal.fire("Success!", "The Excel sheet has been uploaded successfully.", "success");
                // Reload the DataTable if needed
                $('#beneficary_list').DataTable().ajax.reload();
                // Close the modal
                const modal = document.getElementById('uploadSheetModal');
                const bootstrapModal = bootstrap.Modal.getInstance(modal);
                bootstrapModal.hide();
            })
            .catch(error => {
                console.error(error);
                Swal.fire("Error!", "An error occurred while uploading the file. Please try again.", "error");
            });
        });
    </script>
    
    @endpush
    
</x-nform-layout>
