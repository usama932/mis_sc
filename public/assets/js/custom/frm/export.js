
flatpickr("#date_recieved_id", {
    mode: "range",
    dateFormat: "Y-m-d",
    maxDate: "today",
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
            $("#kt_select2_district").prepend("<option value='' >Select District</option><option  value='None'>All</option>");
            var selected='';
            $.each(data, function (i, item) {

                $("#kt_select2_district").append("<option value='" + item.district_id + "' "+selected+" >" +
                item.district_name.replace(/_/g, ' ') + "</option>");
            });
            $('#kt_select2_tehsil').html('<option value="">Select Tehsil</option>');
            $('#kt_select2_union_counsil').html('<option value=""> Select UC</option>');

        }

    });

});
var button = document.querySelector("#btn-submit");
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function () {
    $('#exportid').submit(function (e) {
        e.preventDefault();

        button.setAttribute("data-kt-indicator", "on");
        button.disabled = true;
        $.ajax({
            url: '/getfrm/export',
            type: 'POST',
            data: {
                "_token":csrfToken,
                'name_of_registrar':document.getElementById("name_of_registrar").value,
                'date_received':document.getElementById("date_recieved_id").value,
                'kt_select2_district':document.getElementById("kt_select2_district").value ,
                'kt_select2_province':document.getElementById("kt_select2_province").value ,
                'feedback_channel':document.getElementById("feedback_channel").value ,
                'age_id':document.getElementById("age_id").value , 
                'type_of_client':document.getElementById("type_of_client").value ,
                'project_name':document.getElementById("project_name").value ,
                'status':document.getElementById("status").value
            },
            success: function (response) {
                button.removeAttribute("data-kt-indicator");
                button.disabled = false;
                var blob = new Blob([response]);

                // Create a link element
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                var currentDate = new Date();
                var formattedDate = currentDate.toISOString().slice(0,10); // Format: YYYYMMDD
                var fileName = 'FRM_Tracker_' + formattedDate + '.csv';
                link.download = fileName;

                // Append the link to the document
                document.body.appendChild(link);

                // Trigger a click on the link to start the download
                link.click();

                // Remove the link from the document
                document.body.removeChild(link);

                                    
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
                // Hide loader
                button.removeAttribute("data-kt-indicator");
            }
        });
    });
});