<x-default-layout>
    @section('title')
        Closing Records Info
    @endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <div class="container">
                <div class="justify-content-end d-flex m-5">
                    <a href="{{ route('close_records.edit',$record->id) }}" class="btn btn-primary btn-sm font-weight-bolder">
                        <span class="svg-icon svg-icon-primary svg-icon-1x mx-1">
                            <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect fill="#FFFFFF" x="4" y="11" width="16" height="2" rx="1"/>
                                    <rect fill="#FFFFFF" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)" x="4" y="11" width="16" height="2" rx="1"/>
                                </g>
                            </svg>
                        </span>Update Info
                    </a> 
                </div>
                <div class="row justify-content-center mt-5">
                    
                    <div class="col-md-8">
                      
                        <table class="table table-striped p-auto text-center">
                            <tr>
                                <td><strong>FRM Close Date</strong></td>
                                <td>{{$record->frm_close_date ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>FRM Close Upto</strong></td>
                                <td>{{$record->frm_close_upto ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>QB Close Date</strong></td>
                                <td>{{$record->qb_close_date ?? ''}}</td>
                            </tr>
                            <tr>
                                <td><strong>QB Close Upto</strong></td>
                                <td>{{$record->qb_close_upto ?? ''}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
