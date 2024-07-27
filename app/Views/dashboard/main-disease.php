<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Diseases</h3>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchuserdisease">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Disease...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
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
                                <?php foreach ($dis as $dis) : ?>
                                    <tr>
                                        <td><img src="<?= base_url() . $dis['dis_image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;"></td>
                                        <td><?= $dis['dis_name'] ?></td>
                                        <td><?= $dis['dis_type'] ?></td>
                                        <td><?= $dis['dis_desc'] ?></td>
                                        <td><?= $dis['dis_solutions'] ?></td>
                                        <td>
                                            <button class="btn btn-primary" onclick="openEditDiseaseModal(
                                                        <?= $dis['disease_id']; ?>,
                                                        '<?= $dis['dis_image']; ?>', 
                                                        '<?= $dis['dis_name']; ?>',
                                                        '<?= $dis['dis_type']; ?>',
                                                        '<?= $dis['dis_desc']; ?>',
                                                        '<?= $dis['dis_solutions']; ?>',
                                                        )">Edit</button>
                                            <button class="btn btn-primary" onclick="deletedisease(<?= $dis['disease_id']; ?>)">Delete</button>
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
                        <label for="editdis_image" class="form-label">Images</label>
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
                        <label for="editdis_desc" class="form-label">Disease Descritpion</label>
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