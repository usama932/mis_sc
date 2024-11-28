<x-default-layout>
 
    @section('title')
    View Detail Implementation Plan
    @endsection
    <div class="card p-3">
        <div class="row">
            {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit project</a>
            </div> --}}
            <div class="col-md-12">
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
                        <td><strong>Tenure</strong></td>
                        <td>
                           {{ date('d-M-Y', strtotime($project->project_start))}} -To- {{date('d-M-Y', strtotime($project->project_end));}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Focal Person</strong></td>
                        <td>
                            {{$project->focalperson?->name ?? ''}}<br>
                            {{$project->focalperson?->email ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Awards FP</strong></td>
                        <td>
                            {{$project->awardfp?->name ?? ''}}<br>
                            {{$project->awardfp?->email ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Budget holder FP</strong></td>
                        <td>
                            {{$project->budgetholder?->name ?? ''}}<br>
                            {{$project->budgetholder?->email ?? ''}}
                        </td>
                    </tr>
                </table>
                
            </div>
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
