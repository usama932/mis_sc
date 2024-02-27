<x-default-layout>
 
    @section('title')
     
    @endsection

    <div class="container p-3">
        <input type="hidden" id="dip_activity" value="{{$dip_activity->id}}">
        <div class="table-responsive overflow-* p-5" >
            <table class="table table-striped table-bordered nowrap table-responsive" id="activityQuarters">
                <thead>
                    <tr>
                        <th colspan="8" class="text-center"><h1>{{ucfirst($dip_activity->project->name ?? '')}}</h1></th>
                    </tr>
                    <tr>
                        <th colspan="8" class="text-center"><h3>{{ucfirst($dip_activity->activity_title ?? '')}}</h3></th>
                    </tr>
                    <tr>
                        <th colspan="8" class="text-center"><h4>@foreach($provinces as $province) {{ucfirst($province) }},  @endforeach<h4></th>
                    </tr>
                    <tr>
                        <th>Quarter</th>
                        <th style="background-color: grey">Activity Target</th>
                        <th >Activity Achievement</th>
                        <th style="background-color: grey">Beneficiary Target</th>
                        <th>Women Achievement</th>
                        <th>Men Achievement</th>
                        <th>Girls Achievement</th>
                        <th>Boys Achievement</th>
                        <th>PWD Achievement</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @push("scripts")
        <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
        <script>
             var activity_id = document.getElementById("dip_activity").value ;
            var activityQuarters = $('#activityQuarters').DataTable({
                "order": [[1, 'desc']],
                "dom": 'lfBrtip',
                buttons: [{
                    extend: 'csv',
                    customize: function (csv) {
                        // Add additional rows to CSV export
                        var additionalInfo = $('#additionalInfo').html();
                        csv = additionalInfo + csv;
                        return csv;
                    }
                },
                {
                    extend: 'excel',
                    customize: function (xlsx) {
                        // Add additional rows to Excel export
                        var additionalInfo = $('#additionalInfo').html();
                        $(xlsx).find('worksheet:first').prepend(additionalInfo);
                    }
                }],
                "responsive": true, // Enable responsive mode
                "processing": true,
                "serverSide": true,
                "searching": false,
                "bLengthChange": false,
                "bInfo" : false,
                "responsive": false,
                "info": true,   
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
                    {"data":"remarks","searchable":false,"orderable":false},
                ]
            });
        </script>
    @endpush
</x-default-layout>
