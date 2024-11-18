//Script for Reffered Action
$(document).ready(function () {
    $(".statusid").change(function () {
        var selectedValue = $(this).val(); // Get selected value
        
        if (selectedValue === "Close") {
            $("#actionid").removeClass("d-none").show(); // Show the action div
            $('#action_id').html(`
                <option value="">Select Option</option>
                <option value="Satisfied">Satisfied</option>
                <option value="Partially Satisfied">Partially Satisfied</option>
                <option value="Not Satisfied">Not Satisfied</option>
            `);
        } else if (selectedValue === "Open" || selectedValue === "Select Option") {
            $("#actionid").addClass("d-none").hide(); // Hide the action div
        }
    });
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