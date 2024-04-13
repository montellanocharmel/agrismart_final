<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header" style="margin-top: 4vh;">
                        <h4 style="color:#88c431; ">Damages</h4>
                        <div class=" box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form Active="#">
                                        <form method="post" action="/searchdamage">
                                            <div class="search_field">
                                                <input type="text" name="search_term" placeholder="Search Farmer Name...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="/damages" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="/exportToExceldamage" class="btn btn-primary"><i class="fa-regular fa-file-excel"></i></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Farmer Name</th>
                                        <th scope="col">Field Name</th>
                                        <th scope="col">Barangay</th>
                                        <th scope="col">Variety Name</th>
                                        <th scope="col">Damage Type</th>
                                        <th scope="col">Pest Type</th>
                                        <th scope="col">Severity</th>
                                        <th scope="col">Symptoms</th>
                                        <th scope="col">Actions Taken</th>
                                        <th scope="col">Weather Events</th>
                                        <th scope="col">Damage Descriptions</th>
                                        <th scope="col">Damage Severity</th>
                                        <th scope="col">Mitigation Measures</th>
                                        <th scope="col">Aksyon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($damages as $dam) : ?>
                                        <tr>
                                            <td><?= $dam['farmer_name'] ?></td>
                                            <td><?= $dam['field_name'] ?></td>
                                            <td><?= $dam['field_address'] ?></td>
                                            <td><?= $dam['crop_variety'] ?></td>
                                            <td><?= $dam['damage_type'] ?></td>
                                            <td><?= $dam['pest_type'] ?></td>
                                            <td><?= $dam['severity'] ?></td>
                                            <td><?= $dam['symptoms'] ?></td>
                                            <td><?= $dam['actions'] ?></td>
                                            <td><?= $dam['weather_events'] ?></td>
                                            <td><?= $dam['damage_descriptions'] ?></td>
                                            <td><?= $dam['damage_severity'] ?></td>
                                            <td><?= $dam['mitigation_measures'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #88c431; border: none;">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button type="button" class="dropdown-item" onclick="openEditDamageModal(
                                                        '<?= $dam['damage_id']; ?>',
                                                        '<?= $dam['pest_type']; ?>',
                                                        '<?= $dam['severity']; ?>',
                                                        '<?= $dam['symptoms']; ?>',
                                                        '<?= $dam['actions']; ?>',
                                                        '<?= $dam['weather_events']; ?>',
                                                        '<?= $dam['damage_descriptions']; ?>',
                                                        '<?= $dam['damage_severity']; ?>',
                                                        '<?= $dam['mitigation_measures']; ?>',
                                                        )">Edit</button>
                                                        <button type="button" class="dropdown-item" onclick="deleteDamage(<?= $dam['damage_id']; ?>)">Delete</button>
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


<!-- edit  -->
<div class="modal fade" id="editdamagemodal" tabindex="-1" aria-labelledby="editdamagemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editdamagemodalLabel">Edit Damage Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/damage/update" method="post">
                    <input type="hidden" name="damage_id" id="editdamage_id">
                    <div class="mb-3">
                        <label for="editpest_type" class="form-label">Pest Type</label>
                        <input type="text" name="pest_type" id="editpest_type" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editseverity" class="form-label">Severity</label>
                        <select name="severity" id="editseverity" class="form-control">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editsymptoms" class="form-label">Symptoms</label>
                        <textarea name="symptoms" id="editsymptoms" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editactions" class="form-label">Araw ng Pagtatanim</label>
                        <textarea name="actions" id="editactions" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editweather_events" class="form-label">weather_events</label>
                        <select name="weather_events" id="editweather_events" class="form-control">
                            <option value="typhoon">Bagyo</option>
                            <option value="flooding">Baha</option>
                            <option value="drought">Tagtuyot</option>
                            <option value="hightemperature">Sobrang Init ng Panahon</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editdamage_descriptions" class="form-label">Araw ng Pagsisimula ng Pagtatanim</label>
                        <textarea name="damage_descriptions" id="editdamage_descriptions" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editdamage_severity" class="form-label">Araw ng Pagtatapos ng Pagtatanim</label>
                        <select name="damage_severity" id="editdamage_severity" class="form-control">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editmitigation_measures" class="form-label">Pangalan ng Variety</label>
                        <textarea name="mitigation_measures" id="editmitigation_measures" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>