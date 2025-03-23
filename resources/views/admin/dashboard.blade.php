@extends('admin.layout.master')

@section('css')
<link href="{{asset('dash/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>


@endsection

@section('style')
    
@endsection

@section('breadcrumb')

@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="row gy-5 g-xl-10">
        <!-- <canvas id="kt_chartjs_1" class="mh-400px"></canvas> -->
    </div>
</div>

@endsection

@section('script')
<script src="{{asset('dash/assets/plugins/global/plugins.bundle.js')}}"></script>

<script>
    var ctx = document.getElementById('kt_chartjs_1');

    // Define colors
    var primaryColor = '#D8001DFF'; // Correctly assigned as a string
    var dangerColor = '#0104DAFF'; // Correctly assigned as a string
    var successColor = '#00B828FF'; // Correctly assigned as a string

    // Define fonts
    var fontFamily = KTUtil.getCssVariableValue('--bs-font-sans-serif');

    // Chart labels
    const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // Chart data
    const data = {
        labels: labels,
        datasets: [
            {
                label: 'Target ', // Label for the dataset
                data: [50, 60, 70, 80, 90, 100, 50, 60, 70, 80, 90, 100], // Data points
                backgroundColor: primaryColor, // Background color for the bars
                borderColor: primaryColor, // Border color for the bars
                borderWidth: 1, // Border width
                categoryPercentage: 0.4, // Controls the width of the bars for this dataset
                barPercentage: 0.8 // Controls the spacing between bars for this dataset
            },
            {
                label: 'Actually', // Label for the dataset
                data: [70, 90, 60, 80, 90, 100, 50, 60, 70, 80, 90, 100], // Data points
                backgroundColor: dangerColor, // Background color for the bars
                borderColor: dangerColor, // Border color for the bars
                borderWidth: 1, // Border width
                categoryPercentage: 0.4, // Controls the width of the bars for this dataset
                barPercentage: 0.8 // Controls the spacing between bars for this dataset
            }
            ,
            {
                label: 'Total', // Label for the dataset
                data: [70, 90, 60, 80, 90, 100, 50, 60, 70, 80, 90, 100], // Data points
                backgroundColor: successColor, // Background color for the bars
                borderColor: successColor, // Border color for the bars
                borderWidth: 1, // Border width
                categoryPercentage: 0.4, // Controls the width of the bars for this dataset
                barPercentage: 0.8 // Controls the spacing between bars for this dataset
            }
        ]
    };

    // Chart config
    const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                title: {
                    display: false,
                }
            },
            responsive: true,
            interaction: {
                intersect: false,
            },
            scales: {
                x: {
                    stacked: false, // Disable stacking on the x-axis
                    grid: {
                        display: false // Hide grid lines for the x-axis
                    }
                },
                y: {
                    stacked: false, // Disable stacking on the y-axis
                    beginAtZero: true // Start the y-axis at 0
                }
            }
        },
        defaults: {
            global: {
                defaultFont: fontFamily
            }
        }
    };

    // Init ChartJS -- for more info, please visit: https://www.chartjs.org/docs/latest/
    var myChart = new Chart(ctx, config);
</script>

@endsection