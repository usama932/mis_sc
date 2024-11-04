<x-nform-layout>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Title -->
            <div>
                <h4>Beneficart Asssessment #{{ $benficiaryAssessment->form_no ?? '' }} 
                    <span class="badge badge-success">{{ $benficiaryAssessment->status }}</span>
                </h4>
            </div>
            
           
        </div>
        <div class="card shadow-lg p-4 mb-5">
            <!-- Information Receiver and Client Details Section -->
            <div class="row">
                <!-- Left Column: Information Receiver (Larger Column) -->
                <div class="col-md-6 mb-4">
                    <div class="p-3" style="background-color: #f1416c; color: white;">
                        <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-info-circle text-white "></i> Demographic Information</h5>
                    </div>
                    <div class="p-3 border rounded">
                        <table class="table table-borderless">
                            <tr><td><strong>Teshil</strong></td><td>{{ $benficiaryAssessment->tehsil?->tehsil_name ?? '' }}</td></tr>
                            <tr><td><strong>Union Council</strong></td><td>{{ $benficiaryAssessment->uc?->uc_name ?? '' }}</td></tr>
                            <tr><td><strong>Date </strong></td><td>{{$benficiaryAssessment->form_date ?? '' }}</td></tr>
                            <tr><td><strong>Village</strong></td><td>{{ $benficiaryAssessment->village }}</td></tr>
                            <tr><td><strong>SubVillage</strong></td><td>{{ $benficiaryAssessment->sub_village ?? '' }}</td></tr>
                        </table>
                    </div>
                </div>
    
                <div class="col-md-6 mb-4">
                    <div class="p-3" style="background-color: #f1416c; color: white;">
                        <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-share text-white" ></i> Interview Observation</h5>
                    </div>
                    <div class="p-3 border rounded">
                        <table class="table table-borderless">
                            <tr><td><strong>Cash Assisstance</strong></td><td>{{ $benficiaryAssessment->cash_assistance ?? '' }}</td></tr>
                            <tr><td><strong>Assessment Officer</strong></td><td>{{ $benficiaryAssessment->assessment_officer ?? '' }}</td></tr>
                            <tr><td><strong>VC Representative Name </strong></td><td>{{ $benficiaryAssessment->vc_representative_name  ?? '' }}</td></tr>
                            <tr><td><strong>Created By</strong></td><td>{{ $benficiaryAssessment->user?->name ?? '' }}</td></tr>
                            <tr><td><strong>Created At</strong></td><td>{{date('M d,Y', strtotime($benficiaryAssessment->created_at)) }}</td></tr>
                        </table>
                    </div>
                </div>
               
                <div class="col-md-6 mb-4">
                    <div class="p-3" style="background-color: #f1416c; color: white;">
                        <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-user text-white"></i>General Information</h5>
                    </div>
                    <div class="p-3 border rounded">
                        <table class="table table-borderless">
                            <tr><td><strong>Name of Beneficary</strong></td><td>{{ $benficiaryAssessment->name_of_beneficiary ?? '' }}</td></tr>
                            <tr><td><strong>Father/Husband Name</strong></td><td>{{ $benficiaryAssessment->guardian }}</td></tr>
                            <tr><td><strong>Gender</strong></td><td>{{ $benficiaryAssessment->gender }}</td></tr>
                            <tr><td><strong>Age</strong></td><td>{{ $benficiaryAssessment->age }}</td></tr>
                            <tr><td><strong>Beneficary Contact</strong></td><td>{{ $benficiaryAssessment->beneficiary_contact ?? '' }}</td></tr>
                            <tr><td><strong>Contact Number</strong></td><td>{{ $benficiaryAssessment->contact_number ?? '' }}</td></tr>
                          
                            <tr><td><strong>HH Segregate</strong></td><td>{{ $benficiaryAssessment->hh_segregate }}</td></tr>
                            <tr><td><strong>HH Girls</strong></td><td>{{ $benficiaryAssessment->hh_girls ?? '' }}</td></tr>
                            <tr><td><strong>HH Boys</strong></td><td>{{ $benficiaryAssessment->hh_boys ?? '' }}</td></tr>
                            <tr><td><strong>CNIC Beneficary</strong></td><td>{{ $benficiaryAssessment->cnic_beneficiary ?? '' }}</td></tr>
                            <tr><td><strong>CNIC Spouse</strong></td><td>{{ $benficiaryAssessment->cnic_spouse ?? '' }}</td></tr>
                            <tr><td><strong>CNIC Beneficary Issue Date</strong></td><td>{{date('M d,Y', strtotime($benficiaryAssessment->cnic_issuance "")) }}</td></tr>
                            <tr><td><strong>CNIC Beneficary Expiry</strong></td><td>{{date('M d,Y', strtotime($benficiaryAssessment->cnic_issuance ?? '')) }}</td></tr>
                            <tr><td><strong>HH Receive Cash Assistanance from other source</strong></td><td>{{$benficiaryAssessment->recieve_cash ?? '' }}</td></tr>
                            <tr><td><strong>Recieve Cash Amount</strong></td><td>{{$benficiaryAssessment->recieve_cash_amount ?? ''}}</td></tr>
                            <tr><td><strong>Recieve Cash Source</strong></td><td>{{$benficiaryAssessment->recieve_cash_source ?? ''}}</td></tr>
                        </table>
                    </div>
                </div>
            

                <div class="col-md-6 mb-4">
                    <div class="p-3" style="background-color: #f1416c; color: white;">
                        <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-user text-white"></i> Economic Information</h5>
                    </div>
                
                    <div class="px-3">
                        <table class="table table-sm table-striped">
                            <tr><td><strong>Average Monthly Income</strong></td><td>{{ $benficiaryAssessment->hh_monthly_income ?? '' }}</td></tr>
                            <tr><td><strong>Main Income Source</strong></td><td>{{ $benficiaryAssessment->hh_source_income ?? '' }}</td></tr>
                            <tr><td><strong>Person Earned in family </strong></td><td>{{$benficiaryAssessment->hh_person_earned ?? '' }}</td></tr>
                            <tr><td><strong>Outstanding Debt(PKR)</strong></td><td>{{ $benficiaryAssessment->hh_outstanding_debt ?? '' }}</td></tr>
                        </table>
                    </div>
                   
                </div>
             
    
                <!-- Right Column: Feedback Details -->
                <div class="col-md-6 mb-4">
                    <div class="p-3" style="background-color: #f1416c; color: white;">
                        <h5 class="text-white font-weight-bold mb-3"><i class="fa fa-clipboard text-white"></i> Dwelling Status, Vulnerabilities & Losses</h5>
                    </div>
                    <div class="p-3 border rounded">
                        <table class="table table-borderless">
                            <tr><td><strong>House Damage</strong></td><td>{{ $benficiaryAssessment->feedback_description ?? '' }}</td></tr>
                            <tr><td><strong>HH Belongssq to Minority</strong></td><td>{{ $benficiaryAssessment->category->name ?? '' }} - {{ $benficiaryAssessment->category->description ?? '' }}</td></tr>
                            <tr><td><strong>Theme</strong></td><td>{{ $benficiaryAssessment->theme_name->name ?? '' }}</td></tr>
                            <tr><td><strong>Project Name</strong></td><td>{{ $benficiaryAssessment->project->name ?? 'NA' }}</td></tr>
                            <tr><td><strong>Datix Number</strong></td><td>{{ $benficiaryAssessment->datix_number ?? 'NA' }}</td></tr>
                            <tr><td><strong>Feedback Activity</strong></td><td>{{ $benficiaryAssessment->feedback_activity }}</td></tr>
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
                                <td>{{$benficiaryAssessment->user->name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>Created At</strong></td>
                                <td>{{date('M d,Y', strtotime($benficiaryAssessment->created_at)) ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated By</strong></td>
                                <td>{{$benficiaryAssessment->user1->name ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated At</strong></td>
                                <td>{{date('M d,Y', strtotime($benficiaryAssessment->updated_at)) ?? ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
    
            </div>
    
            <!-- Feedback Responses Section -->
           
        </div> 
    </div>

</x-nform-layout>