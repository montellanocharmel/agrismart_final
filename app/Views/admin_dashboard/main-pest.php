<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Agricultural Pests</h3>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchpest">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Pest...">
                                        </div>
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addpestmodal" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
                                <a href="/adpest" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
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
                                <?php foreach ($pest as $pes) : ?>
                                    <tr>
                                        <td><img src="<?= base_url() . $pes['pest_image'] ?>" alt="" class="avatar-img rounded-circle mx-auto d-block" style="display: block; margin: 0 auto; width: 200px; height: 200px;"></td>
                                        <td><?= $pes['pest_name'] ?></td>
                                        <td><?= $pes['pest_type'] ?></td>
                                        <td><?= truncateText($pes['pest_desc'], 150) ?></td>
                                        <td><?= truncateText($pes['pest_solutions'], 150) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" onclick="openEditPestModal(
                                                        <?= $pes['pest_id']; ?>,
                                                        <?= $pes['pest_name']; ?>,
                                                        <?= $pes['pest_type']; ?>,
                                                        '<?= htmlspecialchars($pes['pest_desc'], ENT_QUOTES, 'UTF-8'); ?>',
                                                        '<?= htmlspecialchars($pes['pest_solutions'], ENT_QUOTES, 'UTF-8'); ?>'
                                                    )">Edit</button>

                                                    <button class="dropdown-item" onclick="deletepest(<?= $pes['pest_id']; ?>)">Delete</button>
                                                </div>
                                            </div>
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

<!-- Add Modal -->
<div class="modal fade" id="addpestmodal" role="dialog" aria-labelledby="addpestmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addpestmodalLabel">Add Pest</h5>
            </div>
            <div class="modal-body">
                <form action="/addpest" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="pest_image" class="form-label">Images</label>
                        <input type="file" name="pest_image" id="pest_image" placeholder="Image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pest_name" class="form-label">Name</label>
                        <input type="text" name="pest_name" id="pest_name" placeholder="Pest Name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pest_type" class="form-label">Type</label>
                        <input type="text" name="pest_type" id="pest_type" placeholder="Pest Type" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pest_desc" class="form-label">Description</label>
                        <textarea name="pest_desc" id="pest_desc" placeholder="Pest Description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="pest_solutions" class="form-label">Recommendations</label>
                        <textarea name="pest_solutions" id="pest_solutions" placeholder="Pest Solutions" class="form-control" rows="4"></textarea>
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
<div class="modal fade" id="editpestmodal" tabindex="-1" aria-labelledby="editpestmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editpestmodalLabel">Edit Pest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/adpest/update" method="post">
                    <input type="hidden" name="pest_id" id="editpest_id">
                    <div class="mb-3">
                        <label for="editpest_name" class="form-label">Name</label>
                        <input type="text" name="pest_name" id="editpest_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editpest_type" class="form-label">Type</label>
                        <input type="text" name="pest_type" id="editpest_type" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editpest_desc" class="form-label">Description</label>
                        <textarea name="pest_desc" id="editpest_desc" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editpest_solutions" class="form-label">Recommendations</label>
                        <textarea name="pest_solutions" id="editpest_solutions" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>