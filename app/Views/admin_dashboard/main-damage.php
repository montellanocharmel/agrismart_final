<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header" style="margin-top: 4vh;">
                        <h3 style="color:#88c431; ">Damages</h3>
                        <div class="box_right d-flex lms_block">
                            <div class="serach_field_2">
                                <div class="search_inner">
                                    <form method="post" action="/searchadmindamage">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Farmer Name or Damage Type...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2 d-flex align-items-center">
                                <a href="/admindamage" class="btn btn-primary me-2"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="/exportToExceladmindamage" class="btn btn-primary me-2"><i class="fa-regular fa-file-excel"></i></a>
                                <form action="/exportToPDFadmindamage" method="get" class="d-inline">
                                    <div class="input-group">
                                        <select name="filter" class="form-select">
                                            <option value="" disabled selected>Export File</option>
                                            <option value="all">All</option>
                                            <option value="pest">Pest</option>
                                            <option value="weather">Weather</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa-regular fa-file-pdf"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th scope="col">Farmer Name</th>
                                        <th scope="col">Barangay</th>
                                        <th scope="col">Weather Event</th>
                                        <th scope="col">Damage Description</th>
                                        <th scope="col">Severity</th>
                                        <th scope="col">Actions Taken</th>
                                        <th scope="col">Cost Estimation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($disaster as $item) : ?>
                                        <tr>
                                            <td><?= $item['farmer_name'] ?></td>
                                            <td><?= $item['field_address'] ?></td>
                                            <td><?= $item['weather_events'] ?></td>
                                            <td><?= $item['damage_description'] ?></td>
                                            <td><?= $item['damage_severity'] ?></td>
                                            <td><?= $item['mititgation_measures'] ?></td>
                                            <td><?= $item['cost_estimation'] ?></td>

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