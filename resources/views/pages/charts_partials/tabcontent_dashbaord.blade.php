     <!-- Tab 1: Chart -->
     <div class="tab-pane fade show active" id="chart" role="tabpanel" aria-labelledby="chart-tab">
        <div class="row mb-3">
            <div class="col-md-4">
                <select name="project" id="project_id" class="form-select btn-select fs-6" aria-label="Select a Project">
                    <option value="" class="fs-8">Select a Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" class="fs-8">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-4 my-4" id="theme-cards-container"></div>
  
        <!-- Charts Section -->
        <div class="row g-4">
            <!-- Google Chart -->
            <div class="col-md-6">
                <div class="chart-container border-danger">
                    <div class="chart-title text-danger">Organization Chart of Pakistan</div>
                    <div id="chart_div"></div>
                    <div class="district-card mt-3">
                        <h5 class="text-danger"><i>Implemented By:</i></h5>
                        <div class="partner-info"  id="partner_info">
                            
                        </div>
                    </div>
        
                </div>
            </div>
            <!-- Sunburst Chart -->
            <div class="col-md-6 ">
                <div class="chart-container border-danger">
                    <div class="chart-title text-danger">Theme-wise Progress Analysis</div>
                    <div id="main" style="width: 100%; height: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane " id="table" role="tabpanel" aria-labelledby="table-tab">
        <div class="container m-3">
            <div class="table-responsive overflow-*">
                <table class="table table-striped table-bordered nowrap" id="projects" style="width:100%">
                    <thead>
                        <tr>
                            <th class="fs-9">Project</th>
                            <th class="fs-9">Type</th>
                            <th class="fs-9">SOF</th>
                            <th class="fs-9">SCI OPs FP</th>
                            <th class="fs-9">Budget Holder</th>
                            <th class="fs-9">Tenure</th>
                            <th class="fs-9">DIP</th>
                            <th class="fs-9 bg-primary">Total Activities</th>
                            <th class="fs-9 bg-info">Total Targets</th>
                            <th class="fs-9 bg-success">Complete Targets</th>
                            <th class="fs-9 bg-danger">Overdue Targets</th>
                            <th class="fs-9 bg-warning">Pending Targets</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project_data as $project)
                            <tr>
                                @php
                                    $focalperson = $project->focal_person;
                                    $budgetholder = $project->budget_holder;
                                    $focal_person = $focalperson ? implode(", ", App\Models\User::whereIn('id', json_decode($focalperson, true))->pluck('name')->toArray()) : '';
                                    $budgetholder = $budgetholder ? implode(", ", App\Models\User::whereIn('id', json_decode($budgetholder, true))->pluck('name')->toArray()) : '';
                                @endphp
                                <td class="fs-9">{{ $project->name }}</td>
                                <td class="fs-9">{{ $project->type }}</td>
                                <td class="fs-9">{{ $project->sof }}</td>
                                <td class="fs-9">{{ $project->focal_person }}</td>
                                <td class="fs-9">{{ $project->budget_holder }}</td>
                                <td class="fs-9">{{ date('M d,Y', strtotime($project->start_date))}} - {{date('M d,Y', strtotime($project->end_date));}}</td>
                                <td class="fs-9">@if($project->activities->count() > 0) Yes @else No @endif</td>
                                <td class="fs-9">{{ $project->total_activities_count }}</td>
                                <td class="fs-9">{{ $project->total_activities_target_count }}</td>
                                <td class="fs-9">{{ $project->complete_activities_count }}</td>
                                <td class="fs-9">{{ $project->overdue_count }}</td>
                                <td class="fs-9">{{ $project->pending_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>