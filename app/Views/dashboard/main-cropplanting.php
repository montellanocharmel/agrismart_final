<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h3 style="color:#88c431">Crop Planting</h3>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchcropplanting">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Farmer Name...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addplantingmodal" class="btn btn-primary"><i class="fa-solid fa-plus"></i></a>
                                <a href="/cropplanting" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="/exportToExcelplanting" class="btn btn-primary"><i class="fa-regular fa-file-excel"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Pangalan ng Magbubukid</th>
                                    <th scope="col">Barangay</th>
                                    <th scope="col">Pangalan ng Bukid</th>
                                    <th scope="col">Pangalan ng Variety</th>
                                    <th scope="col">Araw ng Pagtatanim</th>
                                    <th scope="col">Season</th>
                                    <th scope="col">Simula ng Pagsasaka</th>
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
                                                        '<?= $pla['notes']; ?>',
                                                        )">Edit</button>
                                                    <button class="dropdown-item" onclick="deleteplanting(<?= $pla['planting_id']; ?>)">Delete</button>
                                                    <button type="button" class="dropdown-item" onclick="openAddDiseaseModal('<?= $pla['planting_id']; ?>', '<?= $pla['field_id']; ?>', '<?= $pla['field_name']; ?>', '<?= $pla['field_address']; ?>', '<?= $pla['farmer_name']; ?>', '<?= $pla['fims_code']; ?>', '<?= $pla['crop_variety']; ?>')">Add New Damage</button>
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
                        <label for="editnotes" class="form-label">Notes</label>
                        <textarea name="notes" id="editnotes" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Damage Modal -->
<div class="modal fade" id="adddamagemodal" role="dialog" aria-labelledby="adddamagemodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adddamagemodalLabel">Add Damage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/adddamage" method="post">
                    <div class="mb-3" hidden>
                        <label for="planting_id" class="form-label">ID</label>
                        <input type="text" name="planting_id" id="planting_id" class="form-control" readonly>
                    </div>
                    <div class="mb-3" hidden>
                        <label for="field_id" class="form-label">ID</label>
                        <input type="text" name="field_id" id="field_id" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="field_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="field_name" id="field_name_add" class="form-control" readonly>
                    </div>
                    <div class="mb-3" hidden>
                        <label for="field_address" class="form-label">Field Address</label>
                        <input type="text" name="field_address" id="field_address_add" class="form-control" readonly>
                    </div>
                    <div class="mb-3" hidden>
                        <label for="farmer_name" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="farmer_name" id="farmer_name_add" class="form-control" readonly>
                    </div>
                    <div class="mb-3" hidden>
                        <label for="fims_code" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="fims_code" id="fims_code_add" class="form-control" readonly>
                    </div>
                    <div class="mb-3" hidden>
                        <label for="crop_variety" class="form-label">Pangalan ng Bukid</label>
                        <input type="text" name="crop_variety" id="crop_variety_add" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="damage_type" class="form-label">Damage Type:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="damage_type" id="pest_disease" value="Pest Disease">
                            <label class="form-check-label" for="pest_disease">Damage Caused by Pest/Disease</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="damage_type" id="weather_related" value="Weather Related">
                            <label class="form-check-label" for="weather_related">Damage Caused by Weather</label>
                        </div>
                    </div>
                    <div id="pest_disease_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="pest_type" class="form-label">Type of pest or disease observed:</label>
                            <input type="text" name="pest_type" id="pest_type" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="severity" class="form-label">Severity:</label>
                            <select name="severity" id="severity" class="form-control">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="symptoms" class="form-label">Description of symptoms observed:</label>
                            <textarea name="symptoms" id="symptoms" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="actions" class="form-label">Actions taken or recommended treatment:</label>
                            <textarea name="actions" id="actions" class="form-control"></textarea>
                        </div>
                    </div>
                    <div id="weather_related_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="weather_events" class="form-label">Type of weather event:</label>
                            <select name="weather_events" id="weather_events" class="form-control">
                                <option value="typhoon">Bagyo</option>
                                <option value="flooding">Baha</option>
                                <option value="drought">Tagtuyot</option>
                                <option value="hightemperature">Sobrang Init ng Panahon</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="damage_description" class="form-label">Description of damage observed:</label>
                            <textarea name="damage_description" id="damage_description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="damage_severity" class="form-label">Severity of damage:</label>
                            <select name="damage_severity" id="damage_severity" class="form-control">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mitigation_measures" class="form-label">Actions taken or recommended mitigation measures:</label>
                            <textarea name="mitigation_measures" id="mitigation_measures" class="form-control"></textarea>
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
</div>


