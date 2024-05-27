<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <input type="hidden" id="project_id" value="{{$project->id}}">
                    <h5 class="card-title">Project Details</h5>
                    <ul class="list-unstyled">
                        <li><strong>Project Title:</strong> {{$project->name ?? ''}}</li>
                        @if(!empty($provinces))
                            <li><strong>Provinces:</strong> 
                                @foreach($provinces as $province)
                                    {{ $province->province_name}}@if(!$loop->last),@endif
                                @endforeach
                            </li>
                        @endif
                        @php
                            $groupedThemes = [];
                            foreach($project->themes as $themes) {
                                $mainThemeName = $themes->scisubtheme_name->maintheme->name ?? '';
                                $subThemeName = $themes->scisubtheme_name->name ?? '';
                                $groupedThemes[$mainThemeName][] = $subThemeName;
                            }
                        @endphp
                        <li><strong>Themes:</strong> 
                            @foreach($groupedThemes as $mainThemeName => $subThemes)
                                {{$mainThemeName}}(@foreach($subThemes as $index => $subTheme)
                                <u>{{$subTheme}}</u>@unless($loop->last),@endunless
                                @endforeach)@unless($loop->last),@endunless
                            @endforeach
                        </li>
                        <li><strong>Budget holder FP:</strong> 
                           {{$budgetholder ?? ''}}
                        </li>
                        <li><strong>Donor:</strong> {{$project->donors?->name ?? ''}}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Additional Details</h5>
                    <ul class="list-unstyled">
                        <li><strong>Type:</strong> {{$project->type ?? ''}}</li>
                        @if(!empty($districts))
                            <li><strong>Districts:</strong> 
                                @foreach($districts as $district)
                                    {{ $district->district_name}}@if(!$loop->last),@endif
                                @endforeach
                            </li>
                        @endif
                        <li><strong>Partner:</strong> 
                            @foreach($project->partners as $partners)
                                {{$partners->partner_name->slug ?? ''}}@if(!$loop->last),@endif
                            @endforeach
                        </li>
                        <li><strong>Focal Person:</strong> 
                            {{$focal_person ?? ''}}
                        </li>
                        <li><strong>Award FP:</strong> 
                            {{$project->awardfp?->name ?? ''}} - {{$project->awardfp?->desig?->designation_name ?? ''}}
                        </li>
                        <li><strong>Project Tenure:</strong> 
                            @if(!empty($project->start_date) && $project->start_date != null)
                                {{ date('M d, Y', strtotime($project->start_date))}} -To- {{date( 'M d, Y', strtotime($project->end_date));}}
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Project Description</h5>
                    <p class="card-text">
                        <span id="short-description">{{$project->detail?->project_description ? substr($project->detail->project_description, 0, 1000) . '...' : ''}}</span>
                        <span id="full-description" style="display: none;">{{$project->detail?->project_description ?? ''}}</span>
                        <span id="toggle-button" class="badge badge-primary">Show More</span>
                    </p>
                  
                </div>
            </div>
        </div>
    </div>
   
    <div class="container-fluid">
        <ul class="nav nav-tabs mt-1 fs-6">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#thematic">Thematic Area & Targets</a>
            </li>
            @if($project->detail?->implemented_sc == 0)
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#partner">Implementing Partner</a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#profile">Project Profile</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="thematic" role="tabpanel">
            <div class="card m-4" id="project_theme_table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap" id="project_themes" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Theme</th>
                                    <th>Sub-Theme</th>
                                    <th>HH</th>
                                    <th>Beneficiary</th>
                                    <th>Women</th>
                                    <th>Men</th>
                                    <th>Girls</th>
                                    <th>Boys</th>
                                    <th>PWD/CLWD</th>
                                    <th>PLW</th> 
                                    <th>Other</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if($project->detail?->implemented_sc == 0)
            <div class="tab-pane fade" id="partner" role="tabpanel">
                <div class="card m-4" id="project_partner_table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap" id="project_partners" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Theme</th>
                                        <th>Sub Theme</th>
                                        <th>Partner</th>
                                        <th>Email</th>
                                        <th>Province</th>
                                        <th>District</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="tab-pane fade" id="profile" role="tabpanel">
            <div class="card m-4" id="project_partner_table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap" id="project_profile" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Theme</th>
                                    <th>Province</th>
                                    <th>Details</th>
                                    {{-- <th>Tehsil</th>
                                    <th>UC</th>
                                    <th>Village</th>  --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
