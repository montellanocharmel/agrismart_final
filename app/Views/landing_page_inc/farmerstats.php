<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>AgriSmart</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>assets_landingpage/img/small.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&amp;display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="<?= base_url() ?>assets_landingpage/css/responsive.css">
    <link rel="icon" href="<?= base_url() ?>assets_landingpage/img/small.png" type="image/png">

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/bootstrap1.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/themefy_icon/themify-icons.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/swiper_slider/css/swiper.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/select2/css/select2.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/niceselect/css/nice-select.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/owl_carousel/css/owl.carousel.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/gijgo/gijgo.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/font_awesome/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/tagsinput/tagsinput.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/datatable/css/buttons.dataTables.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/text_editor/summernote-bs4.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/morris/morris.css">

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/vendors/material_icon/material-icons.css" />

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/metisMenu.css">

    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/style1.css" />
    <link rel="stylesheet" href="<?= base_url() ?>dashboard/css/colors/default.css" id="colorSkinCSS">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/5f1f084a1d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <style>
        .farmer-info {
            margin-left: 40px;
        }

        body {
            background-color: white;
        }
    </style>
</head>

<body>
<div  class="top-header-area" id="sticker" >
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="/">
								<img src="<?= base_url() ?>assets_landingpage/img/agrismart-logo1.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="/">Home</a>

								</li>
								<li><a href="/about">About</a>
								<li><a href="/trivias">Trivias</a></li>
								
								</li>
								
								</li>
								
								<li><a href="/reports">Reports</a>
								<li><a href="/trainings">Trainings and Seminars</a>
								<li class="current-list-item"><a href="/farmerstats">Statistics</a>
								<li><a href="#contact">Contact</a>

								<li><a href="/sign_ins">Log In</a></li>
								<li><a href="/registerview">Sign Up</a></li>
								


								<li>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <br><br><br><br><br><br>
    <div class="main_content_iner ">
        <div class="container-fluid p-3">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4 style="color:#f28123;" style="font-size: larger;">Farmer Statistics</h4>
                            <div class=" box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form method="post" action="/searchFarmerProfiles">
                                            <div class="search_field">
                                                <input type="text" name="search_term" placeholder="Enter your FIMS Code...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($profiles as $profile) : ?>
                                <div class="col-md-6 mb-3">
                                    <div class="farmer-info">
                                        <h3 style="color:#88c431;" style="font-size: 1.3vw;">Farmer's Code: <?= $profile['fims_code'] ?></h3>
                                        <h3 style="color:#88c431;" style="font-size: 1.3vw;">Full Name: <?= $profile['fullname'] ?></h3>
                                        <h3 style="color:#88c431;" style="font-size: 1.3vw;">Barangay: <?= $profile['address'] ?></h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php if (empty($profiles)) : ?>
                                <div class="col-lg-12">
                                    <h4 class="text-center" style="color:#88c431;" style="font-size: 1.3vw;">No profiles found</h4>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <h3 style="color:#88c431;"> Fields</h3>
                                <div class="table-responsive">
                                    <div class="QA_table mb-30">
                                        <?php if (!empty($field)) : ?>
                                            <table class="table table-sm lms_table_active" style="margin-bottom: 10px; padding: 5;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pangalan ng Magsasaka</th>
                                                        <th scope="col">Pangalan ng Bukid</th>
                                                        <th scope="col">May-ari ng Lupa</th>
                                                        <th scope="col">Address ng Bukid</th>
                                                        <th scope="col">Kabuuang Sukat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($field as $fie) : ?>
                                                        <tr>
                                                            <td><?= $fie['farmer_name'] ?></td>
                                                            <td><?= $fie['field_name'] ?></td>
                                                            <td><?= $fie['field_owner'] ?></td>
                                                            <td><?= $fie['field_address'] ?></td>
                                                            <td><?= $fie['field_total_area'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php else : ?>
                                            <h4 class="text-center" style="color:#88c431;" style="font-size: 1.3vw;">No fields found</h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <h3 style="color:#88c431;"> Rice Planted</h3>
                                <div class="table-responsive">
                                    <div class="QA_table mb-3">
                                        <?php if (!empty($planting)) : ?>
                                            <div class="QA_table mb_30">
                                                <table class="table table-sm lms_table_active" style="margin-bottom: 10px;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Pangalan ng Bukid</th>
                                                            <th scope="col">Barangay</th>
                                                            <th scope="col">Pangalan ng Bukid</th>
                                                            <th scope="col">Pangalan ng Variety</th>
                                                            <th scope="col">Araw ng Pagtatanim</th>
                                                            <th scope="col">Season</th>
                                                            <th scope="col">Simula ng Pagsasaka</th>
                                                            <th scope="col">Notes</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($planting as $pla) : ?>
                                                            <tr>
                                                                <td><?= $pla['farmer_name'] ?></td>
                                                                <td><?= $pla['field_address'] ?></td>
                                                                <td><?= $pla['field_name'] ?></td>
                                                                <td><?= $pla['crop_variety'] ?></td>
                                                                <td><?= $pla['planting_date'] ?></td>
                                                                <td><?= $pla['season'] ?></td>
                                                                <td><?= $pla['start_date'] ?></td>
                                                                <td><?= $pla['notes'] ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php else : ?>
                                            <h4 class="text-center" style="color:#88c431;" style="font-size: 1.3vw;">No crops details found</h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <h3 style="color:#88c431;"> Harvest</h3>
                                <div class="table-responsive">
                                    <div class="QA_table p-1 mb_30">
                                        <?php if (!empty($harvest)) : ?>
                                            <table class="table lms_table_active">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Pangalan ng Bukid</th>
                                                        <th scope="col">Pangalan ng Variety</th>
                                                        <th scope="col">Dami ng Naani</th>
                                                        <th scope="col">Kabuuang Kita</th>
                                                        <th scope="col">Araw ng Ani</th>
                                                        <th scope="col">Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($harvest as $har) : ?>
                                                        <tr>
                                                            <td><?= $har['field_name'] ?></td>
                                                            <td><?= $har['variety_name'] ?></td>
                                                            <td><?= $har['harvest_quantity'] ?></td>
                                                            <td><?= $har['total_revenue'] ?></td>
                                                            <td><?= $har['harvest_date'] ?></td>
                                                            <td><?= $har['notes'] ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                    </div>
                                <?php else : ?>
                                    <h4 class="text-center" style="color:#88c431;" style="font-size: 1.3vw;">No harvest details found</h4>
                                <?php endif; ?>
                                </div>
                            </div>
                            <!-- Add a container for the chart -->
                            <div class="col-lg-12 col-xl-12">
                                <div class="white_box mb_30">
                                    <div class="box_header border_bottom_1px">
                                        <div class="main-title">
                                            <h3 class="mb_25">Harvest Quantity</h3>
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <!-- Add canvas element for the chart -->
                                        <canvas id="harvestChart" width="400" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
                borderColor: 'rgb(75, 192, 192)',
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

<style>
    li{
        font-size: 115%;
    }
</style>