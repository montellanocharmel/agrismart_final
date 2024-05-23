<!-- single article section -->
<div class="mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-article-section">
                    <div class="single-article-text">
                        <div class="single-article-image">
                            <img src="<?= base_url($pest['pest_image']) ?>" alt="Pest Image" class="img-fluid">
                        </div>
                        <h2></h2>
                        <h2><?= $pest['pest_name'] ?></h2>

                        <p style= "text-align: justify; text-justify: inter-word;"><b>Pest Type:</b> <?= $pest['pest_type'] ?><br><b>Description:</b> <br> <?= $pest['pest_desc'] ?><br> <b>Recommendations:</b> <br> <?= $pest['pest_solutions'] ?> </p>
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