<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header" style="margin-top: 4vh;">
                        <h4 style="color:#88c431; ">Mga Trabaho sa Bukid</h4>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form Active="#">
                                        <div class="search_field">
                                            <input type="text" placeholder="Search content here...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addworkermodal" class="btn_1">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Pangalan ng Magtatrabaho</th>
                                        <th scope="col">Gana sa Isang Araw</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($worker as $work) : ?>
                                        <tr>
                                            <td><?= $work['worker_name'] ?></td>
                                            <td><?= $work['salaryperday'] ?></td>

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" onclick="openEditWorkerModal(
                                                            <?= $work['worker_id']; ?>,
                                                            '<?= $work['worker_name']; ?>',
                                                            '<?= $work['salaryperday']; ?>',

                                                            )">Edit</button>
                                                        <button type="button" class="dropdown-item" onclick="deleteworker(<?= $work['worker_id']; ?>)">Delete</button>
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
</div>

<!-- Add Worker Modal -->
<div class="modal fade" id="addworkermodal" role="dialog" aria-labelledby="addworkermodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addworkermodalLabel">Add New Worker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addworker" method="post">
                    <div class="mb-3">
                        <label for="worker_name" class="form-label">Pangalan ng Magtatrabaho</label>
                        <input type="text" name="worker_name" id="worker_name" placeholder="Pangalan ng Magtatrabaho" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="salaryperday" class="form-label">Gana sa Isang Araw</label>
                        <input type="number" name="salaryperday" id="salaryperday" placeholder="Gana sa Isang Araw" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- edit_product_modal.php -->

<div class="modal fade" id="editworkermodal" tabindex="-1" aria-labelledby="editworkermodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editworkermodalLabel">Edit Worker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/workers/update" method="post">
                    <input type="hidden" name="worker_id" id="editworker_id">
                    <div class="mb-3">
                        <label for="editworker_name" class="form-label">Pangalan ng Magtatrabaho</label>
                        <input type="text" name="worker_name" id="editworker_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editsalaryperday" class="form-label">Gana sa Isang Araw</label>
                        <input type="number" name="salaryperday" id="editsalaryperday" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>