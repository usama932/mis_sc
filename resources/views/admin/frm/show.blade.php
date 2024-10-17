<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<x-nform-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Title -->
        <div>
            <h4>View Feedback/Complaint #{{ $frm->response_id ?? '' }} @if($frm->status == "Close")
                <span class="badge badge-success">Closed</span>
            @else
                <span class="badge badge-warning">Open</span>
            @endif</h4>
        </div>
        
        <!-- Tags Section -->
        <div class="d-flex justify-content-end align-items-center">
            @if (!empty($tagged))
                <h6 class="mr-2 text-muted font-italic">Tags by {{ $frm->tagged_by?->user?->desig?->designation_name }} <i class="fa fa-tag"></i>:</h6>
                @foreach ($tagged as $tag)
                    <span class="badge badge-pill badge-danger mx-1">{{ $tag }}</span>
                @endforeach
            @endif
        </div>
    </div>

    @can('frm tag')
        <!-- Add Tag Button -->
        <div class="d-flex justify-content-end">
            <button type="button" class="badge badge-primary m-2" data-toggle="modal" data-target="#addTagModal">
                <i class="fa fa-plus"></i> Add Tag
            </button>
        </div>
    @endcan

    <!-- Main Information Card -->
    <div class="card shadow-lg p-4 mb-5">
        <!-- Information Receiver and Client Details Section -->
        <div class="row">
            <!-- Left Column: Information Receiver (Larger Column) -->
            <div class="col-md-6 mb-4">
                <div class="p-3" style="background-color: #f1416c; color: white;">
                    <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-info-circle text-white "></i> Information Receiver</h5>
                </div>
                <div class="p-3 border rounded">
                    <table class="table table-borderless">
                        <tr><td><strong>Name of Registrar</strong></td><td>{{ $frm->name_of_registrar }}</td></tr>
                        <tr><td><strong>Date Received</strong></td><td>{{ date('M d,Y', strtotime($frm->date_received)) }}</td></tr>
                        <tr><td><strong>Feedback Channel</strong></td><td>{{ $frm->channel?->name ?? 'NA' }}</td></tr>
                    </table>
                </div>
            </div>

            <!-- Right Column: Client Details (Smaller Column) -->
          
       
            <!-- Left Column: Feedback Referral -->
            <div class="col-md-6 mb-4">
                <div class="p-3" style="background-color: #f1416c; color: white;">
                    <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-share text-white" ></i> Feedback Referral Details</h5>
                </div>
                <div class="p-3 border rounded">
                    <table class="table table-borderless">
                        <tr><td><strong>Feedback Referred/Shared</strong></td><td>{{ $frm->feedback_referredorshared ?? '' }}</td></tr>
                        <tr><td><strong>Referral Name</strong></td><td>{{ $frm->referral_name ?? '' }}</td></tr>
                        <tr><td><strong>Referral Position</strong></td><td>{{ $frm->referral_position ?? '' }}</td></tr>
                        <tr><td><strong>Referral Date</strong></td><td>{{ !empty($frm->date_ofreferral) ? date('M d,Y', strtotime($frm->date_ofreferral)) : 'NA' }}</td></tr>
                        <tr><td><strong>Feedback Summary</strong></td><td>{{ $frm->feedback_summary ?? '' }}</td></tr>
                    </table>
                </div>
            </div>
           
            @can('read feedback registry')
                <!-- Right Column: Client Details (Smaller Column) -->
                <div class="col-md-6 mb-4">
                    <div class="p-3" style="background-color: #f1416c; color: white;">
                        <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-user text-white"></i> Client Details</h5>
                    </div>
                    <div class="p-3 border rounded">
                        <table class="table table-borderless">
                            <tr><td><strong>Name of Client</strong></td><td>{{ $frm->name_of_client }}</td></tr>
                            <tr><td><strong>Type of Client</strong></td><td>{{ $frm->type_of_client }}</td></tr>
                            <tr><td><strong>Gender</strong></td><td>{{ $frm->gender }}</td></tr>
                            <tr><td><strong>Age</strong></td><td>{{ $frm->age }}</td></tr>
                            <tr><td><strong>Province</strong></td><td>{{ $frm->provinces->province_name ?? '' }}</td></tr>
                            <tr><td><strong>District</strong></td><td>{{ $frm->districts->district_name ?? '' }}</td></tr>
                            <tr><td><strong>Tehsil</strong></td><td>{{ $frm->tehsils->tehsil_name ?? $frm->tehsil }}</td></tr>
                            <tr><td><strong>Union Council</strong></td><td>{{ $frm->uc->uc_name ?? $frm->union_counsil }}</td></tr>
                            <tr><td><strong>Village</strong></td><td>{{ $frm->village }}</td></tr>
                            <tr><td><strong>Allow Contact</strong></td><td>{{ $frm->allow_contact }}</td></tr>
                            <tr><td><strong>Contact Number</strong></td><td>{{ $frm->client_contact ?? '' }}</td></tr>
                        </table>
                    </div>
                </div>
           

                <div class="col-md-6 mb-4">
                    <div class="p-3" style="background-color: #f1416c; color: white;">
                        <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-user text-white"></i> FRM Responses</h5>
                    </div>
                    @if($responses->count() > 0)
                        <div class="px-3">
                            <table class="table table-sm table-striped">
                                <thead>
                                    
                                    <th class="fw-bolder">Response</th>
                                    <th class="fw-bolder">Status</th>
                                    <th class="fw-bolder fs-8">Follow On</th>
                                
                                </thead>
                                <tbody>
                                    @foreach($responses as $response)
                                    <tr>
                                        <td>{{ $response->response_summary ?? '--' }}</td>
                                        <td>{{ $response->status }}</td>
                                        <td>
                                        
                                            {{ date('M d ,Y', strtotime($response->follow_up_date)) }}
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    
                </div>
            @endcan

            <!-- Right Column: Feedback Details -->
            <div class="col-md-6 mb-4">
                <div class="p-3" style="background-color: #f1416c; color: white;">
                    <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-clipboard text-white"></i> Feedback Details</h5>
                </div>
                <div class="p-3 border rounded">
                    <table class="table table-borderless">
                        <tr><td><strong>Feedback Description</strong></td><td>{{ $frm->feedback_description ?? '' }}</td></tr>
                        <tr><td><strong>Feedback Category</strong></td><td>{{ $frm->category->name ?? '' }} - {{ $frm->category->description ?? '' }}</td></tr>
                        <tr><td><strong>Theme</strong></td><td>{{ $frm->theme_name->name ?? '' }}</td></tr>
                        <tr><td><strong>Project Name</strong></td><td>{{ $frm->project->name ?? 'NA' }}</td></tr>
                        <tr><td><strong>Datix Number</strong></td><td>{{ $frm->datix_number ?? 'NA' }}</td></tr>
                        <tr><td><strong>Feedback Activity</strong></td><td>{{ $frm->feedback_activity }}</td></tr>
                    </table>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="p-3" style="background-color: #f1416c; color: white;">
                    <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-file text-white"></i> Record Details</h5>
                </div>
                <div class="p-3 border rounded">
                    <table class="table table-borderless">
                  
                        <tr>
                            <td><strong>Created By</strong></td>
                            <td>{{$frm->user->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At</strong></td>
                            <td>{{date('M d,Y', strtotime($frm->created_at)) ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated By</strong></td>
                            <td>{{$frm->user1->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated At</strong></td>
                            <td>{{date('M d,Y', strtotime($frm->updated_at)) ?? ''}}</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

        <!-- Feedback Responses Section -->
       
    </div>

    <!-- Modal for Adding Tags -->
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTagModalLabel">Add Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  id="add-tag" method="post" action="{{ route('add-frmTag') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tag">Tag Name</label>
                            <input type="hidden" value="{{ $frm->id  }}" name="frm_id">
                            <select name="tags[]" id="tags" class="form-select" aria-label="Select Tag" data-control="select2" data-placeholder="Select an option" data-allow-clear="true" multiple required>
                                <option value="">Select Thematic Area</option>
                                <option value="Unsafe Programming" @if($tagged) @if(in_array('Unsafe Programming', $tagged)) selected @endif @endif>Unsafe Programming</option>
                                <option value="Report to Datix"  @if($tagged) @if(in_array('Report to Datix', $tagged)) selected @endif @endif>Report to Datix</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-nform-layout>
