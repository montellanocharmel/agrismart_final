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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addvarietymodal" class="btn_1">Add New</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Barangay</th>
                                        <th scope="col">Equipment</th>
                                        <th scope="col">Pangalan ng Variety</th>
                                        <th scope="col">Presyo</th>
                                        <th scope="col">Dami</th>
                                        <th scope="col">Araw ng Pagbili/Pagbigay</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($variety as $var) : ?>
                                        <tr>
                                            <td><?= $var['barangay'] ?></td>
                                            <td><?= $var['equipment'] ?></td>
                                            <td><?= $var['variety_name'] ?></td>
                                            <td><?= $var['variety_price'] ?></td>
                                            <td><?= $var['quantity'] ?></td>
                                            <td><?= $var['date_bought'] ?></td>
                                            <td><?= $var['notes'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" onclick="openEditVareityModal(
                                                        '<?= $var['variety_id']; ?>',
                                                        '<?= $var['barangay']; ?>',
                                                        '<?= $var['equipment']; ?>',
                                                        '<?= $var['variety_name']; ?>',
                                                        '<?= $var['variety_price']; ?>',
                                                        '<?= $var['quantity']; ?>',
                                                        '<?= $var['date_bought']; ?>',
                                                        '<?= $var['notes']; ?>',
                                                        )">Edit</button>
                                                        <button type="button" class="dropdown-item" onclick="deletevariety(<?= $var['variety_id']; ?>)">Delete</button>
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

<!-- Add Variety Modal -->
<div class="modal fade" id="addvarietymodal" role="dialog" aria-labelledby="addvarietymodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addvarietymodalLabel">Add New Variety</h5>
            </div>
            <div class="modal-body">
                <form action="/addvariety" method="post">
                    <div class="mb-3">
                        <label for="barangay" class="form-label">Barangay</label>
                        <input type="text" name="barangay" id="barangay" placeholder="Barangay" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="equipment" class="form-label">Kagamitan</label>
                        <input type="text" name="equipment" id="equipment" placeholder="Kagamitan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="variety_name" class="form-label">Pangalan ng Variety</label>
                        <input type="text" name="variety_name" id="variety_name" placeholder="Pangalan ng Variety" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="variety_price" class="form-label">Presyo</label>
                        <input type="number" name="variety_price" id="variety_price" placeholder="Gana sa Isang Araw" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Dami</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Dami" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="date_bought" class="form-label">Araw ng Pagbili/Pagbigay</label>
                        <input type="date" name="date_bought" id="date_bought" placeholder="Pangalan ng Variety" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Pangalan ng Variety</label>
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