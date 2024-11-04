$('#mpca_Date').flatpickr({
    altInput: false,
    dateFormat: "Y-m-d",
    maxDate: "today",
    minDate: new Date().fp_incr(-30), 
});
$('#cnic_issuance').flatpickr({
    altInput: false,
    dateFormat: "Y-m-d",
   // maxDate: "today",
   // minDate: "today", 
});
$('#cnic_expiry').flatpickr({
    altInput: false,
    dateFormat: "Y-m-d",
    //maxDate: "today",
   // minDate: "today", 
});
var csrfToken = $('meta[name="csrf-token"]').attr('content');


//get district cascade province
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

