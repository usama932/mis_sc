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
$('#date_feedback_referred').flatpickr({
    altInput: false,
    dateFormat: "Y-m-d",
    maxDate: "today",
    minDate: new Date().fp_incr(-90), 
});
$('#date_recieved_id').flatpickr({
    altInput: true,
    dateFormat: "Y-m-d",
    maxDate: "today",
    minDate: new Date().fp_incr(-60), 
});
$(function () {
    $('[name="date_feedback_referred"]').change(function(){

        var date_recieved_id =  document.getElementById("date").innerHTML;
        var originalDateString = $("#date_feedback_referred").val();


        if(originalDateString >= date_recieved_id) {
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