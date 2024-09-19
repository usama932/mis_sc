<x-default-layout>

    @section('title')
    Dashboard
    @endsection
   
    @can('dashboards')
        <div class="container">
        </div>
    @endcan

@push('scripts')

@endpush
</x-default-layout>
