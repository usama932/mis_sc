$(function () {
    $('[name="date_feedback_referred"]').change(function(){

        var date_recieved_id =  document.getElementById("date").innerHTML;
        var originalDateString = $("#date_feedback_referred").val();

        var parts = originalDateString.split('-');

        var originalDate = new Date('20' + parts[0], parts[1] - 1, parts[2]);

        var date_feedback_referred = originalDate.getFullYear() + '-' + ('0' + (originalDate.getMonth() + 1)).slice(-2) + '-' + ('0' + originalDate.getDate()).slice(-2);

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
