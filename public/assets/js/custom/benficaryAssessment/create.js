$('#mpca_Date').flatpickr({
    altInput: false,
    dateFormat: "Y-m-d",
    maxDate: "today",
    minDate: new Date().fp_incr(-30), 
});
// Initialize the issuance date picker
// Initialize issuance date picker
$('#cnic_issuance').flatpickr({
    altInput: false,
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            // Get the selected issuance date
            let issuanceDate = selectedDates[0];
            
            // Calculate the minimum expiry date (1 month after issuance)
            let minExpiryDate = new Date(issuanceDate);
            minExpiryDate.setMonth(minExpiryDate.getMonth() + 1);

            // Set minDate for expiry date picker
            $('#cnic_expiry').flatpickr({
                altInput: false,
                dateFormat: "Y-m-d",
                minDate: minExpiryDate,
                onChange: function(expiryDates, expiryDateStr, expiryInstance) {
                    // Check if the expiry date is valid
                    if (expiryDates.length > 0) {
                        let expiryDate = expiryDates[0];
                        
                        if (expiryDate < minExpiryDate) {
                            // Show Swal error if the expiry date is less than minExpiryDate
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Expiry Date',
                                text: 'The expiry date must be at least one month after the issuance date.',
                                confirmButtonText: 'OK'
                            });
                            // Clear the invalid date selection
                            expiryInstance.clear();
                        }
                    }
                }
            }).setDate(null); // Clear any previously selected expiry date
        }
    }
});

// Initialize the expiry date picker separately to set other options
$('#cnic_expiry').flatpickr({
    altInput: false,
    dateFormat: "Y-m-d",
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

$(function () {
    $('[name="date_feedback_referred"]').change(function(){
        var date_recieved_id = $("#date_recieved_id").val();
        var date_feedback_referred =$("#date_feedback_referred").val();
        if(date_feedback_referred >= date_recieved_id) {
            //Do something..

    }
    else{
        swal.fire({
                text: "Sorry, Date Reffered Must be Greater Than Date Recieved.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function () {
                KTUtil.scrollTop();

            // $('#exampleModal').modal('hide');
            // console.log("invalid");
            });
    }

    });
});