<x-default-layout>

    @section("stylesheets")
        <link href="{{asset("assets/plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css" />
    @endsection
    @section('title')
        Feedback Registry Management
    @endsection


    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
           <!--begin::Card-->
           <div class="card">
              <!--begin::Card header-->
              <div class="card-header border-0 pt-6">
                 <!--begin::Card title-->
                 <div class="card-title">
                    <!--begin::Search-->
                    <!--end::Search-->
                 </div>
                 <!--begin::Card title-->
                 <!--begin::Card toolbar-->
                 <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                       <a href="{{route("frm-managements.create")}}" class="btn btn-primary" >Add FRM</a>
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                       <div class="fw-bold me-5">
                          <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                       </div>
                       <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
                    </div>
                    <!--end::Group actions-->
                 </div>
                 <!--end::Card toolbar-->
              </div>
              <!--end::Card header-->
              <!--begin::Card body-->
              <div class="card-body pt-0 overflow-*">
                 <form action="" method="post" id="client_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!--begin: Datatable-->
                    <div class="table-responsive overflow-*">
                        <table class="table table-striped table-bordered nowrap" id="frm" style="width:100%">
                        <thead>
                            <tr>
                                <th>#S.No</th>
                                <th>Name of Registrar</th>
                                <th>Date Recieved</th>
                                <th>Feedback Channel</th>
                                <th>Name</th>
                                <th>Type of Client</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Province</th>
                                <th>District</th>
                                <th>Tehsil</th>
                                <th>Union Council</th>
                                <th>Village</th>
                                <th>PWD/CLWD</th>
                                <th>Client Contact.# </th>
                                <th>Feedback Category</th>
                                <th>Theme</th>
                                <th>Project</th>
                                <th>Date of Reffered</th>
                                <th>Refferal Name</th>
                                <th>Refferal Position</th>
                                <th>Action Taken</th>
                                <th>Status</th>
                                <th>Feedback Summary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                 </form>
                 <!--begin::Table-->
                 <!--end::Table-->
              </div>
              <!--end::Card body-->
           </div>
           <!--end::Card-->
           <!--begin::Modals-->
           <!--begin::Modal - Customers - Add-->
           {{-- <div class="modal fade" id="clientModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                 <div class="modal-content">
                    <div class="modal-header">
                       <h4 class="modal-title" id="myModalLabel">Category Detail</h4>
                       <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-light-primary font-weight-bold" data-bs-dismiss="modal">Close</button>
                    </div>
                 </div>
              </div>
           </div> --}}
           <!--end::Modal - New Card-->
           <!--end::Modals-->
        </div>
        <!--end::Content container-->
    </div>
    @push("scripts")
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset("assets/plugins/custom/datatables/datatables.bundle.js")}}"></script>
    <!--end::Page Vendors-->
    <script>
       $(document).on('click', 'th input:checkbox', function () {

           var that = this;
           $(this).closest('table').find('tr > td:first-child input:checkbox')
               .each(function () {
                   this.checked = that.checked;
                   $(this).closest('tr').toggleClass('selected');
               });
       });
        var frm = $('#frm').DataTable( {
            "order": [
                [1, 'asc']
            ],

            buttons: [
                'csv', 'excel'
            ],
            responsive: true, // Enable responsive mode

            dom: 'Bfrtip',
            "info": false,

            "processing": true,
            "serverSide": true,
            "searchDelay": 500,
            "scrollY": true,
            "responsive": false,
            fixedHeader: true,
           "ajax": {
               "url":"{{route('admin.getFrms')}}",
               "dataType":"json",
               "type":"POST",
               "data":{"_token":"<?php echo csrf_token() ?>"}
           },
           "columns":[
               {"data":"id","searchable":false,"orderable":false},
               {"data":"name_of_registrar" },
               {"data":"date_received","searchable":false,"orderable":false},
               {"data":"feedback_channel" },
               {"data":"name_of_client" },
               {"data":"type_of_client" },
               {"data":"gender" },
               {"data":"age" ,"searchable":false,"orderable":false},
               {"data":"province" },
               {"data":"district" },
               {"data":"tehsil" },
               {"data":"uc" },
               {"data":"village" },
               {"data":"pwd_clwd" },
               {"data":"contact_number" },
               {"data":"feedback_category" },
               {"data":"theme" },
               {"data":"project_name" },
               {"data":"date_ofreferral" ,"searchable":false,"orderable":false},
               {"data":"referral_name" },
               {"data":"referral_position" },
               {"data":"type_ofaction_taken" },
               {"data":"status" },
               {"data":"feedback_summary" },
               {"data":"action","searchable":false,"orderable":false},
           ]
       } );

       function viewInfo(id) {

           var CSRF_TOKEN = '{{ csrf_token() }}';
           $.post("{{ route('admin.getFrm') }}", {_token: CSRF_TOKEN, id: id}).done(function (response) {
               $('.modal-body').html(response);
               $('#clientModel').modal('show');

           });
       }


    </script>
    <!--end::Vendors Javascript-->
    @endpush


</x-default-layout>
