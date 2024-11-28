<table class="table table-striped">
    <tr>
        <td><strong>Theme</strong></td>
        <td>{{$profile->theme?->name ?? ''}}</td>
    </tr>
    
    <tr>
        <td><strong>Project</strong></td>
        <td>{{$profile->project?->name ?? ''}}</td>
    </tr>

    <tr>
        <td ><strong>District</strong></td>
        <td>@foreach( $districts as $district  ) {{$district}} @endforeach</td>
    </tr>

    <tr>
        <td><strong>Tehsils</strong></td>
        <td>@foreach( $tehsils as $tehsil  ) {{$district}} @endforeach</td>
    </tr>

    <tr>
        <td ><strong>UCs</strong></td>
        <td>@foreach( $ucs as $uc  ) {{$uc}} @endforeach </td>
    </tr>

    <tr>
        <td ><strong>Village/strong></td>
        <td>{{$profile->village ?? ''}}</td>
    </tr>

    <tr>
        <td><strong>Detail</strong></td>
        <td>{!! $profile->detail  ?? "" !!}</td>
    </tr>

    <tr>
        <td><strong>Created At</strong></td>
        <td>{{date('M d,Y', strtotime($profile->created_at)) ?? ""}}</td>
    </tr>
  
</table>