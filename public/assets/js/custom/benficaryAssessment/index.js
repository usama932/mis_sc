var csrfToken = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var table = $('#beneficary_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/beneficiaryAssessments", 
            type: 'POST', 
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        },
        columns: [
            { data: 'form_no', name: 'form_no' },
            { data: 'assessment', name: 'assessment' },
            { data: 'project', name: 'project' },
            { data: 'name_of_beneficiary', name: 'name_of_beneficiary' },
            { data: 'gender', name: 'gender' },
            { data: 'age', name: 'age' },
            { data: 'hh_under5_girls', name: 'hh_under5_girls' },
            { data: 'hh_under5_boys', name: 'hh_under5_boys' },
            { data: 'hh_under5_7_girls', name: 'hh_under5_7_girls' },
            { data: 'hh_under5_7_boys', name: 'hh_under5_7_boys' },
            { data: 'hh_above18_girls', name: 'hh_above18_girls' },
            { data: 'hh_above18_boys', name: 'hh_above18_boys' },
        
            { data: 'hh_monthly_income', name: 'hh_monthly_income' },
            { data: 'house_demage', name: 'house_demage' },
            
            { data: 'contact_number', name: 'contact_number' },
          
            { data: 'assessment_officer', name: 'assessment_officer' },
            { data: 'vc_representative_name', name: 'vc_representative_name' },
            { data: 'status', name: 'status' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        order: [[0, 'asc']], 
        pageLength: 10,
        language: {
            search: "_INPUT_", 
            searchPlaceholder: "Search indicators..."
        },
    });
});



document.getElementById('districtloader').style.display = 'none';
$("#provinceId").change(function () {
    document.getElementById('districtloader').style.display = 'block';
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    
    $.ajax({
        type: 'POST',
        url: '/getDistrict',
        data: {'province': value, _token: csrfToken },
        dataType: 'json',
        success: function (data) {
            document.getElementById('districtloader').style.display = 'none';
            $("#districtId").find('option').remove();
            $("#districtId").prepend("<option value='' >Select District</option>");
            var selected='';
            $.each(data, function (i, item) {

                $("#districtId").append("<option value='" + item.district_id + "' "+selected+" >" +
                item.district_name.replace(/_/g, ' ') + "</option>");
            });
            $('#tehsilId').html('<option value="">Select Tehsil</option>');
            $('#ucId').html('<option value=""> Select UC</option>');

        }

    });

});

//get tehsil 
document.getElementById('tehsilloader').style.display = 'none';
$("#districtId").change(function () {
    document.getElementById('tehsilloader').style.display = 'block';
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    $.ajax({
    type: 'POST',
    url: '/getTehsil',
    data: {'district_id': value, _token:csrfToken },
    dataType: 'json',
    success: function (data) {
        document.getElementById('tehsilloader').style.display = 'none';
        $("#tehsilId").find('option').remove();
        $("#tehsilId").prepend("<option value='' >Select Tehsil</option>");
        var selected='';
        $.each(data, function (i, item) {

            $("#tehsilId").append("<option value='" + item.id + "' "+selected+" >" +
            item.tehsil_name.replace(/_/g, ' ') + "</option>");
        });
        $('#ucId').html('<option value="">Select UC</option>');

    }
    });

});

document.getElementById('ucloader').style.display = 'none';
$("#tehsilId").change(function () {
    document.getElementById('ucloader').style.display = 'block';
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    $.ajax({
    type: 'POST',
    url: '/getUnionCouncil',
    data: {'tehsil_id': value, _token:csrfToken },
    dataType: 'json',
    success: function (data) {
        document.getElementById('ucloader').style.display = 'none';
    $("#ucId").find('option').remove();
    $("#ucId").prepend("<option value='' >Select UC</option>");
    var selected='';
    $.each(data, function (i, item) {

        $("#ucId").append("<option value='" + item.union_id + "' "+selected+" >" +
        item.uc_name.replace(/_/g, ' ') + "</option>");
    });


    }
    });

});