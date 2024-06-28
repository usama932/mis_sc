<x-default-layout>
    @section('title', 'Monitoring Visits List')
   
    <div id="kt_app_content" class="app-content flex-column-fluid">
    
        @include('admin.quality_bench.partials.index_tiles')
        <div class="card mb-4">
            @include('admin.quality_bench.partials.filter_qb_index')
        </div>
       
        <div class="card">
            <div class="card-body pt-3">
                <div class="card-toolbar mb-2 d-flex justify-content-end">
                    @can('create quality benchmarks')
                        <a href="{{ route('quality-benchs.create') }}" class="btn btn-sm btn-primary font-weight-bolder mx-2">
                            <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                        <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                                    </g>
                                </svg>
                            </span>
                            Add Monitor Visit
                        </a>
                    @endcan
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap" id="quality_bench" style="width:100%">
                        <thead>
                            <tr>
                                <th>#QB.No</th>
                                <th>Project</th>
                                <th>Partner</th>
                                <th>Province</th>
                                <th>District</th>
                                <th>Theme</th>
                                <th>Activity</th>
                                <th>GeoLocations</th>
                                <th>Staff Organization</th>
                                <th>Date Visit</th>
                                <th class="fs-8">QB Base Monitoring</th>
                                <th>Total QBs</th>
                                <th>QBs Not Fully Met</th>
                                <th>QBs Fully Met</th>
                                <th>QBs Not Applicable</th>
                                <th>Score Out</th>
                                <th>QBs Status</th>
                                <th>Attachment</th>
                                <th>Created At</th>
                                <th>Created By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows will be dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
