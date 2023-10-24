<x-default-layout>

    @section("stylesheets")
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    @endsection
    @section('title')
     Export Feedback Response Tracker
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-xxl">
           <!--begin::Card-->
            <div class="card">
                <div class="card-title m-5">
                    <h1>FRM Exports  :</h1>
                </div>
                <form id="exportid">
                    @csrf
                    <div class="card-header border-0 pt-6">
                        <div class="row mb-5">
                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Staff Name</span>
                                </label>
                                <select name="name_of_registrar" id="name_of_registrar" aria-label="Select a Registrar Name" data-control="select2" data-placeholder="Select a Registrar Name..." class="form-select form-select-solid" >
                                    <option  value="" selected>Select Option</option>
                                    <option  value="None" >All</option>
                                    <option  value="Abdul Qadeer">Abdul Qadeer</option>
                                    <option  value="Asif Ali">Asif Ali</option>
                                    <option  value="Ejaz Shah">Ejaz Shah</option>
                                    <option  value="Fatima Shahani">Fatima Shahani</option>
                                    <option  value="Irfan Majeed Butt">Irfan Majeed Butt</option>
                                    <option  value="Naeem uddin">Naeem uddin</option>
                                    <option  value="Qaiser Mehmood">Qaiser Mehmood</option>
                                    <option  value="Shahida, Khaskheli">Shahida, Khaskheli</option>
                                    <option  value="Saba Saeed">Saba Saeed</option>
                                    <option  value="Sanam Altaf">Sanam Altaf</option>
                                    <option  value="Shakila Memon">Shakila Memon</option>
                                    <option  value="Tariq Rahim Baig">Tariq Rahim Baig</option>
                                    <option  value="Ruqaiya Bibi" >Ruqaiya Bibi</option>
                                    <option  value="Dr. Kashmala">Dr. Kashmala</option>
                                    <option  value="Mehnaz" >Mehnaz</option>
                                    <option  value="Musarrat Bibi" >Musarrat Bibi</option>
                                    <option  value="Shaista Mir" >Shaista Mir</option>
                                    <option  value="Shama" >Shama</option>
                                    <option  value="Zahid Ali Khan" >Zahid Ali Khan</option>
                                </select>
                            </div>
                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required" >Date Received</span>
                                </label>
                                <input class="form-control form-control-solid" aria-label="Pick date range"  placeholder="Pick date range" id="date_recieved_id" name="date_received" value=""  class="form-control">
                               
                            </div>

                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Feedback Channel</span>
                                </label>
                                <select name="feedback_channel" id="feedback_channel" aria-label="Select a Feedback Channel" data-control="select2" data-placeholder="Select a Feedback Channel..." class="form-select form-select-solid">
                                    <option  value="" selected>Select Option</option>
                                    <option  value="None" >All</option>
                                    <option  >Hotline</option>
                                    <option  >SMS</option>
                                    <option  >Feedback Form</option>
                                    <option  >Email</option>
                                    <option >Field Monitoring</option>
                                    <option  >Post Distribution Monitoring</option>
                                    <option  >Medical Exit Interview</option>
                                    <option >Community meeting</option>
                                </select>
                            </div>
                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Age</span>
                                </label>
                                <select name="age" aria-label="Select a Age" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="age_id" >
                                    <option  value="">Select Option</option>
                                    <option  value="None" >All</option>
                                    <option value="Under 18">Less than 18 years</option>
                                    <option value="19-50 years">19-50 years</option>
                                    <option value="Above 50 years">Above 50 years</option>
                                </select>

                            </div>
                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Status</span>
                                </label>
                                <select name="status" aria-label="Select a Age" data-control="select2" data-placeholder="Select a age..." class="form-select form-select-solid" id="status" >
                                    <option  value="">Select Option</option>
                                    <option  value="None" >All</option>
                                    <option value="Close">Close</option>
                                    <option value="Open">Open</option>
                                   
                                </select>

                            </div>
                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Province</span>
                                </label>
                                <select   name="province" id="kt_select2_province" aria-label="Select a Province" data-control="select2" data-placeholder="Select a Province..." class="form-select form-select-solid">
                                    <option value="" selected>Select Province</option>
                                    <option  value="None" >All</option>
                                    <option value='4'>Sindh</option>
                                    <option value='2'>KPK</option>
                                </select>

                            </div>
                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">District</span>
                                </label>
                                <select id="kt_select2_district" name="district" aria-label="Select a District" data-control="select2" data-placeholder="Select a District..." class="form-select form-select-solid">

                                </select>
                            </div>
                            <div class="col-md-3 my-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Type</span>
                                </label>
                                <select   name="type_of_client" id="type_of_client" aria-label="Select a Type of Client" data-control="select2" data-placeholder="Select a Type of Client..." class="form-select form-select-solid">
                                    <option value="" selected>Select Client</option>
                                    <option  value="None" >All</option>
                                    <option value="Direct Beneficiary">Direct Beneficiary</option>
                                    <option value="Indirect Beneficiary">Indirect Beneficiary</option>
                                    <option value="Non-Beneficiary">Non-Beneficiary</option>
                                    <option value="Partner Staff">Partner Staff</option>
                                    <option value="Save the Children Staff">Save the Children Staff</option>
                                </select>
                            </div>
                            <div class="col-md-3 mt-3">
                                <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Project</span>
                                </label>
                                <select name="project_name" id="project_name" aria-label="Select a Project Name" data-control="select2" data-placeholder="Select a Project Name" class="form-select form-select-solid">
                                    <option value="" selected>Select Theme</option>
                                    <option  value="None" >All</option>
                                    @foreach($projects as $project)
                                    <option value="{{$project->id}}" >{{$project->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-sm mx-auto mb-3" >Export</button>
                    </div>
                    
                </form>
          
            </div>
        </div>

    </div>

    @push("scripts")
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <script>
    
        $('#date_feedback_referred,#date_feedback_referred_id').flatpickr({
            altInput: true,
            dateFormat: "y-m-d",
            maxDate: "today"
		});
        flatpickr("#date_recieved_id", {
            mode: "range",
            dateFormat: "Y-m-d",
            maxDate: "today",
        });
        $("#kt_select2_province").change(function () {

            var value = $(this).val();
            csrf_token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: '/getDistrict',
                data: {'province': value, _token: csrf_token },
                dataType: 'json',
                success: function (data) {
                    $("#kt_select2_district").find('option').remove();
                    $("#kt_select2_district").prepend("<option value='' >Select District</option><option  value='None'>All</option>");
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
        $(document).on({
            ajaxStart: function() {
                $('#loadingModal').modal('show');
            },
            ajaxStop: function() {
                $('#loadingModal').modal('hide');
            }
        });
        $('#exportid').click(function(e){
            e.preventDefault();
            
          
            $.ajax({
                url: "{{ url('getfrm/export') }}",
                type: 'POST',
                data: {_token: csrf_token },
                dataType: 'json',
                success: function(response) {
                    alert('a');
                    console.log(result);
                },
                error: function(error) {
                    $.each(error, function(key, value) {
                        console.log(value);
                    });
                }
            });
        });
    
    </script>
    <!--end::Vendors Javascript-->
    @endpush


</x-default-layout>
