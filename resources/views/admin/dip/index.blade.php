<x-default-layout>

    @section('title', 'Project List')

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div class="card">

            <div class="card-body pt-3">

                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="dips" style="width:100%">
                        <thead>
                            <tr>
                                <th>Manage Activities/Targets</th>
                                <th>Project Name</th>
                                <th>Type</th>
                                <th>SOF.#</th>
                                <th>Thematic Areas</th>
                                <th>Partner</th>
                                <th>Provinces</th>
                                <th>Districts</th>
                                <th>Project Tenure</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>

        </div>

    </div>

    @push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(document).ready(function() {
            var dip_projects = $('#dips').DataTable({
                "dom": 'lfBrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        filename: 'Project Profile Data export_',
                        text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                        title: 'Themetic area Data export',
                        className: 'badge badge-outline-success',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        filename: 'Project Profile Data CSV_',
                        text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
                        title: 'Themetic area Data',
                        className: 'badge badge-outline-success ',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        }
                    }
                ],
                "responsive": true, // Enable responsive mode
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": true,
                "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
                "bInfo" : true,
                "responsive": false,
                "info": true,
                "ajax": {
                    "url": "{{ route('admin.get_dips') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": { "_token": "{{ csrf_token() }}" }
                },
                "columns": [
                    { 
                        "data": null, // Use null to represent the button column
                        "searchable": false,
                        "orderable": false,
                        "render": function(data, type, row) {
                            return '<a class="btn" href="{{ route("dips.edit", ":id") }}" title="Download project DIP"><span class="badge badge-info"> Manage Activity Target</span></a>'.replace(':id', row.id);
                        }
                    },
                    { "data": "project", "searchable": false, "orderable": false },
                    { "data": "type", "searchable": false, "orderable": false },
                    { "data": "sof", "searchable": false, "orderable": false },
                    { "data": "themes", "searchable": false, "orderable": false },
                    { "data": "partners", "searchable": false, "orderable": false },
                    { "data": "province", "searchable": false, "orderable": false },
                    { "data": "district", "searchable": false, "orderable": false },
                    { "data": "project_tenure", "searchable": false, "orderable": false }
                ]
            });

            function del(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!"
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire(
                            "Deleted!",
                            "Your DIP has been deleted.",
                            "success"
                        );
                        var APP_URL = {!! json_encode(url('/')) !!}
                        window.location.href = APP_URL + "/dip/delete/" + id;
                    }
                });
            }
        });

    </script>
    @endpush

</x-default-layout>
