<div class="main_content_iner">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="row">
                        <div class="col-md-12" style="background-color: white; border-radius: 15px; text-align: center;">
                            <h3 style="color:#88c431;" class="mt-3">Top 10 Barangays with the most Total Land Area</h3>
                            <div class="chart-container">
                                <canvas id="chart1" style="width: 80px; height: 20px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6" style="background-color: white; border-radius: 15px; text-align: center;">
                            <h3 style="color:#88c431;" class="mt-3">Number Crop Varieties Used </h3>
                            <div class="chart-container">
                                <canvas id="chart2" style=" height: 40px;"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="chart3"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="chart4"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="chart5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var chartData = <?php echo json_encode($chartData); ?>;

    // Render the chart
    var ctx = document.getElementById('chart1').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    var chartData2 = <?php echo json_encode($chartData2); ?>;
    var ctx2 = document.getElementById('chart2').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: chartData2,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>