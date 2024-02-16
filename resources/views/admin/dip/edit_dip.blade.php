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
                         
                        <tr>
                            <td><strong>Type</strong></td>
                            <td>{{$project->type ?? ''}}</td>
                        </tr>
                          
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>{{$project->status ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Project Tenure</strong></td>
                            <td>
                                @if(!empty($project->start_date) && $project->start_date != null)
                                    {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                                @endif
                            </td>
                        </tr>
                       
                        <tr>
                            <td><strong>Project Description</strong></td>
                            <td> {{$project->detail?->project_description ?? 'No Detail'}}
                            </td>
                        </tr>
                        
                        @if(!empty($provinces))
                            <tr>
                                <td><strong>Provinces</strong></td>
                                <td>
                                    @foreach($provinces as $province)
                                        {{ $province->province_name}}  @if(! $loop->last) , @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                        @if(!empty($districts))
                            <tr>
                                <td><strong>Disticts</strong></td>
                                <td>  @foreach($districts as $district)
                                    {{ $district->district_name}}  @if(! $loop->last) , @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
               
                <div class="col-md-6">
                    <table class="table table-striped m-4">
                        <tr>
                            <td><strong>House Hold Target </strong></td>
                            <td>  
                                @if(!empty($project->themes))
                                @php
                                    $hh_hold = 0;
                                @endphp
                                @foreach($project->themes as $theme)
                                    @php
                                        $hh_hold += $theme->house_hold_target;
                                    @endphp
                                @endforeach
                                {{ $hh_hold }}
                            @else
                                0
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Individual Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                @php
                                    $individual_target = 0;
                                @endphp
                                @foreach($project->themes as $theme)
                                    @php
                                        $individual_target += $theme->individual_target;
                                        
                                    @endphp
                                @endforeach
                                {{ $individual_target }}
                            @else
                                0
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Women Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                @php
                                    $women_target = 0;
                                @endphp
                                @foreach($project->themes  as $theme)
                                    @php
                                        $women_target += $theme->women_target ;
                                    @endphp
                                    @endforeach
                                {{  $women_target }}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Men Target </strong></td>
                            <td>
                                @if(!empty($project->themes))
                                    @php
                                        $men_target = 0;
                                    @endphp
                                    @foreach($project->themes  as $theme)

                                    @php
                                        $men_target =$men_target + $theme->men_target ;
                                    
                                    @endphp
                                    @endforeach
                                    {{ $men_target}}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td><strong>Girls Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                    @php
                                        $girls_target = 0;
                                    @endphp
                                    @foreach($project->themes  as $theme)
                                        @php
                                            $girls_target = $girls_target + $theme->girls_target ;
                                        @endphp
                                    @endforeach
                                    {{ $girls_target}}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Boys Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                    @php
                                        $boys_target = 0;
                                    @endphp
                                    @foreach($project->themes  as $theme)
                                        @php
                                            $boys_target = 0;
                                            $boys_target =$boys_target + $theme->boys_target ;
                                            
                                        @endphp
                                    @endforeach
                                    {{$boys_target}}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>PWD Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                @php
                                        $pwd_target = 0;
                                    @endphp
                                    @foreach($project->themes  as $theme)
                                        @php
                                            
                                            $pwd_target +=$theme->pwd_target ;
                                            
                                        @endphp
                                    @endforeach
                                    {{$pwd_target}}
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <td><strong>Focal Person</strong></td>
                            <td>
                              {{$project->focalperson?->name ?? ''}}<br>
                              {{-- {{$project->focalperson?->email ?? ''}} --}}
                            </td>
                        </tr>
                    
                       
                        
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="container-fluid">
                    <ul class="nav nav-tabs mt-1 fs-6">
                       
                        <li class="nav-item">
                            <a class="nav-link  active " data-bs-toggle="tab" href="#thematic" >Thematic area</a>
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
                                            <th>#S.No</th>
                                            <th>Theme</th>
                                            <th>Project</th>
                                            <th>House-Hold Target</th>
                                            <th>Individual Target</th>
                                            <th>Women Target</th>
                                            <th>Men Target</th>
                                            <th>Girls Target</th>
                                            <th>Boys Target</th>
                                            <th>PWD Target</th>
                                            {{-- <th>Created At</th>
                                            <th>Created By</th> --}}
                                            <th>Actions</th>
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
                                            <th>#S.No</th>
                                            <th>Project</th>
                                            <th>Themes</th>
                                            <th>Partner</th>
                                            <th>Email</th>
                                            <th>Province</th>
                                            <th>District</th>
                                            {{-- <th>Created At</th>
                                            <th>Created By</th> --}}
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
         
            
        </div>
    
</div>