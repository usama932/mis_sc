$('#date_recieved_id,#date_feedback_referred,#date_feedback_referred_id').flatpickr({
    altInput: true,
    dateFormat: "y-m-d",
    maxDate: "today"
});
$(document).on('click', 'th input:checkbox', function () {

   var that = this;
   $(this).closest('table').find('tr td:first-child input:checkbox')
       .each(function () {
           this.checked = that.checked;
           $(this).closest('tr').toggleClass('selected');
       });
});
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var frm = $('#frm').DataTable( {
    "order": [
        [1, 'desc']
    ],
    "processing": true,
    "serverSide": true,
    "searching": true,
    "responsive": false,
    'info': true,
   
   "ajax": {
       "url":"/get-frms",
       "dataType":"json",
       "type":"POST",
       "data":{"_token":csrfToken}
   },
    "columns":[
       {"data":"id","searchable":false,"orderable":false},
       {"data":"response_id" ,"searchable":false,"orderable":false},
       {"data":"name_of_registrar" },
       {"data":"date_received"},
       {"data":"feedback_channel","searchable":false,"orderable":false },
       {"data":"name_of_client"},
       {"data":"type_of_client"},
       {"data":"gender"},
       {"data":"age" },
       {"data":"province","searchable":false,"orderable":false },
       {"data":"district" ,"searchable":false,"orderable":false},
       {"data":"tehsil" ,"searchable":false,"orderable":false},
    //    {"data":"uc" ,"searchable":false,"orderable":false},
    //    {"data":"village","searchable":false,"orderable":false },
    //    {"data":"pwd_clwd","searchable":false,"orderable":false },
       {"data":"client_contact"},
       {"data":"feedback_category","searchable":false,"orderable":false },
       {"data":"theme" ,"searchable":false,"orderable":false},
       {"data":"project_name" ,"searchable":false,"orderable":false},
       {"data":"date_ofreferral" ,"searchable":false,"orderable":false},
       {"data":"referral_name" ,"searchable":false,"orderable":false},
       {"data":"referral_position"  ,"searchable":false,"orderable":false},
       {"data":"type_ofaction_taken" ,"searchable":false,"orderable":false},
       {"data":"status"},
    //  {"data":"feedback_summary" ,"searchable":false,"orderable":false},
       {"data":"update_response" ,"searchable":false,"orderable":false},
       {"data":"action","searchable":false,"orderable":false},
   ]
});


$("#response_id,#date_recieved_id,#kt_select2_district,#kt_select2_province,#feedback_channel,#name_of_registrar,#name_of_client,#gender,#type_of_client,#project_name,#feedback_category").change(function () {
    var table = $('#frm').DataTable();
    table.destroy();
    var name_of_registrar = document.getElementById("name_of_registrar").value ?? '1';
    var date_received = document.getElementById("date_recieved_id").value
    var kt_select2_district = document.getElementById("kt_select2_district").value ?? '1';
    var kt_select2_province = document.getElementById("kt_select2_province").value ?? '1';
    var feedback_channel = document.getElementById("feedback_channel").value ?? '1';
    var name_of_client = document.getElementById("name_of_client").value ?? '1';
    var type_of_client = document.getElementById("type_of_client").value ?? '1';
    var project_name = document.getElementById("project_name").value ?? '1';
    var response_id = document.getElementById("response_id").value ?? '1';
    var gender = document.getElementById("gender").value ?? '1';
    var feedback_category = document.getElementById("feedback_category").value ?? '1';
    
    var clients = $('#frm').DataTable( {
        "order": [
            [1, 'asc']
        ],

        responsive: false, // Enable responsive mode
        "info": true,
        filter: true,
        "processing": true,
        "serverSide": true,
        "searching": true,
        
       "ajax": {
            "url":"/get-frms",
            "dataType":"json",
            "type":"POST",
            "data":{"_token":csrfToken,
                    'name_of_registrar':name_of_registrar,
                    'date_received':date_received,
                    'kt_select2_district':kt_select2_district,
                    'kt_select2_province':kt_select2_province,
                    'feedback_channel':feedback_channel,
                    'name_of_client':name_of_client,
                    'type_of_client':type_of_client,
                     'project_name':project_name,
                    'response_id':response_id,
                    'gender':gender,
                    'feedback_category':feedback_category
                    }
        },
        "columns":[
                    {"data":"id","searchable":false,"orderable":false},
                    {"data":"response_id" ,"searchable":false,"orderable":false},
                    {"data":"name_of_registrar" },
                    {"data":"date_received","searchable":false,"orderable":false},
                    {"data":"feedback_channel","searchable":false,"orderable":false },
                    {"data":"name_of_client"},
                    {"data":"type_of_client"},
                    {"data":"gender"},
                    {"data":"age" },
                    {"data":"province","searchable":false,"orderable":false },
                    {"data":"district" ,"searchable":false,"orderable":false},
                    {"data":"tehsil" ,"searchable":false,"orderable":false},
                    // {"data":"uc" ,"searchable":false,"orderable":false},
                    // {"data":"village","searchable":false,"orderable":false },
                    // {"data":"pwd_clwd","searchable":false,"orderable":false },
                    {"data":"client_contact"},
                    {"data":"feedback_category","searchable":false,"orderable":false },
                    {"data":"theme" ,"searchable":false,"orderable":false},
                    {"data":"project_name" ,"searchable":false,"orderable":false},
                    {"data":"date_ofreferral" ,"searchable":false,"orderable":false},
                    {"data":"referral_name"},
                    {"data":"referral_position" },
                    {"data":"type_ofaction_taken" ,"searchable":false,"orderable":false},
                    {"data":"status"},
                    //  {"data":"feedback_summary" ,"searchable":false,"orderable":false},
                    {"data":"update_response" ,"searchable":false,"orderable":false},
                    {"data":"action","searchable":false,"orderable":false},
                ]

    });
});
$('#date_recieved_id').flatpickr({
    altInput: true,
    mode: "range",
    maxDate: "today",
    dateFormat: "Y-m-d",
 
});
$("#kt_select2_province").change(function () {

    var value = $(this).val();
    csrf_token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        type: 'POST',
        url: '/getDistrict',
        data: {'province': value, _token: csrf_token },
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