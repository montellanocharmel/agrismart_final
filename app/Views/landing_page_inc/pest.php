<div class="latest-news pt-150 pb-150" id="disease">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Agricultural</span> Pests</h3>
					<p>Mga uri ng sakit ng peste sa halaman</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<?php foreach ($pest as $pes) : ?>
				<div class="col-lg-4 col-md-6 d-flex">
					<div class="single-latest-news mt-3">
						<a href="<?= base_url('pestreadmore/' . $pes['pest_id']) ?>">
							<div class="news-image" style="background-image: url('<?= $pes['pest_image'] ?>');"></div>
						</a>
						<div class="news-text-box">
                        <h3><a href="<?= base_url('pestreadmore/' . $pes['pest_id']) ?>"><?= $pes['pest_name'] ?></a></h3>
                        
						<p class="excerpt"> <b>Pest Type:</b> <?= $pes['pest_type'] ?> <br><b>Description:</b> <?= substr($pes['pest_desc'], 0, 150) . (strlen($pes['pest_desc']) > 150 ? '...' : '') ?>
                       <br> <b>Recommendations:</b> <?= substr($pes['pest_solutions'], 0, 150) . (strlen($pes['pest_solutions']) > 150 ? '...' : '') ?>
                    </p>
                  
							<a href="<?= base_url('pestreadmore/' . $pes['pest_id']) ?>" class="read-more-btn">Read more <i class="fas fa-angle-right"></i></a>

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