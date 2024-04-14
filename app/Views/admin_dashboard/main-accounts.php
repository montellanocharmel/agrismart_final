<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4 style="color:#88c431">Accounts</h4>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchadminmanageaccounts">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Leader Name...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="/manageaccounts" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Pangalan ng Leader</th>
                                    <th scope="col">ID Number</th>
                                    <th scope="col">Barangay</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Account Status</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Aksyon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $us) : ?>
                                    <tr>
                                        <td><?= $us['leader_name'] ?></td>
                                        <td><?= $us['idnumber'] ?></td>
                                        <td><?= $us['barangay'] ?></td>
                                        <td><?= $us['position'] ?></td>
                                        <td><?= $us['accountstatus'] ?></td>
                                        <td><?= $us['created_at'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="openEditPasswordModal(
                                                        <?= $us['leader_id']; ?>,
                                                        '<?= $us['password']; ?>'
                                                        )">Update Password</button>

                                            <?php if ($us['accountstatus'] === 'unrestricted') : ?>
                                                <a href="/restrict-account/<?= $us['leader_id']; ?>" class="btn btn-danger" style="color: white;">Restrict</a>
                                            <?php else : ?>
                                                <a href="/unrestrict-account/<?= $us['leader_id']; ?>" class="btn btn-success" style="color: white;">Unrestrict</a>
                                            <?php endif; ?>


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

<!-- edit password modal.php -->

<div class="modal fade" id="editpasswordmodal" tabindex="-1" aria-labelledby="editpasswordmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editpasswordmodalLabel">Update Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/updatepassword/update" method="post">
                    <input type="hidden" name="leader_id" id="editleader_id">
                    <div class="mb-3">
                        <label for="editpassword" class="form-label">Change Password</label>
                        <input type="password" name="password" id="editpassword" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>