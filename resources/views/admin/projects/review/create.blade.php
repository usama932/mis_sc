    <x-nform-layout>
        @section('title')
        Review Meetings
        @endsection
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="card-toolbar d-flex justify-content-end">
                {{-- @can('create projects_review')
                    <a href="{{ route('projectreviews.create') }}" class="btn btn-primary btn-sm font-weight-bolder">
                        <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>Add Review Meeting
                    </a>
                @endcan --}}
            </div>
        
            <div class="card">
                <form action="{{route('projectreviews.store')}}" method="post" id="create_projectreview" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$id}}">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Review Meeting Title</span></label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Review Date</span>
                                    </label>
                                    <input type="text" class="form-control" id="review_date" name="review_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Responsible Person</span></label>
                                        <select class="form-select form-control" id="responsible_person" name="responsible_person" aria-label="Select a Responsible person" data-control="select2" data-placeholder="Select a  Responsible person..." class="form-select form-control"  data-allow-clear="true" >
                                            <option value="">Select Responsible</option>
                                            @foreach($persons as $person)
                                                <option value="{{$person->id}}">{{$person->name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Action Agreed</span></label>
                                        <select class="form-select form-control" id="action_agreed" name="action_agreed"  aria-label="Select a Action agreed" data-control="select2" data-placeholder="Select Action Agree..." class="form-select form-control"  data-allow-clear="true" >
                                            <option value="">Select Action</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Deadline</span></label>
                                    <input type="text" class="form-control" id="deadline" name="deadline">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Status</span></label>
                                        <select class="form-select form-control" id="status" name="status" aria-label="Select a Status" data-control="select2" data-placeholder="Select Status..." class="form-select form-control"  data-allow-clear="true" >
                                            <option value="">Select Status</option>
                                            <option value="Initiated">Initiated</option>
                                            <option value="Completed">Completed</option>
                                            <option value="In Process">In Process</option>
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="fv-row form-group">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">DIP Identified</span></label>
                                    <textarea class="form-control" rows="1" id="dip_identified" name="dip_identified" rows="3"></textarea>
                                </div>
                            </div>
                        
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" id="kt_create_projectreview" class="btn btn-success btn-sm  m-3">
                                @include('partials/general/_button-indicator', ['label' => 'Submit'])
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </x-nform-layout>
