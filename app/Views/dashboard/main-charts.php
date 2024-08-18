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
    document.getElementById('downloadPDF').addEventListener('click', async function() {
        const {
            jsPDF
        } = window.jspdf;
        const domtoimage = window.domtoimage;

        var doc = new jsPDF('p', 'mm', 'a4');
        var pageWidth = doc.internal.pageSize.getWidth();
        var pageHeight = doc.internal.pageSize.getHeight();

        async function addChartToPDF(chartCanvas, posY) {
            try {
                let dataUrl = await domtoimage.toPng(chartCanvas, {
                    quality: 0.7
                }); // Adjust quality
                let imgWidth = pageWidth - 20;
                let imgHeight = (chartCanvas.height / chartCanvas.width) * imgWidth;

                if (posY + imgHeight > pageHeight) {
                    doc.addPage();
                    posY = 10;
                }

                doc.addImage(dataUrl, 'PNG', 10, posY, imgWidth, imgHeight);
                return posY + imgHeight + 10;
            } catch (error) {
                console.error('Error generating image for PDF:', error);
            }
        }

        let startY = 20;

        // Process charts sequentially
        startY = await addChartToPDF(document.getElementById('chart1'), startY);
        startY = await addChartToPDF(document.getElementById('chart2'), startY);
        startY = await addChartToPDF(document.getElementById('chart3'), startY);
        startY = await addChartToPDF(document.getElementById('chart4'), startY);
        await addChartToPDF(document.getElementById('harvestChart'), startY);

        doc.save('farm_report.pdf');
    });
</script>