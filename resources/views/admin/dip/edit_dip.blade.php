<div>
   
        <div class="card-body py-4">
            <input type="hidden" id="project_id" value="{{$project->id}}">
            <div class="row">
                
                <div class="col-md-6 p-4">
                    <table class="table table-striped p-4">
                        
                        <tr>
                            <td><strong>Project Title</strong></td>
                            <td>{{$project->name ?? ''}}</td>
                        </tr>
                        @if(!empty($provinces))
                            <tr>
                                <td><strong>Provinces</strong></td>
                                <td>
                                    @foreach($provinces as $province)
                                        {{ $province->province_name}}@if(! $loop->last),@endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                       
                        <tr>
                            <td><strong>Themes</strong></td>
                            <td>
                                @php
                                    $groupedThemes = [];
                                    foreach($project->themes as $themes) {
                                        $mainThemeName = $themes->scisubtheme_name->maintheme->name ?? '';
                                        $subThemeName = $themes->scisubtheme_name->name ?? '';
                                        $groupedThemes[$mainThemeName][] = $subThemeName;
                                    }
                                @endphp
                        
                                @foreach($groupedThemes as $mainThemeName => $subThemes)
                                    {{$mainThemeName}}(@foreach($subThemes as $index => $subTheme)
                                    <u>{{$subTheme}}</u>@unless($loop->last),@endunless
                                    @endforeach)@unless($loop->last),@endunless
                                @endforeach
                            </td>
                        </tr>
                      
                        <tr>
                            <td><strong>Donor </strong></td>
                            <td>
                                {{$project->donors?->name ?? ''}}
                            </td>
                        </tr>
                      
                        
                    </table>
                </div>
                <div class="col-md-6 p-4">
                    <table class="table table-striped p-4">
                        
                  
                        <tr>
                            <td><strong>Type</strong></td>
                            <td>{{$project->type ?? ''}}</td>
                        </tr>
                     
                        @if(!empty($districts))
                            <tr>
                                <td><strong>Disticts</strong></td>
                                <td>  @foreach($districts as $district)
                                    {{ $district->district_name}}@if(! $loop->last),@endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                       
                        <td><strong>Partner </strong></td>
                            <td>
                                @foreach($project->partners as $partners)
                                {{$partners->partner_name->slug ?? ''}}@if(! $loop->last),@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Focal Person</strong></td>
                            <td>
                              {{$project->focalperson?->name ?? ''}} - {{$project->focalperson?->desig?->designation_name ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Project Tenure</strong></td>
                            <td>
                                @if(!empty($project->start_date) && $project->start_date != null)
                                    {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                                @endif
                            </td>
                        </tr>
                       
                    </table>
                </div>
                <div class="col-md-12 p-4">
                    <table class="table table-striped p-4">
                        <tr>
                            <td><strong>Project Description</strong></td>
                            <td> {{$project->detail?->project_description ?? ''}}
                            </td>
                        </tr>
                    </table>
                </div>  
            </div>
            <div class="card">
                <div class="container-fluid">
                    <ul class="nav nav-tabs mt-1 fs-6">
                       
                        <li class="nav-item">
                            <a class="nav-link  active " data-bs-toggle="tab" href="#thematic" >Thematic Area & Targets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  " data-bs-toggle="tab" href="#partner">Implementing Partner</a>
                        </li>
                      
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    
                    
                    <div class="tab-pane fade show  active " id="thematic" role="tabpanel">
                        <div class="card m-4"  id="project_theme_table">
                            <div class="card-body overflow-*">
                                <div class="table-responsive overflow-*">
                                    <table class="table table-striped table-bordered nowrap" id="project_themes" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Theme</th>
                                            <th>Sub-Theme</th>
                                            <th>HH</th>
                                            <th>Beneficiary </th>
                                            <th>Women </th>
                                            <th>Men </th>
                                            <th>Girls </th>
                                            <th>Boys </th>
                                            <th>PWD </th>
                                        </tr>
                                    </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade show" id="partner" role="tabpanel">
                        <div class="card m-4"  id="project_partner_table">
                            <div class="card-body overflow-*">
                                <div class="table-responsive overflow-*">
                                    <table class="table table-striped table-bordered nowrap" id="project_partners" style="width:100%">
                                    <thead>
                                        <tr>
                                          
                                            <th>Themes</th>
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
              
                </div>
            </div>
         
            
        </div>
    
</div>