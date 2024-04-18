$("#create_projectprofile").hide();
$("#addprojectprofileBtn").click(function() {

    $("#create_projectprofile").slideToggle();
    $("#project_profile_table").slideToggle();
    $("#cancelprojectprofileBtn").show();
    $(this).hide();
});


$("#cancelprojectprofileBtn").click(function() {
    $("#project_profile_table").slideToggle();
    $("#create_projectprofile").slideToggle();
    $("#addprojectprofileBtn").show(); // Show the other buttons
    $(this).hide(); // Hide the cancel button
});


$("#select2_profile_district").change(function () {
    var value = $(this).val();
    var project = document.getElementById('project_id').value || '';
    csrf_token = $('[name="_token"]').val();
    document.getElementById('tehsilloader').style.display = 'block';
  
    $.ajax({
        type: 'POST',
        url: '/getprofiletehsil',
        data: {'district': value, _token: csrf_token,'project': project },
        dataType: 'json',
        success: function (data) {
            document.getElementById('tehsilloader').style.display = 'none';
            $("#kt_select2_tehsil").empty();
            $("#kt_select2_tehsil").prepend("<option value=''>Select Tehsil</option>");
            $.each(data, function (i, item) {
                $("#kt_select2_tehsil").append("<option value='" + item.id + "'>" +
                    item.tehsil_name.replace(/_/g, ' ') + "</option>");
            });
        }
    });
});

$("#kt_select2_tehsil").change(function () {
    var value = $(this).val();
    var project = document.getElementById('project_id').value || '';
    csrf_token = $('[name="_token"]').val();
    document.getElementById('ucloader').style.display = 'block';
  
    $.ajax({
        type: 'POST',
        url: '/getprofileuc',
        data: {'tehsil': value, _token: csrf_token,'project': project },
        dataType: 'json',
        success: function (data) {
           
            document.getElementById('ucloader').style.display = 'none';
            $("#kt_select2_uc").empty();
            $("#kt_select2_uc").prepend("<option value=''>Select UC</option>");
            $.each(data, function (i, item) {
               
                $("#kt_select2_uc").append("<option value='" + item.union_id + "'>" +
                    item.uc_name.replace(/_/g, ' ') + "</option>");
            });
        }
    });
});

ClassicEditor.create( document.querySelector( '#kt_docs_ckeditor_classic' ) )
.catch( error => {
    console.error( error );
} );