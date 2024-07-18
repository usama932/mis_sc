var baseURL = window.location.origin;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var QBs = $('#quality_bench').DataTable( {
           
    "dom": 'lfBrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            filename: 'Project Profile Data export_',
            text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
            title: 'Themetic area Data export',
            className: 'badge badge-outline-success',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
            }
        },
        {
            extend: 'csvHtml5',
            filename: 'Project Profile Data CSV_',
            text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
            title: 'Themetic area Data',
            className: 'badge badge-outline-success ',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
            }
        }
    ],
    "responsive": true, // Enable responsive mode
    "processing": true,
    "serverSide": true,
    "searching": false,
    "bLengthChange": true,
    "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
    "bInfo" : true,
    "responsive": false,
    "info": true,
    "ajax": {
        "url":"/get_qbs",
        "dataType":"json",
        "type":"POST",
        "data":{"_token":csrfToken}
    },
    "columns":[
                    {"data":"assement_code","searchable":false,"orderable":false},
                    {"data":"project_name","searchable":false,"orderable":false},
                    {"data":"partner","searchable":false,"orderable":false},
                    {"data":"province","searchable":false,"orderable":false},
                    {"data":"district","searchable":false,"orderable":false},
                    {"data":"theme","searchable":false,"orderable":false},
                    {"data":"activity_description","searchable":false,"orderable":false},
                    {"data":"village","searchable":false,"orderable":false},
                    {"data":"staff_organization","searchable":false,"orderable":false},
                    {"data":"date_visit","searchable":false,"orderable":false},
                    {"data":"qb_base","searchable":false,"orderable":false},
                    {"data":"total_qbs","searchable":false,"orderable":false},
                    {"data":"qbs_not_fully_met","searchable":false,"orderable":false},
                    {"data":"qbs_fully_met","searchable":false,"orderable":false},
                    {"data":"qb_not_applicable","searchable":false,"orderable":false},
                    {"data":"score_out","searchable":false,"orderable":false},
                    {"data":"qb_status","searchable":false,"orderable":false},
                    {"data":"attachment","searchable":false,"orderable":false},
                    {"data":"created_at" ,"searchable":false,"orderable":false},
                    {"data":"created_by" ,"searchable":false,"orderable":false},
                    {"data":"action","searchable":false,"orderable":false},
                ]
});

function del(id) {
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
                "Your Quality BenchMark` has been deleted.",
                "success"
            );
            var APP_URL =  json_encode(url('/')) 
            window.location.href = APP_URL + "/qb/delete/" + id;
        }
    });
}

$("#date_visit,#assesment_code,#attachement, #visit_staff,#partner, #accompanied_by, #visit_type, #kt_select2_province, #kt_select2_district, #project_type, #project_name").change(function () {
    var table = $('#quality_bench').DataTable();
    table.destroy();
    var date_visit = document.getElementById("date_visit").value ?? '1';
    var visit_staff = document.getElementById("visit_staff").value
    var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
    var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
    var accompanied_by = document.getElementById("accompanied_by").value ?? '1';
    var visit_type = document.getElementById("visit_type").value ?? '1';
    var project_type = document.getElementById("project_type").value ?? '1';
    var project_name = document.getElementById("project_name").value ?? '1';
    var partner = document.getElementById("partner").value ?? '1';
    var assesment_code = document.getElementById("assesment_code").value ?? '1';
    var attachement = document.getElementById("attachement").value ?? '1';
    var qb = $('#quality_bench').DataTable( {
        "dom": 'lfBrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                filename: 'Project Profile Data export_',
                text: '<i class="fa fa-download text-warning mx-1"></i> Excel',
                title: 'Themetic area Data export',
                className: 'badge badge-outline-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                }
            },
            {
            extend: 'csvHtml5',
            filename: 'Project Profile Data CSV_',
            text: '<i class="fa fa-download text-warning mx-1"></i> CSV',
            title: 'Themetic area Data',
            className: 'badge badge-outline-success',
            exportOptions: {
                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
            }
         }
        ],
        "processing": true,
        "serverSide": true,
        "searching": false,
        "bLengthChange": true,
        "aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
        "bInfo" : false,
        "responsive": false,
        "info": true,

        
        "ajax": {
            "url":"/get_qbs",
            "dataType":"json",
            "type":"POST",
            "data":{"_token":csrfToken,
                    'date_visit':date_visit,
                    'visit_staff':visit_staff,
                    'kt_select2_district':kt_select2_district,
                    'kt_select2_province':kt_select2_province,
                    'accompanied_by':accompanied_by,
                    'visit_type':visit_type,
                    'project_type':project_type,
                    'project_name':project_name,
                    'partner':partner,
                    'assesment_code':assesment_code,
                    'attachement' :attachement
                    }
        },
       "columns":[
                    {"data":"assement_code","searchable":false,"orderable":false},
                    {"data":"project_name","searchable":false,"orderable":false},
                    {"data":"partner","searchable":false,"orderable":false},
                    {"data":"province","searchable":false,"orderable":false},
                    {"data":"district","searchable":false,"orderable":false},
                    {"data":"theme","searchable":false,"orderable":false},
                    {"data":"activity_description","searchable":false,"orderable":false},
                    {"data":"village","searchable":false,"orderable":false},
                    {"data":"staff_organization","searchable":false,"orderable":false},
                    {"data":"date_visit","searchable":false,"orderable":false},
                    {"data":"qb_base","searchable":false,"orderable":false},
                    {"data":"total_qbs","searchable":false,"orderable":false},
                    {"data":"qbs_not_fully_met","searchable":false,"orderable":false},
                    {"data":"qbs_fully_met","searchable":false,"orderable":false},
                    {"data":"qb_not_applicable","searchable":false,"orderable":false},
                    {"data":"score_out","searchable":false,"orderable":false},
                    {"data":"qb_status","searchable":false,"orderable":false},
                    {"data":"attachment","searchable":false,"orderable":false},
                    {"data":"created_at" ,"searchable":false,"orderable":false},
                    {"data":"created_by" ,"searchable":false,"orderable":false},
                    {"data":"action","searchable":false,"orderable":false},
                ]

    });
});

$("#kt_select2_province").change(function () {

    var value = $(this).val();
    csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: 'POST',
        url: '/getDistrict',
        data: {'province': value, _token: csrfToken },
        dataType: 'json',
        success: function (data) {
            $("#kt_select2_district").find('option').remove();
            $("#kt_select2_district").prepend("<option value='' >Select District</option>");
            var selected='';
            $.each(data, function (i, item) {

                $("#kt_select2_district").append("<option value='" + item.district_id + "' "+selected+" >" +
                item.district_name.replace(/_/g, ' ') + "</option>");
            });
            $('#kt_select2_tehsil').html('<option value="">Select Tehsil</option>');
            $('#kt_select2_union_counsil').html('<option value=""> Select UC</option>');

        }

    });

}).trigger('change');

$('.close').click(function() {
    $('#quality_benchmark').modal('hide');
});

flatpickr("#date_visit", {
    mode: "range",
    dateFormat: "Y-m-d",
    maxDate: "today",
    minDate: new Date("2023-10-01"),
});