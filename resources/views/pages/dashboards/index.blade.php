<x-default-layout>

    @section('title')
    Dashboard
    @endsection

    @section('breadcrumbs')
        
    @endsection
    @can('dashboards')
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <iframe title="sci-dashboard-1" width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=ce4b58b8-c937-4937-8264-aa54771a47ee&autoAuth=true&ctid=37ef3d19-1651-4452-b761-dc2414bf0416" frameborder="0" allowFullScreen="true"></iframe>
        </div>
        <!--end::Row-->

    @endcan

   
</x-default-layout>
