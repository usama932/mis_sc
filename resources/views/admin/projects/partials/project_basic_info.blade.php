<div class="row">
    <div class="col-md-6">
        <table class="table table-borderless">
            <tr>
                <td><strong>Project Name</strong></td>
                <td>{{$project->name ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Donor</strong></td>
                <td>
                  {{$project->donors?->name ?? ''}} 
                </td>
            </tr>
            <tr>
                <td><strong>Awards  FP</strong></td>
                <td>
                  {{$project->awardfp?->name ?? ''}} -  {{$project->awardfp?->desig?->designation_name ?? ''}}<br>
               
                </td>
            </tr>
            <tr>
                <td><strong>SOF.#</strong></td>
                <td>{{$project->sof ?? ''}}</td>
            </tr>
           
            @if(!empty($provinces))
                <tr>
                    <td><strong>Provinces</strong></td>
                    <td>
                        @foreach($provinces as $province)
                            {{ $province->province_name}}  @if(! $loop->last)<br> @endif
                        @endforeach
                    </td>
                </tr>
            @endif
            {{-- <tr>
                <td><strong>Status</strong></td>
                <td>{{$project->status ?? ''}}</td>
            </tr> --}}
            
            {{-- <tr>
                <td><strong>Project Status </strong></td>
                <td>
                    @if($project->active == 1)
                        Active
                    @else
                        InActive
                    @endif
                  {{$project->atic ?? ''}}
                </td>
            </tr> --}}
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-borderless">
            <tr>
                <td><strong>Type</strong></td>
                <td>{{$project->type ?? ''}}</td>
            </tr>
            <tr>
                <td class="fs-8"><strong>Operational Focal Person</strong></td>
                <td>
                  {{$focal_person ?? ''}}
                  {{-- {{$project->focalperson?->email ?? ''}} --}}
                </td>
            </tr>
            <tr>
                <td><strong>Budget Holder FP</strong></td>
                <td>
                  {{$budgetholder ?? ''}}
               
                </td>
            </tr>
            <tr>
                <td class="fs-8"><strong>Project Tenure</strong></td>
                <td>
                    @if(!empty($project->start_date) && $project->start_date != null)
                        {{ date('d-M-Y', strtotime($project->start_date))}} -To- {{date('d-M-Y', strtotime($project->end_date));}}
                    @endif
                </td>
            </tr>
           
            
         
            @if(!empty($districts))
            <tr>
                <td><strong>Disticts</strong></td>
                <td>  @foreach($districts as $district)
                    {{ $district->district_name}}  @if(! $loop->last)<br> @endif
                    @endforeach
                </td>
            </tr>
            @endif
           
           
            {{-- <tr>
                <td><strong>Project Extended </strong></td>
                <td>
                    @if($project->project_extended == "0")  
                        No
                    @else
                       Yes 
                    @endif
                </td>
            </tr> --}}
            
        </table>
    </div>
    <div class="col-md-12"> 
        <table class="table ">
            <tr>
                <td><strong>Project Description</strong></td>
                <td>{{$project->detail?->project_description ??  ''}}</td>
            </tr>
        </table>
    </div>
</div>