<div class="main_content_iner">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Pests</h3>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchuserpest">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Pest...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="/userpest" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
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
                                <?php foreach ($pest as $pes) : ?>
                                    <tr>
                                        <td><img src="<?= base_url() . $pes['pest_image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;"></td>
                                        <td><?= $pes['pest_name'] ?></td>
                                        <td><?= $pes['pest_type'] ?></td>
                                        <td><?= strlen($pes['pest_desc']) > 70 ? substr($pes['pest_desc'], 0, 70) . '...' : $pes['pest_desc'] ?></td>
                                        <td><?= strlen($pes['pest_solutions']) > 70 ? substr($pes['pest_solutions'], 0, 70) . '...' : $pes['pest_solutions'] ?></td>
                                        <td class="text-center">
                                            <button style="color: white; margin-bottom: 7px;" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewPestModal_<?= $pes['pest_id']; ?>"><i class="fa-regular fa-eye"></i></button>
                                            <button style="color: white; margin-bottom: 7px;" class="btn btn-warning" onclick="openEditPestModal(
                                                        <?= $pes['pest_id']; ?>,
                                                        '<?= base_url() . $pes['pest_image']; ?>', 
                                                        '<?= $pes['pest_name']; ?>',
                                                        '<?= $pes['pest_type']; ?>',
                                                        '<?= $pes['pest_desc']; ?>',
                                                        '<?= $pes['pest_solutions']; ?>')"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <button style="color: white; margin-bottom: 7px;" class="btn btn-danger" onclick="deletepest(<?= $pes['pest_id']; ?>)"><i class="fa-solid fa-trash-can"></i></button>
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


<!-- edit  -->

<div class="modal fade" id="editpestmodal" tabindex="-1" aria-labelledby="editpestmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editpestmodalLabel">Edit Disease Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/userpest/update" method="post">
                    <input type="hidden" name="pest_id" id="editpest_id">
                    <div class="mb-3">
                        <label for="editpest_image" class="form-label">Images</label>
                        <input type="file" name="pest_image" id="editpest_image" class="form-control">
                        <img id="editpest_image_preview" src="" alt="Current Image" style="display: none; width: 100%; height: auto; margin-top: 10px;">
                    </div>
                    <div class="mb-3">
                        <label for="editpest_name" class="form-label">Disease Name</label>
                        <input type="text" name="pest_name" id="editpest_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editpest_type" class="form-label">Disease Type</label>
                        <input type="text" name="pest_type" id="editpest_type" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editpest_desc" class="form-label">Disease Descritpion</label>
                        <input type="text" name="pest_desc" id="editpest_desc" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editpest_solutions" class="form-label">Solutions</label>
                        <input type="text" name="pest_solutions" id="editpest_solutions" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div><?php foreach ($pest as $pes) : ?>
    <div class="modal fade" id="viewPestModal_<?= $pes['pest_id']; ?>" tabindex="-1" aria-labelledby="viewPestModalLabel_<?= $pes['pest_id']; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="viewPestModalLabel_<?= $pes['pest_id']; ?>">Pest Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?= base_url() . $pes['pest_image'] ?>" alt="Pest Image" style="width: 40%; height: auto; margin-top: 10px;"><br><br><br>
                        <h2 style="color: #f28123;"><?= $pes['pest_name'] ?></h2><br>
                    </div>
                    <div style="width: 90%; margin-left: 30spx;">
                        <h3 style="color: #f28123;">Farmer Name</h3>
                        <h2><?= $pes['farmer_name'] ?></h2>
                        <h3 style="color: #f28123;">Field Address</h3>
                        <h2><?= $pes['field_address'] ?></h2>
                        <h3 style="color: #f28123;">Variety</h3>
                        <h2><?= $pes['crop_variety'] ?></h2>
                        <h3 style="color: #f28123;">Type</h3>
                        <h2><?= $pes['pest_type'] ?></h2>
                        <h3 style="color: #f28123;">Description</h3>
                        <h2><?= $pes['pest_desc'] ?></h2>
                        <h3 style="color: #f28123;">Recommendations</h3>
                        <h2><?= $pes['pest_solutions'] ?></h2>
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