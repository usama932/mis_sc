var activity_id = document.getElementById("dip_activity").value ;
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
var activityQuarters = $('#activityQuarters').DataTable({
    "order": [[1, 'desc']],
    // "dom": 'lfBrtip',
    // buttons: [{
    //     extend: 'csv',
    //     customize: function (csv) {
    //         // Add additional rows to CSV export
    //         var additionalInfo = $('#additionalInfo').html();
    //         csv = additionalInfo + csv;
    //         return csv;
    //     }
    // },
    // {
    //     extend: 'excel',
    //     customize: function (xlsx) {
    //         // Add additional rows to Excel export
    //         var additionalInfo = $('#additionalInfo').html();
    //         $(xlsx).find('worksheet:first').prepend(additionalInfo);
    //     }
    // }],
    "responsive": true, // Enable responsive mode
    "processing": true,
    "serverSide": true,
    "searching": false,
    "bLengthChange": false,
    "bInfo" : false,
    "responsive": false,
    "info": false,   
    "ajax": {
        "url":"/activity_Quarters",
        "dataType":"json",
        "type":"POST",
        "data":{"_token":csrfToken,
                "activity_id":activity_id
        }
    },
    "columns":[
        {"data":"quarter","searchable":false,"orderable":false},
        {"data":"activity_target","searchable":false,"orderable":false},
        {"data":"activity_acheive","searchable":false,"orderable":false},
        {"data":"benefit_target","searchable":false,"orderable":false},
        {"data":"women_target","searchable":false,"orderable":false},
        {"data":"men_target","searchable":false,"orderable":false},
        {"data":"girls_target","searchable":false,"orderable":false},
        {"data":"boys_target","searchable":false,"orderable":false},
        {"data":"pwd_target","searchable":false,"orderable":false},
        {"data":"status","searchable":false,"orderable":false},
        {"data":"remarks","searchable":false,"orderable":false},
        {"data":"action","searchable":false,"orderable":false},
    ]
});


$(document).ready(function() {
    $('.submitButton').click(function(e) {
        e.preventDefault();
    
        // Perform validation
        var donor = $('.donor').val();
        if (!donor) {
            $('#donorError').text('Please select a donor');
            return;
        } else {
            $('#donorError').text('');
        }
        // var remarks = $('.remarks').val();
        // if (!remarks) {
        //     $('#remarksError').text('Please add Remarks');
        //     return;
        // } else {
        //     $('#remarksError').text('');
        // }
        // Submit the form using AJAX
        $.ajax({
            url: $('.update_quarter_status_form').attr('action'),
            type: 'Post',
            data: $('.update_quarter_status_form').serialize(),
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
        });
    });
});