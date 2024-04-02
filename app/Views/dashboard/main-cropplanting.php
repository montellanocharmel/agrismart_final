<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4 style="color:#88c431">Crop Planting</h4>
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

                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Pangalan ng Bukid</th>
                                    <th scope="col">Barangay</th>
                                    <th scope="col">Pangalan ng Bukid</th>
                                    <th scope="col">Pangalan ng Variety</th>
                                    <th scope="col">Araw ng Pagtatanim</th>
                                    <th scope="col">Season</th>
                                    <th scope="col">Simula ng Pagsasaka</th>
                                    <th scope="col">Ani</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Aksyon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($planting as $pla) : ?>
                                    <tr>
                                        <td><?= $pla['farmer_name'] ?></td>
                                        <td><?= $pla['field_address'] ?></td>
                                        <td><?= $pla['field_name'] ?></td>
                                        <td><?= $pla['crop_variety'] ?></td>
                                        <td><?= $pla['planting_date'] ?></td>
                                        <td><?= $pla['season'] ?></td>
                                        <td><?= $pla['start_date'] ?></td>
                                        <td><?= $pla['end_date'] ?></td>
                                        <td><?= $pla['notes'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item" onclick="openEditPlantingModal(
                                                        <?= $pla['planting_id']; ?>,
                                                        '<?= $pla['farmer_name']; ?>', 
                                                        '<?= $pla['field_name']; ?>',
                                                        '<?= $pla['crop_variety']; ?>',
                                                        '<?= $pla['planting_date']; ?>',
                                                        '<?= $pla['season']; ?>',
                                                        '<?= $pla['start_date']; ?>',
                                                        '<?= $pla['end_date']; ?>',
                                                        '<?= $pla['notes']; ?>',
                                                        )">Edit</button>
                                                    <button class="dropdown-item" onclick="deleteplanting(<?= $pla['planting_id']; ?>)">Delete</button>
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
<div class="modal fade" id="addplantingmodal" role="dialog" aria-labelledby="addplantingmodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addplantingmodalLabel">Add New Crop Planting Details</h5>
            </div>
            <div class="modal-body">
                <form action="/addplanting" method="post">
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_name" placeholder="Pangalan ng Bukid" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="crop_variety" class="form-label">Pangalang ng Variety</label>
                        <input type="text" name="crop_variety" id="crop_variety" placeholder="Pangalan ng Variety" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="planting_date" class="form-label">Araw ng Pagtatanim</label>
                        <input type="date" name="planting_date" id="planting_date" class=" form-control">
                    </div>
                    <div class="mb-3">
                        <label for="season" class="form-label">Season</label>
                        <select name="season" id="season" class=" form-control">
                            <option value="Dry Season">Dry Season(December to May)</option>
                            <option value="Wet Season">Wet Season (June to November)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Simula ng Pagtatanim</label>
                        <input type="date" name="start_date" id="start_date" class=" form-control">
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Araw ng Ani</label>
                        <input type="date" name="end_date" id="end_date" class=" form-control">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Araw ng Pagtatanim</label>
                        <textarea name="notes" id="notes" class=" form-control"></textarea>
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
<!-- edit  -->

<div class="modal fade" id="editplantingmodal" tabindex="-1" aria-labelledby="editplantingmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editplantingmodalLabel">Edit Crop Planting Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/cropplanting/update" method="post">
                    <input type="hidden" name="planting_id" id="editplanting_id">
                    <div class="mb-3">
                        <label for="editfarmer_name" class="form-label">Pangalan ng May-ari</label>
                        <input type="text" name="farmer_name" id="editfarmer_name" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editfield_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="editfield_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editcrop_variety" class="form-label">Pangalan ng Variety</label>
                        <input type="text" name="crop_variety" id="editcrop_variety" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editplanting_date" class="form-label">Araw ng Pagtatanim</label>
                        <input type="date" name="planting_date" id="editplanting_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editseason" class="form-label">Season</label>
                        <input type="text" name="season" id="editseason" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editstart_date" class="form-label">Araw ng Pagsisimula ng Pagtatanim</label>
                        <input type="date" name="start_date" id="editstart_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editend_date" class="form-label">Araw ng Pagtatapos ng Pagtatanim</label>
                        <input type="date" name="end_date" id="editend_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editnotes" class="form-label">Pangalan ng Variety</label>
                        <textarea name="notes" id="editnotes" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>