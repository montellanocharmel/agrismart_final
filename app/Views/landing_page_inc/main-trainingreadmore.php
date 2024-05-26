<!-- single article section -->
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <div class="single-article-image">
                            <img src="<?= base_url($training['image_training']) ?>" alt="Training Image" class="img-fluid">
                        </div>
                        <h2></h2>
                        <h2><?= $training['event_title'] ?></h2>

                        <p style= "text-align: justify; text-justify: inter-word;"><b>Date:</b> <?= $training['date'] ?><br><b>Time:</b> <?= $training['time'] ?><br> <b>Resource Speaker:</b> <?= $training['speaker'] ?> <br> <b>Venue:</b>  <?= $training['place'] ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .single-article-image {
        text-align: center;
        margin-bottom: 20px;
    }

    .single-article-image img {
        max-width: 100%;
        height: auto;
    }
</style>