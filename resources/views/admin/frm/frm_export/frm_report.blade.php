<table>
    <tr>
        <th>S.No.#</th>
        <th>Unique ID</th>
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
        <th>Feedback Category </th>
        <th>DATIX Reference.#</th>
        <th>Theme</th>
        <th>Feedback Activity </th>
        <th>Project</th>
        <th>Province</th>
        <th>District</th>
        <th>Tehsil</th>
        <th>UC</th>
        <th>Village</th>
        <th>Referred Date</th>
        <th>Referred to</th>
        <th>Designation</th>
        <th>Feedback Summary</th>
        <th>Date of Responseback Given</th>
        <th>Response Back Given</th>
        <th>Days taken in resolution feedback or concern</th>
        <th>Action Status</th>
        <th>Remarks</th>
        <th>Complainant satisfaction level on Action</th>
        <th>System Status</th>
    </tr>
   
    @foreach($frms as $frm)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $frm->response_id ?? ''}}</td>
            <td>{{ $frm->name_of_registrar ?? '' }}</td>
            <td>{{$frm->date_received ?? ''}}</td>
            <td>{{ $frm->channel?->name ?? ''}}</td>
            <td>{{ $frm->name_of_client ?? ''}}</td>
            <td>{{ $frm->type_of_client ?? ''}}</td>
            <td>{{ $frm->gender ?? ''}}</td>
            <td>{{ $frm->pwd_clwd ?? ''}}</td>
            <td>{{ $frm->age ?? ''}}</td>
            <td>{{ $frm->allow_contact ?? ''}}</td>
            <td>{{ $frm->client_contact ?? ''}}</td>
            <td>{{ $frm->feedback_description ?? ''}}</td>
            <td>{{ $frm->category?->name ?? ''}}-{{ $frm->category?->description ?? ''}}</td>
            <td>{{ $frm->datix_number ?? ''}}</td>
            <td>{{ $frm->theme_name?->name ?? ''}}</td>
            <td>{{ $frm->feedback_activity ?? ''}}</td>
            <td>{{ $frm->project?->name ?? ''}}</td>
            <td>{{ $frm->provinces?->province_name ?? ''}}</td>
            <td>{{ $frm->districts?->district_name ?? ''}}</td>
            <td>{{ $frm->tehsils?->tehsil_name ?? $frm->tehsil}}</td>
            <td>{{ $frm->uc?->uc_name ?? $frm->union_counsil}}</td>
            <td>{{ $frm->village ?? ''}}</td> 
            <td>@if(!empty($frm->date_ofreferral)) {{ $frm->date_ofreferral ?? ''}} @else  @endif</td>
            <td>{{ $frm->referral_name ?? ''}}</td>
            <td>{{ $frm->referral_position ?? ''}}</td>
            <td>{{ $frm->feedback_summary ?? '' }}</td>
            <td>{{ $frm->date_of_respbackgiven ?? ''}}</td>
            <td>{{ $frm->response_summary ?? ''}}</td>
            <td>
                @php
                if($frm->status == "Close" && !empty($frm->date_received) && $frm->date_of_respbackgiven !== null)
                {
                   
                       
                    $dayss = round((strtotime($frm->date_of_respbackgiven) -  strtotime($frm->date_received) )/ 86400)  ?? '';
                    echo  $dayss;
                }
                else{
                   
                   $dayss =  (strtotime(date("Y-m-d")) - strtotime($frm->date_received)) / 86400;
                    echo $dayss;
                }
                @endphp
            </td>
            @php
                if(!empty($frm->date_of_respbackgiven) &&  $frm->date_of_respbackgiven !== null && $frm->status == "Close"){
                  
                    $days = round((strtotime($frm->date_of_respbackgiven) -  strtotime($frm->date_received) )/ 86400)  ?? '';
                   
                    if(!empty($frm->date_of_respbackgiven &&  $frm->date_of_respbackgiven !== null && $frm->status == "Close"))
                        if($frm->feedback_category != '6' || $frm->feedback_category != '7'){
                            if($days == '0' ){
                            $status = "Closed Timely";
                            }
                            elseif($days > '0' && $days <= '15'){
                                $status = "Closed Timely";
                            }
                          
                            else{
                                $status = "Closed with Delay";
                            }
                        }
                        else{
                            if($days == '0' ){
                                $status = "Closed Timely";
                            }
                            elseif($days > '0' && $days <= '90'){
                                $status = "Closed Timely";
                            }
                          
                            else{
                                $status = "Closed with Delay";
                            }
                        }
                      
                    else  {
                        $dayss =  (strtotime(date("Y-m-d")) - strtotime($frm->date_received)) / 86400;
                        echo $dayss;
                    }
                } 
            @endphp
            <td>@if($frm->status == "Open") Open @else {{$status ?? ''}} @endif</td>
                
            <td>
                @if($frm->responses->count() > 0)
                    @foreach($frm->responses as $response)
                        {{$response->follow_up_date}}:: {{$response->response_summary ?? ''}}\n
                       
                    @endforeach
                @else

                @endif
            </td>
            
            <td>{{ $frm->type_ofaction_taken ?? ''}}</td>
               
            <td>{{$frm->status ?? ""}}</td>
           
        </tr>
    @endforeach
   
</table>