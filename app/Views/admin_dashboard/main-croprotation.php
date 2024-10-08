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
                                    <form method="post" action="/searchadmincropplanting">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Farmer Name...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="/admincropplanting" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="/exportToExceladminplanting" class="btn btn-primary"><i class="fa-regular fa-file-excel"></i></a>
                                <a href="/exportToPDFadminplanting" class="btn btn-primary"><i class="fa-regular fa-file-pdf"></i></a>

                            </div>
                        </div>
                    </div>

                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Pangalan ng Bukid</th>
                                    <th scope="col">Pangalan ng Variety</th>
                                    <th scope="col">Araw ng Pagtatanim</th>
                                    <th scope="col">Season</th>
                                    <th scope="col">Simula ng Pagsasaka</th>
                                    <th scope="col">Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($planting as $pla) : ?>
                                    <tr>
                                        <td><?= $pla['field_name'] ?></td>
                                        <td><?= $pla['crop_variety'] ?></td>
                                        <td><?= $pla['planting_date'] ?></td>
                                        <td><?= $pla['season'] ?></td>
                                        <td><?= $pla['start_date'] ?></td>
                                        <td><?= $pla['notes'] ?></td>
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