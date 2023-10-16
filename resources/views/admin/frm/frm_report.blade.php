<table>
    <thead>
    <tr>
        <th>S.No.#</th>
        <th>Response ID</th>
        <th>Name of staff who received feedback/complaint</th>
        <th>Date Received</th>
        <th>Feedback Channel</th>
        <th>Name of person sharing feedback/complaint</th>
        <th>Type of person who shared feedback/complaint</th>
        <th>Gender</th>
        <th>PWD/CLWD</th>
        <th>Age</th>
        <th>Allow Contact</th>
        <th>Contact No</th>
        <th>Feedback Description</th>
        <th>Feedback Category No.</th>
        <th>Category in which this feedback or concern falls</th>
        <th>DATIX Reference.#</th>
        <th>Theme</th>
        <th>Feedback Activity </th>
        <th>Project</th>
        <th>Province</th>
        <th>District</th>
        <th>Tehsil</th>
        <th>UC</th>
        <th>Village</th>
        <th>Date of Refferal</th>
        <th>Name of staff member to whom feedback or concern was referred to</th>
        <th>Referred Person's Designation</th>
        <th>Feedback Summary</th>
        <th>Date of Responseback Given</th>
        <th>Response Given</th>
        <th>Complainant satisfaction level on Action</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($frms as $frm)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $frm->response_id ?? 'NA'}}</td>
            <td>{{ $frm->name_of_registrar ?? 'NA' }}</td>
            <td>{{$frm->date_received ?? 'NA'}}</td>
            <td>{{ $frm->channel?->name ?? 'NA'}}</td>
            <td>{{ $frm->name_of_client ?? 'NA'}}</td>
            <td>{{ $frm->type_of_client ?? 'NA'}}</td>
            <td>{{ $frm->gender ?? 'NA'}}</td>
            <td>{{ $frm->pwd_clwd ?? 'NA'}}</td>
            <td>{{ $frm->age ?? 'NA'}}</td>
            <td>{{ $frm->allow_contact ?? 'NA'}}</td>
            <td>{{ $frm->client_contact ?? 'NA'}}</td>
            <td>{{ $frm->feedback_description ?? 'NA'}}</td>
            <td>{{ $frm->category?->name ?? 'NA'}}</td>
            <td>{{ $frm->category?->description ?? 'NA'}}</td>
            <td>{{ $frm->datix_number ?? 'NA'}}</td>
            <td>{{ $frm->theme_name?->name ?? 'NA'}}</td>
            <td>{{ $frm->feedback_activity ?? 'NA'}}</td>
            <td>{{ $frm->project?->name ?? 'NA'}}</td>
            <td>{{ $frm->provinces?->province_name ?? 'NA'}}</td>
            <td>{{ $frm->districts?->district_name ?? 'NA'}}</td>
            <td>{{ $frm->tehsils?->tehsil_name ?? $frm->tehsil}}</td>
            <td>{{ $frm->uc?->uc_name ?? $frm->union_counsil}}</td>
            <td>{{ $frm->village ?? 'NA'}}</td> 
            <td>{{ $frm->date_ofreferral ?? 'NA'}}</td>
            <td>{{ $frm->referral_name ?? 'NA'}}</td>
            <td>{{ $frm->referral_position ?? 'NA'}}</td>
            <td>{{ $frm->feedback_summary ?? 'NA'}}</td>
            <td>{{ $frm->date_of_respbackgiven ?? 'NA'}}</td>
            <td>{{ $frm->type_of_response_required ?? 'NA'}}</td>
            <td>{{ $frm->type_ofaction_taken ?? 'NA'}}</td>
            <td>{{ $frm->status ?? 'NA'}}</td>
           
        </tr>
    @endforeach
    </tbody>
</table>