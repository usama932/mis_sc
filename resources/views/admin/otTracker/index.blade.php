<x-default-layout>
    @section('title', 'Output Tracker')
    <style>
        able.dataTable td {
            white-space: normal; /* Enables word wrapping for all columns */
        }

        table.dataTable td.wrap-activity {
            max-width: 150px; /* Adjust width as needed */
            white-space: normal;
            word-wrap: break-word;
        }

        table.dataTable td.wrap-project {
            max-width: 150px; /* Adjust width as needed */
            white-space: normal;
            word-wrap: break-word;
        }

        table.dataTable td.wrap-remarks {
            max-width: 300px; /* Adjust width as needed */
            white-space: normal;
            word-wrap: break-word;
        }
    </style>
   
   
    <div class="card">
        @include('admin.otTracker.partials.filters')
    </div> 
    <div class="card my-3">
        <div class="card-body pt-3">
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap" id="ottracker" style="width:100%">
                    <thead>
                        <tr>
                             {{-- <th>Reported Date</th> --}}
                            <th>Date</th>
                           
                            <th>Project</th>
                            <th>SOF</th>
                            <th class="fs-8">Activity</th>
                            <th>Thematic Area</th>
                            <th>LOP Target</th>
                            <th>Beneficary Target</th>
                            <th>Monthly  Achievement</th>
                            <th>Men</th>
                            <th>Women</th>
                            <th>Total Adults</th>
                            <th>Girls</th>
                            <th>Boys</th>
                            <th>PWD</th>
                            <th>Total Children </th>
                            <th>Total Reach</th>
                            <th>Remarks</th>
                            <th>Created By</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</x-default-layout>
