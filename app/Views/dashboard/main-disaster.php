    <div class="main_content_iner">
        <div class="container-fluid p-3">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h3 style="color:#88c431">Agricultural Disasters</h3>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form method="post" action="/searchuserdisaster">
                                            <div class="search_field">
                                                <input type="text" name="search_term" placeholder="Search Disaster...">
                                            </div>
                                            <button type="submit"><i class="ti-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <a href="/disaster" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Farmer Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Weather Events</th>
                                        <th scope="col">Damage Descriptions</th>
                                        <th scope="col">Damage Severity</th>
                                        <th scope="col">Recommendations</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($disaster as $item) : ?>
                                        <tr>
                                            <td><?= $item['farmer_name'] ?></td>
                                            <td><?= $item['field_address'] ?></td>
                                            <td><?= $item['weather_events'] ?></td>
                                            <td><?= $item['damage_description'] ?></td>
                                            <td><?= $item['damage_severity'] ?></td>
                                            <td><?= $item['mititgation_measures'] ?></td>
                                            <td class="text-center">
                                                <button style="color: white; margin-bottom: 7px;" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDisasterModal_<?= $item['disaster_id']; ?>"><i class="fa-regular fa-eye"></i></button>
                                                <button style="color: white; margin-bottom: 7px;" class="btn btn-warning" onclick="openEditDisasterModal(
                                                    '<?= $item['disaster_id']; ?>',
                                                    '<?= $item['weather_events']; ?>',
                                                    '<?= $item['damage_description']; ?>',
                                                    '<?= $item['damage_severity']; ?>',
                                                    '<?= $item['mititgation_measures']; ?>'
                                                )"><i class="fa-regular fa-pen-to-square"></i></button>
                                                <button style="color: white; margin-bottom: 7px;" class="btn btn-danger" onclick="deletedisaster(<?= $item['disaster_id']; ?>)"><i class="fa-solid fa-trash-can"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Disaster Modal -->
    <div class="modal fade" id="editdisastermodal" tabindex="-1" aria-labelledby="editdisastermodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editdisastermodalLabel">Edit Disaster Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/disaster/update" method="post">
                        <input type="hidden" name="disaster_id" id="editdisaster_id">
                        <div class="mb-3">
                            <label for="editweather_events" class="form-label">Weather Events</label>
                            <input type="text" name="weather_events" id="editweather_events" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="editdamage_description" class="form-label">Damage Descriptions</label>
                            <input type="text" name="damage_description" id="editdamage_description" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="editdamage_severity" class="form-label">Severity</label>
                            <input type="text" name="damage_severity" id="editdamage_severity" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="editmititgation_measures" class="form-label">Solutions</label>
                            <input type="text" name="mititgation_measures" id="editmititgation_measures" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php foreach ($disaster as $item) : ?>
        <div class="modal fade" id="viewDisasterModal_<?= $item['disaster_id']; ?>" tabindex="-1" aria-labelledby="viewDisasterModalLabel_<?= $item['disaster_id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg-custom">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="viewDisasterModalLabel_<?= $item['disaster_id']; ?>">Disaster Details</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div style="width: 90%; margin: 0 auto;">
                            <h3 style="color: #f28123;">Farmer Name</h3>
                            <h2><?= $item['farmer_name'] ?></h2>
                            <h3 style="color: #f28123;">Field Address</h3>
                            <h2><?= $item['field_address'] ?></h2>
                            <h3 style="color: #f28123;">Variety</h3>
                            <h2><?= $item['weather_events'] ?></h2>
                            <h3 style="color: #f28123;">Type</h3>
                            <h2><?= $item['damage_description'] ?></h2>
                            <h3 style="color: #f28123;">Description</h3>
                            <h2><?= $item['damage_severity'] ?></h2>
                            <h3 style="color: #f28123;">Recommendations</h3>
                            <h2><?= $item['mititgation_measures'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <style>
        .modal-lg-custom {
            max-width: 50%;
        }

        .modal-body img {
            width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .modal-body p {
            word-break: break-word;
            white-space: pre-wrap;
        }

        .modal-body .text-center {
            text-align: center;
        }
    </style>