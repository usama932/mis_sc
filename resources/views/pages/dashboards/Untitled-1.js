   $("#projects").DataTable({
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            filename: 'Implementing Partner Data export_',
                            text: '<i class="flaticon2-download"></i> Excel',
                            title: 'Thematic Area Data Export',
                            className: 'badge badge-success my-2',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5,6,7,8,9,10,11]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            filename: 'Implementing Partner Data CSV_',
                            text: '<i class="flaticon2-download"></i> CSV',
                            title: 'Thematic Area Data',
                            className: 'badge badge-success my-2',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        }
                    ],
                    dom: 'lfBrtip',
                    processing: true,
                    serverSide: false,
                    searching: false,
                    paging: false,
                    responsive: false,
                    info: true,
                });


                