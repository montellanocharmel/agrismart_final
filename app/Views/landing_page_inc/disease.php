<div class="latest-news pt-150 pb-150" id="disease">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Agricultural</span> Diseases</h3>
					<p>Mga uri ng sakit ng halaman</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<?php foreach ($disease as $dis) : ?>
				<div class="col-lg-4 col-md-6 d-flex">
					<div class="single-latest-news mt-3">
						<a href="<?= base_url('diseasereadmore/' . $dis['disease_id']) ?>">
							<div class="news-image" style="background-image: url('<?= $dis['dis_image'] ?>');"></div>
						</a>
						<div class="news-text-box">
                        <h3><a href="<?= base_url('reportsreadmore/' . $dis['disease_id']) ?>"><?= $dis['dis_name'] ?></a></h3>
                        
						<p class="excerpt"> <b>Disease Type:</b> <?= $dis['dis_type'] ?> <br><b>Description:</b> <?= substr($dis['dis_desc'], 0, 150) . (strlen($dis['dis_desc']) > 150 ? '...' : '') ?>
                       <br> <b>Recommendations:</b> <?= substr($dis['dis_solutions'], 0, 150) . (strlen($dis['dis_solutions']) > 150 ? '...' : '') ?>
                    </p>
                  
							<a href="<?= base_url('diseasereadmore/' . $dis['disease_id']) ?>" class="read-more-btn">Read more <i class="fas fa-angle-right"></i></a>

						</div>

					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="news.html" class="boxed-btn">More Trivias</a>
			</div>
		</div>
	</div>
</div>

<style>
	.single-latest-news {
		display: flex;
		flex-direction: column;
		height: 100%;
	}

	.news-image {
		width: 100%;
		height: 200px;
		background-size: contain;
		background-repeat: no-repeat;
		background-position: center;
	}


	.news-text-box {
		flex: 1;
		display: flex;
		flex-direction: column;
	}

	.news-text-box h3 {
		margin-top: 15px;
	}

	.news-text-box p {
		flex: 1;
		margin: 15px 0;
		overflow: hidden;
	}

	.news-text-box a {
		align-self: flex-start;
	}
</style>