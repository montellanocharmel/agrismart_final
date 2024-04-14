<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="single_element">
                    <div class="quick_activity">
                        <div class="row">
                            <div class="col-12">
                                <div class="quick_activity_wrap quick_activity_wrap">
                                    <div class="single_quick_activity  d-flex">
                                        <div class="count_content count_content2">
                                            <h3><span class="counter blue_color"><?= $totalHarvestQuantity ?></span> </h3>
                                            <p>Harvest Quantity</p>
                                        </div>
                                    </div>
                                    <div class="single_quick_activity d-flex">
                                        <div class="count_content count_content2">
                                            <h3><span class="counter red_color"><?= $totalRevenueThisYear ?> </span> </h3>
                                            <p>Revenue</p>
                                        </div>
                                    </div>
                                    <div class="single_quick_activity  d-flex">
                                        <div class="count_content count_content2">
                                            <h3><span class="counter yellow_color"><?= $totalLandArea ?></span> </h3>
                                            <p>Total Land Area</p>
                                        </div>
                                    </div>
                                    <div class="single_quick_activity  d-flex">
                                        <div class="count_content count_content2">
                                            <h3><span class="counter green_color"><?= $totalNoofFarmers ?> </span> </h3>
                                            <p>No. of Farmers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xl-12">
                <div class="white_box mb_30 ">
                    <div class="box_header border_bottom_1px  ">
                        <div class="main-title">
                            <h3 class="mb_25">Harvest Quantity</h3>
                        </div>
                    </div>
                    <div class="my-4">
                        <canvas id="harvestChart" width="400" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('harvestChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($monthlyLabels) ?>,
            datasets: [{
                label: 'Harvest Quantity',
                data: <?= json_encode($monthlyHarvestData) ?>,
                fill: false,
                borderColor: 'rgb(250, 208, 92)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>