<x-default-layout>

    @section('title')
    View Indicator Detail
    @endsection

    <div class="card p-4 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bolder text-danger ">Indicator Detail</h3>
        </div>
        <div class="row">
            <!-- Left Column: Basic Information Table -->
            <div class="col-md-6">
                <div class="card-title my-4">
                    <div class="d-flex align-items-center p-2" style="background-color: #d6281b; border-radius: 15px;">
                        <h5 class="fw-bold m-0 text-white">Basic Information</h5>
                    </div>
                </div>
                
                <table class="table table-striped table-bordered nowrap m-4">
                    <tbody>
                        <tr>
                            <td class="fw-bolder">Project</td>
                            <td>{{$indicatorActivity->project?->name ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Log Frame</td>
                            <td>{{$indicatorActivity->log_frame_level ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Log Frame Statement</td>
                            <td>{{$indicatorActivity->log_frame_result_statement ?? 'N/A'}}</td>
                        </tr>
                     
                        <tr>
                            <td class="fw-bold">Actual Periodicity</td>
                            <td>{{$indicatorActivity->actual_periodicity ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">Dis-segregation</td>
                            <td>{{$indicatorActivity->disaggregation ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">Baseline</td>
                            <td>{{$indicatorActivity->baseline ?? 'N/A'}}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">Created By</td>
                            <td>{{$indicatorActivity->user?->name ?? 'N/A'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Right Column: Additional Information or Placeholder -->
            <div class="col-md-6">
                
                <div class="card-title my-4">
                    <div class="d-flex align-items-center p-2" style="background-color: #d6281b; border-radius: 15px;">
                        <h5 class="fw-bold m-0 text-white">Indicator Information</h5>
                    </div>
                </div>
                <table class="table table-striped table-bordered nowrap m-4">
                    <tbody>
                      
                        <tr>
                            <td class="fw-bold">Indicator Name</td>
                            <td>{{$indicatorActivity->indicator_name ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Indicator Context</td>
                            <td>{{$indicatorActivity->indicator_context_type ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Unit of Measure</td>
                            <td>{{$indicatorActivity->indicator?->unit_of_measure ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Actual Periodicity</td>
                            <td>{{$indicatorActivity->actual_periodicity ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Nature</td>
                            <td>{{$indicatorActivity->nature ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Date Format</td>
                            <td>{{$indicatorActivity->data_format ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Created At</td>
                            <td>{{date('M d,Y', strtotime($indicatorActivity->created_at)) ?? ''}}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-default-layout>
