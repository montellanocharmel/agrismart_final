<div class="latest-news pt-150 pb-150" id="trivias">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Tri</span>vias</h3>
					<p>Mga dagdag kaalaman tungkol sa Agrikultura</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<?php foreach ($trivia as $tri) : ?>
				<div class="col-lg-4 col-md-6 d-flex">
					<div class="single-latest-news mt-3">
						<a href="<?= base_url('triviareadmore/' . $tri['trivia_id']) ?>">
							<div class="news-image" style="background-image: url('<?= $tri['image'] ?>');"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="<?= base_url('triviareadmore/' . $tri['trivia_id']) ?>">Alam niyo ba?</a></h3>
							<p class="excerpt">
								<?= substr($tri['trivia'], 0, 150) . (strlen($tri['trivia']) > 150 ? '...' : '') ?>
							</p>
							<a href="<?= base_url('triviareadmore/' . $tri['trivia_id']) ?>" class="read-more-btn">Read more <i class="fas fa-angle-right"></i></a>

						</div>

					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row">

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