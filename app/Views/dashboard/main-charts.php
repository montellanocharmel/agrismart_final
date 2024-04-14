<div class="main_content_iner">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">

                <button id="downloadPDF" class="btn btn-primary mb-2"><i class="fa-regular fa-file-pdf"></i></button>
                <div class="QA_section">
                    <div class=" row justify-content-center">
                        <div class="col-md-11" style="background-color: white; border-radius: 15px; text-align: center;">
                            <h3 style="color:#88c431;" class="mt-3">Top 10 Barangays with the Most Land Area</h3>
                            <div class="chart-container">
                                <canvas id="chart1" style="width: 80px; height: 20px;"></canvas>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-5" style="background-color: white; border-radius: 15px; text-align: center;">
                            <h3 style="color:#88c431;" class="mt-3">Number Crop Varieties Used </h3>
                            <div class="chart-container">
                                <canvas id="chart2" style=" height: 40px;"></canvas>
                            </div>
                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-5 mt-2" style="background-color: white; border-radius: 15px; text-align: center;">
                            <h3 style="color:#88c431;" class="mt-3">Harvest Quantity </h3>
                            <div class="chart-container">
                                <canvas id="harvestChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-md-5" style="background-color: white; border-radius: 15px; text-align: center;">
                            <h3 style="color:#88c431;" class="mt-3">Damaged by Pest</h3>
                            <div class="chart-container">
                                <canvas id="chart3" style=" height: 40px;"></canvas>
                            </div>
                        </div>
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-5 mt-2" style="background-color: white; border-radius: 15px; text-align: center;">
                            <h3 style="color:#88c431;" class="mt-3">Damaged by Weather Events</h3>
                            <div class="chart-container">
                                <canvas id="chart4" style=" height: 40px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .download-button-container {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script>
    var chartData = <?php echo json_encode($chartData); ?>;

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

    var chartData3 = <?php echo json_encode($chartData3); ?>;
    var ctx = document.getElementById('chart3').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData3,
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
    var chartData4 = <?php echo json_encode($chartData4); ?>;
    var ctx = document.getElementById('chart4').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData4,
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
    var chartData = <?php echo json_encode($chartData6); ?>;

    var ctx = document.getElementById('harvestChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'day'
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    window.jsPDF = window.jspdf.jsPDF;
    document.getElementById('downloadPDF').addEventListener('click', function() {
        var chartsContainer = document.querySelector('.QA_section');
        var containerWidth = chartsContainer.scrollWidth;
        var containerHeight = chartsContainer.scrollHeight; // Use scrollHeight if the entire height of the content is needed
        var pageWidth = 800; // Adjust this value as needed
        var pageHeight = 500; // Adjust this value as needed

        var pdf = new jsPDF({
            orientation: 'landscape',
            unit: 'px',
            format: [pageWidth, pageHeight]
        });

        domtoimage.toPng(chartsContainer, {
                height: containerHeight,
                width: containerWidth
            })
            .then(function(dataUrl) {
                pdf.addImage(dataUrl, 'PNG', 0, 0, pageWidth, pageHeight);
                pdf.save('charts.pdf');
            })
            .catch(function(error) {
                console.error('Error generating PDF:', error);
            });
    });
</script>