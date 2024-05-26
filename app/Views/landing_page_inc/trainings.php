<!-- trivias -->
<div class="latest-news pt-150 pb-150" id="trivias">
	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Trainings &</span> Seminars</h3>
					<p>Mga pagsasanay at pagtitipon tungkol sa agrikultura</p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php foreach ($training as $train) : ?>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
					<a href="<?= base_url('trainingreadmore/' . $train['training_id']) ?>">
					
							<div class="news-image" style="background-image: url('<?= $train['image_training'] ?>');"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="<?= base_url('trainingreadmore/' . $train['training_id']) ?>"><?= $train['event_title'] ?></a></h3>
							<p class="excerpt">Date: <?= $train['date'] ?> <br>Time: <?= $train['time'] ?> <br> Resource Speaker: <?= $train['speaker'] ?> <br>Venue: <?= $train['place'] ?></p>
							<a href="<?= base_url('trainingreadmore/' . $train['training_id']) ?>" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>


		</div>
		<div class="row">

		</div>
	</div>
</div>
<!-- end latest news -->

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