<!-- Add Damage Modal -->
<div class="modal fade" id="adddiseasemodal" role="dialog" aria-labelledby="adddiseasemodalLabel" aria-hidden="true">
    <br>
    <div class="modal-dialog modal-dialog-centered" style="z-index: 10000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adddiseasemodalLabel">Add Damage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/adddis" id="damageForm" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="damage_type" class="form-label">Type of Damage</label>
                        <div>
                            <input type="radio" name="damage_type" value="natural_disaster" onclick="toggleDamageFields('natural_disaster')"> Natural Disaster
                            <input type="radio" name="damage_type" value="disease" onclick="toggleDamageFields('disease')"> Disease
                            <input type="radio" name="damage_type" value="pest" onclick="toggleDamageFields('pest')"> Pest
                        </div>
                    </div>

                    <div id="common_fields" style="display: none;">
                        <input type="hidden" name="field_id" id="damage_field_id">
                        <input type="hidden" name="planting_id" id="damage_planting_id">
                        <input type="hidden" name="field_address" id="damage_field_address">
                        <input type="hidden" name="field_name" id="damage_field_name">
                        <input type="hidden" name="crop_variety" id="damage_crop_variety">
                        <input type="hidden" name="user_id" id="damage_user_id">
                        <input type="hidden" name="farmer_name" id="damage_farmer_name">
                        <input type="hidden" name="fims_code" id="damage_fims_code">
                    </div>

                    <!-- Natural Disaster Fields -->
                    <div id="natural_disaster_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="weather_events" class="form-label">Type of Weather Event:</label>
                            <select name="weather_events" id="weather_events" class="form-control">
                                <option value="Typhoon">Bagyo</option>
                                <option value="Flooding">Baha</option>
                                <option value="Drought">Tagtuyot</option>
                                <option value="High_Temperature">Sobrang Init ng Panahon</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="damage_description" class="form-label">Description of Damage Observed:</label>
                            <textarea name="damage_description" id="damage_description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="damage_severity" class="form-label">Severity of Damage:</label>
                            <select name="damage_severity" id="damage_severity" class="form-control">
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mititgation_measures" class="form-label">Actions Taken or Recommended Mitigation Measures:</label>
                            <textarea name="mititgation_measures" id="mititgation_measures" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- Disease Fields -->
                    <div id="disease_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="dis_image" class="form-label">Images</label>
                            <input type="file" name="dis_image" id="dis_image" placeholder="Disease Image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dis_name" class="form-label">Disease Name:</label>
                            <textarea name="dis_name" id="dis_name" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="dis_type" class="form-label">Disease Type:</label>
                            <textarea name="dis_type" id="dis_type" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="dis_desc" class="form-label">Disease Description:</label>
                            <textarea name="dis_desc" id="dis_desc" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="dis_solutions" class="form-label">Actions Taken or Recommended Mitigation Measures:</label>
                            <textarea name="dis_solutions" id="dis_solutions" class="form-control"></textarea>
                        </div>
                    </div>

                    <!-- Pest Fields -->
                    <div id="pest_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="pest_image" class="form-label">Images</label>
                            <input type="file" name="pest_image" id="pest_image" placeholder="Disease Image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="pest_name" class="form-label">Pest Name:</label>
                            <textarea name="pest_name" id="pest_name" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pest_desc" class="form-label">Pest Description:</label>
                            <textarea name="pest_desc" id="pest_desc" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pest_type" class="form-label">Pest Type:</label>
                            <textarea name="pest_type" id="pest_type" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="pest_solutions" class="form-label">Actions Taken or Recommended Mitigation Measures:</label>
                            <textarea name="pest_solutions" id="pest_solutions" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var pestDiseaseRadio = document.getElementById("pest_disease");
        var weatherRelatedRadio = document.getElementById("weather_related");
        var pestDiseaseFields = document.getElementById("pest_disease_fields");
        var weatherRelatedFields = document.getElementById("weather_related_fields");

        pestDiseaseRadio.addEventListener("change", function() {
            if (this.checked) {
                pestDiseaseFields.style.display = "block";
                weatherRelatedFields.style.display = "none";
            }
        });

        weatherRelatedRadio.addEventListener("change", function() {
            if (this.checked) {
                pestDiseaseFields.style.display = "none";
                weatherRelatedFields.style.display = "block";
            }
        });
    });
</script>
<script>
    function toggleDamageFields(damageType) {
        document.getElementById('natural_disaster_fields').style.display = damageType === 'natural_disaster' ? 'block' : 'none';
        document.getElementById('disease_fields').style.display = damageType === 'disease' ? 'block' : 'none';
        document.getElementById('pest_fields').style.display = damageType === 'pest' ? 'block' : 'none';
        document.getElementById('common_fields').style.display = 'block';
    }


    function openAddDiseaseModal(planting_id, field_id, field_name, field_address, farmer_name, fims_code, crop_variety) {
        document.getElementById('damage_planting_id').value = planting_id;
        document.getElementById('damage_field_id').value = field_id;
        document.getElementById('damage_field_name').value = field_name;
        document.getElementById('damage_field_address').value = field_address;
        document.getElementById('damage_farmer_name').value = farmer_name;
        document.getElementById('damage_fims_code').value = fims_code;
        document.getElementById('damage_crop_variety').value = crop_variety;
        $('#adddiseasemodal').modal('show');
    }
</script>