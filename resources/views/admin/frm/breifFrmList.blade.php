<x-default-layout>

    @section('title')
    FRM List
    @endsection
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
    
        <div class="card">
            <div class="card-title m-5">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success  p-5 rounded">
                            <h1 class="m-5">Total FRM =>
                            
                                {{$total_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-primary p-5 rounded">
                            <h1 class="m-5">Open FRM =>
                            
                                {{$open_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning p-5 rounded">
                            <h1 class="m-5">Close FRM =>
                            
                                {{$close_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                </div>
             
            </div>
            
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
                            <th class="fs-9">Date Recieved</th>
                            <th class="fs-9">Feedback Channel</th>
                            <th class="fs-9">Type of Client</th>
                            <th class="fs-9">Gender</th>
                            <th class="fs-9">Province</th>
                            <th class="fs-9">District</th>
                            <th class="fs-9">Feedback Category</th>
                            <th class="fs-9">Feedback Description</th>
                            <th class="fs-9">Theme</th>
                            <th class="fs-9">Project</th>
                            <th class="fs-9">Satisfaction</th>
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
