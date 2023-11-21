<x-nform-layout>

    @section('title')
       Add Learning Logs
    @endsection

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card">
            <form action="" method="post">
                @csrf
                
            </form>

        </div>
    </div>
   
    @push("scripts")
 
    <!--end::Vendors Javascript-->
    @endpush


</x-nform-layout>
