<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Diseases</h3>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchdisease">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Plant Disease...">
                                        </div>
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#adddiseasemodal" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
                                <a href="/addisease" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
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
                                    <th scope="col">Descriptions</th>
                                    <th scope="col">Recommendations</th>
                                    <th scope="col">Aksyon</th>
                                </tr>
                            </thead>
                            <?php
                            function truncateText($text, $maxLength)
                            {
                                if (strlen($text) > $maxLength) {
                                    $text = substr($text, 0, $maxLength) . '...';
                                }
                                return $text;
                            }
                            ?>
                            <tbody>
                                <?php foreach ($dis as $disease) : ?>
                                    <tr>
                                        <td><img src="<?= base_url() . $disease['dis_image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="width: 200px; height: 200px;"></td>
                                        <td><?= $disease['dis_name'] ?></td>
                                        <td><?= $disease['dis_type'] ?></td>
                                        <td><?= $disease['dis_desc'] ?></td>
                                        <td><?= $disease['dis_solutions'] ?></td>

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

<!-- Add Modal -->
<div class="modal fade" id="adddiseasemodal" role="dialog" aria-labelledby="adddiseasemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adddiseasemodalLabel">Add disease</h5>
            </div>
            <div class="modal-body">
                <form action="/adddisease" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="dis_image" class="form-label">Images</label>
                        <input type="file" name="dis_image" id="dis_image" placeholder="Disease Image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="dis_name" class="form-label">Name</label>
                        <input type="text" name="dis_name" id="dis_name" placeholder="Disease Name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="dis_type" class="form-label">Type</label>
                        <input type="text" name="dis_type" id="dis_type" placeholder="Disease Type" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="dis_desc" class="form-label">Description</label>
                        <textarea name="dis_desc" id="dis_desc" placeholder="Disease Description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="dis_solutions" class="form-label">Recommendations</label>
                        <textarea name="dis_solutions" id="dis_solutions" placeholder="Disease Solutions" class="form-control" rows="4"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editdiseasemodal" tabindex="-1" aria-labelledby="editdiseasemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editdiseasemodalLabel">Edit Disease</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addisease/update" method="post">
                    <input type="hidden" name="dis_id" id="editdisease_id">
                    <div class="mb-3">
                        <label for="editdis_name" class="form-label">Name</label>
                        <input type="text" name="dis_name" id="editdis_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editdis_type" class="form-label">Type</label>
                        <input type="text" name="dis_type" id="editdis_type" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editdis_desc" class="form-label">Description</label>
                        <textarea name="dis_desc" id="editdis_desc" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editdis_solutions" class="form-label">Recommendations</label>
                        <textarea name="dis_solutions" id="editdis_solutions" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>