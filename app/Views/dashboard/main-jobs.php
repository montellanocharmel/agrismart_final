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
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Trabaho</th>
                                        <th scope="col">Pangalan ng Bukid</th>
                                        <th scope="col">Araw</th>
                                        <th scope="col">Pangalan ng Magtatrabaho</th>
                                        <th scope="col">Total na Nagastos</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jobs as $job) : ?>
                                        <tr>
                                            <td><?= $job['job_name'] ?></td>
                                            <td><?= $job['field_name'] ?></td>
                                            <td><?= $job['finished_date'] ?></td>
                                            <td><?= $job['worker_name'] ?></td>
                                            <td><?= $job['total_money_spent'] ?></td>
                                            <td><?= $job['notes'] ?></td>

                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" onclick="openEditJobModal(
                                                            <?= $job['job_id']; ?>,
                                                            '<?= $job['job_name']; ?>',
                                                            '<?= $job['field_name']; ?>',
                                                            '<?= $job['finished_date']; ?>',
                                                            '<?= $job['worker_name']; ?>', 
                                                            '<?= $job['total_money_spent']; ?>',
                                                            '<?= $job['notes']; ?>',

                                                            )">Edit</button>
                                                        <button type="button" class="dropdown-item" onclick="deleteJob(<?= $job['job_id']; ?>)">Delete</button>
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

<!-- Add Product Modal -->
<div class="modal fade" id="addjobmodal" role="dialog" aria-labelledby="addjobmodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addjobmodalLabel">Add New Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addjob" method="post">
                    <div class="mb-3">
                        <label for="job_name" class="form-label">Trabaho</label>
                        <select name="job_name" id="job_name" class="form-select">
                            <option value="Gamas">Gamas</option>
                            <option value="Lipat Tanim">Lipat Tanim</option>
                            <option value="Spray">Spray</option>
                            <option value="Fertilize">Fertilize</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_name" placeholder="Pangalan ng Bukid" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="finished_date" class="form-label">Araw</label>
                        <input type="date" name="finished_date" id="finished_date" class=" form-control">
                    </div>
                    <div class="mb-3">
                        <label for="worker_name" class="form-label">Pangalang ng Magtatrabaho</label>
                        <input type="text" name="worker_name" id="worker_name" placeholder="Pangalan ng Magtatrabaho" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="total_money_spent" class="form-label">Total na Nagastos</label>
                        <input type="text" name="total_money_spent" id="total_money_spent" placeholder="Total na Nagastos" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" name="notes" id="notes" placeholder="Notes" class="form-control">
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

<div class="modal fade" id="editjobmodal" tabindex="-1" aria-labelledby="editjobmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editjobmodalLabel">Edit Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/jobs/update" method="post">
                    <input type="hidden" name="job_id" id="editjob_id">
                    <div class="mb-3">
                        <label for="editjob_name" class="form-label">Trabaho</label>
                        <input type="text" name="job_name" id="editjob_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editfield_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="editfield_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editfinished_date" class="form-label">Araw</label>
                        <input type="date" name="finished_date" id="editfinished_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editworker_name" class="form-label">Pangalan ng Magtatrabaho</label>
                        <input type="text" name="worker_name" id="editworker_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edittotal_money_spent" class="form-label">Total na Nagastos</label>
                        <input type="text" name="total_money_spent" id="edittotal_money_spent" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editnotes" class="form-label">Notes</label>
                        <input type="text" name="notes" id="editnotes" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>