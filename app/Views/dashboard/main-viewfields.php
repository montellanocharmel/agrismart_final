<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4 style="color:#88c431">Mga Bukid</h4>
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
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addfieldmodal" class="btn_1">Add New</a>
                            </div>
                        </div>
                    </div>

                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Pangalan ng Magsasaka</th>
                                    <th scope="col">Pangalan ng Bukid</th>
                                    <th scope="col">May-ari ng Lupa</th>
                                    <th scope="col">Address ng Bukid</th>
                                    <th scope="col">Kabuuang Sukat</th>
                                    <th scope="col">Aksyon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($field as $fie) : ?>
                                    <tr>
                                        <td><?= $fie['farmer_name'] ?></td>
                                        <td><?= $fie['field_name'] ?></td>
                                        <td><?= $fie['field_owner'] ?></td>
                                        <td><?= $fie['field_address'] ?></td>
                                        <td><?= $fie['field_total_area'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="dropdown-item" onclick="openEditFieldModal(
                                                        <?= $fie['field_id']; ?>,
                                                        '<?= $fie['farmer_name']; ?>',
                                                        '<?= $fie['field_name']; ?>',
                                                        '<?= $fie['field_owner']; ?>',
                                                        '<?= $fie['field_address']; ?>',
                                                        '<?= $fie['field_total_area']; ?>',
                                                        )">Edit</button>
                                                    <button type="button" class="dropdown-item" onclick="deleteProduct(<?= $fie['field_id']; ?>)">Delete</button>
                                                    <button type="button" class="dropdown-item" onclick="openAddPlantingModal('<?= $fie['field_id']; ?>', '<?= $fie['field_name']; ?>')">Add New Planting Details</button>
                                                    <button type="button" class="dropdown-item" onclick="openAddJobModal('<?= $fie['field_id']; ?>', '<?= $fie['field_name']; ?>')">Add Expenses</button>
                                                    <button type="button" class="dropdown-item" onclick="openAddHarvestModal('<?= $fie['field_id']; ?>', '<?= $fie['field_name']; ?>')">Add New Harvest</button>
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

<!-- Add Field Modal -->
<div class="modal fade" id="addfieldmodal" role="dialog" aria-labelledby="addfieldmodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addfieldmodalLabel">Add New Field</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addfield" method="post">
                    <div class="mb-3">
                        <label for="farmer_name" class="form-label">Pangalan ng Magsasaka</label>
                        <input type="text" name="farmer_name" id="farmer_name" placeholder="Pangalan ng Magsasaka" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_name" placeholder="Pangalan ng Bukid" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="field_owner" class="form-label">Pangalang ng May-ari</label>
                        <input type="text" name="field_owner" id="field_owner" placeholder="Kung hindi sarili ng lupang binubukid, ilagay ang pangalan ng may-ari" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="field_address" class="form-label">Address ng Bukid</label>
                        <div class="form-input">
                            <select class="form-select mb-3" name="field_address" tabindex="10" required>
                                <option value="" selected disabled>Select Barangay</option>
                                <option value="Poblacion I">Poblacion I</option>
                                <option value="Poblacion II">Poblacion II</option>
                                <option value="Poblacion III">Poblacion III</option>
                                <option value="Adrialuna">Adrialuna</option>
                                <option value="Andres Ylagan">Andres Ylagan</option>
                                <option value="Antipolo">Antipolo</option>
                                <option value="Apitong">Apitong</option>
                                <option value="Arangin">Arangin</option>
                                <option value="Aurora">Aurora</option>
                                <option value="Bacungan">Bacungan</option>
                                <option value="Bagong Buhay">Bagong Buhay</option>
                                <option value="Balite">Balite</option>
                                <option value="Bancuro">Bancuro</option>
                                <option value="Banuton">Banuton</option>
                                <option value="Barcenaga">Barcenaga</option>
                                <option value="Bayani">Bayani</option>
                                <option value="Buhangin">Buhangin</option>
                                <option value="Caburo">Caburo</option>
                                <option value="Concepcion">Concepcion</option>
                                <option value="Dao">Dao</option>
                                <option value="Del Pilar">Del Pilar</option>
                                <option value="Estrella">Estrella</option>
                                <option value="Evangelista">Evangelista</option>
                                <option value="Gamao">Gamao</option>
                                <option value="General Esco">General Esco</option>
                                <option value="Herrera">Herrera</option>
                                <option value="Inarawan">Inarawan</option>
                                <option value="Kalinisan">Kalinisan</option>
                                <option value="Laguna">Laguna</option>
                                <option value="Mabini">Mabini</option>
                                <option value="Magtibay">Magtibay</option>
                                <option value="Mahabang Parang">Mahabang Parang</option>
                                <option value="Malaya">Malaya</option>
                                <option value="Malinao">Malinao</option>
                                <option value="Malvar">Malvar</option>
                                <option value="Masagana">Masagana</option>
                                <option value="Masaguing">Masaguing</option>
                                <option value="Melgar A">Melgar A</option>
                                <option value="Melgar B">Melgar B</option>
                                <option value="Metolza">Metolza</option>
                                <option value="Montelago">Montelago</option>
                                <option value="Montemayor">Montemayor</option>
                                <option value="Motoderazo">Motoderazo</option>
                                <option value="Mulawin">Mulawin</option>
                                <option value="Nag-Iba 1">Nag-Iba 1</option>
                                <option value="Nag-Iba 2">Nag-Iba 2</option>
                                <option value="Pagkakaisa">Pagkakaisa</option>
                                <option value="Paitan">Paitan</option>
                                <option value="Paniquian">Paniquian</option>
                                <option value="Pinagsabangan 1">Pinagsabangan 1</option>
                                <option value="Pinagsabangan 2">Pinagsabangan 2</option>
                                <option value="Piñahan">Piñahan</option>
                                <option value="Sampaguita">Sampaguita</option>
                                <option value="San Agustin 1">San Agustin 1</option>
                                <option value="San Agustin 2">San Agustin 2</option>
                                <option value="San Andres">San Andres</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="San Carlos">San Carlos</option>
                                <option value="San Isidro">San Isidro</option>
                                <option value="San Jose">San Jose</option>
                                <option value="San Luis">San Luis</option>
                                <option value="San Nicolas">San Nicolas</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="Sta. Cruz">Sta. Cruz</option>
                                <option value="Sta. Cruz">Sta. Cruz</option>
                                <option value="Sta. Isabel">Sta. Isabel</option>
                                <option value="Sta. Maria">Sta. Maria</option>
                                <option value="Satiago">Satiago</option>
                                <option value="Sto. Niño">Sto. Niño</option>
                                <option value="Tagumpay">Tagumpay</option>
                                <option value="Tigkan">Tigkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="field_total_area" class="form-label">Kabuuang Sukat</label>
                        <input type="text" name="field_total_area" id="field_total_area" placeholder="Ilagay kung ilang Hectares." class="form-control">
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


