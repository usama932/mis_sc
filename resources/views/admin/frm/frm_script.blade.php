<script>
    $(document).ready(function(){
        $(".genderit").change(function(){

            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");

                if(optionValue == "Girl" || optionValue == "Boy"){
                    $('#age_id').html('<option value="">Select Age</option>\<option value="Less than 18 years">Less than 18 years</option>');

                }else if(optionValue == "Male" || optionValue == "Female")
                {
                    $('#age_id').html('<option value="">Select Age</option>\<option value="19-50 years">19-50 years</option>\<option value="Above 50 years">Above 50 years</option>');
                }
                else{
                    $(".box").hide();
                }
            });
        }).change();
    });
    //script for select Allow to Contact
    $(document).ready(function(){
        $('.contact_id').click(function(){

            var demo = $(this).val();
            if(demo == "Yes"){
                $(".contact_div").show();
            }
            else{
                $(".contact_div").hide();
            }
        });
    });
    //script for select Category and datix
    $(document).ready(function(){
        $(".categoryit").change(function(){

            $(this).find("option:selected").each(function(){
                var optionValue = $(this).val();

                var test = "6";
                var test1 ="7";



                if(optionValue == test || optionValue == test1){

                    $("#show_datix").show();
                }
                else{
                    $("#show_datix").hide();
                }
            });
        }).change();
    });
    //Script for Reffered share
    $(document).ready(function(){
        $(".shareid").change(function(){

            $(this).find("option:selected").each(function(){
                var optionValue = $(this).val();

                var test = "Yes";
                var test1 ="No";

                if(optionValue == test ){

                    $(".yes_divs").show();
                    $(".no_divs").hide();
                }
                else if(optionValue == test1){
                    $(".yes_divs").hide();
                    $(".no_divs").show();
                }
                else{
                    $(".yes_divs").hide();
                    $(".no_divs").hide();
                }
            });
        }).change();
    });
    //Script for Reffered Action
    $(document).ready(function(){
        $(".statusid").change(function(){

            $(this).find("option:selected").each(function(){
                var optionValue = $(this).val();

                var test  = "Open";
                var test1 = "Close";

                if(optionValue == test1 ){

                    $(".actionid").show();
                    $('#action_id').html('<label class="font-weight-bold">Action Taken</label>\
                    \<select class="form-control " name="actiontaken_closingloop_id">\
                        \<option value="">Select Option</option>\
                        \<option>Satisfied</option>\
                        \<option>Partially Satisfied</option>\
                        \<option>Not Satisfied</option>\
                    \</select>');
                }
                else if(optionValue == test){
                    $(".actionid").hide();

                }
                else{
                    $(".actionid").hide();
                }
            });
        }).change();
    });

    //flatpicker for date
    $('#date_feedback_referred,#date_feedback_referred_id').flatpickr({
        altInput: true,
        dateFormat: "y-m-d",
        maxDate: "today",
        minDate: new Date().fp_incr(-60), 
    });
    $('#date_recieved_id').flatpickr({
        altInput: true,
        dateFormat: "y-m-d",
        maxDate: "today",
        minDate: new Date().fp_incr(-60), 
    });
    //script for province, district,tehisl and uc
    ///get district cascade province
    $("#kt_select2_province").change(function () {
        function showLoader() {
            $("#loader").show();
        }

        // Function to hide the loader
        function hideLoader() {
            $("#loader").hide();
        }
        var value = $(this).val();
        csrf_token = $('[name="_token"]').val();
        showLoader();
        $.ajax({
            type: 'POST',
            url: '/getDistrict',
            data: {'province': value, _token: csrf_token },
            dataType: 'json',
            success: function (data) {
                hideLoader();
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

    $("#kt_select2_district").change(function () {

        var value = $(this).val();
        csrf_token = $('[name="_token"]').val();
        $.ajax({
        type: 'POST',
        url: '/getTehsil',
        data: {'district_id': value, _token: csrf_token },
        dataType: 'json',
        success: function (data) {
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

    }).trigger('change');
    $("#kt_select2_tehsil").change(function () {

        var value = $(this).val();
        csrf_token = $('[name="_token"]').val();
        $.ajax({
        type: 'POST',
        url: '/getUnionCouncil',
        data: {'tehsil_id': value, _token: csrf_token },
        dataType: 'json',
        success: function (data) {
        $("#kt_select2_union_counsil").find('option').remove();
        $("#kt_select2_union_counsil").prepend("<option value='' >Select UC</option>");
        var selected='';
        $.each(data, function (i, item) {

            $("#kt_select2_union_counsil").append("<option value='" + item.union_id + "' "+selected+" >" +
            item.uc_name.replace(/_/g, ' ') + "</option>");
        });


        }
        });

    }).trigger('change');

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
</script>
