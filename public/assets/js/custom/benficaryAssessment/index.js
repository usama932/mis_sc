$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    var table = $('#beneficary_list').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/beneficiaryAssessments", 
            type: 'POST', 
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
        },
        columns: [
            { data: 'form_no', name: 'form_no' },
            { data: 'assessment', name: 'assessment' },
            { data: 'project', name: 'project' },
            { data: 'hh_under5_girls', name: 'hh_under5_girls' },
            { data: 'hh_under5_boys', name: 'hh_under5_boys' },
            { data: 'hh_under5_7_girls', name: 'hh_under5_7_girls' },
            { data: 'hh_under5_7_boys', name: 'hh_under5_7_boys' },
            { data: 'hh_above18_girls', name: 'hh_above18_girls' },
            { data: 'hh_above18_boys', name: 'hh_above18_boys' },
            { data: 'name_of_beneficiary', name: 'name_of_beneficiary' },
            { data: 'gender', name: 'gender' },
            { data: 'age', name: 'age' },
            { data: 'hh_monthly_income', name: 'hh_monthly_income' },
            { data: 'house_demage', name: 'house_demage' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'cash_assistance', name: 'cash_assistance' },
            { data: 'assessment_officer', name: 'assessment_officer' },
            { data: 'vc_representative_name', name: 'vc_representative_name' },
            { data: 'status', name: 'status' },
            { data: 'created_by', name: 'created_by' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        order: [[0, 'asc']], 
        pageLength: 10,
        language: {
            search: "_INPUT_", 
            searchPlaceholder: "Search indicators..."
        },
    });
});
