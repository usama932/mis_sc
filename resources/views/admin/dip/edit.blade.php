<x-nform-layout>
 
    @section('title')
        Edit Detail Implementation Plan
        
    @endsection
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <input type="hidden" id="dip_id" value="{{$dip->id}}" />
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-line-tabs m-5 fs-6">
                <li class="nav-item">
                    <a class="nav-link @if(session('active') == 'basic_info') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_1">DIP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(session('dip_activity') == 'basic_info') active @endif " data-bs-toggle="tab" href="#kt_tab_pane_2">DIP Activities</a>
                </li>
               
            </ul>
            
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade   @if(session('active') == 'basic_info') show active @endif" id="kt_tab_pane_1" role="tabpanel">
                   @include('admin.dip.edit_dip')
                </div>
                <div class="tab-pane fade @if(session('active') == 'dip_activity') show active @endif" id="kt_tab_pane_2" role="tabpanel">
                    @include('admin.dip.dip_activity')
                </div>   
            </div>
        </div>
    </div>
    @push('scripts')

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @endpush

</x-nform-layout>
