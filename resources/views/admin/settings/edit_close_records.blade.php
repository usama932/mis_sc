<x-default-layout>
    @section('title')
        Closing Records Info
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Closing Info</h3>
                
            </div>
            <div class="card-body">
                <form method="post" action="{{route('close_records.update',$record->id)}}">
                    @csrf
                    @method('put')
                    <div class="row"> 
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">FRM Close Date</span>
                            </label>
                            <input type="text" name="frm_close_date" id="frm_close_date" class="form-control" value="{{$record->frm_close_date}}"/>
                        
                            <div id="frm_close_dateError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">FRM Close Upto</span>
                            </label>
                            <input type="text" name="frm_close_upto" id="frm_close_upto" class="form-control" value="{{$record->frm_close_upto}}"/>
                        
                            <div id="frm_close_upto	Error" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">QB Close Date</span>
                            </label>
                            <input type="text" name="qb_close_date" id="qb_close_date" class="form-control" value="{{$record->qb_close_date}}" />
                        
                            <div id="qb_close_dateeError" class="error-message "></div>
                        </div>
                        <div class="fv-row col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2 d-flex">
                                <span class="required">QB Close Upto</span>
                            </label>
                            <input type="text" name="qb_close_upto" id="qb_close_upto" class="form-control" value="{{$record->qb_close_upto}}" />
                        
                            <div id="qb_close_uptoError" class="error-message "></div>
                        </div>
                        <div class="separator my-3"></div>
                        <div class="text-end">
                            <button type="submit" id="kt_qb_submit" class="btn btn-primary">
                                @include('partials/general/_button-indicator', ['label' => 'Update'])
                            </button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $('#frm_close_date').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d",
            maxDate: new Date().fp_incr(+1),
            minDate: new Date("2023-10-01"),
        });
        $('#frm_close_upto').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d",
            maxDate: new Date().fp_incr(+1),
            minDate: new Date("2023-10-01"),
        });
        $('#qb_close_date').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d",
            maxDate: new Date().fp_incr(+1),
            minDate: new Date("2023-10-01"),
        });
        $('#qb_close_upto').flatpickr({
            altInput: true,
            dateFormat: "Y-m-d",
            maxDate: new Date().fp_incr(+3),
            minDate: new Date("2023-10-01"),
        });
    </script>
@endpush
</x-default-layout>
