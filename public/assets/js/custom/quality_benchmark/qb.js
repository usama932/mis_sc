

document.getElementById('districtloader').style.display = 'none';
$("#kt_select2_province").change(function () {
   
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    document.getElementById('districtloader').style.display = 'block';
    $.ajax({
        type: 'POST',
        url: '/getDistrict',
        data: {'province': value, _token: csrf_token },
        dataType: 'json',
        success: function (data) {
            document.getElementById('districtloader').style.display = 'none';
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

});
document.getElementById('tehsilloader').style.display = 'none';
$("#kt_select2_district").change(function () {
    document.getElementById('tehsilloader').style.display = 'block';
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    $.ajax({
    type: 'POST',
    url: '/getTehsil',
    data: {'district_id': value, _token: csrf_token },
    dataType: 'json',
    success: function (data) {

        document.getElementById('tehsilloader').style.display = 'none';
        $("#kt_select2_tehsil").find('option').remove();
        $("#kt_select2_tehsil").prepend("<option value='' >Select Tehsil</option>");
        var selected='';
        $.each(data, function (i, item) {

            $("#kt_select2_tehsil").append("<option value='" + item.id + "' "+selected+" >" +
            item.tehsil_name.replace(/_/g, ' ') + "</option>");
        });
        $('#kt_select2_union_counsil').html('<option value="">Select UC</option>');

    }
    });

});
document.getElementById('ucloader').style.display = 'none';
$("#kt_select2_tehsil").change(function () {
    document.getElementById('ucloader').style.display = 'block';
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    $.ajax({
    type: 'POST',
    url: '/getUnionCouncil',
    data: {'tehsil_id': value, _token: csrf_token },
    dataType: 'json',
    success: function (data) {
    document.getElementById('ucloader').style.display = 'none';
    $("#kt_select2_union_counsil").find('option').remove();
    $("#kt_select2_union_counsil").prepend("<option value='' >Select UC</option>");
    var selected='';
    $.each(data, function (i, item) {

        $("#kt_select2_union_counsil").append("<option value='" + item.union_id + "' "+selected+" >" +
        item.uc_name.replace(/_/g, ' ') + "</option>");
    });


    }
    });

});

//select QB met
$(document).ready(function(){
    $(".qb_id").change(function(){

        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");

            if(optionValue == "Not Fully Met"){
                $('#gap_id').show();

            }else if(optionValue == "Fully Met")
            {
                $('#gap_id').hide();
            }
            else{
                $('#gap_id').hide();
            }
        });
    }).change();
});
  //select agree_id
$(document).ready(function(){
    $(".agree_id").change(function(){

        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");

            if(optionValue == "Yes"){
                $('.action_agree_id').show();

            }else if(optionValue == "No")
            {
                $('.action_agree_id').hide();
            }
            else{
                $('.action_agree_id').hide();
            }
        });
    }).change();
});

document.getElementById('projectloader').style.display = 'none';
$("#project_name").change(function () {
   
    var value = $(this).val();
    csrf_token = $('[name="_token"]').val();
    document.getElementById('projectloader').style.display = 'block';
    $.ajax({
        type: 'POST',
        url: '/getproject_type',
        data: {'project_name': value, _token: csrf_token },
        dataType: 'json',
        success: function (data) {
            document.getElementById('projectloader').style.display = 'none';
            $("#project_type").val(data.type.replace(/_/g, ' '));
           
        }

    });

});

document.getElementById('ploader').style.display = 'none';
$('#project_name').on('change', function() {
    let projectId = $(this).val();
    
    let csrf_token = $('[name="_token"]').val();
    document.getElementById('ploader').style.display = 'block';

    $.ajax({
        url: '/getProjectActivities', // Route to the controller
        type: 'POST',
        data: { projectId: projectId, _token: csrf_token },
        success: function(response) {
            document.getElementById('ploader').style.display = 'none';
            
            // Clear previous options
            $('#dip_activity_id').empty();
            
            // Check if activities exist
            if (response.activities && response.activities.length > 0) {
                // Populate options
                $.each(response.activities, function(key, activity) {
                    $('#dip_activity_id').append(
                        `<option value="">Select Activity</option><option value="${activity.id}">${activity.activity_number} - ${activity.activity_title}</option>`
                    );
                });
                // Enable the dropdown and make the label required
                $('#dip_activity_id').prop('disabled', false);
                $('label[for="kt_select2_union_counsil"] .required').show(); // Show required label
            } else {
                // Display "No activities" and disable the field
                $('#dip_activity_id').append('<option>No activities</option>');
                $('#dip_activity_id').prop('disabled', true);
                $('span .required').hide(); // Hide required label
            }
        },
        error: function(xhr) {
            console.error(xhr.responseText);
        }
    });
});





$("#type_of_visit").change(function(){
    
    $(this).find("option:selected").each(function(){
        
        var optionValue = $(this).attr("value");

        if(optionValue == "Independent"){
            $('#accompanied_by').html('<option value="">Select Age</option>\<option  value="NA">NA</option>');

        }else if(optionValue == "Joint" )
        {
            $('#accompanied_by').html('<option value="">Select Age</option>\<option value="Project Staff">Project Staff</option>\<option value="Govt Officials">Govt Officials</option>\<option  value="Donor">Donor</option>');
        }
        else{
            $('#accompanied_by').html('<option value="">Select Age</option>');
        }
       
    });
});
