var button = document.querySelector("#btn-submit");
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
$(document).ready(function () {
    $('#exportqb').submit(function (e) {
        e.preventDefault();
        button.setAttribute("data-kt-indicator", "on");
        button.disabled = true;
        $.ajax({
            url: '/getqb/export',
            type: 'POST',
            data: {
                "_token":csrfToken,
                'visit_staff_name':document.getElementById("visit_staff_name").value,
                'date_visit':document.getElementById("date_visit").value,
                'kt_select2_district':document.getElementById("kt_select2_district").value ,
                'kt_select2_province':document.getElementById("kt_select2_province").value ,
                'accompanied_by':document.getElementById("accompanied_by").value ,
                'type_of_visit':document.getElementById("type_of_visit").value , 
                'project_type':document.getElementById("project_type").value ,
                'project_name':document.getElementById("project_name").value ,
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
                var fileName = 'QB_Tracker_' + formattedDate + '.csv';
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
$(document).ready(function () {
    $('#exportqbactionpoint').submit(function (e) {
        e.preventDefault();
        button.setAttribute("data-kt-indicator", "on");
        button.disabled = true;
        $.ajax({
            url: '/getactionpoint/export',
            type: 'POST',
            data: {
                "_token":csrfToken,
                'date_visit':document.getElementById("date_visit").value,
               
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
                var fileName = 'QB_ActionPoint_Tracker_' + formattedDate + '.csv';
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