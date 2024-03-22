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
                                            <h3><span class="counter blue_color"><!-- $totalHarvestQuantity ?>--></span> </h3>
                                            <p>Total na Naani</p>
                                        </div>
                                    </div>
                                    <div class="single_quick_activity d-flex">
                                        <div class="count_content count_content2">
                                            <h3><span class="counter red_color"><!--  $totalRevenueThisYear ?>--></span> </h3>
                                            <p>Kita Ngayong Taon</p>
                                        </div>
                                    </div>
                                    <div class="single_quick_activity  d-flex">
                                        <div class="count_content count_content2">
                                            <h3><span class="counter yellow_color"><!--$totalBinhiCount ?>--></span> </h3>
                                            <p>Binhi</p>
                                        </div>
                                    </div>
                                    <div class="single_quick_activity  d-flex">
                                        <div class="count_content count_content2">
                                            <h3><span class="counter green_color"><!--$totalMoneySpent ?>--></span> </h3>
                                            <p>Nagastos</p>
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
                            <h3 class="mb_25">Income</h3>
                        </div>
                    </div>
                    <div class="my-4">
                        <canvas id="monthlyRevenueChart" width="400" height="100"></canvas>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!--
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly revenue chart
        var monthlyLabels =  json_encode($monthlyLabels) ?>;
        var monthlyData =  json_encode($monthlyData) ?>;

        // Create a line chart for monthly revenue
        var monthlyCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        var monthlyLineChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: monthlyData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',

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
    });
</script>-->