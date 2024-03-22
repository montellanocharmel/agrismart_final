<div class="main_content_iner ">
    <div class="container-fluid p-3">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="QA_section">
                    <div class="white_box_tittle list_header">
                        <h4 style="color:#88c431">Accounts</h4>
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
                                    <th scope="col">Pangalan ng Leader</th>
                                    <th scope="col">ID Number</th>
                                    <th scope="col">Barangay</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Kelan Ginawa ang Account</th>
                                    <th scope="col">Aksyon</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $us) : ?>
                                    <tr>
                                        <td><?= $us['leader_name'] ?></td>
                                        <td><?= $us['idnumber'] ?></td>
                                        <td><?= $us['barangay'] ?></td>
                                        <td><?= $us['position'] ?></td>
                                        <td><?= $us['created_at'] ?></td>
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