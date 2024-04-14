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
                                        <form method="post" action="/searchadmindamage">
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
                                <a href="/admindamage" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="/exportToExceladmindamage" class="btn btn-primary"><i class="fa-regular fa-file-excel"></i></i></a>
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