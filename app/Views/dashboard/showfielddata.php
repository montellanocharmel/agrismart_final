<div class="main_content_iner">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">

                    <div class="container-fluid p-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 style="color:#88c431; margin-top: 10px;">Farmer Profile</h2>
                                    </div>
                                    <div class="card-body">
                                        <style>
                                            @media (max-width: 767px) {
                                                .responsive-font p {
                                                    font-size: 15px;
                                                }
                                            }

                                            @media (min-width: 768px) {
                                                .responsive-font p {
                                                    font-size: 18px;
                                                }
                                            }
                                        </style>
                                        <div class="row">
                                            <div class="col-5 responsive-font" style="padding-right: 15px;">
                                                <p style="line-height: 2; margin: 0; text-align: right;">Farmer Name</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">FIMS Code</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">Field Owner</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">Field Address</p>
                                                <p style="line-height: 2; margin: 0; text-align: right;">Field Total Area</p>
                                            </div>
                                            <div class="col-7 responsive-font">
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['farmer_name'] ?: ' ', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['fims_code'] ?: ' ', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['field_owner'] ?: ' .', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['field_address'] ?: ' ', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                                <p style="line-height: 2; margin: 0;"><strong><?= htmlspecialchars($field['field_total_area'] ?: ' ', ENT_QUOTES, 'UTF-8') ?></strong></p>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>



                            <!-- Main Content -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h2 style="color:#88c431">Field Details</h2>
                                    </div>
                                    <div class="card-body">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="planting-details-tab" data-toggle="tab" href="#planting-details" role="tab" aria-controls="planting-details" aria-selected="true">Planting Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="expenses-tab" data-toggle="tab" href="#expenses" role="tab" aria-controls="expenses" aria-selected="false">Expenses</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="damages-tab" data-toggle="tab" href="#damages" role="tab" aria-controls="damages" aria-selected="false">Damages</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="harvest-details-tab" data-toggle="tab" href="#harvest-details" role="tab" aria-controls="harvest-details" aria-selected="false">Harvest Details</a>
                                            </li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="planting-details" role="tabpanel" aria-labelledby="planting-details-tab">

                                                <?php if (isset($plantingDetails) && !empty($plantingDetails)) : ?>
                                                    <?php foreach ($plantingDetails as $detail) : ?>
                                                        <div class="card" style="font-size: 1vw; margin-bottom: 1rem;">
                                                            <h1 style="margin-left: 15px;"> <?= htmlspecialchars($detail['field_name'], ENT_QUOTES, 'UTF-8') ?></h1>

                                                            <div class="card-body" style="font-size: .8vw;">
                                                                <p style="font-size: .8vw;"><strong>Crop Variety:</strong> <?= htmlspecialchars($detail['crop_variety'], ENT_QUOTES, 'UTF-8') ?></p>
                                                                <p style="font-size: .8vw;"><strong>Planting Date:</strong> <?= htmlspecialchars($detail['planting_date'], ENT_QUOTES, 'UTF-8') ?></p>
                                                                <p style="font-size: .8vw;"><strong>Season:</strong> <?= htmlspecialchars($detail['season'], ENT_QUOTES, 'UTF-8') ?></p>
                                                                <p style="font-size: .8vw;"><strong>Start Date:</strong> <?= htmlspecialchars($detail['start_date'], ENT_QUOTES, 'UTF-8') ?></p>
                                                                <p style="font-size: .8vw;"><strong>Notes:</strong> <?= htmlspecialchars($detail['notes'], ENT_QUOTES, 'UTF-8') ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <p style="font-size: .8vw;">No planting details found for this field.</p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="tab-pane fade" id="expenses" role="tabpanel" aria-labelledby="expenses-tab">
                                                <h3>Expenses</h3>
                                                <!-- Your expenses content here -->
                                            </div>
                                            <div class="tab-pane fade" id="damages" role="tabpanel" aria-labelledby="damages-tab">
                                                <h3>Damages</h3>
                                                <!-- Your damages content here -->
                                            </div>
                                            <div class="tab-pane fade" id="harvest-details" role="tabpanel" aria-labelledby="harvest-details-tab">
                                                <h3>Harvest Details</h3>
                                                <!-- Your harvest details content here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>