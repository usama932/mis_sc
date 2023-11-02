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
