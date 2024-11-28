<x-default-layout>

    @section('title')
        FRM List
    @endsection
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
    
        <div class="card">
            <div class="card mb-4">
                @include('admin.frm.partials.filter_index')
            </div>
           
            <div class="card-body pt-0 overflow-*">
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="frm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fs-9">Response.#</th>
                            <th class="fs-9">Name of Registrar</th>
                            <th class="fs-9">Feedback Category</th>
                            <th class="fs-9">Feedback Description</th>
                            <th class="fs-9">Theme</th>
                            <th class="fs-9">Project</th>
                            <th class="fs-9">Status</th>
                            <th class="fs-9">Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
