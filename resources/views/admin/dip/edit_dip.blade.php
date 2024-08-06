<div class="container">
    <style>
        .description-text, .full-text {
        display: inline;
        }
        .toggle-text {
            color: blue;
            cursor: pointer;
            margin-left: 5px;
        }
        </style>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm border-light">
                    <div class="card-body">
                        <input type="hidden" id="project_id" value="{{ $project->id }}">
                        <h5 class="card-title font-weight-bold">Project Details</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Project Title:</strong> {{ $project->name ?? 'N/A' }} 
                                <span class="text-muted">({{ $project->type ?? 'Type not mentioned' }})</span>
                            </li>
                            @if (!empty($provinces))
                                <li class="list-group-item">
                                    <strong>Provinces:</strong> 
                                    {{ implode(', ', $provinces->pluck('province_name')->toArray()) }}
                                </li>
                            @endif
                            @php
                                $groupedThemes = [];
                                foreach ($project->themes as $theme) {
                                    $mainThemeName = $theme->scisubtheme_name->maintheme->name ?? '';
                                    $subThemeName = $theme->scisubtheme_name->name ?? '';
                                    $groupedThemes[$mainThemeName][] = $subThemeName;
                                }
                            @endphp
                            <li class="list-group-item">
                                <strong>Themes:</strong> 
                                @foreach ($groupedThemes as $mainThemeName => $subThemes)
                                    {{ $mainThemeName }} (  {{ implode(', ', $subThemes) }} )
                                  
                                @endforeach
                            </li>
                            <li class="list-group-item">
                                <strong>Budget Holder FP:</strong> {{ $budgetholder ?? 'N/A' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Donor:</strong> {{ $project->donors?->name ?? 'N/A' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Additional Details</h5>
                        <ul class="list-group list-group-flush">
                            @if (!empty($districts))
                                <li class="list-group-item">
                                    <strong>Districts:</strong> 
                                    {{ implode(', ', $districts->pluck('district_name')->toArray()) }}
                                </li>
                            @endif
                            <li class="list-group-item">
                                <strong>Partner:</strong> 
                                {{ implode(', ', $project->partners->pluck('partner_name.slug')->toArray()) ?? 'N/A' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Focal Person:</strong> {{ $focal_person ?? 'N/A' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Award FP:</strong> 
                                {{ $project->awardfp?->name ?? 'N/A' }} - 
                                {{ $project->awardfp?->desig?->designation_name ?? 'N/A' }}
                            </li>
                            <li class="list-group-item">
                                <strong>Project Tenure:</strong> 
                                @if (!empty($project->start_date))
                                    {{ date('M d, Y', strtotime($project->start_date)) }} - 
                                    {{ date('M d, Y', strtotime($project->end_date)) }}
                                @else
                                    N/A
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm border-light">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">Project Description</h5>
                        <p class="card-text">
                           
                                <span class="description-text">
                                    {{ Str::limit($project->detail?->project_description, 500, '...') }}
                                </span>
                                <span class="full-text" style="display: none;">
                                    {{$project->detail?->project_description ??  ''}}
                                </span>
                                @if(strlen($project->detail?->project_description ?? '') > 100)
                                    <a href="javascript:void(0);" class="toggle-text">See More</a>
                                @endif
                           

                            </span>
                        
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-text').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    let descriptionText = this.previousElementSibling.previousElementSibling;
                    let fullText = this.previousElementSibling;
                    
                    if (fullText.style.display === 'none') {
                        descriptionText.style.display = 'none';
                        fullText.style.display = 'inline';
                        this.textContent = 'See Less';
                    } else {
                        descriptionText.style.display = 'inline';
                        fullText.style.display = 'none';
                        this.textContent = 'See More';
                    }
                });
            });
        });
    </script>
</div>
