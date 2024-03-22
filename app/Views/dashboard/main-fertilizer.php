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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addfertilizersmodal" class="btn_1">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Pangalan ng Fertilizer</th>
                                        <th scope="col">Presyo</th>
                                        <th scope="col">Dami</th>
                                        <th scope="col">Araw ng Pagbili/Pagbigay</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($fertilizers as $fer) : ?>
                                        <tr>
                                            <td><?= $fer['fertilizer_name'] ?></td>
                                            <td><?= $fer['price'] ?></td>
                                            <td><?= $fer['quantity'] ?></td>
                                            <td><?= $fer['date_bought'] ?></td>
                                            <td><?= $fer['notes'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" onclick="openEditfereityModal(
                                                        <?= $fer['fertilizer_id']; ?>,
                                                        '<?= $fer['fertilizer_name']; ?>',
                                                        '<?= $fer['price']; ?>',
                                                        '<?= $fer['quantity']; ?>',
                                                        '<?= $fer['date_bought']; ?>',
                                                        '<?= $fer['notes']; ?>',
                                                        )">Edit</button>
                                                        <button type="button" class="dropdown-item" onclick="deleteferiety(<?= $fer['fertilizer_id']; ?>)">Delete</button>
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
<div class="modal fade" id="addfertilizersmodal" role="dialog" aria-labelledby="addfertilizersmodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addfertilizersmodalLabel">Add New Fertilizers</h5>
            </div>
            <div class="modal-body">
                <form action="/addfertilizers" method="post">
                    <div class="mb-3">
                        <label for="fertilizer_name" class="form-label">Pangalan ng fertilizers</label>
                        <input type="text" name="fertilizer_name" id="fertilizer_name" placeholder="Pangalan ng fertilizers" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="fertilizers_price" class="form-label">Presyo</label>
                        <input type="number" name="price" id="price" placeholder="Presyo" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Dami</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Dami" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="date_bought" class="form-label">Araw ng Pagbili/Pagbigay</label>
                        <input type="date" name="date_bought" id="date_bought" placeholder="Pangalan ng fertilizers" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Pangalan ng fertilizers</label>
                        <textarea name="notes" id="notes" placeholder="Notes" class="form-control"></textarea>
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