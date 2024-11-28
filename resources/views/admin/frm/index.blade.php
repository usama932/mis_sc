<x-default-layout>

    @section('title')
    FRM List
    @endsection
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
    
        <div class="card">
            <div class="card-title m-5">
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-success  p-5 rounded">
                            <h1 class="m-5">Total FRM =>
                            
                                {{$total_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-primary p-5 rounded">
                            <h1 class="m-5">Open FRM =>
                            
                                {{$open_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning p-5 rounded">
                            <h1 class="m-5">Close FRM =>
                            
                                {{$close_frm ?? ''}}
                            </h1>
                        </div>
                    </div>
                </div>
             
            </div>
            
            <div class="card mb-4">
                @include('admin.frm.partials.filter_index')
            </div>
           
            <div class="card-body pt-0 overflow-*">
                <div class="card-toolbar m-5 d-flex justify-content-end">   
                    @can('create feedback registry')
                   <!--begin::Button-->
                       <a href="{{ route('frm-managements.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                           <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                               <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                   <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                       <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                       <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                                   </g>
                               </svg>
                           </span>Add Feedback/Complaint
                       </a>
                       <!--end::Button-->
                   @endcan
                </div>   
                <div class="table-responsive overflow-*">
                    <table class="table table-striped table-bordered nowrap" id="frm" style="width:100%">
                    <thead>
                        <tr>
                            <th>#S.No</th>
                            <th>Response.#</th>
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
                            {{-- <th>Union Council</th>
                            <th>Village</th>
                            <th>PWD/CLWD</th> --}}
                            <th>Client Contact.# </th>
                            <th>Feedback Category</th>
                            <th>Theme</th>
                            <th>Project</th>
                            <th>Date of Reffered</th>
                            <th>Refferal Name</th>
                            <th>Refferal Position</th>
                            <th>Satisfaction</th>
                            <th>Status</th>
                            {{-- <th>Feedback Summary</th> --}}
                            <th>Update Response</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push("scripts")

    @endpush


</x-default-layout>
