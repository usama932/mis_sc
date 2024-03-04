<x-default-layout>
 
    @section('title')
     
    @endsection

    <div class="container p-3">
        <input type="hidden" id="dip_activity" value="{{$dip_activity->id}}">
        <div class="table-responsive overflow-* p-5" >
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <tr>
                            <td class="fs-1 text-center"> <strong>{{$dip_activity->project->name ?? ''}}</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th class="fs-4 text-center"> <strong>Activity Title</strong></th>
                            <td class="fs-4 text-center"> <strong>{{$dip_activity->activity_title ?? ''}}</strong></td>
                        </tr>
                      
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th class="fs-4 text-center"> <strong>LOP Target</strong></th>
                            <td class="fs-4 text-center"> <strong>{{$dip_activity->lop_target ?? ''}}</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-striped">
                        <tr>
                            <td class="text-center fs-8"><strong>Thematic Area</strong></td>
                            <td class="fs-9">{{$dip_activity->scisubtheme_name?->maintheme?->name ?? ''}}</td>
                        </tr>
                        @if(!empty($districts))
                            <tr>
                                <td class="text-center fs-9"><strong>Districts</strong></td>
                                <td class="fs-9">
                                    @foreach($districts as $district)
                                    {{ $district}}@if(! $loop->last), @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-striped">
                        @if(!empty($provinces))
                        <tr>
                            <td class="text-center fs-9"><strong>Provinces</strong></td>
                            <td class="fs-8">
                                @foreach($provinces as $province)
                                {{ $province}}@if(! $loop->last), @endif
                                @endforeach
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td class="text-center fs-9"><strong>SOF</strong></td>
                            <td class="fs-9">
                                {{$dip_activity->project->sof ?? ''}}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table table-striped">
                        <tr>
                            <td class="text-center fs-9"><strong>Donor</strong></td>
                            <td class="fs-9">
                                {{$dip_activity->project->donors->name ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fs-9"><strong>Project Tenure</strong></td>
                            <td class="fs-9">
                                @if(!empty($dip_activity->project->start_date) && $dip_activity->project->start_date != null)
                                {{ date('M d, Y', strtotime($dip_activity->project->start_date))}} - {{date('M d, Y', strtotime($dip_activity->project->end_date))}}
                                @endif
                            </td>
                        </tr>
                        
                    </table>
                </div>
                
            </div>
            <table class="table table-bordered nowrap table-responsive" id="activityQuarters">
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="2"  class="text-center" >Activity</th>
                        <th colspan="7" class="text-center" >Beneficiary Target vs Achievement</th>
                        <th class="fs-8"></th>
                    </tr>
                    <tr>  
                        <th>Quarter</th>
                        <th style="background-color: grey"> Target</th>
                        <th> Achievement</th>
                        <th style="background-color: grey">Target</th>
                        <th>Women </th>
                        <th>Men </th>
                        <th>Girls </th>
                        <th>Boys </th>
                        <th>PWD </th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @foreach($months as $month)
        <div class="modal fade project_theme_modal" id="update_status_{{ $month->quarter_id }}" tabindex="-1" aria-labelledby="editThemeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Update Status</h3>
                        <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="update_quarter_status_form" method="post" autocomplete="off" action="{{ route('quarterstatus.update',$month->quarter_id) }}">   
                            @csrf
                            @method('post') <!-- Assuming you are using PUT method for updating -->
                            <input type="hidden" name="project_id" value="{{ $month->project_id }}">
                            <input type="hidden" name="activity_id" value="{{ $month->activity_id }}">
                            <div class="fv-row col-md-12">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Status</span>
                                </label> 
                                <select   name="status" class="form-select form-control donor" id="donor" aria-label="Select a Donor" data-control="select2" data-placeholder="Select a Donor" class="form-select "  data-allow-clear="true" > 
                                    <option  value=''>Select Donor</option>
                                    <option  value='Posted'>Posted</option>
                                    <option  value='Returned'>Returned</option>
                                
                                </select>
                                <div id="donorError" class="error-message text-danger"></div>
                            </div>  
                            {{-- <div class="fv-row col-md-12">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Remarks</span>
                                </label>
                                <textarea class="form-control remarks" name="remarks"></textarea>
                                <div id="remarksError" class="error-message text-danger"></div>
                            </div>   --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary btn-sm m-5 submitButton" id="">
                                    @include('partials/general/_button-indicator', ['label' => 'Update'])
                                </button>
                                <div id="loadingSpinner" class="loadingSpinner" style="display: none;">Loading...</div>
                            </div>      
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @push("scripts")
        <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
        <script>
                var activity_id = document.getElementById("dip_activity").value ;
                var activityQuarters = $('#activityQuarters').DataTable({
                "order": [[1, 'desc']],
                // "dom": 'lfBrtip',
                // buttons: [{
                //     extend: 'csv',
                //     customize: function (csv) {
                //         // Add additional rows to CSV export
                //         var additionalInfo = $('#additionalInfo').html();
                //         csv = additionalInfo + csv;
                //         return csv;
                //     }
                // },
                // {
                //     extend: 'excel',
                //     customize: function (xlsx) {
                //         // Add additional rows to Excel export
                //         var additionalInfo = $('#additionalInfo').html();
                //         $(xlsx).find('worksheet:first').prepend(additionalInfo);
                //     }
                // }],
                "responsive": true, // Enable responsive mode
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": false,
                "bInfo" : false,
                "responsive": false,
                "info": false,   
                "ajax": {
                    "url":"{{route('admin.activityQuarters')}}",
                    "dataType":"json",
                    "type":"POST",
                    "data":{"_token":"<?php echo csrf_token() ?>",
                            "activity_id":activity_id
                    }
                },
                "columns":[
                    {"data":"quarter","searchable":false,"orderable":false},
                    {"data":"activity_target","searchable":false,"orderable":false},
                    {"data":"activity_acheive","searchable":false,"orderable":false},
                    {"data":"benefit_target","searchable":false,"orderable":false},
                    {"data":"women_target","searchable":false,"orderable":false},
                    {"data":"men_target","searchable":false,"orderable":false},
                    {"data":"girls_target","searchable":false,"orderable":false},
                    {"data":"boys_target","searchable":false,"orderable":false},
                    {"data":"pwd_target","searchable":false,"orderable":false},
                    {"data":"status","searchable":false,"orderable":false},
                    {"data":"remarks","searchable":false,"orderable":false},
                    {"data":"action","searchable":false,"orderable":false},
                ]
            });


            $(document).ready(function() {
                $('.submitButton').click(function(e) {
                    e.preventDefault();
                   
                    // Perform validation
                    var donor = $('.donor').val();
                    if (!donor) {
                        $('#donorError').text('Please select a donor');
                        return;
                    } else {
                        $('#donorError').text('');
                    }
                    // var remarks = $('.remarks').val();
                    // if (!remarks) {
                    //     $('#remarksError').text('Please add Remarks');
                    //     return;
                    // } else {
                    //     $('#remarksError').text('');
                    // }
                    // Submit the form using AJAX
                    $.ajax({
                        url: $('.update_quarter_status_form').attr('action'),
                        type: 'Post',
                        data: $('.update_quarter_status_form').serialize(),
                        beforeSend: function() {
                            $('.loadingSpinner').show();
                        },
                        success: function(response) {
                            if(response){
                                toastr.options = {
                                    "closeButton": false,
                                    "debug": true,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toastr-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };

                                activityQuarters.ajax.reload(null, false).draw(false);
                                $('.loadingSpinner}').hide();
                                $('.project_theme_modal').modal('hide');
                                $('.loadingSpinner}').hide();
                                toastr.success("Activity Quarter Status Updated", "Success");
                            }
                        },
                        error: function(xhr) {
                            // Handle errors
                            
                            if(xhr){
                                toastr.options = {
                                    "closeButton": false,
                                    "debug": true,
                                    "newestOnTop": false,
                                    "progressBar": false,
                                    "positionClass": "toastr-top-right",
                                    "preventDuplicates": false,
                                    "onclick": null,
                                    "showDuration": "300",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "fadeIn",
                                    "hideMethod": "fadeOut"
                                };
                                toastr.error(xhr.responseText, "Error occurred");
                            }
                        },
                        complete: function() {
                            $('.loadingSpinner}').hide();
                        }
                    });
                });
            });
        </script>
        
    @endpush
</x-default-layout>
