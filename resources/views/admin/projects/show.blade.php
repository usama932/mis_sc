<x-default-layout>
 
    @section('title')
    View Project Detail
    @endsection
    <div class="card p-3">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit project</a>
            </div>
            <div class="col-md-6">
                
                <table class="table table-striped m-4">
                    
                    <tr>
                        <td><strong>Project</strong></td>
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
                           {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Focal Person</strong></td>
                        <td>
                          {{$project->focalperson?->name ?? ''}}<br>
                          {{$project->focalperson?->email ?? ''}}
                        </td>
                    </tr>
                </table>
                
            </div>
            <div class="col-md-6">
                <table class="table table-striped m-4">
                    
                    <tr>
                        <td><strong>Total Target</strong></td>
                        <td> {{$project->detail?->total_targets ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>House Hold Target </strong></td>
                        <td> {{$project->detail?->hh_targets ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Individual Target </strong></td>
                        <td> {{$project->detail?->individual_targets ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Male Target </strong></td>
                        <td> {{$project->detail?->male_targets ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Female Target </strong></td>
                        <td> {{$project->detail?->female_targets ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Boys Target </strong></td>
                        <td> {{$project->detail?->boys_targets ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Girls Target </strong></td>
                        <td> {{$project->detail?->girls_targets ?? ''}}</td>
                    </tr>
                    
                </table>
            </div>
            @if(!empty($project->detail))
                <h5 class="mx-3">Project Details</h5>
                <div class="col-md-12">
                    <table class="table table-striped m-4">
                        <tr>
                            <td><strong>Project Description</strong></td>
                            <td> {{$project->detail?->project_description ?? 'No Detail'}}
                            </td>
                        </tr>
                        
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
            @endif
            <h5 class="mx-3"></h5>
            <div class="col-md-12">
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
                
            </div>
        </div>
       
        
    </div>
</x-default-layout>
