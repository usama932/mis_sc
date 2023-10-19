
//Monitor Visits Scripts
<script>
    //Monitor Visits
    var qb_id = document.getElementById("qb_id").value;
    
    var clients = $('#monitor_visits').DataTable({
        "order": [
            [1, 'asc']
        ],
        
        "processing": true,
        "serverSide": true,
        "searchDelay": 500,
        "responsive": true,
        "ajax": {
            "url": "{{ route('get_monitor_visits') }}",
            "dataType": "json",
            "type": "POST",
            "data": {
                "_token": "<?php echo csrf_token(); ?>",
                "qb_id":qb_id
            }
        },
        "columns": [{
                "data": "id",
                "searchable": false,
                "orderable": false
            },
            {
                "data": "activity_number"
            },
            {
                "data": "qb_met"
            },
        
            {
                "data": "created_at"
            },
            {
                "data": "action",
                "searchable": false,
                "orderable": false
            }
        ]
    });
    function monitorviewInfo(id) {

        var CSRF_TOKEN = '{{ csrf_token() }}';
        $.post("{{ route('view_monitor_visit') }}", {
            _token: CSRF_TOKEN,
            id: id
        }).done(function(response) {
            $('.modal-body').html(response);
            $('#view_monitor_visit').modal('show');

        });
    }
    function monitordel(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                Swal.fire(
                    "Deleted!",
                    "Your monitor visit has been deleted.",
                    "success"
                );
                var APP_URL = {!! json_encode(url('/')) !!}
                window.location.href = APP_URL + "/monitor_visit/delete/" + id;
            }
        });
    }
    $('.close').click(function() {
        $('#view_monitor_visit').modal('hide');
    });
</script>

//Action Point Scripts
<script>
    $("#activity_id").change(function () {
        
        var value = $(this).val();
        csrf_token = $('[name="_token"]').val();
       
        $.ajax({
            type: 'POST',
            url: '/getactivity',
            data: {'activity_id': value, _token: csrf_token },
            dataType: 'json',
            success: function (data) {
                document.getElementById('db_note').value = data.qbs_description;
            }

        });

    }).trigger('change');
</script>
<script>
    var qb_id = document.getElementById("qb_id").value;
    var clients = $('#action_points').DataTable({
        "order": [
            [1, 'asc']
        ],
        "processing": true,
        "serverSide": true,
        "searchDelay": 500,
        "responsive": true,
        "ajax": {
            "url": "{{ route('get_action_points') }}",
            "dataType": "json",
            "type": "POST",
            "data": {
                "_token": "<?php echo csrf_token(); ?>",
                "qb_id":qb_id
            }
        },
        "columns": [{
                "data": "id",
                "searchable": false,
                "orderable": false
            },
            {
                "data": "monitor_visits_id"
            },
            {
                "data": "action_agree"
            },
            {
                "data": "action_type"
            },
            {
                "data": "responsible_person"
            },
            {
                "data": "deadline"
            },
            {
                "data": "created_by"
            },
           
            {
                "data": "action",
                "searchable": false,
                "orderable": false
            }
        ]
    });
    function actionviewInfo(id) {

        var CSRF_TOKEN = '{{ csrf_token() }}';
        $.post("{{ route('view_action_point') }}", {
            _token: CSRF_TOKEN,
            id: id
        }).done(function(response) {
            $('.modal-body').html(response);
            $('#view_action_point').modal('show');

        });
    }
    function actiondel(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                Swal.fire(
                    "Deleted!",
                    "Your monitor visit has been deleted.",
                    "success"
                );
                var APP_URL = {!! json_encode(url('/')) !!}
                window.location.href = APP_URL + "/action_point/delete/" + id;
            }
        });
    }
    $('.close').click(function() {
        $('#view_monitor_visit,#view_action_point').modal('hide');
    });
</script>

//Qb Attachment Scripts 
<script>
    var qb_id = document.getElementById("qb_id").value;
    var clients = $('#qbattachments').DataTable({
        "order": [
            [1, 'asc']
        ],
        "processing": true,
        "serverSide": true,
        "searchDelay": 500,
        "responsive": true,
        "ajax": {
            "url": "{{ route('get_qb_attachments') }}",
            "dataType": "json",
            "type": "POST",
            "data": {
                "_token": "<?php echo csrf_token(); ?>",
                "qb_id":qb_id
            }
        },
        "columns": [{
                "data": "id",
                "searchable": false,
                "orderable": false
            },
            {
                "data": "comments"
            },
            {
                "data": "document"
            },
            {
                "data": "created_by"
            },
           
            {
                "data": "action",
                "searchable": false,
                "orderable": false
            }
        ]
    });
    function qb_attachmentviewInfo(id) {

        var CSRF_TOKEN = '{{ csrf_token() }}';
        $.post("{{ route('view_qb_attachments') }}", {
            _token: CSRF_TOKEN,
            id: id
        }).done(function(response) {
            $('.modal-body').html(response);
            $('#view_qbattachment').modal('show');

        });
    }
    function qb_attachmentdel(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                Swal.fire(
                    "Deleted!",
                    "Your QB Attachment has been deleted.",
                    "success"
                );
                var APP_URL = {!! json_encode(url('/')) !!}
                window.location.href = APP_URL + "/qb_attachments/delete/" + id;
            }
        });
    }
    $('.close').click(function() {
        $('#view_monitor_visit,#view_action_point,#view_qbattachment').modal('hide');
    });
</script>
//Quality Benchmark
