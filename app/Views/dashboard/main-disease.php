<div class="main_content_iner">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Diseases</h3>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchuserdisease">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Disease...">
                                        </div>
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="/dis" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Recommendations</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dis as $disease) : ?>
                                    <tr>
                                        <td><img src="<?= base_url() . $disease['dis_image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="width: 200px; height: 200px;"></td>
                                        <td><?= $disease['dis_name'] ?></td>
                                        <td><?= $disease['dis_type'] ?></td>
                                        <td><?= $disease['dis_desc'] ?></td>
                                        <td><?= $disease['dis_solutions'] ?></td>
                                        <td class="text-center">
                                            <button style="color: white; margin-bottom: 7px;" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewDiseaseModal_<?= $disease['disease_id']; ?>"><i class="fa-regular fa-eye"></i></button>
                                            <button style="color: white; margin-bottom: 7px;" class="btn btn-warning" onclick="openEditDiseaseModal(
                                                <?= $disease['disease_id']; ?>,
                                                '<?= $disease['dis_image']; ?>', 
                                                '<?= $disease['dis_name']; ?>',
                                                '<?= $disease['dis_type']; ?>',
                                                '<?= $disease['dis_desc']; ?>',
                                                '<?= $disease['dis_solutions']; ?>'
                                            )"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button style="color: white; margin-bottom: 7px;" class="btn btn-danger" onclick="deletedisease(<?= $disease['disease_id']; ?>)"><i class="fa-solid fa-trash-can"></i></button>
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

<!-- Edit Disease Modal -->
<div class="modal fade" id="editdiseasemodal" tabindex="-1" aria-labelledby="editdiseasemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editdiseasemodalLabel">Edit Disease Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dis/update" method="post">
                    <input type="hidden" name="disease_id" id="editdisease_id">
                    <div class="mb-3">
                        <label for="editdis_image" class="form-label">Image</label>
                        <input type="file" name="dis_image" id="editdis_image" class="form-control">
                        <img id="editdis_image_preview" src="" alt="Current Image" style="display: none; width: 100%; height: auto; margin-top: 10px;">
                    </div>
                    <div class="mb-3">
                        <label for="editdis_name" class="form-label">Disease Name</label>
                        <input type="text" name="dis_name" id="editdis_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editdis_type" class="form-label">Disease Type</label>
                        <input type="text" name="dis_type" id="editdis_type" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editdis_desc" class="form-label">Disease Description</label>
                        <input type="text" name="dis_desc" id="editdis_desc" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editdis_solutions" class="form-label">Solutions</label>
                        <input type="text" name="dis_solutions" id="editdis_solutions" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($dis as $disease) : ?>
    <div class="modal fade" id="viewDiseaseModal_<?= $disease['disease_id']; ?>" tabindex="-1" aria-labelledby="viewDiseaseModalLabel_<?= $disease['disease_id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="viewDiseaseModalLabel_<?= $disease['disease_id']; ?>">Disease Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= base_url() . $disease['dis_image'] ?>" alt="Disease Image" style="width: 40%; height: auto; margin-top: 10px;"><br><br><br>
                        <h2 style="color: #f28123;"><?= $disease['dis_name'] ?></h2><br>
                    </div>
                    <div style="width: 90%; margin: 0 auto;">
                        <h3 style="color: #f28123;">Farmer Name</h3>
                        <h2><?= $disease['farmer_name'] ?></h2>
                        <h3 style="color: #f28123;">Field Address</h3>
                        <h2><?= $disease['field_address'] ?></h2>
                        <h3 style="color: #f28123;">Variety</h3>
                        <h2><?= $disease['crop_variety'] ?></h2>
                        <h3 style="color: #f28123;">Type</h3>
                        <h2><?= $disease['dis_type'] ?></h2>
                        <h3 style="color: #f28123;">Description</h3>
                        <h2><?= $disease['dis_desc'] ?></h2>
                        <h3 style="color: #f28123;">Recommendations</h3>
                        <h2><?= $disease['dis_solutions'] ?></h2>
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