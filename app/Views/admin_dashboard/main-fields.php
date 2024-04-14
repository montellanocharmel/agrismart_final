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
                                    <form method="post" action="/searchadminfields">
                                        <div class="search_field">
                                            <input type="text" name="search_term" placeholder="Search Farmer Name...">
                                        </div>
                                        <button type="submit"> <i class="ti-search"></i> </button>
                                    </form>
                                </div>
                            </div>
                            <div class="add_button ms-2">
                                <a href="/adminfields" class="btn btn-primary"><i class="fa-solid fa-arrows-rotate"></i></a>
                                <a href="/exportToExceladminfields" class="btn btn-primary"><i class="fa-regular fa-file-excel"></i></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="QA_table mb_30">
                        <table class="table lms_table_active">
                            <thead>
                                <tr>
                                    <th scope="col">Pangalan ng Magbubukid</th>
                                    <th scope="col">Pangalan ng Bukid</th>
                                    <th scope="col">May-ari ng Lupa</th>
                                    <th scope="col">Address ng Bukid</th>
                                    <th scope="col">Kabuuang Sukat</th>
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