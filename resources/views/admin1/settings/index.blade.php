<x-default-layout>
    @push('stylesheets')
        <link rel="stylesheet" href="{{asset('assets/css/style.bundle.css')}}">
        <script src="//code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>
       
    @endpush
    @section('title')
        Settings
 
    <script>
         $('#qb_lock_date,#frm_lock_date').flatpickr({
                altInput: true,
                dateFormat: "y-m-d",
                maxDate: "today",
            });
    </script>
    //Action Point Scripts
@endpush

</x-default-layout>