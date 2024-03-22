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
                                            <button type="button" class="btn btn-primary" style="background-color: #88c431; border: none;">View</button>
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