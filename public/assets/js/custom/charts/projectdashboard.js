// Function to google charts chart
function drawGoogleChart(provinces, districts) {
    google.charts.load('current', { packages: ['orgchart'] });
    google.charts.setOnLoadCallback(function() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');

        var chartData = [['Pakistan', '']];

        provinces.forEach(function(province) {
            chartData.push([province.province_name, 'Pakistan']);
        });

        districts.forEach(function(district) {
            var provinceName = provinces.find(prov => prov.province_id === district.provinces_id)?.province_name || 'Unknown';
            chartData.push([district.district_name, provinceName]);
        });

        data.addRows(chartData);

        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, { allowHtml: true });

        // Show the chart_div after drawing
        $('#chart_div').show();
        
    });
}

// Function to draw Sunburst chart
function drawSunburstChart(themes, subThemes) {
    if (!themes || !subThemes || themes.length === 0) {
        console.error("Invalid themes or subThemes data");
        return;
    }

    // Dispose of the previous chart instance if it exists
    var myChart = echarts.getInstanceByDom(document.getElementById('main'));
    if (myChart) {
        myChart.dispose();
    }

    // Initialize a new chart instance
    myChart = echarts.init(document.getElementById('main'));

    // Prepare hierarchical data for the Sunburst chart
    var sunburstData = themes.map(function(theme) {
        return {
            name: theme.name,
            value: 1, // Adjust this value as needed
            children: subThemes
                .filter(subTheme => subTheme.sci_theme_id === theme.id)
                .map(subTheme => ({
                    name: subTheme.name,
                    value: 1, // Adjust this value as needed
                    tooltip: {
                        formatter: function() {
                            return `${subTheme.name}`; // Customize the tooltip content
                        }
                    }
                }))
        };
    });

    var option = {
        title: {
            text: 'Project Themes & SubThemes',
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: function(params) {
                if (params.data.tooltip) {
                    return params.data.tooltip.formatter();
                }
                return `${params.name} `; // Fallback tooltip
            }
        },
        series: {
            type: 'sunburst',
            data: sunburstData,
            radius: [0, '100%'],
            label: {
                rotate: 'radial',
                overflow: 'truncate',
                formatter: function(params) {
                    return params.name.length > 10 ? params.name.substr(0, 10) + '...' : params.name;
                },
                fontSize: 9,
                fontWeight: 'bold'
            },
            emphasis: {
                focus: 'ancestor',
                label: {
                    show: true,
                    fontSize: 10,
                    fontWeight: 'bold'
                }
            },
            levels: [
                {},
                {
                    r0: '15%',
                    r: '35%',
                    label: {
                        rotate: 'tangential',
                        fontSize: 8
                    }
                },
                {
                    r0: '35%',
                    r: '70%',
                    label: {
                        align: 'right',
                        fontWeight: 'bold',
                        fontSize: 8
                    }
                }
            ],
            nodeClick: 'root',
            itemStyle: {
                borderColor: '#fff',
                borderWidth: 1
            }
        }
    };

    myChart.setOption(option);
}




//Datatable projects
$("#projects").DataTable({
    buttons: [
        {
            extend: 'excelHtml5',
            filename: 'Implementing Partner Data export_',
            text: '<i class="flaticon2-download"></i> Excel',
            title: 'Thematic Area Data Export',
            className: 'badge badge-success my-2',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6,7]
            }
        },
        {
            extend: 'csvHtml5',
            filename: 'Implementing Partner Data CSV_',
            text: '<i class="flaticon2-download"></i> CSV',
            title: 'Thematic Area Data',
            className: 'badge badge-success my-2',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5,6,7]
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


