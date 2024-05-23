<!-- trivias -->
<div class="latest-news pt-150 pb-150" id="trivias">
	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Re</span>ports</h3>
					<p>Mga balita at isyu tungkol sa agrikultura</p>
				</div>
			</div>
		</div>

		<div class="row">
			<?php foreach ($reports as $rep) : ?>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="<?= base_url('reportsreadmore/' . $rep['report_id']) ?>">
							<div class="news-image" style="background-image: url('<?= $rep['images'] ?>');"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="<?= base_url('reportsreadmore/' . $rep['report_id']) ?>"><?= $rep['title'] ?></a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i><?= $rep['created_at'] ?></span>
							</p>
							<p class="excerpt">
								<?= substr($rep['description'], 0, 150) . (strlen($rep['description']) > 150 ? '...' : '') ?>
							</p> <a href="<?= base_url('reportsreadmore/' . $rep['report_id']) ?>" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>


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

	p .excerpt {
		text-align: justify;
  		text-justify: inter-word;
	}
</style>