<x-nform-layout>
    @section('title')
        Add Indicator Activities
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="{{route('indicators.addActivityForm')}}" method="post" id="create_indicator_activities" enctype="multipart/form-data" data-kt-redirect-url="{{ route('indicators.index') }}">
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <div class="fv-row col-md-12">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Project</span>
                            </label>
                            <select name="projectId" id="projectId" class="form-select" data-control="select2" data-placeholder="Select Project"  data-allow-clear="true">
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row col-md-4">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Indicators</span>
                            </label>
                            <select name="indicatorId" id="indicatorId" class="form-select" size="10" data-placeholder="Select Indicators"   data-control="select"  data-allow-clear="true"
                                style="height: 60px !important; padding: 10px !important; font-size: 16px !important; border-radius: 8px !important; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important; cursor: pointer !important;">
                            
                          
                            </select>
                        </div>
                        <div class="fv-row col-md-1 text-center">
                            <i class="fa fa-angle-double-right mt-8" aria-hidden="true" style="font-size:48px;color:red"></i>
                        </div>
                        <div class="fv-row col-md-7">
                            <label class="fs-6 fw-semibold form-label">
                                <span class="required">Activities</span>
                            </label>
                            <select name="activities[]" multiple id="activities" size="10"  class="form-select  " data-control="select" data-placeholder="Select Activities"  data-allow-clear="true">
                                <option value="">Select Activities</option>
                              
                            </select>
                        </div>
                    </div>  
                </div>
                
                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary m-3" id="kt_create_indicator_activities">
                        @include('partials/general/_button-indicator', ['label' => 'Submit'])
                    </button>
                </div>
            </form>
        </div>
    </div>


</x-nform-layout>
