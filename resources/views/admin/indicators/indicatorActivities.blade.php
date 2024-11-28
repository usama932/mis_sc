<x-default-layout>
    @section('title', 'Indicators Activities')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        
        <div class="card">
            <div class="card-body pt-3">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="indicatorActivities" style="width:100%">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Indicator Name</th>
                                <th class="fs-8">Indicator Type</th>
                                <th>Activity</th>
                                <th>Activity Target</th>
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
@push('scripts')
<script>
    var APP_URL = @json(url('/')); // Use the Blade directive to pass the URL to JavaScript
</script>
@endpush
</x-default-layout>
