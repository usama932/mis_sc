<x-nform-layout>
    @section('title')
    Learning Logs
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row ">
            <div class="col-md-2 col-sm-3 col-xs-3">
                <!--begin::Card widget 11-->
                <div class="card card-flush h-xl-100" style="background-color: #F6E5CA">
                    <!--begin::Body-->
                    <div class="card-body    pt-5">
                    <!--begin::Section-->
                    <div class="text-start">            
                        <span class="d-block fw-bold fs-1 text-gray-800">{{$totallogs ?? ''}}</span>
                        <span class="mt-1 fw-semibold fs-9" style="color: ">Total Learning Logs</span>
                    </div>
                    <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
            </div>
            <div class="col-md-2  col-sm-3 col-xs-3">
                <!--begin::Card widget 11-->
                <div class="card card-flush h-xl-100" style="background-color: #BFDDE3">
                    <!--begin::Body-->
                    <div class="card-body text-center pt-5">
                    <!--begin::Section-->
                    <div class="text-start">            
                        <span class="d-block fw-bold fs-1 text-gray-800">{{$totalassesment  ?? ''}}</span>
                        <span class="mt-1 fw-semibold fs-7" style="color: ">Assessment</span>
                    </div>
                    <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
            </div>
            <div class="col-md-2  col-sm-3 col-xs-3">
                <!--begin::Card widget 11-->
                <div class="card card-flush h-xl-100" style="background-color: #BFDDE3">
                    <!--begin::Body-->
                    <div class="card-body text-center pt-5">
                    <!--begin::Section-->
                    <div class="text-start">            
                        <span class="d-block fw-bold fs-1 text-gray-800">{{$totalResearch  ?? ''}}</span>
                        <span class="mt-1 fw-semibold fs-9" style="color: ">Research Study</span>
                    </div>
                    <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
            </div>
            <div class="col-md-2   col-sm-3 col-xs-3">
                <!--begin::Card widget 11-->
                <div class="card card-flush h-xl-100" style="background-color: #BFDDE3">
                    <!--begin::Body-->
                    <div class="card-body text-center pt-5">
                    <!--begin::Section-->
                    <div class="text-start">            
                        <span class="d-block fw-bold fs-1 text-gray-800">{{$totalEvaluation  ?? ''}}</span>
                        <span class="mt-1 fw-semibold fs-7" style="color: ">Evaluation</span>
                    </div>
                    <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
            </div>
            <div class="col-md-2   col-sm-3 col-xs-3">
                <!--begin::Card widget 11-->
                <div class="card card-flush h-xl-100" style="background-color: #BFDDE3">
                    <!--begin::Body-->
                    <div class="card-body text-center pt-5">
                    <!--begin::Section-->
                    <div class="text-start">            
                        <span class="d-block fw-bold fs-1 text-gray-800">{{$totalPDM  ?? ''}}</span>
                        <span class="mt-1 fw-semibold fs-7" style="color: ">PDM</span>
                    </div>
                    <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
            </div>
            <div class="col-md-2   col-sm-3 col-xs-3">
                <!--begin::Card widget 11-->
                <div class="card card-flush h-xl-100" style="background-color: #BFDDE3">
                    <!--begin::Body-->
                    <div class="card-body text-center pt-5">
                    <!--begin::Section-->
                    <div class="text-start">            
                        <span class="d-block fw-bold fs-1 text-gray-800">{{$totalSurvey  ?? ''}}</span>
                        <span class="mt-1 fw-semibold fs-7" style="color: ">Survey</span>
                    </div>
                    <!--end::Section-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card widget 11-->
            </div>
        </div>
       
        <div class="card-toolbar  justify-content-between mt-4">
            <div class="row">
                <div class="col-md-4 ">
                    <select  name="project" id="project" aria-label="Search Project" data-control="select2" data-placeholder="Search Project" class="form-select"  data-allow-clear="true" >
                    <option value="">Search Project </option>
                    @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col-md-4 ">
                    <select name="research_type" id="research_type" aria-label="Search Research Type" data-control="select2" data-placeholder="Search Research Type" class="form-select form-control"  data-allow-clear="true" >
                        <option value="" >Search Research Type</option>
                        <option value="Assessment" >Assessment</option>
                        <option value="Evaluation">Evalution</option>
                        <option value="Learning PPT">Learning PPT</option>
                        <option value="Learning Briefer">Learning Briefer</option>
                        <option value="PDM">PDM</option>
                        <option value="Research Study">Research Study</option>
                        <option value="Survey Report">Survey Report</option>
                        <option value="Reports">Reports</option>
                    </select>
                </div>
                <div class="col-md-4 ">
                    <select name="theme" id="theme" class="form-select form-control" data-control="select2" data-placeholder="Select an Search" data-allow-clear="true">
                    <option value="" >Search Theme</option>
                    @foreach($themes as $theme)
                    <option value="{{$theme->id}}" >{{$theme->name}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        @include('admin.learninglogs.search')
      
       {{ $logs->links('pagination::bootstrap-5') }} 
    </div>
    <div class="modal fade" id="quality_benchmark" data-backdrop="static" tabindex="1" role="dialog"
       aria-labelledby="staticBackdrop" aria-hidden="true">
       <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content ">
             <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="quality_benchmark">Quality Bench Detail</h4>
             </div>
             <div class="modal-body"></div>
             <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold close"
                   data-dismiss="modal">Close</button>
             </div>
          </div>
       </div>
    </div>
    @push("scripts")
    <script>
       function del(id) {
           Swal.fire({
               title: "Are you sure?",
               text: "You won't be able to revert this!",
               icon: "warning",
               showCancelButton: true,
               confirmButtonText: "Yes, delete it!"
           }).then(function(result) {
               if (result.value) {
                   Swal.fire(
                       "Deleted!",
                       "Your Learning Log has been deleted.",
                       "success"
                   );
                   var APP_URL = {!! json_encode(url('/')) !!}
                   window.location.href = APP_URL + "/learninglog/delete/" + id;
               }
           });
       }
       
       
    </script>
    <script>
       $(document).ready(function () {
           $('#research_type, #theme, #project').on('change', function () {
               KTApp.showPageLoading();
               var researchType =  $('#research_type').val();
               var theme = $('#theme').val();
               var project = $('#project').val();
               $.ajax({
                   type: 'post',
                   url: '{{ route("learninglog.search") }}',
                   data: {
                       '_token': '{{ csrf_token() }}',
                       'research_type': researchType,
                       'theme': theme,
                       'project': project
                   },
                   success: function (data) {
                       KTApp.hidePageLoading();
                       $('#researchResults').html(data);
                   },
                   error: function (xhr, status, error) {
                       // Handle errors
                       console.error(xhr.responseText);
                   }
               });
           });
       });
       
    </script>
    <!--end::Vendors Javascript-->
    @endpush
 </x-nform-layout>