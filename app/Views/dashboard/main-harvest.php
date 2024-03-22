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
                        <div class="QA_table p-1 mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Pangalan ng Bukid</th>
                                        <th scope="col">Pangalan ng Variety</th>
                                        <th scope="col">Dami ng Naani</th>
                                        <th scope="col">Kabuuang Kita</th>
                                        <th scope="col">Araw ng Ani</th>
                                        <th scope="col">Notes</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($harvest as $har) : ?>
                                        <tr>
                                            <td><?= $har['field_name'] ?></td>
                                            <td><?= $har['variety_name'] ?></td>
                                            <td><?= $har['harvest_quantity'] ?></td>
                                            <td><?= $har['total_revenue'] ?></td>
                                            <td><?= $har['harvest_date'] ?></td>
                                            <td><?= $har['notes'] ?></td>

                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="openEditHarvestModal(
                                            <?= $har['harvest_id']; ?>,
                                            '<?= $har['field_name']; ?>',
                                            '<?= $har['variety_name']; ?>',
                                            '<?= $har['harvest_quantity']; ?>',
                                            '<?= $har['total_revenue']; ?>',
                                            '<?= $har['harvest_date']; ?>',
                                            '<?= $har['notes']; ?>',

                                            )">Edit</button>
                                                <button type="button" class="btn btn-danger" onclick="deleteHarvest(<?= $har['harvest_id']; ?>)">Delete</button>
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
<div class="modal fade" id="addharvestmodal" role="dialog" aria-labelledby="addharvestmodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addharvestmodalLabel">Add New Harvest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addharvest" method="post">
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_name" placeholder="Pangalan ng Bukid" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="variety_name" class="form-label">Pangalan ng Variety</label>
                        <input type="text" name="variety_name" id="variety_name" placeholder="Pangalan ng Variety" class=" form-control">
                    </div>
                    <div class="mb-3">
                        <label for="harvest_quantity" class="form-label">Dami ng Naani</label>
                        <input type="text" name="harvest_quantity" id="harvest_quantity" placeholder="Dami ng Naani" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="total_revenue" class="form-label">Kabuuang Kita</label>
                        <input type="text" name="total_revenue" id="total_revenue" placeholder="Kabuuang Kita" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="harvest_date" class="form-label">Araw ng Ani</label>
                        <input type="date" name="harvest_date" id="harvest_date" class="form-control">
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

<div class="modal fade" id="editharvestmodal" tabindex="-1" aria-labelledby="editharvestmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editharvestmodalLabel">Edit Harvest</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/harvest/update" method="post">
                    <input type="hidden" name="harvest_id" id="editharvest_id">
                    <div class="mb-3">
                        <label for="editfield_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="editfield_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editvariety_name" class="form-label">Pangalan ng Variety</label>
                        <input type="text" name="variety_name" id="editvariety_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editharvest_quantity" class="form-label">Dami ng Naani</label>
                        <input type="number" name="harvest_quantity" id="editharvest_quantity" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edittotal_revenue" class="form-label">Kabuuang Kita</label>
                        <input type="number" name="total_revenue" id="edittotal_revenue" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editharvest_date" class="form-label">Kagamitan</label>
                        <input type="date" name="harvest_date" id="editharvest_date" class="form-control">
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