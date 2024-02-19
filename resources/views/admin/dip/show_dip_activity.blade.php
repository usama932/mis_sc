<x-default-layout>
 
    @section('title')
         Project Activity Detail
    @endsection

    <div class="container p-3" >
       
    
        <h1 class="text-center text-capitalize">{{$dip_activity->project->name ?? ''}}</h1>
        <h4 class="text-center text-capitalize">{{$dip_activity->activity_number ?? ''}}</h4>
        <h6 class="text-center text-capitalize">@foreach($provinces as $province) {{$province }},  @endforeach</h6>
        <input type="hidden" id="dip_activity" value="{{$dip_activity->id}}">
        <div class="table-responsive overflow-*">
            <table class="table table-striped table-bordered nowrap table-responsive" id="activityQuarters">
            
                <thead>
                    <tr>
                        <th>Quarter</th>
                        <th>Activity Target</th>
                        <th>Beneficiary Target</th>
                        <th>Women Achieve Target</th>
                        <th>Men Achieve Target</th>
                        <th>Girls Achieve Target</th>
                        <th>Boys Achieve Target</th>
                        <th>Attachment</th>
                        <th>Image</th>
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
            var activityQuarters = $('#activityQuarters').DataTable( {
                "order": [
                [1, 'desc']
            ],
            "dom": 'lfBrtip',
            buttons: [
                'csv', 'excel'
            ],
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
                                {"data":"benefit_target","searchable":false,"orderable":false},
                                {"data":"women_target","searchable":false,"orderable":false},
                                {"data":"men_target","searchable":false,"orderable":false},
                                {"data":"girls_target","searchable":false,"orderable":false},
                                {"data":"boys_target","searchable":false,"orderable":false},
                                {"data":"attachment","searchable":false,"orderable":false},
                                {"data":"image","searchable":false,"orderable":false},
                                {"data":"remarks","searchable":false,"orderable":false},
                            ]
            });[]

            
            
        </script>
    @endpush
</x-default-layout>
