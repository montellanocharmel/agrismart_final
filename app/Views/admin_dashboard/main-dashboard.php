<div class="main_content_iner ">
    <div class="container-fluid p-0">
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
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php if (!empty($notifications)) : ?>
                                <div class="white_box mb_30" style="height: 390px; overflow-y: auto;">
                                    <div class="box_header border_bottom_1px">
                                        <div class="main-title">
                                            <h3 class="mb_25">Notification</h3>
                                        </div>
                                    </div>


                                    <ul>
                                        <?php foreach ($notifications as $notification) : ?>
                                            <li id="notification-<?= $notification['notification_id'] ?>" style="font-size: 17px; margin-bottom: 10px;">
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <?php if (!empty($notification['url'])): ?>
                                                            <a href="<?= base_url($notification['url']) ?>">
                                                                <i class="fa-solid fa-circle-exclamation" style="color: grey"></i>
                                                                <b>New </b> <?= htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') ?>
                                                            </a>
                                                        <?php else: ?>
                                                            <i <i class="fa-solid fa-circle-exclamation" style="color: grey"></i>
                                                            <b>New </b> <?= htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-lg-2">

                                                        <button class="btn btn-sm btn-danger  mark-as-read" data-id="<?= $notification['notification_id'] ?>">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                <?php endif; ?>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="white_box mb_30" style="height: 390px; overflow-y: auto;">
                                <div class="box_header border_bottom_1px">
                                    <div class="main-title">
                                        <h3 class="mb_25">
                                            <?= $monthName ?> <?= $year ?><br>
                                        </h3>
                                    </div>
                                </div>
                                <div>
                                    <?= $calendar ?>
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
<style>
    .calendar {
        width: 100%;
        border-collapse: collapse;
        background-color: white;

    }

    .calendar th {
        background-color: white;
        padding: 10px;
        margin-bottom: 10px;
        text-align: center;
    }

    .calendar td {
        border: 1px solid #ddd;
        width: 14.28%;
        height: 40px;
        vertical-align: top;
        padding: 10px;
        margin-bottom: 10px;
    }

    .calendar .header {
        background-color: white;
    }

    .calendar .day {
        text-align: center;
        font-weight: bold;
        background-color: white;

    }

    .alert {
        margin-bottom: 20px;
        padding: 15px;
        font-size: 0.9vw;
    }
</style>
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
<script>
    document.querySelectorAll('.mark-as-read').forEach(button => {
        button.addEventListener('click', function() {
            const notificationId = this.getAttribute('data-id');
            const notificationElement = document.getElementById('notification-' + notificationId);

            fetch(`/mark-notification-as-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_token() ?>',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        notificationElement.remove();
                    } else {
                        alert('Failed to mark notification as read.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>