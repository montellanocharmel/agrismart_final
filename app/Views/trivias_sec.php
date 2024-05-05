<?= $this->include('/landing_page_inc/top') ?>

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
						<nav class="main-menu" style= "color:black;">
							<ul>
								<li ><a href="/">Home</a>

								</li>
								<li><a href="/about">About</a>
								<li class="current-list-item"><a href="/trivias">Trivias</a></li>
								
								</li>
								
								</li>
								
								<li><a href="/reports">Reports</a>
								<li><a href="/trainings">Trainings and Seminars</a>
								<li><a href="/farmerstats">Statistics</a>
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



    <?= $this->include('/landing_page_inc/trivias') ?>
    <?= $this->include('/landing_page_inc/footer') ?>
    <?= $this->include('/landing_page_inc/end') ?>
</body>