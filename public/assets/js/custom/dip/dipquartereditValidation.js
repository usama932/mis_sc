var activity_id = document.getElementById("dip_activity").value ;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


$(document).ready(function() {
    $('.submiteditButton').click(function(e) {
        e.preventDefault();
    
        // Perform validation
        var activity_target = $('.activity_target').val();
        if (!activity_target) {
            $('#activity_targetError').text('Please select a activity target').css('color', 'red');;
            return;
        } else {
            $('#activity_targetError').text('');
        }
        
        var women_target = $('.women_target').val();
        if (!women_target) {
            $('#women_targetError').text('Please select a women target').css('color', 'red');;
            return;
        } else {
            $('#women_targetError').text('');
        }

        var men_target = $('.men_target').val();
        if (!men_target) {
            $('#men_targetError').text('Please select a men target').css('color', 'red');;
            return;
        } else {
            $('#men_targetError').text('');
        }

        var girls_target = $('.girls_target').val();
        if (!girls_target) {
            $('#girls_targetError').text('Please select a girls target').css('color', 'red');
            return;
        } else {
            $('#girls_targetError').text('');
        }

        var boys_target = $('.boys_target').val();
        if (!boys_target) {
            $('#boys_targetError').text('Please select a boys target').css('color', 'red');;
            return;
        } else {
            $('#boys_targetError').text('');
        }
        alert
        $.ajax({
            url: $('.edit_quarter_status_form').attr('action'),
            type: 'Post',
            data: $('.edit_quarter_status_form').serialize(),
            beforeSend: function() {
                $('.loadingSpinner').show();
            },
            success: function(response) {
                if(response){
                    toastr.options = {
                        "closeButton": false,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    activityQuarters.ajax.reload(null, false).draw(false);
                    $('.loadingSpinners').hide();
                    $('.project_theme_modal').modal('hide');
                    $('.loadingSpinner').hide();
                    toastr.success("Activity Quarter Status Updated", "Success");
                }
            },
            error: function(xhr) {
                // Handle errors
                
                if(xhr){
                    toastr.options = {
                        "closeButton": false,
                        "debug": true,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.error(xhr.responseText, "Error occurred");
                }
            },
            complete: function() {
                $('.loadingSpinner').hide();
            }
        // });
    });
    });
});