<!-- Add Planting Details Modal -->
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
                        <label for="field_id" class="form-label">ID ng Bukid</label>
                        <input type="text" name="field_id" id="field_id_planting" placeholder="ID ng Bukid" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_name_add" placeholder="Pangalan ng Bukid" class="form-control" readonly>
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
                        <select name="season" id="season" class="form-select">
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
                        <label for="notes" class="form-label">Notes</label>
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


<!-- Add Expenses Modal -->
<div class="modal fade" id="addjobmodal" role="dialog" aria-labelledby="addjobmodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addjobmodalLabel">Add Expenses</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addexpenses" method="post">
                    <div class="mb-3">
                        <label for="field_id" class="form-label">ID ng Bukid</label>
                        <input type="text" name="field_id" id="field_id_add" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_nameadd" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="expense_name" class="form-label">Saan Ginastos</label>
                        <input type="text" name="expense_name" id="expense_name" placeholder="Saan Ginastos" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="finished_date" class="form-label">Araw</label>
                        <input type="date" name="finished_date" id="finished_date" class=" form-control">
                    </div>
                    <div class="mb-3">
                        <label for="total_money_spent" class="form-label">Total na Nagastos</label>
                        <input type="number" name="total_money_spent" id="total_money_spent" placeholder="Total na Nagastos" class="form-control">
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


<!-- Add Harvest Modal -->
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
                        <label for="field_id" class="form-label">ID ng Bukid</label>
                        <input type="text" name="field_id" id="field_id_harvest" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_name_harvest" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="variety_name" class="form-label">Pangalan ng Variety</label>
                        <input type="text" name="variety_name" id="variety_name" placeholder="Pangalan ng Variety" class=" form-control">
                    </div>
                    <div class="mb-3">
                        <label for="harvest_quantity" class="form-label">Dami ng Naani</label>
                        <input type="number" name="harvest_quantity" id="harvest_quantity" placeholder="Dami ng Naani" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="total_revenue" class="form-label">Kabuuang Kita</label>
                        <input type="number" name="total_revenue" id="total_revenue" placeholder="Kabuuang Kita" class="form-control">
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


<!-- edit field modal.php -->

