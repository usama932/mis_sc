<x-default-layout>
 
    @section('title')
    View Detail Implementation Plan
    @endsection
    <div class="card p-3">
        <div class="row">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('dips.edit',$dip->id)}}" class="btn btn-primary me-md-2 btn-sm" target="_blank">Edit DIP</a>
            </div>
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
                        <td>{{$dip->projects->name ?? ''}}</td>
                    </tr>
                     
                    <tr>
                        <td><strong>Partner</strong></td>
                        <td>
                            @foreach($partners as $partner)
                                {{$partner->name}},
                            @endforeach
                        </td>
                    </tr>
                      
                    <tr>
                        <td><strong>Theme</strong></td>
                        <td>
                            @foreach($themes as $theme)
                                {{$theme->name}},
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Provinces</strong></td>
                        <td>
                            @foreach($provinces as $province)
                                {{$province->province_name}},
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Distirct</strong></td>
                        <td>
                            @foreach($districts as $district)
                                {{$district->district_name}},
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Tenure</strong></td>
                        <td>
                           {{ date('d-M-Y', strtotime($dip->project_start))}} -To- {{date('d-M-Y', strtotime($dip->project_end));}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Project Submission</strong></td>
                        <td>
                            {{ date('d-M-Y', strtotime($dip->project_submition))}} 
                        </td>
                    </tr>
                </table>
                
            </div>
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
                        <td><strong>Created By</strong></td>
                        <td>{{$dip->user->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Created At</strong></td>
                        <td>   {{ date('d-M-Y', strtotime($dip->created_at))}} </td>
                    </tr>
                    <tr>
                        <td><strong>Updated By</strong></td>
                        <td>{{$dip->user1->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated At</strong></td>
                        <td>{{ date('d-M-Y', strtotime($dip->updated_at))}} </td>
                    </tr>
                </table>
                
            </div>
    
        </div>
    </div>
</x-default-layout>
