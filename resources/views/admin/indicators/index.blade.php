<x-default-layout>
    @section('title', 'Indicators')

   
    <div class="card mb-4">
        
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        
        <div class="card">
            <div class="card-toolbar m-3 d-flex justify-content-end">
                @can('create iptt')
                    <a href="{{ route('indicators.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                        <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>
                        Add Project
                    </a>
                @endcan
            </div>
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="projects" style="width:100%">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Type</th>
                                <th>SOF</th>
                                <th>Donor</th>
                                <th class="fs-8">Operational FP</th>
                                <th class="fs-8">Budget Holder FP</th>
                                <th class="fs-8">Awards FP</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