<div class="modal fade" id="editfieldmodal" tabindex="-1" aria-labelledby="editfieldmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editfieldmodalLabel">Edit Field</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/viewfields/update" method="post">
                    <input type="hidden" name="field_id" id="editfield_id">
                    <div class="mb-3">
                        <label for="editfarmer_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="farmer_name" id="editfarmer_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editfield_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="editfield_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editfield_owner" class="form-label">May-ari ng Bukid</label>
                        <input type="text" name="field_owner" id="editfield_owner" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="editfield_address" class="form-label">Address ng Bukid</label>
                        <div class="form-input">
                            <select class="form-select mb-3" id="editfield_address" name="field_address" tabindex="10" required>
                                <option value="" selected disabled>Select Barangay</option>
                                <option value="Poblacion I">Poblacion I</option>
                                <option value="Poblacion II">Poblacion II</option>
                                <option value="Poblacion III">Poblacion III</option>
                                <option value="Adrialuna">Adrialuna</option>
                                <option value="Andres Ylagan">Andres Ylagan</option>
                                <option value="Antipolo">Antipolo</option>
                                <option value="Apitong">Apitong</option>
                                <option value="Arangin">Arangin</option>
                                <option value="Aurora">Aurora</option>
                                <option value="Bacungan">Bacungan</option>
                                <option value="Bagong Buhay">Bagong Buhay</option>
                                <option value="Balite">Balite</option>
                                <option value="Bancuro">Bancuro</option>
                                <option value="Banuton">Banuton</option>
                                <option value="Barcenaga">Barcenaga</option>
                                <option value="Bayani">Bayani</option>
                                <option value="Buhangin">Buhangin</option>
                                <option value="Caburo">Caburo</option>
                                <option value="Concepcion">Concepcion</option>
                                <option value="Dao">Dao</option>
                                <option value="Del Pilar">Del Pilar</option>
                                <option value="Estrella">Estrella</option>
                                <option value="Evangelista">Evangelista</option>
                                <option value="Gamao">Gamao</option>
                                <option value="General Esco">General Esco</option>
                                <option value="Herrera">Herrera</option>
                                <option value="Inarawan">Inarawan</option>
                                <option value="Kalinisan">Kalinisan</option>
                                <option value="Laguna">Laguna</option>
                                <option value="Mabini">Mabini</option>
                                <option value="Magtibay">Magtibay</option>
                                <option value="Mahabang Parang">Mahabang Parang</option>
                                <option value="Malaya">Malaya</option>
                                <option value="Malinao">Malinao</option>
                                <option value="Malvar">Malvar</option>
                                <option value="Masagana">Masagana</option>
                                <option value="Masaguing">Masaguing</option>
                                <option value="Melgar A">Melgar A</option>
                                <option value="Melgar B">Melgar B</option>
                                <option value="Metolza">Metolza</option>
                                <option value="Montelago">Montelago</option>
                                <option value="Montemayor">Montemayor</option>
                                <option value="Motoderazo">Motoderazo</option>
                                <option value="Mulawin">Mulawin</option>
                                <option value="Nag-Iba 1">Nag-Iba 1</option>
                                <option value="Nag-Iba 2">Nag-Iba 2</option>
                                <option value="Pagkakaisa">Pagkakaisa</option>
                                <option value="Paitan">Paitan</option>
                                <option value="Paniquian">Paniquian</option>
                                <option value="Pinagsabangan 1">Pinagsabangan 1</option>
                                <option value="Pinagsabangan 2">Pinagsabangan 2</option>
                                <option value="Piñahan">Piñahan</option>
                                <option value="Sampaguita">Sampaguita</option>
                                <option value="San Agustin 1">San Agustin 1</option>
                                <option value="San Agustin 2">San Agustin 2</option>
                                <option value="San Andres">San Andres</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="San Carlos">San Carlos</option>
                                <option value="San Isidro">San Isidro</option>
                                <option value="San Jose">San Jose</option>
                                <option value="San Luis">San Luis</option>
                                <option value="San Nicolas">San Nicolas</option>
                                <option value="San Pedro">San Pedro</option>
                                <option value="Sta. Cruz">Sta. Cruz</option>
                                <option value="Sta. Cruz">Sta. Cruz</option>
                                <option value="Sta. Isabel">Sta. Isabel</option>
                                <option value="Sta. Maria">Sta. Maria</option>
                                <option value="Satiago">Satiago</option>
                                <option value="Sto. Niño">Sto. Niño</option>
                                <option value="Tagumpay">Tagumpay</option>
                                <option value="Tigkan">Tigkan</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editfield_total_area" class="form-label">Kabuuang Sukat</label>
                        <input type="text" name="field_total_area" id="editfield_total_area" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>