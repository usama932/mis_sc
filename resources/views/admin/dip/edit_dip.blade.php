<div>
   
        <div class="card-body py-4">
            <div class="row">
                {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit project</a>
                </div> --}}
                <div class="col-md-6">
                    <div class="card-title  border-0 my-4"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Basic Info  ::</h5>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped m-4">
                        
                        <tr>
                            <td><strong>Project</strong></td>
                            <td>{{$project->name ?? ''}}</td>
                        </tr>
                        @if(!empty($project->detail?->project_description))
                            <tr>
                                <td><strong>Project Description</strong></td>
                                <td>{{$project->detail?->project_description ?? ''}}</td>
                            </tr>
                        @endif
                        @if(!empty($project->partners))
                            <tr>
                                <td><strong>Partners</strong></td>
                                <td> 
                                    @foreach($project->partners as $parnter)
                                        {{ $parnter->partner_name?->name ?? ''}} @if(! $loop->last) , @endif
                                    @endforeach  
                                </td>
                            </tr>
                        @endif
                          
                        @if(!empty($project->themes))
                            <tr>
                                <td><strong>Thematic Area</strong></td>
                                <td>
                                    @foreach($project->themes as $theme)
                                        {{ $theme->theme_name?->name ?? ''}} @if(! $loop->last) , @endif
                                    @endforeach  
                                    
                                </td>
                            </tr>
                        @endif
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
                        <tr>
                            <td><strong>Focal Person</strong></td>
                            <td>
                                {{$project->focalperson?->name ?? ''}}<br>
                                {{$project->focalperson?->email ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Tenure</strong></td>
                            <td>
                               {{ date('d-M-Y', strtotime($project->project_start))}} -To- {{date('d-M-Y', strtotime($project->project_end));}}
                            </td>
                        </tr>
                        
                    </table>
                    
                </div>
                <div class="col-md-6">
                    <div class="card-title  border-0 my-4"">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                                <h5 class="fw-bold m-3">Target</h5>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped m-4">
                    
                   
                        <tr>
                            <td><strong>House Hold Target </strong></td>
                            <td>  
                                @if(!empty($project->themes))
                                    @foreach($project->themes as $theme)
                                        @php
                                            $hh_hold = 0;
                                            $hh_hold =$hh_hold + $theme->house_hold_target ;
                                            echo  $hh_hold;
                                        @endphp
                                    @endforeach
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Individual Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                    @foreach($project->themes as $theme)
                                        @php
                                            $individual_target = 0;
                                            $individual_target =$individual_target + $theme->individual_target ;
                                            echo  $individual_target;
                                        @endphp
                                    @endforeach
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Women Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                    @foreach($project->themes  as $theme)
                                        @php
                                            $women_target = 0;
                                            $women_target =$women_target + $theme->women_target ;
                                            echo  $women_target;
                                        @endphp
                                    @endforeach
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Men Target </strong></td>
                            <td>
                                @if(!empty($project->themes))
                                    @foreach($project->themes  as $theme)
                                    @php
                                        $men_target = 0;
                                        $men_target =$men_target + $theme->women_target ;
                                        echo  $men_target;
                                    @endphp
                                    @endforeach
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                       
                        <tr>
                            <td><strong>Girls Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                    @foreach($project->themes  as $theme)
                                        @php
                                            $girls_target = 0;
                                            $girls_target = $girls_target + $theme->women_target ;
                                            echo  $girls_target;
                                        @endphp
                                    @endforeach
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Boys Target </strong></td>
                            <td> 
                                @if(!empty($project->themes))
                                    @foreach($project->themes  as $theme)
                                        @php
                                            $boys_target = 0;
                                            $boys_target =$boys_target + $theme->women_target ;
                                            echo  $boys_target;
                                        @endphp
                                    @endforeach
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        
                    </table>
                </div>
                {{-- <div class="col-md-12">
                   
                    <table class="table table-striped m-4">
                        
                        <tr>
                            <td><strong>Created By</strong></td>
                            <td>{{$project->user->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>   {{ date('d-M-Y', strtotime($project->created_at))}} </td>
                        </tr>
                        <tr>
                            <td><strong>Updated By</strong></td>
                            <td>{{$project->user1->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{ date('d-M-Y', strtotime($project->updated_at))}} </td>
                        </tr>
                    </table>
                    
                </div> --}}
        
            </div>
    
        </div>
    
</div>