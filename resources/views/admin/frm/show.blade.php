<x-default-layout>
    @section('title')
        View Feedback Registry
    @endsection

    <div class="card">

        <div class="row">
            <div class="col-md-6">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Information Receiver::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">

                    <tr>
                        <td ><strong>Name of Registrar</strong></td>
                        <td>{{$frm->name_of_registrar}}</td>
                    </tr>
                    <tr>
                        <td><strong>Date Received</strong></td>
                        <td>{{$frm->date_received}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Channel</strong></td>
                        <td>{{$frm->feedback_channel}}</td>
                    </tr>
                </table>
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Client Details:</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">

                    <tr>
                        <td><strong>Name of Client</strong></td>
                        <td>{{$frm->name_of_client}}}</td>
                    </tr>
                    <tr>
                        <td><strong>Type of Client</strong></td>
                        <td>{{$frm->type_of_client}}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender</strong></td>
                        <td>{{$frm->gender }}</td>
                    </tr>
                    <tr>
                        <td><strong>Age</strong></td>
                        <td>{{$frm->age}}</td>
                    </tr>
                    <tr>
                        <td><strong>Province</strong></td>
                        <td>{{$frm->province}}</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td>{{$frm->district}}</td>
                    </tr>
                    <tr>
                        <td><strong>Tehsil</strong></td>
                        <td>{{$frm->tehsil}}</td>
                    </tr>
                    <tr>
                        <td><strong>Union Council</strong></td>
                        <td>{{$frm->union_counsil}}</td>
                    </tr>
                    <tr>
                        <td><strong>Village</strong></td>
                        <td>{{$frm->village}}</td>
                    </tr>
                    <tr>
                        <td><strong>Allow Contact</strong></td>
                        <td>{{$frm->allow_contact}}</td>
                    </tr>
                    <tr>
                        <td><strong>Contact Number</strong></td>
                        <td>{{$frm->client_contact ?? 'NA'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Description</strong></td>
                        <td>{{$frm->feedback_description}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Cateogory</strong></td>
                        <td>{{$frm->feedback_category}}</td>
                    </tr>
                    @if($frm->datix_number)
                        <tr>
                            <td><strong>Datix Number</strong></td>
                            <td>{{$frm->datix_number}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Theme</strong></td>
                        <td>{{$frm->theme}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Activity</strong></td>
                        <td>{{$frm->feedback_activity}}</td>
                    </tr>
                    <tr>
                        <td><strong>Project Name</strong></td>
                        <td>{{$frm->project_name}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="card-title  border-0 my-4"">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1 " style="background-color: #F1C40F !important; border-radius:25px;">
                            <h5 class="fw-bold m-3">Feedback Refferal Details::</h5>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">

                    <tr>
                        <td ><strong>Name of Registrar</strong></td>
                        <td>{{$frm->name_of_registrar}}</td>
                    </tr>
                    <tr>
                        <td><strong>Date Received</strong></td>
                        <td>{{$frm->date_received}}</td>
                    </tr>
                    <tr>
                        <td><strong>Feedback Channel</strong></td>
                        <td>{{$frm->feedback_channel}}</td>
                    </tr>
                </table>
            </div>
        </div>



    </div>




</x-default-layout>
